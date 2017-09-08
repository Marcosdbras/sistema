<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Schema export handler
 *
 * @package PhpMyAdmin
 */

use PhpMyAdmin\Core;
use PhpMyAdmin\Plugins\SchemaPlugin;
use PhpMyAdmin\Relation;

/**
 * Gets some core libraries
 */
require_once 'libraries/common.inc.php';

/**
 * get all variables needed for exporting relational schema
 * in $cfgRelation
 */
$cfgRelation = Relation::getRelationsParam();

require_once 'libraries/pmd_common.php';
require_once 'libraries/plugin_interface.lib.php';

if (! isset($_REQUEST['export_type'])) {
    PhpMyAdmin\Util::checkParameters(array('export_type'));
}

/**
 * Include the appropriate Schema Class depending on $export_type
 * default is PDF
 */
PMA_processExportSchema($_REQUEST['export_type']);

/**
 * get all the export options and verify
 * call and include the appropriate Schema Class depending on $export_type
 *
 * @param string $export_type format of the export
 *
 * @return void
 */
function PMA_processExportSchema($export_type)
{
    /**
     * default is PDF, otherwise validate it's only letters a-z
     */
    if (! isset($export_type) || ! preg_match('/^[a-zA-Z]+$/', $export_type)) {
        $export_type = 'pdf';
    }

    // sanitize this parameter which will be used below in a file inclusion
    $export_type = Core::securePath($export_type);

    // get the specific plugin
    /* @var $export_plugin SchemaPlugin */
    $export_plugin = PMA_getPlugin(
        "schema",
        $export_type,
        'libraries/classes/Plugins/Schema/'
    );

    // Check schema export type
    if (! isset($export_plugin)) {
        Core::fatalError(__('Bad type!'));
    }

    $GLOBALS['dbi']->selectDb($GLOBALS['db']);
    $export_plugin->exportSchema($GLOBALS['db']);
}
