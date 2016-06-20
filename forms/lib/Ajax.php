<?php

class Ajax
{

    public static function CreateNewClientScheduleD()
    {

        self::_CreateNewScheduleDForUser(Core::Client()->getUserId());
    }
    public static function CreateNewAdminScheduleD()
    {
        self::_CreateNewScheduleDForUser();
    }
    public static function _CreateNewScheduleDForUser($uid = -1)
    {

        include_once __DIR__ . DS . 'RWAForm.php';
        $data = RWAForm::ValidateScheduleDData(json_decode(UrlVar('json')));

        /* @var $db ScheduleDatabase */
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $entry = array(
            'code' => $data->{'participant-id'},

            'formDate' => RWAForm::GetFormDate($data),
        );

        if ($uid >= 0) {
            $entry['uid'] = $uid;
        }

        $update = false;

        if (key_exists('id', $data)) {
            if ($data->id > 0) {
                $entry['id'] = $data->id;
                $id = $data->id;

                $update = true;
            }
            unset($data->id);
        }
        $entry['formData'] = json_encode($data, JSON_PRETTY_PRINT);
        if ($update) {
            $db->updateSchedule($entry);
        } else {
            $date = date('Y-m-d H:i:s');
            $entry['submitDate'] = $date;
            $entry['uid'] = Core::Client()->getUserId();
            $id = $db->createSchedule($entry);
        }

        echo json_encode(array(
            'success' => true,
            'result' => array(
                'id' => $id,
            ),
        ), JSON_PRETTY_PRINT);
    }

    public static function CreateNewClientAddendum()
    {
        self::_CreateNewAddendumForUser(Core::Client()->getUserId());
    }
    public static function CreateNewAdminAddendum()
    {
        self::_CreateNewAddendumForUser();
    }
    public static function _CreateNewAddendumForUser($uid = -1)
    {

        include_once __DIR__ . DS . 'RWAForm.php';
        $data = RWAForm::ValidateAddendumData(json_decode(UrlVar('json')));

        /* @var $db ScheduleDatabase */
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $entry = array(
            'code' => $data->{'participant-id'},
            'formDate' => RWAForm::GetFormDate($data),
        );
        if ($uid >= 0) {
            $entry['uid'] = $uid;
        }

        $update = false;

        if (key_exists('id', $data) && $data->id > 0) {
            $entry['id'] = $data->id;
            $id = $data->id;
            unset($data->id);
            $update = true;
        }
        $entry['formData'] = json_encode($data, JSON_PRETTY_PRINT);
        if ($update) {
            $db->updateAddendum($entry);
        } else {
            $date = date('Y-m-d H:i:s');
            $entry['submitDate'] = $date;
            $entry['uid'] = Core::Client()->getUserId();
            $id = $db->createAddendum($entry);
        }

        echo json_encode(array(
            'success' => true,
            'result' => array(
                'id' => $id,
            ),
        ), JSON_PRETTY_PRINT);

    }

    public static function CreateNewClientQuarterly()
    {
        self::_CreateNewQuarterlyForUser(Core::Client()->getUserId());
    }
    public static function CreateNewAdminQuarterly()
    {

        self::_CreateNewQuarterlyForUser();
    }
    public static function _CreateNewQuarterlyForUser($uid = -1)
    {

        include_once __DIR__ . DS . 'RWAForm.php';
        $data = RWAForm::ValidateAddendumData(json_decode(UrlVar('json')));

        /* @var $db ScheduleDatabase */
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $entry = array(
            'code' => $data->{'participant-id'},
            'formDate' => RWAForm::GetFormDate($data),
        );
        if ($uid >= 0) {
            $entry['uid'] = $uid;
        }

        $update = false;

        if (key_exists('id', $data)) {
            if ($data->id > 0) {
                $entry['id'] = $data->id;
                $id = $data->id;

                $update = true;
            }
            unset($data->id);
        }
        $entry['formData'] = json_encode($data, JSON_PRETTY_PRINT);
        if ($update) {
            $db->updateQuarterly($entry);
        } else {
            $date = date('Y-m-d H:i:s');
            $entry['submitDate'] = $date;
            $entry['uid'] = Core::Client()->getUserId();
            $id = $db->createQuarterly($entry);
        }

        echo json_encode(array(
            'success' => true,
            'result' => array(
                'id' => $id,
            ),
        ), JSON_PRETTY_PRINT);
    }

