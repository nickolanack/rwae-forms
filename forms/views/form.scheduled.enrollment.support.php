
<span class="group"><span class="left"><label>Start date of supports<input
			type="date" value="" name="enrollment-support-start-date" /></label>
		<h4>Tutor (or similar)</h4> <label><?php

		Scaffold('form.info',
		    array(
		        'text' => 'If the intensity or duration of supports is reported by the agency provider as a range, please enter the mean/average. If RWA is funding these supports, a definitive number (not a range) is required.',
		        )
		); ?>Number of hours per week <input
			style="width: 150px;" type="number" value="" step="any" min="0"
			name="enrollment-support-coach-hours-weekly" />
	</label> <label>Hourly rate <input type="number" value="" step="any"
			min="0" name="enrollment-support-coach-rate" />
	</label><label><?php

		Scaffold('form.info',
		    array(
		        'text' => 'If the intensity or duration of supports is reported by the agency provider as a range, please enter the mean/average. If RWA is funding these supports, a definitive number (not a range) is required.',
		        )
		); ?>Number of weeks needed <input style="width: 150px;"
			type="number" value="" step="any" min="0"
			name="enrollment-support-coach-weeks" />
	</label> <label>Total $ needed for tutor (or similar) at this request <input
			style="width: 50px;" type="number" value="" step="any" min="0"
			name="enrollment-support-coach-total" />
	</label><label>Provider <input type="text" value=""
			name="enrollment-support-provider" />
	</label>

	<div><?php 

		Scaffold('form.info',
		    array(
		        'text' => ' If these supports were funded by generic/agency supports, you do not need to complete the following fields: hourly rate for tutor, total $ needed for tutor (or similar) at this request.',
		        )
		);

	?>Were these supports funded by generic/agency sources?</div>
<span class="inline">
		<label><input type="radio" value="yes"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-coach" /> Yes </label>
	<label><input type="radio" value="no"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-coach" /> No </label>
</span>

</span><span class="right">
		<h4>Transportation</h4> <label><?php

		Scaffold('form.info',
		    array(
		        'text' => 'If the intensity or duration of supports is reported by the agency provider as a range, please enter the mean/average. If RWA is funding these supports, a definitive number (not a range) is required.',
		        )
		); ?>Number of trips <input type="number"
			value="" name="enrollment-support-trans-trips" />
	</label> <label>Rate per trip <input type="number" value="" step="any"
			min="0" name="enrollment-support-trans-rate" />
	</label><label><?php

		Scaffold('form.info',
		    array(
		        'text' => 'If the intensity or duration of supports is reported by the agency provider as a range, please enter the mean/average. If RWA is funding these supports, a definitive number (not a range) is required.',
		        )
		); ?>Number of weeks needed <input style="width: 150px;"
			type="number" value="" step="any" min="0"
			name="enrollment-support-trans-weeks" />
	</label> Other justification if applicable<textarea
			name="enrollment-support-trans-justification"
			style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>

		<label>Total $ needed for transportation at this request <input
			style="width: 50px;" type="number" value="" step="any" min="0"
			name="enrollment-support-trans-total" />
	</label> <label>Provider <input type="text" value=""
			name="enrollment-support-trans-provider" />
	</label>
	<div><?php 

		Scaffold('form.info',
		    array(
		        'text' => 'If these supports were funded by generic/agency supports, you do not need to complete the following fields: total $ needed for transportation at this request.',
		        )
		);

	?>Were these supports funded by generic/agency sources?</div>
<span class="inline">
		<label><input type="radio" value="yes"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-transportation" /> Yes </label>
	<label><input type="radio" value="no"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-transportation" /> No </label>
</span>
</span><span class="right">
		<h4>Other</h4>
		<div style="width: 380px;">Please describe any other charge not captured above (e.g., for uniform, supplies, fees, devices, ramps, etc.)</div> <textarea name="enrollment-support-trans-other"
			style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>
		<label>Total $ needed for this other support this request<input
			style="width: 50px;" type="number" value="" step="any" min="0"
			name="enrollment-support-trans-other-total" />
	</label><label>Provider <input type="text" value=""
			name="enrollment-support-trans-other-provider" />
	</label>
</span><span class="right">
		<h4>Comments</h4> <textarea name="enrollment-support-trans-other-comments"
			style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>

</span></span>
<div>Were these supports funded by generic/agency sources?</div>
<span class="inline">
		<label><input type="radio" value="yes"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-other" /> Yes </label>
	<label><input type="radio" value="no"
		name="job-support-<?php echo $config['n']; ?>-external-provider-enrollment-other" /> No </label>
</span>
