<?php
$config = array_merge(array(
    'n' => 1,
    'class' => '',
    'style' => ''
), $params);

$num = [
    'One',
    'Two',
    'Three'
];

?><section class="job <?php echo $config['class'];?>" style="<?php echo $config['style'];?>">
	<h4>Job <?php echo $num[$config['n']-1];?></h4>
	<label>Start date <input type="text" value=""
		name="job-<?php echo $config['n'];?>-start-date" />
	</label> <label>Name of firm <input type="text" value=""
		name="job-<?php

echo $config['n'];
?>-firm" />
	</label><label>Community <input type="text" value=""
		name="job-<?php echo $config['n']; ?>-community" />
	</label>
	<h4>Type of Job</h4>
	<span class="inline"><label><input type="radio" value=""
			name="job-<?php

echo $config['n'];
?>-type" /> Permanent part-time </label> <label><input type="radio"
			value="" name="job-<?php echo $config['n'];?>-type" /> Permanent
			full-time </label> <label><input type="radio" value=""
			name="job-<?php

echo $config['n'];
?>-type" /> Seasonal part-time </label> <label><input type="radio"
			value="" name="job-<?php echo $config['n'];?>-type" /> Seasonal
			full-time </label> </span><br /> <label>Job title <input type="text"
		value="" name="job-<?php

echo $config['n'];
?>-title" />
	</label> <label>Number of work hours per week <input
		style="width: 20px;" type="text" value=""
		name="job-<?php echo $config['n'];?>-hours-weekly" />
	</label> <label>Industry sector code <input style="width: 100px;"
		type="text" value="" name="job-<?php

echo $config['n'];
?>-sector" />
	</label> <label>Hourly wage/salary <input style="width: 100px;"
		type="text" value="" name="job-<?php echo $config['n'];?>-wage" />
	</label>
	<h4>Is this self-employment?</h4>
	<span class="inline"><label><input type="radio" value="yes"
			name="job-<?php

echo $config['n'];
?>-self-employment" /> Yes </label><input type="radio" value="no"
		name="job-<?php echo $config['n'];?>-self-employment" /> No </label> </span>
	<h4>Number of other employees at his/her workplace</h4>
	<span class="inline"><label><input type="radio" value="0"
			name="job-<?php

echo $config['n'];
?>-num-employees" /> 0 (Self-employed, sole employee) </label> <label><input
			type="radio" value="1-9"
			name="job-<?php echo $config['n'];?>-num-employees" /> 1-9 </label> <label><input
			type="radio" value="10-19"
			name="job-<?php

echo $config['n'];
?>-num-employees" /> 10-19 </label> <label><input type="radio"
			value="20-49" name="job-<?php echo $config['n'];?>-num-employees" />
			20-49 </label> <label><input type="radio" value="50-99"
			name="job-<?php

echo $config['n'];
?>-num-employees" /> 50-99 </label> <label><input type="radio"
			value="100+" name="job-<?php echo $config['n'];?>-num-employees" />
			100+ </label></span>
	<h4>Comments (if any)</h4>
	<textarea type="text" name="job-<?php

echo $config['n'];
?>-comments"
		style="resize: vertical; width: 250px; box-sizing: border-box;">
	</textarea>
    <?php
    
    if ($config['n'] == 1) {
        
        Scaffold('scheduled.job', array(
            'n' => 2,
            'class' => 'two'
        ));
        Scaffold('scheduled.job', array(
            'n' => 3,
            'class' => 'three'
        ));
    }
    ?>
</section>