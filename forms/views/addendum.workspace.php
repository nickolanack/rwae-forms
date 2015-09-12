<div id="addendum-area" class="form-container">
	<div id="addendum-warnings-area"></div>
<?php
Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

             if(!this.getAttribute("disabled")){
                //UIFormManager.saveForm();
             }

        '
    ));
Scaffold('cpanel.button', 
    array(
        'title' => 'Cancel',
        'className' => 'btn btn-danger pull-right cancel-btn',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '
            if(!this.getAttribute("disabled")){
                UIFormManager.hideForms();
            }
        '
    ));
?><div></div><?php
Scaffold('form.addendum', array());
?><div></div><?php

IncludeJs(dirname(__DIR__) . DS . 'js' . DS . 'UIFormManager.js');

Scaffold('cpanel.button', 
    array(
        'title' => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '
            if(!this.getAttribute("disabled")){
                //UIFormManager.saveForm();
            }
        '
    ));
?><div></div><?php
?>
</div>
