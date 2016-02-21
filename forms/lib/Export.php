<?php

class Export
{

    public static function ExportScheduleDForms()
    {
        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        $csv = null;
        $db->iterateAllSchedules(
            function ($record) use (&$csv) {

                $form = get_object_vars(json_decode($record->formData));

                if (empty($csv)) {
                    $keys = array_merge(array(), array_keys($form));
                    $csv = EasyCsv::CreateCsv($keys);
                }
                EasyCsv::AddRow($csv, array_values($form));
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
        $csv = null;
        $db->iterateAllAddendums(
            function ($record) use (&$csv) {

                $form = get_object_vars(json_decode($record->formData));

                if (empty($csv)) {
                    $keys = array_merge(array(), array_keys($form));
                    $csv = EasyCsv::CreateCsv($keys);
                }
                EasyCsv::AddRow($csv, array_values($form));
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
        $csv = null;
        $db->iterateAllQuarterlys(
            function ($record) use (&$csv) {

                $form = get_object_vars(json_decode($record->formData));

                if (empty($csv)) {
                    $keys = array_merge(array(), array_keys($form));
                    $csv = EasyCsv::CreateCsv($keys);
                }
                EasyCsv::AddRow($csv, array_values($form));
            });

        header('Content-Type: application/csv;');
        header('Content-disposition: filename="rwa-export-quarterly-' . date('Y-m-d') . '.csv"');
        echo EasyCsv::Write($csv);

        return;
    }

}
