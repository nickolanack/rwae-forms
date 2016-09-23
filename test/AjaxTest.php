<?php
/**
 *
 * @author nblackwe
 *
 */
class AjaxTest extends PHPUnit_Framework_TestCase
{

    protected function _includeCore()
    {
        if (!defined('_JEXEC')) {
            define('_JOOMLA', 1);
        }

/**
 * use php-core-app a web-app framework for php
 * and joomla.
 */
        include_once dirname(__DIR__) . '/forms/php-core-app/core.php';
        Core::Parameters()->disableCaching();
        Core::Parameters()->disableCompression();

        Core::HTML()->setDomain('example.com')->setScriptPath('index.php');

    }

    /**
     * @runInSeparateProcess
     */
    public function testFormsMetadata()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';


    }

}
