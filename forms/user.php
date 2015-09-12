<?php
if (!defined('_JEXEC')) {
    define('_JOOMLA', 1);
}

include_once 'php-core-app/core.php';
Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

if (UrlVar('task') == 'create-new-scheduled') {
    
    $data = json_decode(UrlVar('json'));
    
    /* @var $db ScheduleDatabase */
    include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
    $db = ScheduleDatabase::GetInstance();
    
    $entry = array(
        'code' => '',
        'uid' => Core::Client()->getUserId()
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
            
            ob_start();
            Scaffold('list.scheduled.item', $data, __DIR__ . DS . 'views');
            $html = ob_get_contents();
            ob_end_clean();
            
            echo json_encode(array_merge($data, array(
                'html' => $html
            )), JSON_PRETTY_PRINT);
            $count ++;
            if ($count >= $max)
                return false;
        }, 
        array(
            'uid' => Core::Client()->getUserId(),
            'ORDER BY' => 'submitDate DESC'
        ));
    
    echo '],' . "\n" . ' "success":true}';
    
    return;
}

Scaffold('user.panel', array(
    'url' => UrlFrom(__FILE__)
), __DIR__ . DS . 'views');

