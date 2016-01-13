<?php

function Localize($callback, $replace){

    array_walk ( $replace , function(&$v, $k){

    $v='<span class="lang" data-fr="'.htmlspecialchars($v).'" ><span class="en">'.$k.'</span></span>';//'-en:'.$k.'-';

    });

	$keys=array_keys($replace);
	usort($keys, function($a, $b){
		return strlen($b)-strlen($a);
	});

    ob_start();
    $callback();
    $text=ob_get_contents();
    ob_end_clean();

    foreach($keys as $search){

        $i=0;
        while(($i=strpos($text, $search, $i))!==false){
           $stag=strrpos($text, '<', $i-strlen($text));
           $etag=strrpos($text, '>', $i-strlen($text));
           $lang=strrpos($text, '"en">', $i-strlen($text));
           if($stag===false||($etag>$stag&&($lang===false||$lang<$stag))){
                $text=substr($text, 0, $i). $replace[$search].substr($text, $i+strlen($search));
           }
           $i+=strlen($replace[$search]);

           //print_r(array($i, $search, $replace[$search], $stag, $etag, $lang));
        }
       //$text=str_replace($search, $replace[$search], $text);

    }

    echo $text;

}