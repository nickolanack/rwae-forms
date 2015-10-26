<?php
Behavior('ajax');

?><link rel="stylesheet"
	href="<?php echo UrlFrom(dirname(__DIR__) . DS . 'css' . DS . 'forms.css');?>"
	type="text/css"><?php

$sbtn = Scaffold('cpanel.button', 
    array(
        'title' => 'Show All Schedule D Forms',
        'className' => 'btn btn-primary big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_table.png?tint=rgb(255,255,255)',
        'script' => '
            this.removeClass("btn-primary");
		    this.setAttribute("disabled", true);
        '
    ));

Scaffold('cpanel.button', 
    array(
        'title' => 'Show All Schedule D Authors',
        'className' => 'btn btn-danger big',
        'icon' => Core::AssetsDir() . DS . 'Tile Icons' . DS . 'profile.png?tint=rgb(255,255,255)',
        'script' => '

            ' . $sbtn . '.addClass("btn-primary");
		    ' . $sbtn . '.removeAttribute("disabled");

        '
    ));

Scaffold('cpanel.button', 
    array(
        'title' => 'Generate Reports',
        'className' => 'btn btn-success big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_clipboard.png?tint=rgb(255,255,255)',
        'script' => '

            ' . $sbtn . '.addClass("btn-primary");
		    ' . $sbtn . '.removeAttribute("disabled");

        '
    ));

IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIFormManager.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIUserList.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIUsersFormsList.js');
Scaffold('scheduled.workspace');
Scaffold('addendum.workspace');
Scaffold('quarterly.workspace');

Scaffold('list.scheduled');
Scaffold('list.users');
Scaffold('list.utilities');

$q = ((int) ((date('n') - 1) / 3));
$quarters = array(
    '1st',
    '2nd',
    '3rd',
    '4th'
);
$quarter = $quarters[$q];

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        ' . $sbtn . '.removeClass("btn-primary");
		' . $sbtn . '.setAttribute("disabled", true);





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
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
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
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
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
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no',
            'job-1-working' => 'no',
            'job-2-working' => 'no',
            'job-3-working' => 'no',
            'job-1-promoted' => 'no',
            'job-2-promoted' => 'no',
            'job-3-promoted' => 'no',
            'job-1-wage-changed' => 'no',
            'job-2-wage-changed' => 'no',
            'job-3-wage-changed' => 'no',
            'job-1-hours-changed' => 'no',
            'job-2-hours-changed' => 'no',
            'job-3-hours-changed' => 'no'
        )) . '

        });


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
        });

        // show users list of completed forms whenever all forms are hidden
        UIFormManager.addEvent("hideForms",function(){
            $("list-schedule-d").addClass("enabled");
        });




        new UIUserList({
            url:ajaxUrl,
            formManager:UIFormManager,
            element:$("list-users"),
        });



    });

');