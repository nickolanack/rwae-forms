<?php

/**
 * This is the front end controller for RWA forms and ajax methods.
 * provides access to the current users forms, create delete etc.
 */

if (!defined('_JEXEC')) {
    define('_JOOMLA', 1);
}

/**
 * use php-core-app a web-app framework for php
 * and joomla.
 */
include_once 'php-core-app/core.php';
Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

if (UrlVar('task') == 'create-new-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewClientScheduleD();
    return;

} elseif (UrlVar('task') == 'create-new-addendum') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewClientAddendum();
    return;

} elseif (UrlVar('task') == 'create-new-quarterly') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::CreateNewClientQuarterly();
    return;

} elseif (UrlVar('task') == 'list-scheduled') {

    include_once __DIR__ . DS . 'lib' . DS . 'Ajax.php';
    Ajax::ListClientScheduleD();
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

}

Scaffold('user.panel', array(
    'url' => UrlFrom(__FILE__),
), __DIR__ . DS . 'views');
