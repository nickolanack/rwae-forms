<?php
/**
 *
 * @author nblackwe
 *
 */
class FormTest extends PHPUnit_Framework_TestCase
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

        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        include_once dirname(__DIR__) . DS . 'forms/lib' . DS . 'RWAForm.php';
        $db = ScheduleDatabase::GetInstance();

        $fields = RWAForm::GetFieldNames('scheduled');
        $db->iterateAllSchedules(
            function ($record) use ($fields) {

                $formdata = get_object_vars(json_decode($record->formData));

                echo 'Missing Fields: ' . print_r(array_diff($fields, array_keys($formdata)), true) . "\n";
                echo 'Extra Fields: ' . print_r(array_diff(array_keys($formdata), $fields), true) . "\n";

            });

        $fields = RWAForm::GetFieldNames('addendum');
        $db->iterateAllAddendums(
            function ($record) use ($fields) {

                $formdata = get_object_vars(json_decode($record->formData));

                echo 'Missing Fields: ' . print_r(array_diff($fields, array_keys($formdata)), true) . "\n";
                echo 'Extra Fields: ' . print_r(array_diff(array_keys($formdata), $fields), true) . "\n";

            });

        $fields = RWAForm::GetFieldNames('quarterly');
        $db->iterateAllQuarterlys(
            function ($record) use ($fields) {

                $formdata = get_object_vars(json_decode($record->formData));

                echo 'Missing Fields: ' . print_r(array_diff($fields, array_keys($formdata)), true) . "\n";
                echo 'Extra Fields: ' . print_r(array_diff(array_keys($formdata), $fields), true) . "\n";

            });

    }

    /**
     * @runInSeparateProcess
     */
    public function testExportFormsMetadata()
    {

        $this->_includeCore();

        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        include_once dirname(__DIR__) . DS . 'forms/lib' . DS . 'RWAForm.php';
        $db = ScheduleDatabase::GetInstance();

        $fieldsNames = RWAForm::GetFieldNames('scheduled');
        $fieldValuesArray = array();

        $db->iterateAllSchedules(
            function ($record) use ($fieldsNames, &$fieldValuesArray) {

                $form = get_object_vars(json_decode($record->formData));
                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $values[] = $form[$field];
                    } else {
                        $values[] = "";
                    }
                }

                $fieldValuesArray[] = $values;

            });

        echo print_r($fieldsNames, true) . print_r($fieldValuesArray, true) . "\n";

    }

}
