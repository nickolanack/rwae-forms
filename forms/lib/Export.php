<?php

class Export
{

    public static function ExportScheduleDForms()
    {
        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        include_once __DIR__ . '/RWAForm.php';
        $fieldsNames = RWAForm::GetFieldNames('scheduled');
        $csv = EasyCsv::CreateCsv($fieldsNames);
        $db->iterateAllSchedules(
            function ($record) use (&$csv, $fieldsNames) {

                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $values[] = $form[$field];
                    } else {
                        $values[] = "";
                    }
                }
                EasyCsv::AddRow($csv, $values);
            });

        header('Content-Type: application/csv;');
        header('Content-disposition: filename="rwa-export-scheduled-' . date('Y-m-d') . '.csv"');
        echo EasyCsv::Write($csv);

        return;
    }

    public static function ExportAddendumForms()
    {
        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        include_once __DIR__ . '/RWAForm.php';
        $fieldsNames = RWAForm::GetFieldNames('addendum');
        $csv = EasyCsv::CreateCsv($fieldsNames);

        $db->iterateAllAddendums(
            function ($record) use (&$csv, $fieldsNames) {

                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $values[] = $form[$field];
                    } else {
                        $values[] = "";
                    }
                }

                EasyCsv::AddRow($csv, $values);
            });

        header('Content-Type: application/csv;');
        header('Content-disposition: filename="rwa-export-addendum-' . date('Y-m-d') . '.csv"');
        echo EasyCsv::Write($csv);

        return;
    }

    public static function ExportQuarterlyForms()
    {
        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        include_once __DIR__ . '/RWAForm.php';
        $fieldsNames = RWAForm::GetFieldNames('quarterly');
        $csv = EasyCsv::CreateCsv($fieldsNames);

        $db->iterateAllQuarterlys(
            function ($record) use (&$csv, $fieldsNames) {

                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $values[] = $form[$field];
                    } else {
                        $values[] = "";
                    }
                }

                EasyCsv::AddRow($csv, $values);
            });

        header('Content-Type: application/csv;');
        header('Content-disposition: filename="rwa-export-quarterly-' . date('Y-m-d') . '.csv"');
        echo EasyCsv::Write($csv);

        return;
    }

}
