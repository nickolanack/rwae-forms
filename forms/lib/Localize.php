<?php

function Localize($callback, $replace){

	$keys=array_keys($replace);
	usort($keys, function($b, $a){
		return strlen($a)-strlen($b);
	});

    ob_start();
    $callback();
    $text=ob_get_contents();
    ob_end_clean();

    foreach($keys as $search){

        $text=str_replace($search, $replace[$search], $text);

    }

    echo $text;

}