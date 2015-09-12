<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Schedule D Quarterly</h2>
	<h3>To be completed ONLY if the participant has a new employer, is
		newly self-employed or is newly enrolled in post-secondary education</h3>
	<section class="b">

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
		<label>First name or nickname <input type="text" value=""
			name="participant-first-name" />
		</label><label>Participant’s ID <input type="text" value=""
			name="participant-id" />
		</label>

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
    ?>


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


         <span class="qtr-job-supports" style="display: none;">
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


		<h4>Any changes in this person’s employment through RWA since their
			Schedule D or last Quarterly Update (or Addendum)?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="enrolled-quarter" id="cbx-enrolled" /> Yes </label><label><input
				type="radio" value="no" name="enrolled-quarter" id="cbx-no-enrolled"
				checked="checked" /> No </label></span>
				<?php
    
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.enrolled")',
            'enabler' => '$("cbx-enrolled")',
            'disabler' => '$("cbx-no-enrolled")'
        ));
    
    ?>
    <span class="enrolled" style="display: none;">
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
		</span>
	</section>

</form>