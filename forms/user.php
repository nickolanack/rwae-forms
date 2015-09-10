<?php
if (!defined('_JEXEC')) {
    // make sure that core.php detects joomla environment
    define('_JEXEC', 1);
}

include_once 'php-core-app/core.php';

Core::Parameters()->disableCaching();
Core::Parameters()->disableCompression();

if (UrlVar('userTask') == 'createScheduleD') {}

?><link rel="stylesheet"
	href="<?php echo UrlFrom(__DIR__ . DS . 'css' . DS . 'forms.css');?>"
	type="text/css"><?php

Behavior('ajax');
Scaffold('cpanel.button', 
    array(
        'title' => 'Create A New Schedule D',
        'className' => 'btn btn-primary big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            var btn=this;
            window.create_new_btn=btn;
            console.log(btn);
            btn.removeClass("btn-primary");
            btn.setAttribute("disabled", true);
            $("new-rwa-schedule-d").addClass("enabled");
            $("list-schedule-d").removeClass("enabled");

        '
    ));

?><div id="new-rwa-schedule-d">
<?php

Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            $$("#new-rwa-schedule-d>form")[0].submit();

        '
    ));
Scaffold('cpanel.button', 
    array(
        'title' => 'Cancel',
        'className' => 'btn btn-danger pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            var btn=window.create_new_btn;
            btn.addClass("btn-primary");
            btn.removeAttribute("disabled");
            $("new-rwa-schedule-d").removeClass("enabled");
            $("list-schedule-d").addClass("enabled");

        '
    ));
?><div></div><?php
Scaffold('scheduled', array(), __DIR__ . DS . 'scaffolds');
?><div></div><?php
Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            var form=$$("#new-rwa-schedule-d>form")[0];

            data={};
            Array.prototype.slice.call(form, 0).forEach(function(i){

                var name=i.name;
                var value=i.value;
                if(name.indexOf("[]")==-1){
                    data[name]=value;

                }else{
                    if((typeof data[name])=="undefined"){
                        data[name]=[];
                    }
                    data[name].push(value);
                }

            });

            console.log(data);

        '
    ));
?><div></div><?php
?>
</div>


<div id="list-schedule-d" class="enabled">
	<section>
<?php
/* @var $db ScheduleDatabase */
include_once __DIR__ . DS . 'database' . DS . 'ScheduleDatabase.php';
$db = ScheduleDatabase::GetInstance();
$count = 0;
$db->iterateAllSchedules(function ($record) use(&$count) {
    print_r($record);
    $count ++;
}, array(
    'uid' => Core::Client()->getId()
));

if (count == 0) {
    ?><div class="empty info">you have not completed any schedule d
			forms yet</div><?php
}
?>
</section>
</div>