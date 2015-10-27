
<div id="list-utilities" class="">
	<section>

		<?php
Scaffold('cpanel.button', 
    array(
        'title' => 'Export Spreadsheets',
        'className' => 'btn btn-danger',
        'icon' => Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'download.png?tint=rgb(255,255,255)',
        'script' => '

            window.open("' .
             UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-scheduled", "_blank");
            window.open("' .
             UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-addendum", "_blank");
            window.open("' .
             UrlFrom(dirname(__DIR__) . DS . 'admin.php') . '?task=export-quarterly", "_blank");
        '
    ));

?>
	</section>
</div>