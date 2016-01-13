<?php
include_once dirname(__DIR__).DS.'lib'.DS.'Localize.php';

include_once Core::LibDir().DS.'easycsv'.DS.'EasyCsv.php';
$language=array();
$languageFilePath=dirname(__DIR__).DS.'language.csv';
if(file_exists($languageFilePath)){
   $csv= EasyCsv::OpenCsv($languageFilePath);

   //echo '<pre>';

   EasyCsv::IterateRows_Assoc($csv, function($row, $i)use(&$language){
        if(!empty($row['English'])){
            $language[$row['English']]=$row['French'];
        }
   });
  file_put_contents(dirname(__DIR__).DS.'language.json', json_encode($language, JSON_PRETTY_PRINT));
   //echo '</pre>';



}else{

    $language=get_object_vars(json_decode(file_get_contents(__DIR__.DS.'words.json')));
}






Behavior('ajax');

Localize(function(){

    Scaffold('button.create.scheduled');

}, $language);

IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIFormManager.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'UIUsersFormsList.js');
IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'Language.js');


$keys=array_keys($language);
usort($keys, function($a, $b){
    return strlen($b)-strlen($a);
});

IncludeJSBlock('

window.Language.Instance=new Language({'."\n".implode(",\n", array_map(function($k) use($language){

return '  '.json_encode($k).':'.json_encode($language[$k]);

},$keys))."\n".'});

');



Core::LibDir().DS.'easycsv'.DS.'EasyCsv.php';




//print_r($language);

Localize(function(){

    Scaffold('scheduled.workspace');
    Scaffold('addendum.workspace');
    Scaffold('quarterly.workspace');

}, $language);


Scaffold('list.scheduled');

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
            endDate:"' . date('Y-') . ($q * 3 + 1) . '-01 00:00:00"
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

if (Core::Client()->getUsername() == 'nickolanack') {
    // Scaffold('qunit.test');
}



