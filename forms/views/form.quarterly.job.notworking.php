<?php
$config = array_merge(array(
    'prefix' => 'job-1-'
), $params);
$prefix = $config['prefix'];
?>


<h4>If not working, went to new employment or enrolled in post-
	secondary education this quarter (Please check all that apply.)</h4>
<span class="inline"> <label><input type="checkbox"
		value="went-to-new-employer"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Went to new
		employer</label> <label><input type="checkbox"
		value="went-to-self-employment"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Went to self-
		employment</label> <label><input type="checkbox"
		value="going-to-school"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Going to school</label>
	<label><input type="checkbox" value="illness-or-disability"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Illness/
		disability</label> <label><input type="checkbox"
		value="waiting-for-recall"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Waiting for
		recall</label> <label><input type="checkbox"
		value="laid-off-indefinitely"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Laid off
		indefinitely</label> <label><input type="checkbox" value="quit"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Quit</label> <label><input
		type="checkbox" value="was-terminated"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Was Terminated</label>
	<label><input type="checkbox" value="other-reason"
		name="<?php echo $prefix; ?>-notworking-reason[]" /> Other reason</label>
</span>


<h4>Details, Please</h4>
<textarea type="text" name="<?php

echo $prefix;
?>-notworking-details"
	style="resize: vertical; width: 250px; box-sizing: border-box;">
	</textarea>


<label>Date s/he left the job (MM/DD/YYYY)<input type="date" value=""
	name="participant-start-date" /></label>

<h4>Comments</h4>
<textarea type="text"
	name="<?php

echo $prefix;
?>-not-working-comments"
	style="resize: vertical; width: 250px; box-sizing: border-box;">
	</textarea>