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
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_edit.png') . '?tint=rgb(255,255,255)");

}


.scheduled-item>.btn-activate{
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'down_arrow.png') . '?tint=rgb(0,0,0)");
}
    .scheduled-item>.btn-activate.active{
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Control Panel Icons' . DS . 'up_arrow.png') . '?tint=rgb(0,0,0)");
}

.scheduled-item>.btn-danger {
    background-image:url("' .
    UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png') . '?tint=rgb(255,255,255)");
    background-size:11px;
    width: 1px;
}
.scheduled-item>.btn-success {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png') . '?tint=rgb(0,68,204)");
    background-size:11px;
    width: 1px;
}


.subforms-list .btn-primary {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_edit.png') . '?tint=rgb(0,0,0)");
}

.scheduled-item .btn-remove {
    background-image:url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_delete.png') . '?tint=rgb(235, 0, 139)");
    background-color: transparent;
    box-shadow: none;

}

.subform-expected-quarterly>.btn-primary {
    background-image: url("' . UrlFrom(Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'xsm_plus.png') . '?tint=rgb(0,0,0)");
}

');