
<div id="list-utilities" class="">
	<section>

		<?php

Scaffold('cpanel.button',
    array(
        'title'     => 'Export Pretty Documents*',
        'className' => 'btn btn-primary',
        'icon'      => Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'download.png?tint=rgb(255,255,255)',
        'script'    => '

            window.open("' .
        UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-formatted", "_blank");


        ',
    ));

Scaffold('cpanel.button',
    array(
        'title'     => 'Export Raw SpreadSheets',
        'className' => 'btn btn-danger',
        'icon'      => Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'download.png?tint=rgb(255,255,255)',
        'script'    => '

            window.open("' .
        UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-scheduled", "_blank");
            window.open("' .
        UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-addendum", "_blank");
            window.open("' .
        UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-quarterly", "_blank");
        ',
    ));

Behavior('modal');

Scaffold('cpanel.button',
    array(
        'title'     => 'Generate Statistics',
        'className' => 'btn btn-success',
        'icon'      => Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'download.png?tint=rgb(255,255,255)',
        'script'    => '

            var html='.json_encode(file_get_contents(__DIR__ . DS . 'statistics.html')).';

            var container=new Element("div",{
                html:html,
                styles:{  padding: "50px"}
            });

            var buttonExecute=new Element("button", {"class":"btn btn-primary", "html":"Process"});
            container.appendChild(buttonExecute);





            buttonExecute.addEvent("click",function(){


                //TODO: this is very form specific (setting stats quarter) and will limit extendability...
                var currentQ = parseInt($("stats-quarter").value);



                container.innerHTML=html.replace("value=\"8\"", "value=\""+currentQ+"\"");
                container.appendChild(buttonExecute);


                 var processPifFn=(function(){

                    '.file_get_contents(__DIR__ . DS . 'statistics.js').'

                })();
                




                var url='.json_encode($params['url']).';

                (new AjaxControlQuery(
                    url,
                    "list-scheduled", {
                        sortField: "formDate",
                        sortOrder: "ASC"

                    }
                )).addEvent("success", function(response) {

                    response.results.forEach(function(record){


                       (new AjaxControlQuery(
                            url,
                            "list-addendums-quarterlys",
                            {"participant-id":record.formData["participant-id"]}
                        )).addEvent("success", function(response) {


                            processPifFn(record, response.results);



                        }).execute();



                    });



                }).execute();

             });

            PushBoxWindow.open(container,{handler: "append", size: {x: 750, y: 450}, anchor:this, push:true});




        ',
    ));


?>

<p>* Nicely Formatted Documents is under development</p>
	</section>
</div>