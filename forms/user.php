<?php
if (! defined('_JEXEC')) {
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
    
    $date = date('Y-m-d H:i:s');
    $id = $db->createSchedule(
        array(
            'code' => '',
            'uid' => Core::Client()->getUserId(),
            'formData' => json_encode($data, JSON_PRETTY_PRINT),
            'submitDate' => $date
        ));
    
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
            Scaffold('scheduled.list.item', $data, __DIR__ . DS . 'scaffolds');
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

?><link rel="stylesheet"
	href="<?php echo UrlFrom(__DIR__ . DS . 'css' . DS . 'forms.css');?>"
	type="text/css"><?php

Behavior('ajax');
$btn = Scaffold('cpanel.button', 
    array(
        'title' => 'Create A New Schedule D',
        'className' => 'btn btn-primary big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            UserForm.showScheduleD(this);
        '
    ));

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        UserForm.addEvent("showForm",function(){

            ' . $btn . '.removeClass("btn-primary");
			' . $btn . '.setAttribute("disabled", true);

        }).addEvent("hideForm",function(){

            ' . $btn . '.addClass("btn-primary");
		    ' . $btn . '.removeAttribute("disabled");

        });

    });

    ');

?><div id="new-rwa-schedule-d">
<?php

Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

             UserForm.saveScheduleD();

        '
    ));
Scaffold('cpanel.button', 
    array(
        'title' => 'Cancel',
        'className' => 'btn btn-danger pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

             UserForm.hideScheduleD();
        '
    ));
?><div></div><?php
Scaffold('scheduled', array(), __DIR__ . DS . 'scaffolds');
?><div></div><?php

IncludeJs(__DIR__ . DS . 'js' . DS . 'UserForm.js');

Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '
            UserForm.saveScheduleD();
        '
    ));
?><div></div><?php
?>
</div>



<div id="list-schedule-d" class="enabled">
	<section>
		<div>Loading</div>
	</section>
</div>

<?php
Behavior('popover');
IncludeCSSBlock(
    '
.scheduled-item>.btn-primary {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_edit.png') . '?tint=rgb(255,255,255)");
}
.scheduled-item>.btn-danger {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_plus.png') . '?tint=rgb(255,255,255)");
}
.scheduled-item>.btn-success {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_plus.png') . '?tint=rgb(0,68,204)");
}
');

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        UserForm.setAjaxUrl(' . json_encode(UrlFrom(__FILE__)) . ');
        UserForm.displayList();


    });

');
