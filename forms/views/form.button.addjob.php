<?php
$config = array_merge(array(
    
    'elementsArray' => '([])'
), $params);
$id = rand(0000, 9999);
?>
<input type="hidden" name="job-1-isactive" value="yes"
	id="job-1-isactive-<?php echo $id; ?>" />

<input type="hidden" name="job-2-isactive" value="no"
	id="job-2-isactive-<?php echo $id; ?>" />

<input type="hidden" name="job-3-isactive" value="no"
	id="job-3-isactive-<?php echo $id; ?>" />

<?php

Scaffold('cpanel.button', 
    array(
        'title' => 'Add Job',
        'className' => 'btn btn-success pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '


            button=this;
            ' . $config['elementsArray'] . '.forEach(function(el){
                if(!el.hasClass("two")){
                    el.addClass("two");

                    $("job-2-isactive-' . $id . '").value="yes";

                }else{

                    if(!el.hasClass("three")){
                        el.addClass("three");

                         $("job-3-isactive-' . $id . '").value="yes";

                        button.removeClass("btn-success");
                        button.setAttribute("disabled", true);
                    }else{



                    }

                }
            });

        '
    ));
