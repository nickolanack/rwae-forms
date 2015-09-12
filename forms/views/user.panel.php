<?php
Behavior('ajax');

Scaffold('button.create.scheduled');

Scaffold('scheduled.workspace');
Scaffold('addendum.workspace');
Scaffold('quarterly.workspace');

Scaffold('list.scheduled');

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        UIFormManager.setAjaxUrl(' . json_encode($params['url']) . ');



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
            'id' => -1,
            'admin-year' => date('Y'),
            'admin-quarter' => ((int) ((date('n') - 1) / 3)) + 1,
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
            'id' => -1,
            'admin-year' => date('Y'),
            'admin-quarter' => ((int) ((date('n') - 1) / 3)) + 1,
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
            'id' => -1,
            'admin-year' => date('Y'),
            'admin-quarter' => ((int) ((date('n') - 1) / 3)) + 1,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
        )) . '

        });


        UIFormManager.displayList();


    });

');

IncludeCSS(dirname(__DIR__) . DS . 'css' . DS . 'forms.css');



