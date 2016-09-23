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

<span class="inline"><label><input type="radio"
		value="<?php echo $config['values'][0];?>"
		name="<?php echo $config['name'];?>" id="yes_<?php echo $id;?>" /> Yes
</label><label><input type="radio"
		value="<?php echo $config['values'][1];?>"
		name="<?php echo $config['name'];?>" id="no_<?php echo $id;?>"
		checked="checked" /> No </label></span>

<span id="<?php echo $id;?>" class="<?php echo $config['className'];?>"
	style="display: none;">

<?php

$enablerArgs = array(
    'elementArray' => '[$("' . $id . '")]',
    'enabler' => '$("yes_' . $id . '")',
    'disabler' => '$("no_' . $id . '")'
);

$callbacks = $config['callback'];
$first = $callbacks;
if (is_array($callbacks)) {
    $first = $callbacks[0];
}
$first();

?>

</span>
<?php
if (is_array($callbacks) && count($callbacks) == 2) {
    $enablerArgs['elementArrayEnabled'] = '[$("_' . $id . '")]';
    ?><span id="_<?php echo $id;?>"
	class="<?php echo $config['className'];?>" style="">

<?php
    
    $second = $callbacks[1];
    $second();
    ?>

</span><?php
} else {}

Scaffold('script.radiobutton.display.toggle', $enablerArgs);

