<?php
$btn = Scaffold('cpanel.button', 
    array(
        'title' => 'Create A New Schedule D',
        'className' => 'btn btn-primary big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '

            UIFormManager.showForm("scheduled");
        '
    ));

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        UIFormManager.addEvent("showForm",function(){

            ' . $btn . '.removeClass("btn-primary");
			' . $btn . '.setAttribute("disabled", true);

        }).addEvent("hideForms",function(){

            ' . $btn . '.addClass("btn-primary");
		    ' . $btn . '.removeAttribute("disabled");

        });

    });

    ');