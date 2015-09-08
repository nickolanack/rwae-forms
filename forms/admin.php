<?php
error_reporting(E_ALL ^ E_NOTICE); // report everything except notices
ini_set('display_errors', 1);

if (! defined('_JEXEC')) {
    // make sure that core.php detects joomla environment
    define('_JEXEC', 1);
}

include_once 'php-core-app/core.php';

Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

?><link rel="stylesheet"
	href="<?php echo UrlFrom(__DIR__ . DS . 'css' . DS . 'forms.css');?>"
	type="text/css"><?php

Scaffold('cpanel.button', 
    array(
        'title' => 'Show All Schedule D Forms',
        'className' => 'btn btn-primary',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_table.png?tint=rgb(255,255,255)',
        'script' => '

            alert("test");

        '
    ));

Scaffold('cpanel.button', 
    array(
        'title' => 'Show All Schedule D Authors',
        'className' => 'btn btn-primary',
        'icon' => Core::AssetsDir() . DS . 'Tile Icons' . DS . 'profile.png?tint=rgb(255,255,255)',
        'script' => '

            alert("test");

        '
    ));

Scaffold('cpanel.button', 
    array(
        'title' => 'Generate Reports',
        'className' => 'btn btn-success',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_clipboard.png?tint=rgb(255,255,255)',
        'script' => '

            alert("test");

        '
    ));

/* @var $db ScheduleDatabase */
include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
$db = ScheduleDatabase::GetInstance();

foreach ($db->tables() as $table) {
    
    $updates = $db->verifyTable($table);
    if (count($updates)) {
        array_walk($updates, function ($alter) use($db) {
            $db->execute($alter);
        });
    }
}
