<?php
$config = array_merge(
    array(
        'values' => array(
            'yes',
            'no'
        ),
        'name' => 'employed-quarter',
        'className' => ''
    ), $params);

$id = '_switch_' + rand(00000, 99999);

?>

<span class="inline"><label><input type="radio" value="yes"
		name="employed-quarter" id="yes_<?php echo $id?>" /> Yes </label><label><input
		type="radio" value="no" name="employed-quarter"
		id="no_<?php echo $id?>" checked="checked" /> No </label></span>
<?php
Scaffold('script.radiobutton.display.toggle', 
    array(
        'elementArray' => '[$("' . $id . '")]',
        'enabler' => '$("yes_' . $id . '")',
        'disabler' => '$("no_' . $id . '")'
    ));
?>
<span id="<?php echo $id;?>" class="<?php echo $config['className']?>"
	style="display: none;">

<?php

$callback = $config['callback'];
$callback();

?>

</span>