    public static function ListAdminScheduleD()
    {
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        $count = 0;

        $max = 20;

        echo '{"results":[' . "\n";
        $db->iterateAllSchedules(
            function ($record) use (&$count, $max) {
                if ($count > 0) {
                    echo ", ";
                }

                $data = get_object_vars($record);
                $data['formData'] = json_decode($record->formData);
                // $data['currentData'] = json_decode($record->formData); // this should reflect all changes made by
                // addendums,
                // and quarterlys

                $data['user'] = Core::Client()->userMetadataFor($record->uid);

                ob_start();
                Scaffold('list.scheduled.item', $data, dirname(__DIR__) . DS . 'views');
                $html = ob_get_contents();
                ob_end_clean();

                echo json_encode(array_merge($data, array(
                    'html' => $html,
                )), JSON_PRETTY_PRINT);
                $count++;
                if ($count >= $max) {
                    //return false;
                }
            }, array(

                'ORDER BY' => 'submitDate DESC',
            ));

        echo '],' . "\n" . ' "success":true}';

        return;
    }

    public static function ListClientScheduleD()
    {
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        $uid=Core::Client()->getUserId();


        $prefixes=array();

        $results=$db->getUserData($uid);

        if($results){
            $prefixes=json_decode($results[0]->data)->{'rwa-prefixes'};
        }

        $filter= array(
                array_merge(array('join'=>'OR', 'uid' => $uid), array_map(function($p){
                    return array('field'=>'LOWER(code)','value'=>strtolower($p).'-%', 'comparator'=>'LIKE');
                },$prefixes)),
                'ORDER BY' => 'submitDate DESC',
            );



        $count = 0;

        $max = 20;

        echo '{"results":[' . "\n";
        $db->iterateAllSchedules(
            function ($record) use (&$count, $max) {
                if ($count > 0) {
                    echo ", ";
                }

                $data = get_object_vars($record);
                $data['formData'] = json_decode($record->formData);
                // $data['currentData'] = json_decode($record->formData); // this should reflect all changes made by addendums,
                // and quarterlys

                ob_start();
                Scaffold('list.scheduled.item', $data, dirname(__DIR__) . DS . 'views');
                $html = ob_get_contents();
                ob_end_clean();

                echo json_encode(array_merge($data, array(
                    'html' => $html,
                )), JSON_PRETTY_PRINT);
                $count++;
                if ($count >= $max) {
                    //return false;
                }
            }, $filter);

        $query = $db->lastQuery();
        file_put_contents(__DIR__ . '/.query.log', $query . "\n", FILE_APPEND);

        /*
        $count = (int) $db->countSchedule(array(
        'uid' => Core::Client()->getUserId()));
         */

        echo '], ' . "\n" . ' "success":true}';

        return;
    }

    public static function ListAddendumsAndQuarterlies()
    {
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $countAddendums = 0;
        $json = json_decode(UrlVar('json'));
        if (!key_exists('participant-id', $json)) {
            throw new Exception('Expected $json->{\'participant-id\'}');
        }
        $code = $json->{'participant-id'};

        $max = 10;

        echo '{"results":' . "\n" . '{"addendums":[' . "\n";
        $db->iterateAllAddendums(
            function ($record) use (&$countAddendums, $max) {
                if ($countAddendums > 0) {
                    echo ", ";
                }

                $data = get_object_vars($record);
                $data['formData'] = json_decode($record->formData);

                ob_start();
                Scaffold('list.scheduled.item', $data, dirname(__DIR__) . DS . 'views');
                $html = ob_get_contents();
                ob_end_clean();

                echo json_encode(array_merge($data, array(
                    'html' => $html,
                )), JSON_PRETTY_PRINT);
                $countAddendums++;
                if ($countAddendums >= $max) {
                    return false;
                }
            }, array(
                'code' => $code,
                'ORDER BY' => 'submitDate DESC',
            ));

        echo '],' . "\n" . '"quarterlys":[';

        $countQuarterlys = 0;

        $db->iterateAllQuarterlys(
            function ($record) use (&$countQuarterlys, $max) {
                if (($countQuarterlys) > 0) {
                    echo ", ";
                }

                $data = get_object_vars($record);
                $data['formData'] = json_decode($record->formData);

                ob_start();
                Scaffold('list.scheduled.item', $data, dirname(__DIR__) . DS . 'views');
                $html = ob_get_contents();
                ob_end_clean();

                echo json_encode(array_merge($data, array(
                    'html' => $html,
                )), JSON_PRETTY_PRINT);
                $countQuarterlys++;
                if ($countQuarterlys >= $max) {
                    return false;
                }
            }, array(
                'code' => $code,
                'ORDER BY' => 'submitDate DESC',
            ));

        echo ']},' . "\n" . ' "success":true}';

        return;
    }

