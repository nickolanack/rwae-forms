<?php
Behavior('ajax');

?><link rel="stylesheet"
	href="<?php echo UrlFrom(dirname(__DIR__) . DS . 'css' . DS . 'forms.css'); ?>"
	type="text/css"><?php

$schedButton = Scaffold('cpanel.button',
    array(
        'title'     => 'Show All Participant Information Form Forms',
        'className' => 'btn btn-primary big',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_table.png?tint=rgb(255,255,255)',
    ));

$authButton = Scaffold('cpanel.button',
    array(
        'title'     => 'Show All Participant Information Form Authors',
        'className' => 'btn btn-danger big',
        'icon'      => Core::AssetsDir() . DS . 'Tile Icons' . DS . 'profile.png?tint=rgb(255,255,255)',
    ));

$expButton = Scaffold('cpanel.button',
    array(
        'title'     => 'Manage Data',
        'className' => 'btn btn-success big',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_clipboard.png?tint=rgb(255,255,255)',
    ));

IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIFormManager.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIUserList.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIUsersFormsList.js');
Scaffold('scheduled.workspace');
Scaffold('addendum.workspace');
Scaffold('quarterly.workspace');
Scaffold('user.workspace');

Scaffold('list.scheduled');
Scaffold('list.users');
Scaffold('list.utilities');

