<?php

class Export
{

    public static function ExportScheduleDForms()
    {
        include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        include_once __DIR__ . '/RWAForm.php';
        $fieldsNames = array_unique(array_merge(array('id', 'code', 'submitDate', 'formDate'), RWAForm::GetFieldNames('scheduled')));
        $csv = EasyCsv::CreateCsv($fieldsNames);
        $db->iterateAllSchedules(
            function ($record) use (&$csv, $fieldsNames) {


                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $theValue = $form[$field];
                        if(is_object($theValue)||is_array($theValue)){
                            $theValue=json_encode($theValue);
                        }
                        $values[] = $theValue;
                    } else {
                        $values[] = "";
                    }
                }


                $values[0]=$record->id;
                $values[1]=$record->code;
                $values[2]=$record->submitDate;
                $values[3]=$record->formDate;

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
        $fieldsNames = array_unique(array_merge(array('id', 'code', 'submitDate', 'formDate'), RWAForm::GetFieldNames('addendum')));
        $csv = EasyCsv::CreateCsv($fieldsNames);

        $db->iterateAllAddendums(
            function ($record) use (&$csv, $fieldsNames) {

                

                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $theValue = $form[$field];
                        if(is_object($theValue)||is_array($theValue)){
                            $theValue=json_encode($theValue);
                        }
                        $values[] = $theValue;
                    } else {
                        $values[] = "";
                    }
                }

                $values[0]=$record->id;
                $values[1]=$record->code;
                $values[2]=$record->submitDate;
                $values[3]=$record->formDate;


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
        $fieldsNames = array_unique(array_merge(array('id', 'code', 'submitDate', 'formDate'), RWAForm::GetFieldNames('quarterly')));
        $csv = EasyCsv::CreateCsv($fieldsNames);

        $db->iterateAllQuarterlys(
            function ($record) use (&$csv, $fieldsNames) {

     

                $form = get_object_vars(json_decode($record->formData));

                $values = array();
                foreach ($fieldsNames as $field) {
                    if (key_exists($field, $form)) {
                        $theValue = $form[$field];
                        if(is_object($theValue)||is_array($theValue)){
                            $theValue=json_encode($theValue);
                        }
                        $values[] = $theValue;
                    } else {
                        $values[] = "";
                    }
                }


                $values[0]=$record->id;
                $values[1]=$record->code;
                $values[2]=$record->submitDate;
                $values[3]=$record->formDate;

                EasyCsv::AddRow($csv, $values);
            });

        header('Content-Type: application/csv;');
        header('Content-disposition: filename="rwa-export-quarterly-' . date('Y-m-d') . '.csv"');
        echo EasyCsv::Write($csv);

        return;
    }

}
