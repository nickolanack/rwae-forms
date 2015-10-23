<div id="list-schedule-d" class="enabled">
	<section>
		<div>Loading</div>
	</section>
</div>

<?php
Behavior('popover');
IncludeCSSBlock(
    '
.scheduled-item>.btn-primary, .subforms-list .btn-primary {
    background-image:url("' .
         UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_edit.png') . '?tint=rgb(255,255,255)");

}

.scheduled-item>.btn-danger {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png') .
         '?tint=rgb(255,255,255)");
    background-size:11px;
    width: 1px;
}
.scheduled-item>.btn-success {
    background-image:url("' .
         UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png') .
         '?tint=rgb(0,68,204)");
    background-size:11px;
    width: 1px;
}


.subforms-list .btn-primary {
    background-image:url("' .
         UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_edit.png') . '?tint=rgb(0,0,0)");

}
');