<?php
$config = array_merge(
    array(
        
        'elementArray' => '([])',
        'elementArrayEnabled' => '([])',
        'enabler' => 'test',
        'disabler' => 'null',
        'disable' => '"none"',
        'enable' => 'null'
    ), $params);

if ($config['enabler'] == 'null') {
    // throw new Exception('Expectes \'enabler\' in :' . __FILE__);
}

IncludeJSBlock(
    '
           window.addEvent("load",function(){

                var enabler=' . $config['enabler'] . ';
                var disabler=' . $config['disabler'] . ';

                if(!enabler){
                    throw new Error("you need to set \'enabler\' arg in "+' .
         json_encode(basename(__FILE__)) . ');
                }

                 if(!disabler){
                    throw new Error("you need to set \'disabler\' arg in "+' .
         json_encode(basename(__FILE__)) . ');
                }


                disabler.addEvent("change",function(){

                    if(this.checked){
                        ' . $config['elementArray'] . '.forEach(function(s){
                            s.setStyle("display",' . $config['disable'] . ');
                        });

                        ' . $config['elementArrayEnabled'] . '.forEach(function(s){
                            s.setStyle("display",' . $config['enable'] . ');
                        });
                    }

                });


                enabler.addEvent("change",function(){

                    if(this.checked){
                        ' . $config['elementArray'] . '.forEach(function(s){
                            s.setStyle("display",' . $config['enable'] . ');
                        });

                        ' . $config['elementArrayEnabled'] . '.forEach(function(s){
                            s.setStyle("display",' . $config['disable'] . ');
                        });
                    }

                });
            });
        ');