<div id="user-area" class="form-container">
	<div id="user-warnings-area"></div>
<?php
Scaffold('cpanel.button',
    array(
        'title'     => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '

             if(!this.getAttribute("disabled")){
                UIFormManager.saveForm("user");
             }

        ',
    ));
Scaffold('cpanel.button',
    array(
        'title'     => 'Cancel',
        'className' => 'btn btn-danger pull-right cancel-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '
            if(!this.getAttribute("disabled")){
                UIFormManager.hideForms();
            }
        ',
    ));
?><div></div><?php
Scaffold('form.user', array());
?><div></div><?php
Scaffold('cpanel.button',
    array(
        'title'     => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '
            if(!this.getAttribute("disabled")){
                UIFormManager.saveForm("user");
            }
        ',
    ));
?><div></div><?php
?>
</div>



<div id="userassign-area" class="form-container">
    <div id="userassign-warnings-area"></div>
<?php
Scaffold('cpanel.button',
    array(
        'title'     => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '

             if(!this.getAttribute("disabled")){
                UIFormManager.saveForm("userassign");
             }

        ',
    ));
Scaffold('cpanel.button',
    array(
        'title'     => 'Cancel',
        'className' => 'btn btn-danger pull-right cancel-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '
            if(!this.getAttribute("disabled")){
                UIFormManager.hideForms();
            }
        ',
    ));
?><div></div><?php
Scaffold('form.userassign', array());
?><div></div><?php
Scaffold('cpanel.button',
    array(
        'title'     => 'Submit',
        'className' => 'btn btn-primary pull-right submit-btn',
        'icon'      => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script'    => '
            if(!this.getAttribute("disabled")){
                UIFormManager.saveForm("userassign");
            }
        ',
    ));
?><div></div><?php
?>
</div>