$q        = ((int) ((date('n') - 1) / 3));
$quarters = array(
    '1st',
    '2nd',
    '3rd',
    '4th',
);
$quarter = $quarters[$q];

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        var ajaxUrl=' . json_encode($params['url']) . ';

        UIFormManager.setAjaxUrl(ajaxUrl);



        UIFormManager.addForm({
            name:"scheduled",
            ajaxUrl:null,
            ajaxTask:"create-new-scheduled",
            container:$("schedule-d-area"),
            form:$$("#schedule-d-area>form")[0],
            submitButtons:$$("#schedule-d-area .submit-btn"),
            cancelButtons:$$("#schedule-d-area .cancel-btn"),
            additionalFormButtons:$$("#schedule-d-area>form .btn"),
            warningsArea:$("sheduled-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id'                  => -1,
            'admin-year'          => date('Y'),
            'admin-quarter'       => $quarter,
            'employed-quarter'    => 'no',
            'job-supports'        => 'no',
            'enrolled-quarter'    => 'no',
            'enrollment-supports' => 'no',
        )) . '

        });


        UIFormManager.addForm({
            name:"addendum",
            ajaxUrl:null,
            ajaxTask:"create-new-addendum",
            container:$("addendum-area"),
            form:$$("#addendum-area>form")[0],
            submitButtons:$$("#addendum-area .submit-btn"),
            cancelButtons:$$("#addendum-area .cancel-btn"),
            additionalFormButtons:$$("#addendum-area>form .btn"),
            warningsArea:$("addendum-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id'                  => -1,
            'admin-year'          => date('Y'),
            'admin-quarter'       => $quarter,
            'employed-quarter'    => 'no',
            'job-supports'        => 'no',
            'enrolled-quarter'    => 'no',
            'enrollment-supports' => 'no',
        )) . '

        });

        UIFormManager.addForm({
            name:"quarterly",
            ajaxUrl:null,
            ajaxTask:"create-new-quarterly",
            container:$("quarterly-area"),
            form:$$("#quarterly-area>form")[0],
            submitButtons:$$("#quarterly-area .submit-btn"),
            cancelButtons:$$("#quarterly-area .cancel-btn"),
            additionalFormButtons:$$("#quarterly-area>form .btn"),
            warningsArea:$("quarterly-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id'                  => -1,
            'admin-year'          => date('Y'),
            'admin-quarter'       => $quarter,
            'employed-quarter'    => 'no',
            'job-supports'        => 'no',
            'enrolled-quarter'    => 'no',
            'enrollment-supports' => 'no',
            'job-1-working'       => 'no',
            'job-2-working'       => 'no',
            'job-3-working'       => 'no',
            'job-1-promoted'      => 'no',
            'job-2-promoted'      => 'no',
            'job-3-promoted'      => 'no',
            'job-1-wage-changed'  => 'no',
            'job-2-wage-changed'  => 'no',
            'job-3-wage-changed'  => 'no',
            'job-1-hours-changed' => 'no',
            'job-2-hours-changed' => 'no',
            'job-3-hours-changed' => 'no',
        )) . '

        });


        UIFormManager.addForm({
            name:"user",
            ajaxUrl:null,
            ajaxTask:"save-user",
            container:$("user-area"),
            form:$$("#user-area>form")[0],
            submitButtons:$$("#user-area .submit-btn"),
            cancelButtons:$$("#user-area .cancel-btn"),
            additionalFormButtons:$$("#user-area>form .btn"),
            warningsArea:$("user-warnings-area"),
            defaultFormData:' . json_encode(array())

    . '

        });


        UIFormManager.addForm({
            name:"userassign",
            ajaxUrl:null,
            ajaxTask:"assiqn-user",
            container:$("userassign-area"),
            form:$$("#userassign-area>form")[0],
            submitButtons:$$("#userassign-area .submit-btn"),
            cancelButtons:$$("#userassign-area .cancel-btn"),
            additionalFormButtons:$$("#userassign-area>form .btn"),
            warningsArea:$("userassign-warnings-area"),
            defaultFormData:' . json_encode(array())

    . '

        });


        var enableScheduleButton=function(){
            ' . $schedButton . '.addClass("btn-primary");
		    ' . $schedButton . '.removeAttribute("disabled");
            $("list-schedule-d").removeClass("enabled");
        };
        var disableScheduleButton=function(){
            ' . $schedButton . '.removeClass("btn-primary");
		    ' . $schedButton . '.setAttribute("disabled", true);
        };
        disableScheduleButton();


        var enableAuthButton=function(){
            ' . $authButton . '.addClass("btn-danger");
		    ' . $authButton . '.removeAttribute("disabled");
            $("list-users").removeClass("enabled");

        };
        var disableAuthButton=function(){
            ' . $authButton . '.removeClass("btn-danger");
		    ' . $authButton . '.setAttribute("disabled", true);
        };

         var enableExpButton=function(){
            ' . $expButton . '.addClass("btn-success");
		    ' . $expButton . '.removeAttribute("disabled");
            $("list-utilities").removeClass("enabled");

        };
        var disableExpButton=function(){
            ' . $expButton . '.removeClass("btn-success");
		    ' . $expButton . '.setAttribute("disabled", true);
        };




        new UIUsersFormsList({
            url:ajaxUrl,
            formManager:UIFormManager,
            element:$("list-schedule-d"),
            endDate:"' . date('Y-') . ($q * 3 + 1) . '-01 00:00:00",
            title:"All Previously Completed Forms (for all users)"
            //showCreateButtons:false
        });

        /**
         * Users Form List Display Behavior
         */
        // hide users list of completed forms whenever any form becomes visible
        UIFormManager.addEvent("showForm",function(){
            $("list-schedule-d").removeClass("enabled");
            disableScheduleButton();
            disableAuthButton();
            disableExpButton();

        });

        // show users list of completed forms whenever all forms are hidden
        UIFormManager.addEvent("hideForms",function(){
            $("list-schedule-d").addClass("enabled");
            disableScheduleButton();
            enableAuthButton();
            enableExpButton();

        });


         ' . $schedButton . '.addEvent("click", function(){
            $("list-schedule-d").addClass("enabled");
            disableScheduleButton();
            enableAuthButton();
            enableExpButton();

         });


        ' . $authButton . '.addEvent("click",function(){
            $("list-users").addClass("enabled");
            enableScheduleButton();
            disableAuthButton();
            enableExpButton();

         });


        ' . $expButton . '.addEvent("click",function(){
            $("list-utilities").addClass("enabled");
            enableScheduleButton();
            enableAuthButton();
            disableExpButton();
         });



        var userList=new UIUserList({
            url:ajaxUrl,
            formManager:UIFormManager,
            element:$("list-users"),
        });





    });

');