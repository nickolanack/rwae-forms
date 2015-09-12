<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Schedule D</h2>
	<h3>Administrative and Baseline</h3>
	<section class="c">

		<span class="group"><label><span class="lbl">Year </span> <input
				type="number" value="" name="admin-year" /></label><label
			class="pull-right">Quarter <input type="radio" value="1"
				name="admin-quarter" /> 1st <input type="radio" value="2"
				name="admin-quarter" /> 2nd <input type="radio" value="3"
				name="admin-quarter" /> 3rd <input type="radio" value="4"
				name="admin-quarter" /> 4th
		</label></span>
		<hr />
		<label><span class="lbl">Agency name </span><input type="text"
			value="" name="agency-name" /> </label><label><span class="lbl">Agency
				contact person </span><input type="text" value=""
			name="agency-contact-person" /> </label> <label><span class="lbl">Contact
				person’s phone </span><input type="tel" value=""
			name="agency-contact-phone" /> </label><label><span class="lbl">Contact
				person’s email </span><input type="email" value=""
			name="agency-contact-email" /> </label>

		<hr />
		<h3>Participant</h3>
		<span class="group"> <span class="left"> <label>First name or nickname
					<input type="text" value="" name="participant-first-name" />
			</label> <label>Province/Territory <input type="text" value=""
					name="participant-province-territory" />
			</label><label>Start date with RWA <input type="date" value=""
					name="participant-start-date" />
			</label> <label>Individual's community <input type="text" value=""
					name="participant-age" />
			</label>
		</span><span class="right"> <!-- right -->
				<h4>His/her gender</h4> <span class="inline"><label><input
						type="radio" value="M" name="participant-gender" /> Male</label> <label><input
						type="radio" value="F" name="participant-gender" /> Female</label></span>
				<h4>Age (best estimate)</h4> <span class="inline"> <label><input
						type="radio" value="" name="participant-age" /> 15-24</label> <label><input
						type="radio" value="" name="participant-age" /> 25-34</label> <label><input
						type="radio" value="" name="participant-age" /> 35-44</label> <label><input
						type="radio" value="" name="participant-age" /> 45-54</label> <label><input
						type="radio" value="" name="participant-age" /> 55-64</label> <label><input
						type="radio" value="" name="participant-age" /> 65 + </label>
			</span>
		</span><span class="left">
				<h4>His/her disability (Check any that apply.)</h4> <span
				class="inline"><label><input type="checkbox" value=""
						name="participant-disabilities[]" /> Autism Spectrum Disorder </label>
					<label><input type="checkbox" value=""
						name="participant-disabilities[]" /> Intellectual Disability </label></span>

		</span>
		</span>
		<hr />
		<h4>His/her sources of income in the year before coming into RWA.
			(Check any that apply.)</h4>
		<label><input type="checkbox" value="employment-or-self-employment"
			name="participant-previous-income" /> Earnings from employment or
			self-employment </label> <label><input type="checkbox"
			value="employment-insurance" name="participant-previous-income" />
			Employment insurance </label> <label><input type="checkbox"
			value="quebec-canada-pension" name="participant-previous-income" />
			Canada/Quebec Pension Plan (Disability) </label> <label><input
			type="checkbox" value="workers-compensation"
			name="participant-previous-income" /> Workers’ compensation </label>
		<label class="longtext"><input type="checkbox"
			value="social-assistance" name="participant-previous-income" />
			Social assistance, incl. provincial / territorial disability program
		</label> <label><input type="checkbox" value="other"
			name="participant-previous-income" /> Other </label>
	</section>

	<h3>Initial Activities</h3>
	<h4>Employment</h4>
	<section class="a">

		<h4>Was this person employed as a result of RWA for any part of this
			quarter?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="employed-quarter" id="sch-cbx-employ" /> Yes </label><label><input
				type="radio" value="no" name="employed-quarter"
				id="sch-cbx-no-employ" checked="checked" /> No </label></span>
				<?php
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.sch-jobs")',
            'enabler' => '$("sch-cbx-employ")',
            'disabler' => '$("sch-cbx-no-employ")'
        ));
    
    ?>

		<span class="sch-jobs jobs" style="display: none;">
			<hr />
			<?php

Scaffold('form.scheduled.job');
Scaffold('form.button.addjob', array(
    'elementsArray' => '$$(".sch-jobs")'
));
?>



                <hr style="margin-top: 110px;" />
			<section>
				<h3>RWA Section</h3>
				<label>Facilitator / Coordinator <input type="text" value=""
					name="participant-facilitator" />
				</label> <label>Participant’s ID <input type="text" value=""
					name="participant-id" />
				</label>
			</section>

		</span> <span class="sch-jobs jobs" style="display: none;">
			<h3>Supports For Employment</h3>
			<h4>Does this person require any supports from RWA for employment?</h4>
			<span class="inline"><label><input type="radio" value="yes"
					name="job-supports" id="sch-cbx-supports" /> Yes </label><label><input
					type="radio" value="no" name="job-supports"
					id="sch-cbx-no-supports" checked="checked" /> No </label></span>

<?php

Scaffold('script.radiobutton.display.toggle', 
    array(
        
        'elementArray' => '$$("span.sch-job-supports")',
        'enabler' => '$("sch-cbx-supports")',
        'disabler' => '$("sch-cbx-no-supports")'
    ));
?>


         <span class="sch-job-supports" style="display: none;">
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
	<section class="b">


		<h4>Was this person enrolled in post-secondary education as a result
			of RWA for any part of this quarter ?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="enrolled-quarter" id="sch-cbx-enrolled" /> Yes </label><label><input
				type="radio" value="no" name="enrolled-quarter"
				id="sch-cbx-no-enrolled" checked="checked" /> No </label></span>
				<?php
    
    Scaffold('script.radiobutton.display.toggle', 
        array(
            
            'elementArray' => '$$("span.sch-enrolled")',
            'enabler' => '$("sch-cbx-enrolled")',
            'disabler' => '$("sch-cbx-no-enrolled")'
        ));
    
    ?>
    <span class="sch-enrolled" style="display: none;">
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
		</span> <span class="sch-enrolled" style="display: none;">
			<h3>Supports for Post-Secondary Education</h3>
			<h4>Does this person require any supports from RWA for post-secondary
				education?</h4> <span class="inline"><label><input type="radio"
					value="yes" name="enrollment-supports" id="sch-cbx-e-supports" />
					Yes </label><label><input type="radio" value="no"
					name="enrollment-supports" id="sch-cbx-no-e-supports"
					checked="checked" /> No </label></span>

<?php
Scaffold('script.radiobutton.display.toggle', 
    array(
        
        'elementArray' => '$$("span.sch-enroll-supports")',
        'enabler' => '$("sch-cbx-e-supports")',
        'disabler' => '$("sch-cbx-no-e-supports")'
    ));

?>

<span class="sch-enroll-supports" style="display: none;">
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