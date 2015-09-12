<?php
$config = array_merge(array(
    'prefix' => 'job-1'
), $params);
$prefix = $config['prefix'];

if ($prefix == "job-") {
    throw new Exception("Expecting a number at the end of prefix ie: job-3");
}
?>
<label>New job title (if applicable) <input type="text" value=""
	name="<?php
echo $prefix?>-title" />
</label>


<h4>Promoted this quarter?</h4>
<span class="inline"><label><input type="radio" value="yes"
		name="<?php

echo $prefix;
?>-promoted" /> yes </label> <label><input type="radio" value="no"
		name="<?php echo $prefix;?>-promoted" /> no </label></span>

<h4>Any change in hourly wage/salary this quarter?</h4>
<span class="inline"><label><input type="radio" value="yes"
		name="<?php

echo $prefix;
?>-wage-changed" /> yes </label> <label><input type="radio" value="no"
		name="<?php echo $prefix;?>-wage-changed" /> no </label></span>
<label>New Hourly wage/salary <input style="width: 100px;" type="number"
	value="no" name="<?php echo $prefix;?>-wage" /></label>

<h4>Any change in the number of hours of work per week?</h4>
<span class="inline"><label><input type="radio" value="yes-increase"
		name="<?php

echo $prefix;
?>-hours-changed" /> yes increase</label> <label><input type="radio"
		value="yes-decrease" name="<?php echo $prefix;?>-hours-changed" /> yes
		decrease </label> <label><input type="radio" value="no"
		name="<?php echo $prefix;?>-hours-changed" /> no </label></span>
<label>New number of hours per week <input style="width: 100px;"
	type="number" value="" name="<?php echo $prefix;?>-hours-weekly" /></label>