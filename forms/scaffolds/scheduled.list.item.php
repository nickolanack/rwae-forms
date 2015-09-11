<?php
$data = $params['formData'];

$span = function ($name, $default = null) use($data) {
    $value = $data->{$name};
    if (empty($value) && ! is_null($default)) {
        $value = $default;
    }
    ?><span class="data-<?php echo $name?>"><?php echo $value;?></span><?php
};

$span('admin-year');
$span('admin-quarter');
$span('agency-name', '<span class="form-value-empty">empty-agency</span>');
$span('participant-first-name', '<span class="form-value-empty">empty-name</span>');
