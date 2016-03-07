
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

?>

<p>* Nicely Formatted Documents is under development</p>
	</section>
</div>