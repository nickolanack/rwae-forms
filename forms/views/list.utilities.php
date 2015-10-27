
<div id="list-utilities" class="">
	<section>

		<?php
Scaffold('cpanel.button', 
    array(
        'title' => 'Export as Spreadsheet',
        'className' => 'btn btn-primary big',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_table.png?tint=rgb(255,255,255)',
        'script' => '

           window.open("' .
             UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export", "_blank");


        '
    ));

?>
	</section>
</div>