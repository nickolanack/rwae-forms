<?php
if (! defined('_JEXEC')) {
    define('_JOOMLA', 1);
}

include_once 'php-core-app/core.php';
Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

if (UrlVar('task') == 'create-new-scheduled') {
    
    include_once __DIR__ . DS . 'lib' . DS . 'RWAForm.php';
    $data = RWAForm::ValidateScheduleDData(json_decode(UrlVar('json')));
    
    /* @var $db ScheduleDatabase */
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    
    $db = ScheduleDatabase::GetInstance();
    
    $entry = array(
        'code' => $data->{'participant-id'},
        'uid' => Core::Client()->getUserId(),
        'formDate' => RWAForm::GetFormDate($data)
    );
    
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
        $id = $db->createSchedule($entry);
    }
    
    echo json_encode(
        array(
            'success' => true,
            'result' => array(
                'id' => $id
            )
        ), JSON_PRETTY_PRINT);
    
    return;
} elseif (UrlVar('task') == 'create-new-addendum') {
    
    include_once __DIR__ . DS . 'lib' . DS . 'RWAForm.php';
    $data = RWAForm::ValidateAddendumData(json_decode(UrlVar('json')));
    
    /* @var $db ScheduleDatabase */
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $db = ScheduleDatabase::GetInstance();
    
    $entry = array(
        'code' => $data->{'participant-id'},
        'uid' => Core::Client()->getUserId(),
        'formDate' => RWAForm::GetFormDate($data)
    );
    
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
        $id = $db->createAddendum($entry);
    }
    
    echo json_encode(
        array(
            'success' => true,
            'result' => array(
                'id' => $id
            )
        ), JSON_PRETTY_PRINT);
    
    return;
} elseif (UrlVar('task') == 'create-new-quarterly') {
    
    include_once __DIR__ . DS . 'lib' . DS . 'RWAForm.php';
    $data = RWAForm::ValidateQuarterlyData(json_decode(UrlVar('json')));
    
    /* @var $db ScheduleDatabase */
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    
    $db = ScheduleDatabase::GetInstance();
    
    $entry = array(
        'code' => $data->{'participant-id'},
        'uid' => Core::Client()->getUserId(),
        'formDate' => RWAForm::GetFormDate($data)
    );
    
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
        $id = $db->createQuarterly($entry);
    }
    
    echo json_encode(
        array(
            'success' => true,
            'result' => array(
                'id' => $id
            )
        ), JSON_PRETTY_PRINT);
    
    return;
} elseif (UrlVar('task') == 'list-scheduled') {
    
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $db = ScheduleDatabase::GetInstance();
    $count = 0;
    
    $max = 10;
    
    echo '{"results":[' . "\n";
    $db->iterateAllSchedules(
        function ($record) use(&$count, $max) {
            if ($count > 0) {
                echo ", ";
            }
            
            $data = get_object_vars($record);
            $data['formData'] = json_decode($record->formData);
            // $data['currentData'] = json_decode($record->formData); // this should reflect all changes made by addendums,
            // and quarterlys
            
            ob_start();
            Scaffold('list.scheduled.item', $data, __DIR__ . DS . 'views');
            $html = ob_get_contents();
            ob_end_clean();
            
            echo json_encode(array_merge($data, array(
                'html' => $html
            )), JSON_PRETTY_PRINT);
            $count ++;
            if ($count >= $max) {
                return false;
            }
        }, array(
            'uid' => Core::Client()->getUserId(),
            'ORDER BY' => 'formDate DESC'
        ));
    
    echo '],' . "\n" . ' "success":true}';
    
    return;
} elseif (UrlVar('task') == 'list-addendums-quarterlys') {
    
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $db = ScheduleDatabase::GetInstance();
    
    $countAddendums = 0;
    $json = json_decode(UrlVar('json'));
    if (! key_exists('participant-id', $json)) {
        throw new Exception('Expected $json->{\'participant-id\'}');
    }
    $code = $json->{'participant-id'};
    
    $max = 10;
    
    echo '{"results":' . "\n" . '{"addendums":[' . "\n";
    $db->iterateAllAddendums(
        function ($record) use(&$countAddendums, $max) {
            if ($countAddendums > 0) {
                echo ", ";
            }
            
            $data = get_object_vars($record);
            $data['formData'] = json_decode($record->formData);
            
            ob_start();
            Scaffold('list.scheduled.item', $data, __DIR__ . DS . 'views');
            $html = ob_get_contents();
            ob_end_clean();
            
            echo json_encode(array_merge($data, array(
                'html' => $html
            )), JSON_PRETTY_PRINT);
            $countAddendums ++;
            if ($countAddendums >= $max) {
                return false;
            }
        }, array(
            'code' => $code,
            'ORDER BY' => 'formDate DESC'
        ));
    
    echo '],' . "\n" . '"quarterlys":[';
    
    $countQuarterlys = 0;
    
    $db->iterateAllQuarterlys(
        function ($record) use(&$countQuarterlys, $max) {
            if (($countQuarterlys) > 0) {
                echo ", ";
            }
            
            $data = get_object_vars($record);
            $data['formData'] = json_decode($record->formData);
            
            ob_start();
            Scaffold('list.scheduled.item', $data, __DIR__ . DS . 'views');
            $html = ob_get_contents();
            ob_end_clean();
            
            echo json_encode(array_merge($data, array(
                'html' => $html
            )), JSON_PRETTY_PRINT);
            $countQuarterlys ++;
            if ($countQuarterlys >= $max) {
                return false;
            }
        }, array(
            'code' => $code,
            'ORDER BY' => 'formDate DESC'
        ));
    
    echo ']},' . "\n" . ' "success":true}';
    
    return;
} elseif (UrlVar('task') == 'delete-scheduled') {
    
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $json = json_decode(UrlVar('json'));
    if (! key_exists('id', $json)) {}
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
} elseif (UrlVar('task') == 'delete-quarterly') {
    
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $json = json_decode(UrlVar('json'));
    if (! key_exists('id', $json)) {}
    $id = (int) $json->id;
    
    $db = ScheduleDatabase::GetInstance();
    $db->deleteQuarterly($id);
    
    echo '{"success":true}';
    
    return;
} elseif (UrlVar('task') == 'delete-addendum') {
    
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $json = json_decode(UrlVar('json'));
    if (! key_exists('id', $json)) {}
    $id = (int) $json->id;
    
    $db = ScheduleDatabase::GetInstance();
    $db->deleteAddendum($id);
    
    echo '{"success":true}';
    
    return;
}

Scaffold('user.panel', array(
    'url' => UrlFrom(__FILE__)
), __DIR__ . DS . 'views');

