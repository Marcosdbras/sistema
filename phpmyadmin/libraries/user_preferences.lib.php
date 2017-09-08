<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Functions for displaying user preferences pages
 *
 * @package PhpMyAdmin
 */
use PhpMyAdmin\Config\ConfigFile;
use PhpMyAdmin\Config\Forms\User\UserFormList;
use PhpMyAdmin\Core;
use PhpMyAdmin\Message;
use PhpMyAdmin\Relation;
use PhpMyAdmin\Url;

if (! defined('PHPMYADMIN')) {
    exit;
}

/**
 * Common initialization for user preferences modification pages
 *
 * @param ConfigFile $cf Config file instance
 *
 * @return void
 */
function PMA_userprefsPageInit(ConfigFile $cf)
{
    $forms_all_keys = UserFormList::getFields();
    $cf->resetConfigData(); // start with a clean instance
    $cf->setAllowedKeys($forms_all_keys);
    $cf->setCfgUpdateReadMapping(
        array(
            'Server/hide_db' => 'Servers/1/hide_db',
            'Server/only_db' => 'Servers/1/only_db'
        )
    );
    $cf->updateWithGlobalConfig($GLOBALS['cfg']);
}

/**
 * Loads user preferences
 *
 * Returns an array:
 * * config_data - path => value pairs
 * * mtime - last modification time
 * * type - 'db' (config read from pmadb) or 'session' (read from user session)
 *
 * @return array
 */
function PMA_loadUserprefs()
{
    $cfgRelation = Relation::getRelationsParam();
    if (! $cfgRelation['userconfigwork']) {
        // no pmadb table, use session storage
        if (! isset($_SESSION['userconfig'])) {
            $_SESSION['userconfig'] = array(
                'db' => array(),
                'ts' => time());
        }
        return array(
            'config_data' => $_SESSION['userconfig']['db'],
            'mtime' => $_SESSION['userconfig']['ts'],
            'type' => 'session');
    }
    // load configuration from pmadb
    $query_table = PhpMyAdmin\Util::backquote($cfgRelation['db']) . '.'
        . PhpMyAdmin\Util::backquote($cfgRelation['userconfig']);
    $query = 'SELECT `config_data`, UNIX_TIMESTAMP(`timevalue`) ts'
        . ' FROM ' . $query_table
        . ' WHERE `username` = \''
        . $GLOBALS['dbi']->escapeString($cfgRelation['user'])
        . '\'';
    $row = $GLOBALS['dbi']->fetchSingleRow($query, 'ASSOC', $GLOBALS['controllink']);

    return array(
        'config_data' => $row ? (array)json_decode($row['config_data']) : array(),
        'mtime' => $row ? $row['ts'] : time(),
        'type' => 'db');
}

/**
 * Saves user preferences
 *
 * @param array $config_array configuration array
 *
 * @return true|PhpMyAdmin\Message
 */
function PMA_saveUserprefs(array $config_array)
{
    $cfgRelation = Relation::getRelationsParam();
    $server = isset($GLOBALS['server'])
        ? $GLOBALS['server']
        : $GLOBALS['cfg']['ServerDefault'];
    $cache_key = 'server_' . $server;
    if (! $cfgRelation['userconfigwork']) {
        // no pmadb table, use session storage
        $_SESSION['userconfig'] = array(
            'db' => $config_array,
            'ts' => time());
        if (isset($_SESSION['cache'][$cache_key]['userprefs'])) {
            unset($_SESSION['cache'][$cache_key]['userprefs']);
        }
        return true;
    }

    // save configuration to pmadb
    $query_table = PhpMyAdmin\Util::backquote($cfgRelation['db']) . '.'
        . PhpMyAdmin\Util::backquote($cfgRelation['userconfig']);
    $query = 'SELECT `username` FROM ' . $query_table
        . ' WHERE `username` = \''
        . $GLOBALS['dbi']->escapeString($cfgRelation['user'])
        . '\'';

    $has_config = $GLOBALS['dbi']->fetchValue(
        $query, 0, 0, $GLOBALS['controllink']
    );
    $config_data = json_encode($config_array);
    if ($has_config) {
        $query = 'UPDATE ' . $query_table
            . ' SET `timevalue` = NOW(), `config_data` = \''
            . $GLOBALS['dbi']->escapeString($config_data)
            . '\''
            . ' WHERE `username` = \''
            . $GLOBALS['dbi']->escapeString($cfgRelation['user'])
            . '\'';
    } else {
        $query = 'INSERT INTO ' . $query_table
            . ' (`username`, `timevalue`,`config_data`) '
            . 'VALUES (\''
            . $GLOBALS['dbi']->escapeString($cfgRelation['user']) . '\', NOW(), '
            . '\'' . $GLOBALS['dbi']->escapeString($config_data) . '\')';
    }
    if (isset($_SESSION['cache'][$cache_key]['userprefs'])) {
        unset($_SESSION['cache'][$cache_key]['userprefs']);
    }
    if (!$GLOBALS['dbi']->tryQuery($query, $GLOBALS['controllink'])) {
        $message = Message::error(__('Could not save configuration'));
        $message->addMessage(
            Message::rawError(
                $GLOBALS['dbi']->getError($GLOBALS['controllink'])
            ),
            '<br /><br />'
        );
        return $message;
    }
    return true;
}

