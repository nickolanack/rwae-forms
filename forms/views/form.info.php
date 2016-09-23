<?php 


$config = array_merge(
    array(
        
        'text' => 'info text',

    ), $params);
	$id="info-help-".rand(10000,99999);

?>
<span id="<?php echo $id; ?>" class="help-icon"><?php 
IncludeJSBlock('
	 
	 window.addEvent("load",function(){

	 	

	 	new UIPopover("'.$id.'", {
                    description: '.json_encode($config['text']).',
                    anchor: UIPopover.AnchorTo("top")
                });


	 });

');
?></span>