<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Normalization process (temporarily specific to 1NF)
 *
 * @package PhpMyAdmin
 */

use PhpMyAdmin\Core;
use PhpMyAdmin\Normalization;
use PhpMyAdmin\Response;
use PhpMyAdmin\Url;

/**
 *
 */
require_once 'libraries/common.inc.php';

if (isset($_REQUEST['getColumns'])) {
    $html = '<option selected disabled>' . __('Select one…') . '</option>'
        . '<option value="no_such_col">' . __('No such column') . '</option>';
    //get column whose datatype falls under string category
    $html .= Normalization::getHtmlForColumnsList(
        $db,
        $table,
        _pgettext('string types', 'String')
    );
    echo $html;
    exit;
}
if (isset($_REQUEST['splitColumn'])) {
    $num_fields = min(4096, intval($_REQUEST['numFields']));
    $html = Normalization::getHtmlForCreateNewColumn($num_fields, $db, $table);
    $html .= Url::getHiddenInputs($db, $table);
    echo $html;
    exit;
}
if (isset($_REQUEST['addNewPrimary'])) {
    $num_fields = 1;
    $columnMeta = array('Field'=>$table . "_id", 'Extra'=>'auto_increment');
    $html = Normalization::getHtmlForCreateNewColumn(
        $num_fields, $db, $table, $columnMeta
    );
    $html .= Url::getHiddenInputs($db, $table);
    echo $html;
    exit;
}
if (isset($_REQUEST['findPdl'])) {
    $html = Normalization::findPartialDependencies($table, $db);
    echo $html;
    exit;
}

if (isset($_REQUEST['getNewTables2NF'])) {
    $partialDependencies = json_decode($_REQUEST['pd']);
    $html = Normalization::getHtmlForNewTables2NF($partialDependencies, $table);
    echo $html;
    exit;
}

$response = Response::getInstance();

if (isset($_REQUEST['getNewTables3NF'])) {
    $dependencies = json_decode($_REQUEST['pd']);
    $tables = json_decode($_REQUEST['tables']);
    $newTables = Normalization::getHtmlForNewTables3NF($dependencies, $tables, $db);
    $response->disable();
    Core::headerJSON();
    echo json_encode($newTables);
    exit;
}

$header = $response->getHeader();
$scripts = $header->getScripts();
$scripts->addFile('normalization.js');
$scripts->addFile('vendor/jquery/jquery.uitablefilter.js');
$normalForm = '1nf';
if (Core::isValid($_REQUEST['normalizeTo'], array('1nf', '2nf', '3nf'))) {
    $normalForm = $_REQUEST['normalizeTo'];
}
if (isset($_REQUEST['createNewTables2NF'])) {
    $partialDependencies = json_decode($_REQUEST['pd']);
    $tablesName = json_decode($_REQUEST['newTablesName']);
    $res = Normalization::createNewTablesFor2NF($partialDependencies, $tablesName, $table, $db);
    $response->addJSON($res);
    exit;
}
if (isset($_REQUEST['createNewTables3NF'])) {
    $newtables = json_decode($_REQUEST['newTables']);
    $res = Normalization::createNewTablesFor3NF($newtables, $db);
    $response->addJSON($res);
    exit;
}
if (isset($_POST['repeatingColumns'])) {
    $repeatingColumns = $_POST['repeatingColumns'];
    $newTable = $_POST['newTable'];
    $newColumn = $_POST['newColumn'];
    $primary_columns = $_POST['primary_columns'];
    $res = Normalization::moveRepeatingGroup(
        $repeatingColumns, $primary_columns, $newTable, $newColumn, $table, $db
    );
    $response->addJSON($res);
    exit;
}
if (isset($_REQUEST['step1'])) {
    $html = Normalization::getHtmlFor1NFStep1($db, $table, $normalForm);
    $response->addHTML($html);
} else if (isset($_REQUEST['step2'])) {
    $res = Normalization::getHtmlContentsFor1NFStep2($db, $table);
    $response->addJSON($res);
} else if (isset($_REQUEST['step3'])) {
    $res = Normalization::getHtmlContentsFor1NFStep3($db, $table);
    $response->addJSON($res);
} else if (isset($_REQUEST['step4'])) {
    $res = Normalization::getHtmlContentsFor1NFStep4($db, $table);
    $response->addJSON($res);
} else if (isset($_REQUEST['step']) && $_REQUEST['step'] == '2.1') {
    $res = Normalization::getHtmlFor2NFstep1($db, $table);
    $response->addJSON($res);
} else if (isset($_REQUEST['step']) && $_REQUEST['step'] == '3.1') {
    $tables = $_REQUEST['tables'];
    $res = Normalization::getHtmlFor3NFstep1($db, $tables);
    $response->addJSON($res);
} else {
    $response->addHTML(Normalization::getHtmlForNormalizetable());
}
