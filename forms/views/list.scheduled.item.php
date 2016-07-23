<?php
$data = $params['formData'];

$span = function ($name, $default = null) use ($data) {
    $value = $data->{$name};
    if (empty($value) && !is_null($default)) {
        $value = $default;
    }
    ?><span class="data-<?php echo $name ?>"><?php echo $value; ?></span><?php
};
$span('participant-id');




?><span class="data-q">(<?php 

	//TODO move this to a function.

	$starty=2014;
	$startq=2; //0, 1, 2, 3


	$q=(((int)$data->{'admin-year'})-2014)*4;
	$q-=$startq;

	$q+=(int)$data->{'admin-quarter'};


	echo 'Q'.$q; 


	?>)</span><?php
$span('admin-year');
$span('admin-quarter');
$span('agency-name', '<span class="form-value-empty">empty-agency</span>');
$span('participant-first-name', '<span class="form-value-empty">empty-name</span>');
