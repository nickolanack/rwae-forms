<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Schedule D Quarterly</h2>
	<section class="b">
		<?php Scaffold('form.section.admin');?>
		<hr />
		<?php Scaffold('form.section.agency');?>
		<hr />
        <?php Scaffold('form.section.participant.b');?>
	</section>

	<h4>Employment</h4>
	<section class="c">
		<h4>Any changes in this person’s employment through RWA since their
			Schedule D or last Quarterly Update (or Addendum)?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="employed-quarter" id="qtr-cbx-employ" /> Yes </label><label><input
				type="radio" value="no" name="employed-quarter"
				id="qtr-cbx-no-employ" checked="checked" /> No </label></span>
				<?php
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.qtr-jobs")',
            'enabler' => '$("qtr-cbx-employ")',
            'disabler' => '$("qtr-cbx-no-employ")'
        ));
    
    Scaffold('form.switch', 
        array(
            'name' => 'employed-quarter',
            'className' => 'jobs',
            'callback' => function () {
                ?><?php
            }
        ))?>



		<span class="qtr-jobs jobs" style="display: none;">

			<?php

Scaffold('form.scheduled.job');
Scaffold('form.button.addjob', array(
    'elementsArray' => '$$(".qtr-jobs")'
));
?>


                <hr style="margin-top: 110px;" />
			<section>
				<h3>RWA Section</h3>
				<label>Facilitator / Coordinator <input type="text" value=""
					name="participant-facilitator" />
				</label>
			</section>

		</span>


		<hr />

		<h4>Any changes in this person’s need for or use of supports for
			employment from RWA since their last Schedule D or last Quarterly
			Update (or Addendum)?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="job-supports" id="qtr-cbx-supports" /> Yes </label><label><input
				type="radio" value="no" name="job-supports" id="qtr-cbx-no-supports"
				checked="checked" /> No </label></span>
				<?php
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.qtr-jobs")',
            'enabler' => '$("qtr-cbx-employ")',
            'disabler' => '$("qtr-cbx-no-employ")'
        ));
    ?>


		<span class="qtr-job-supports job-supports" style="display: none;">

			<?php

Scaffold('script.radiobutton.display.toggle', 
    array(
        'elementArray' => '$$("span.qtr-job-supports")',
        'enabler' => '$("qtr-cbx-supports")',
        'disabler' => '$("qtr-cbx-no-supports")'
    ));
?>


         <span class="qtr-job-supports jobs" style="display: none;">
				<hr />
				<?php
    
    Scaffold('form.scheduled.job.support', array(
        'class' => 'sch-job'
    ));
    
    ?>


		</span>


		</span>



	</section>

	<h4>Post Secondary Education</h4>
	<section class="a">


		<h4>Was this person enrolled in post-secondary education as a result
			of RWA for any part of this quarter?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="enrolled-quarter" id="qtr-cbx-enrolled" /> Yes </label><label><input
				type="radio" value="no" name="enrolled-quarter"
				id="qtr-cbx-no-enrolled" checked="checked" /> No </label></span>
				<?php
    
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.qtr-enrolled")',
            'enabler' => '$("qtr-cbx-enrolled")',
            'disabler' => '$("qtr-cbx-no-enrolled")'
        ));
    
    ?>
    <span class="qtr-enrolled" style="display: none;">
			<hr /> <span class="group"><span class="left"><label>Start date <input
						type="date" value="" name="enroll-start-date" /></label> <label>Expected
						duration of program <input style="width: 150px;" type="number"
						value="" name="enroll-duration-months" />
				</label> <label><input type="checkbox" value="true"
						name="enroll-less-month" /> (Check if less than 1 month)</label> </span><span
				class="right">
					<h4>Type of program</h4> <span class="inline"> <label><input
							type="radio" value="" name="enroll-type" /> College, CEGEP or
							technical institute</label> <label><input type="radio" value=""
							name="enroll-type" /> Trades school</label> <label><input
							type="radio" value="" name="enroll-type" /> University</label> <label><input
							type="radio" value="" name="enroll-type" /> Other (if other,
							please describe)</label>
				</span> <textarea name="enroll-type-other"
						style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>

			</span><span class="left"> <label>Name of institution <input
						type="text" value="" name="enroll-institution" /></label> <label>Name
						of program <input type="text" value="" name="enroll-program" />
				</label></span></span>
		</span> <span class="qtr-enrolled" style="display: none;">
			<h3>Supports for Post-Secondary Education</h3>
			<h4>Any changes in this person’s need for or use of supports from RWA
				for post-secondary education since their last Schedule D or last
				Quarterly Update (or Addendum)?</h4> <span class="inline"><label><input
					type="radio" value="yes" name="enrollment-supports"
					id="qtr-cbx-e-supports" /> Yes </label><label><input type="radio"
					value="no" name="enrollment-supports" id="qtr-cbx-no-e-supports"
					checked="checked" /> No </label></span>

<?php
Scaffold('script.radiobutton.display.toggle', 
    array(
        
        'elementArray' => '$$("span.qtr-enroll-supports")',
        'enabler' => '$("qtr-cbx-e-supports")',
        'disabler' => '$("qtr-cbx-no-e-supports")'
    ));

?>

<span class="qtr-enroll-supports" style="display: none;">
				<hr /> <span class="group"><span class="left">
						<h4>Tutor (or similar)</h4> <label>Number of hours per week <input
							style="width: 150px;" type="number" value=""
							name="enrollment-support-coach-hours-weekly" />
					</label> <label>Hourly rate <input type="number" value=""
							name="enrollment-support-coach-rate" />
					</label><label>Number of weeks needed <input style="width: 150px;"
							type="number" value="" name="enrollment-support-coach-weeks" />
					</label> <label>Total $ needed for tutor (or similar) at this
							request <input style="width: 50px;" type="number" value=""
							name="enrollment-support-coach-total" />
					</label><label>Provider <input type="text" value=""
							name="enrollment-support-trans-provider" />
					</label>
				</span><span class="right">
						<h4>Transportation</h4> <label>Number of trips <input
							type="number" value="" name="enrollment-support-trans-trips" />
					</label> <label>Rate per trip <input type="number" value=""
							name="enrollment-support-trans-rate" />
					</label><label>Number of weeks needed <input style="width: 150px;"
							type="number" value="" name="enrollment-support-trans-weeks" />
					</label> Other justification if applicable<textarea
							name="enrollment-support-trans-justification"
							style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>

						<label>Total $ needed for transportation at this request <input
							style="width: 50px;" type="number" value=""
							name="enrollment-support-trans-total" />
					</label> <label>Provider <input type="text" value=""
							name="enrollment-support-trans-provider" />
					</label>
				</span><span class="right">
						<h4>Other</h4>
						<div style="width: 380px;">Please describe any other charge not
							captured above (e.g., for uniform, supplies, fees, devices,
							ramps, etc.)</div> <textarea
							name="enrollment-support-trans-other"
							style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>
						<label>Total $ needed for this other support this request<input
							style="width: 50px;" type="number" value=""
							name="enrollment-support-trans-total" />
					</label><label>Provider <input type="text" value=""
							name="enrollment-support-trans-other-provider" />
					</label>
				</span><span class="right">
						<h4>Comments</h4> <textarea name="enrollment-support-trans-other"
							style="resize: vertical; width: 380px; box-sizing: border-box;"></textarea>

				</span></span>


		</span>
		</span>
	</section>

</form>