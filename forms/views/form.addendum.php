<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Schedule D Addendum</h2>
	<h3>To be completed ONLY if the participant has a new employer, is
		newly self-employed or is newly enrolled in post-secondary education</h3>
	<section class="a">

		<?php Scaffold('form.section.admin');?>
		<hr />
		<?php Scaffold('form.section.agency');?>
		<hr />
		<?php Scaffold('form.section.participant.b');?>
	</section>

	<h4>Employment</h4>
	<section class="b">
		<h4>did employment change?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="employed-quarter" id="add-cbx-employ" /> Yes </label><label><input
				type="radio" value="no" name="employed-quarter"
				id="add-cbx-no-employ" checked="checked" /> No </label></span>
				<?php
    Scaffold('script.radiobutton.display.toggle', 
        array(
            'elementArray' => '$$("span.jobs")',
            'enabler' => '$("add-cbx-employ")',
            'disabler' => '$("add-cbx-no-employ")'
        ));
    ?>


		<span class="add-jobs jobs" style="display: none;">

			<?php

Scaffold('form.scheduled.job');
Scaffold('form.button.addjob', array(
    'elementsArray' => '$$(".add-jobs")'
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



	</section>

	<h4>Post Secondary Education</h4>
	<section class="c">


		<h4>did enrollment change?</h4>
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