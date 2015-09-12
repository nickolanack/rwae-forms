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

?><section class="job <?php echo $config['class'];?>">
	<h4>Support Details For Job <?php echo $num[$config['n']-1];?></h4>
	<span class="group"><span class="left">
			<h4>Job Coach</h4> <label>Number of hours per week <input
				style="width: 50px;" type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-coach-hours-weekly" />
		</label> <label>Hourly rate <input type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-coach-rate" />
		</label><label>Number of weeks needed <input style="width: 50px;"
				type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-coach-weeks" />
		</label> <label>Total $ needed for job coach at this request <input
				type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-coach-total" />
		</label>
	</span><span class="right">
			<h4>Transportation</h4> <label>Number of trips <input
				style="width: 100px;" type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-trips" />
		</label> <label>Rate per trip <input type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-rate" />
		</label><label>Number of weeks needed <input style="width: 50px;"
				type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-weeks" />
		</label> Other justification if applicable<textarea
				name="job-support-<?php echo $config['n']; ?>-trans-justification"
				style="resize: vertical; width: 250px; box-sizing: border-box;"></textarea>

			<label>Total $ needed for transportation at this request <input
				type="number" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-total" />
		</label> <label>Provider <input type="text" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-provider" />
		</label>
	</span><span class="right">
			<h4>Other</h4>
			<div style="width: 250px;">Please describe any other charge not
				captured above (e.g., for uniform, supplies, fees, devices, ramps,
				etc.)</div> <textarea type="text"
				name="job-support-<?php echo $config['n']; ?>-trans-other"
				style="resize: vertical; width: 250px; box-sizing: border-box;"></textarea>
			<label>Provider <input type="text" value=""
				name="job-support-<?php echo $config['n']; ?>-trans-other-provider" />
		</label>
	</span></span>
 <?php

if ($config['n'] == 1) {
    
    Scaffold('form.scheduled.job.support', array(
        'n' => 2,
        'class' => 'two'
    ));
    Scaffold('form.scheduled.job.support', array(
        'n' => 3,
        'class' => 'three'
    ));
}
?>
</section>