/**
 * Returns a user preferences array filtered by $cfg['UserprefsDisallow']
 * (blacklist) and keys from user preferences form (whitelist)
 *
 * @param array $config_data path => value pairs
 *
 * @return array
 */
function PMA_applyUserprefs(array $config_data)
{
    $cfg = array();
    $blacklist = array_flip($GLOBALS['cfg']['UserprefsDisallow']);
    $whitelist = array_flip(UserFormList::getFields());
    // whitelist some additional fields which are custom handled
    $whitelist['ThemeDefault'] = true;
    $whitelist['fontsize'] = true;
    $whitelist['lang'] = true;
    $whitelist['collation_connection'] = true;
    $whitelist['Server/hide_db'] = true;
    $whitelist['Server/only_db'] = true;
    foreach ($config_data as $path => $value) {
        if (! isset($whitelist[$path]) || isset($blacklist[$path])) {
            continue;
        }
        Core::arrayWrite($path, $cfg, $value);
    }
    return $cfg;
}

/**
 * Updates one user preferences option (loads and saves to database).
 *
 * No validation is done!
 *
 * @param string $path          configuration
 * @param mixed  $value         value
 * @param mixed  $default_value default value
 *
 * @return void
 */
function PMA_persistOption($path, $value, $default_value)
{
    $prefs = PMA_loadUserprefs();
    if ($value === $default_value) {
        if (isset($prefs['config_data'][$path])) {
            unset($prefs['config_data'][$path]);
        } else {
            return;
        }
    } else {
        $prefs['config_data'][$path] = $value;
    }
    PMA_saveUserprefs($prefs['config_data']);
}

/**
 * Redirects after saving new user preferences
 *
 * @param string $file_name Filename
 * @param array  $params    URL parameters
 * @param string $hash      Hash value
 *
 * @return void
 */
function PMA_userprefsRedirect($file_name,
    $params = null, $hash = null
) {
    // redirect
    $url_params = array('saved' => 1);
    if (is_array($params)) {
        $url_params = array_merge($params, $url_params);
    }
    if ($hash) {
        $hash = '#' . urlencode($hash);
    }
    Core::sendHeaderLocation('./' . $file_name
        . Url::getCommonRaw($url_params) . $hash
    );
}

/**
 * Shows form which allows to quickly load
 * settings stored in browser's local storage
 *
 * @return string
 */
function PMA_userprefsAutoloadGetHeader()
{
    if (isset($_REQUEST['prefs_autoload'])
        && $_REQUEST['prefs_autoload'] == 'hide'
    ) {
        $_SESSION['userprefs_autoload'] = true;
        return '';
    }

    $script_name = basename(basename($GLOBALS['PMA_PHP_SELF']));
    $return_url = $script_name . '?' . http_build_query($_GET, '', '&');

    return PhpMyAdmin\Template::get('prefs_autoload')
        ->render(
            array(
                'hidden_inputs' => Url::getHiddenInputs(),
                'return_url' => $return_url,
            )
        );
}
