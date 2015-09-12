<?php
Behavior('ajax');

Scaffold('button.create.scheduled');

Scaffold('scheduled.workspace');
Scaffold('addendum.workspace');
Scaffold('quarterly.workspace');

Scaffold('list.scheduled');

$quarter = ((int) ((date('n') - 1) / 3));
$quarters = array(
    '1st',
    '2nd',
    '3rd',
    '4th'
);
$quarter = $quarters[$quarter];

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
            'enrollment-supports' => 'no'
        )) . '

        });


        UIFormManager.displayList();


    });

');

IncludeCSS(dirname(__DIR__) . DS . 'css' . DS . 'forms.css');

IncludeCSSBlock(
    '

section h6 {
    background-color: #F8EAF2;
    line-height: 20px;
    padding: 5px;
    width: 50%;
    border-radius: 4px;
    margin: 5px;
    color: rgb(235, 0, 139);
    border: 1px solid rgba(235, 0, 139, 0.2);
    position: relative;
    left: -100px;
}

section h6:before {
    content: "Temporary Note: ";
}

    ');

Scaffold('qunit.test');




