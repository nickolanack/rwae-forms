<?php
error_reporting(E_ALL ^ E_NOTICE); // report everything except notices
ini_set('display_errors', 1);

if (!defined('_JEXEC')) {
    define('_JOOMLA', 1);
}

include_once 'php-core-app/core.php';
Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

if (UrlVar('task') == 'create-new-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewAdminScheduleD();
    return;

} elseif (UrlVar('task') == 'create-new-addendum') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewAdminAddendum();
    return;

} elseif (UrlVar('task') == 'create-new-quarterly') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewAdminQuarterly();
    return;

} elseif (UrlVar('task') == 'list-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::ListAdminScheduleD();
    return;

} elseif (UrlVar('task') == 'list-addendums-quarterlys') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::ListAddendumsAndQuarterlies();
    return;

} elseif (UrlVar('task') == 'delete-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::DeleteScheduleD();
    return;

} elseif (UrlVar('task') == 'delete-quarterly') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::DeleteQuarterly();
    return;

} elseif (UrlVar('task') == 'delete-addendum') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::DeleteAddendum();
    return;

} elseif (UrlVar('task') == 'export-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Export.php';
    Export::ExportScheduleDForms();
    return;

} elseif (UrlVar('task') == 'export-addendum') {

    include_once __DIR__ . DS . 'lib' . DS . 'Export.php';
    Export::ExportAddendumForms();
    return;

} elseif (UrlVar('task') == 'export-quarterly') {

    include_once __DIR__ . DS . 'lib' . DS . 'Export.php';
    Export::ExportQuarterlyForms();
    return;

} elseif (UrlVar('task') == 'list-users') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::ListUsers();
    return;
}

Scaffold('user.admin.panel', array(
    'url' => UrlFrom(__FILE__),
), __DIR__ . DS . 'views');

/* @var $db ScheduleDatabase */
include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
$db = ScheduleDatabase::GetInstance();
$total = 0;
foreach ($db->tables() as $table) {

    $updates = $db->verifyTable($table);
    if (count($updates)) {
        array_walk($updates,
            function ($alter) use ($db) {
                $db->execute($alter);
                $count++;
            });
    }
}
echo '<!-- ';
echo "<br/><br/>by the way, the database was just validated";
if ($total > 0) {

    echo " and "+$total+" update"+($total == 1 ? "" : "s")+" where made";
} else {

    echo " and it is perfect! (as I expected)";
}
echo ' -->';
