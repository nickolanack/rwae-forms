
<?php
$config = array_merge(array(
    'prefix' => 'job-1'
), $params);
$prefix = $config['prefix'];
?>

<label>Start date <input type="date" value=""
	name="<?php echo $prefix;?>-start-date" />
</label>
<label>Name of firm <input type="text" value=""
	name="<?php

echo $prefix;
?>-firm" />
</label>
<label>Community <input type="text" value=""
	name="<?php echo $prefix; ?>-community" />
</label>
<h4>Type of Job</h4>
<span class="inline"><label><input type="radio"
		value="permanent-part-time" name="<?php

echo $prefix;
?>-type" /> Permanent part-time </label> <label><input type="radio"
		value="permanent-full-time" name="<?php echo $prefix;?>-type" />
		Permanent full-time </label> <label><input type="radio"
		value="seasonal-part-time" name="<?php

echo $prefix;
?>-type" /> Seasonal part-time </label> <label><input type="radio"
		value="seasonal-full-time" name="<?php echo $prefix;?>-type" />
		Seasonal full-time </label> </span>
<br />
<label>Job title <input type="text" value=""
	name="<?php

echo $prefix;
?>-title" />
</label>
<label>Number of hours per week <input style="width: 50px;"
	type="number" value="" step="any" min="0"
	name="<?php echo $prefix;?>-hours-weekly" />
</label>
<label>Industry sector code <!--  <input style="width: 100px;" type="text"
	value="" name="<?php

echo $prefix;
?>-sector" />--> <select name="<?php

echo $prefix;
?>-sector" value="">
		<option value="ADMIN">Administration</option>
		<option value="AGRIC">Agriculture/Forestry</option>
		<option value="ARTS">Arts/Entertainment/Recreation</option>
		<option value="CONST">Construction</option>
		<option value="EDUC">Education & Early Learning</option>
		<option value="FINA">Finance & Insurance</option>
		<option value="FOOD">Food Services</option>
		<option value="HLTH">Health Care & Social Assistance</option>
		<option value="IT">Information & Communication Technology</option>
		<option value="CULT">Information & Culture</option>
		<option value="MGMT">Management</option>
		<option value="MANU">Manufacturing</option>
		<option value="NTRL">Natural Resources</option>
		<option value="PROF">Professional, Science & Tech Services</option>
		<option value="PUBL">Public Administration</option>
		<option value="REAL">Real Estate</option>
		<option value="RETA">Retail</option>
		<option value="TRANS">Transportation</option>
		<option value="TRVL">Travel & Tourism</option>
		<option value="UTIL">Utilities</option>
		<option value="WARE">Warehousing</option>
		<option value="OTHER">Other services (repair, laundry, religious)</option>


</select>

</label>
<label>Hourly wage/salary <input style="width: 100px;" type="number"
	value="" step="any" min="0" name="<?php echo $prefix;?>-wage" />
</label>
<h4>Is this self-employment?</h4>
<span class="inline"><label><input type="radio" value="yes"
		name="<?php

echo $prefix;
?>-self-employment" /> Yes </label><label><input type="radio" value="no"
		name="<?php echo $prefix;?>-self-employment" /> No </label> </span>
<h4>Number of other employees at his/her workplace (your best estimate)</h4>
<span class="inline"><label><input type="radio" value="0"
		name="<?php

echo $prefix;
?>-num-employees" /> 0 (Self-employed, sole employee) </label> <label><input
		type="radio" value="1-9" name="<?php echo $prefix;?>-num-employees" />
		1-9 </label> <label><input type="radio" value="10-19"
		name="<?php

echo $prefix;
?>-num-employees" /> 10-19 </label> <label><input type="radio"
		value="20-49" name="<?php echo $prefix;?>-num-employees" /> 20-49 </label>
	<label><input type="radio" value="50-99"
		name="<?php

echo $prefix;
?>-num-employees" /> 50-99 </label> <label><input type="radio"
		value="100-plus" name="<?php echo $prefix;?>-num-employees" /> 100+ </label>
	<label><input type="radio" value="unknown"
		name="<?php echo $prefix;?>-num-employees" /> Unknown </label> </span>
<h4>Comments (if any)</h4>
<textarea type="text" name="<?php

echo $prefix;
?>-comments"
	style="resize: vertical; width: 250px; box-sizing: border-box;">
	</textarea>