    public static function DeleteScheduleD()
    {
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $json = json_decode(UrlVar('json'));
        if (!key_exists('id', $json)) {}
        $id = (int) $json->id;

        $db = ScheduleDatabase::GetInstance();
        $s = $db->getSchedule($id);
        if (empty($s)) {}
        $scheduled = $s[0];

        $db->deleteSchedule($id);
        $db->execute('DELETE FROM ' . $db->table('Addendum') . ' WHERE code=' . $scheduled->code);
        $db->execute('DELETE FROM ' . $db->table('Quarterly') . ' WHERE code=' . $scheduled->code);

        echo '{"success":true}';

        return;
    }

    public static function DeleteQuarterly()
    {

        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $json = json_decode(UrlVar('json'));
        if (!key_exists('id', $json)) {}
        $id = (int) $json->id;

        $db = ScheduleDatabase::GetInstance();
        $db->deleteQuarterly($id);

        echo '{"success":true}';

        return;

    }

    public static function DeleteAdminAddendum()
    {

        echo '{"success":true}';

        return;

    }

    public static function ListUsers()
    {
        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        $count = 0;

        $max = 10;

        echo '{"results":[' . "\n";

        $db->iterate('SELECT count(*), uid FROM ' . $db->table('Schedule') . ' GROUP BY uid',
            function ($record) use (&$count, $max) {
                if ($count > 0) {
                    echo ", ";
                }

                echo json_encode(Core::Client()->userMetadataFor($record->uid), JSON_PRETTY_PRINT);

                $count++;
                if ($count >= $max) {
                    return false;
                }
            }, array(

                'ORDER BY' => 'submitDate DESC',
            ));

        echo '],' . "\n" . ' "success":true}';

        return;
    }

    public static function SaveUserData(){
        $json = json_decode(UrlVar('json'));
     

        $rwaPrefixes=$json->{'rwa-prefixes'};
        $uid=$json->id;
        $rwaPrefixes=str_replace(',', ' ',$rwaPrefixes);
        $rwaPrefixes=explode(' ', $rwaPrefixes);
        $rwaPrefixes=array_filter($rwaPrefixes, function($p){
            $p=trim($p);
            return !empty($p);
        });

        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        //$uid=Core::Client()->getUserId();
        $results=$db->getUserData($uid);

        $fields=array('uid'=>$uid, 'data'=>json_encode(array('rwa-prefixes'=>array_values($rwaPrefixes)),JSON_PRETTY_PRINT));

        if(! $results){
            $db->createUserData($fields);
        }else{
            $db->updateUserData(array_merge($fields, array('id'=>$results[0]->id)));
        }

        echo '{"success":true}';

        return;

    }

     public static function GetUserData(){
  
        $json = json_decode(UrlVar('json'));
        $uid=$json->id;

        include_once dirname(__DIR__) . DS . 'database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();
        //$uid=Core::Client()->getUserId();
        $results=$db->getUserData($uid);

        if($results){
            $prefixes=implode(', ',json_decode($results[0]->data)->{'rwa-prefixes'});

            echo json_encode(array('success'=>true, 'data'=>array('rwa-prefixes'=>$prefixes)));
            return;
        }

    
        echo '{"success":true, data:{}}';

        return;

    }

}
