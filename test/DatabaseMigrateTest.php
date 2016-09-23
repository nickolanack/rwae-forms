<?php
/**
 *
 * @author nblackwe
 *
 */
class DatabaseTest extends PHPUnit_Framework_TestCase
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
    public function testDatabase()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $db->iterateAllSchedules(function ($row) use (&$db) {

            $formData = json_decode($row->formData);
            $this->assertTrue(is_object($formData));
            $needsUpdate = false;
            $keys = array('job-1-type', 'job-2-type', 'job-3-type');
            foreach ($keys as $key) {
                if (strpos($formData->$key, 'seasonal') !== false) {
                    //$this->fail($key . '=' . $formData->$key);
                    $formData->$key = 'seasonal';
                    $needsUpdate = true;
                }
                if (strpos($formData->$key, 'permanent') !== false) {
                    //$this->fail($key . '=' . $formData->$key);
                    $formData->$key = 'permanent';
                    $needsUpdate = true;
                }
            }

            $formJson = json_encode($formData, JSON_PRETTY_PRINT);
            $update = array('id' => $row->id, 'formData' => $formJson);
            if ($needsUpdate) {
                //$db->updateSchedule($update);
                //$this->fail(print_r($update, true));
            }

        });

        $db->iterateAllAddendums(function ($row) use (&$db) {

            $formData = json_decode($row->formData);
            $this->assertTrue(is_object($formData));
            $needsUpdate = false;
            $keys = array('job-1-type', 'job-2-type', 'job-3-type');
            foreach ($keys as $key) {
                if (strpos($formData->$key, 'seasonal') !== false) {
                    //$this->fail($key . '=' . $formData->$key);
                    $formData->$key = 'seasonal';
                    $needsUpdate = true;
                }
                if (strpos($formData->$key, 'permanent') !== false) {
                    //$this->fail($key . '=' . $formData->$key);
                    $formData->$key = 'permanent';
                    $needsUpdate = true;
                }
            }

            $formJson = json_encode($formData, JSON_PRETTY_PRINT);
            $update = array('id' => $row->id, 'formData' => $formJson);

            if ($needsUpdate) {
                //$db->updateAddendum($update);
                $this->fail(print_r($update, true));
            }

        });

        //$this->assertTrue(true);

    }

}
