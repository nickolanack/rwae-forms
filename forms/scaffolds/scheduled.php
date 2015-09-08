<form>
	<h2>Administrative and Baseline</h2>
	<section>

		<label>Year <input type="text" value="<?php echo date('Y'); ?>"
			name="year" /></label> <span class="group">Quarter <label><input
				type="radio" value="" name="quarter" /> 1st</label> <label><input
				type="radio" value="" name="quarter" /> 2nd</label> <label><input
				type="radio" value="" name="quarter" /> 3rd</label> <label><input
				type="radio" value="" name="quarter" /> 4th</label></span> <label>Agency
			name <input type="text" value="" name="agency_name" />
		</label> <label>Agency contact person <input type="text" value=""
			name="agency_contact_person" />
		</label> <label>Contact person’s phone <input type="text" value=""
			name="agency_contact_phone" />
		</label>
	</section>

	<section>
		<span class="group"> <span class="left"> <label>Participant's first
					name or nickname <input type="text" value=""
					name="participant_first_name" />
			</label> <label>Province/Territory <input type="text" value=""
					name="participant_province_territory" />
			</label><label>Start date with RWA <input type="text" value=""
					name="participant_start_date" />
			</label> <label>Individual's community <input type="text" value=""
					name="participant_age" />
			</label>
		</span><span class="right"> <!-- right -->
				<h3>His/her gender</h3> <label><input type="radio" value="M"
					name="participant_gender" /> Male</label> <label><input
					type="radio" value="F" name="participant_gender" /> Female</label>
				<h3>Age (best estimate)</h3> <label><input type="radio" value=""
					name="participant_age" /> 15-24</label> <label><input type="radio"
					value="" name="participant_age" /> 25-34</label> <label><input
					type="radio" value="" name="participant_age" /> 35-44</label> <label><input
					type="radio" value="" name="participant_age" /> 45-54</label> <label><input
					type="radio" value="" name="participant_age" /> 55-64</label> <label><input
					type="radio" value="" name="participant_age" /> 65 + </label>
				<h3>His/her disability (Check any that apply.)</h3> <label><input
					type="checkbox" value="" name="participant_disability[]" /> Autism
					Spectrum Disorder </label> <label><input type="checkbox" value=""
					name="participant_disability[]" /> Intellectual Disability </label>

		</span>
		</span>
	</section>



	<section>
		<h3>His/her sources of income in the year before coming into RWA.
			(Check any that apply.)</h3>
		<label><input type="checkbox" value="employment-or-self-employment"
			name="participant_previous_income[]" /> Earnings from employment or
			self-employment </label> <label><input type="checkbox"
			value="employment-insurance" name="participant_previous_income[]" />
			Employment insurance </label> <label><input type="checkbox"
			value="quebec-canada-pension" name="participant_previous_income[]" />
			Canada/Quebec Pension Plan (Disability) </label> <label><input
			type="checkbox" value="workers-compensation"
			name="participant_previous_income[]" /> Workers’ compensation </label>
		<label><input type="checkbox" value="social-assistance"
			name="participant_previous_income[]" /> Social assistance, incl.
			provincial / territorial disability program </label> <label><input
			type="checkbox" value="other" name="participant_previous_income[]" />
			Other </label>
	</section>

	<h2>Initial Activities</h2>

	<section>
		<h3>Employment</h3>
		<h3>Was this person employed as a result of RWA for any part of this
			quarter?</h3>
		<span class="group"><label><input type="radio" value="yes"
				name="employed-quarter" checked="checked" /> Yes </label> <label><input
				type="radio" value="no" name="employed-quarter" /> No </label></span>


		<section>
			<h3>Job One</h3>
			<label>Start date <input type="text" value="" name="job-start-date[]" />
			</label> <label>Name of firm <input type="text" value=""
				name="job-firm[]" />
			</label><label>Community <input type="text" value=""
				name="job-community[]" />
			</label>
			<h3>Type of Job</h3>
			<label><input type="radio" value="" name="job-type[]" /> Permanent
				part-time </label> <label><input type="radio" value=""
				name="job-type[]" /> Permanent full-time </label> <label><input
				type="radio" value="" name="job-type[]" /> Seasonal part-time </label>

			<label><input type="radio" value="" name="job-type[]" /> Seasonal
				full-time </label> <label>Job title <input type="text" value=""
				name="job-title[]" />
			</label> <label>Number of work hours per week <input type="text"
				value="" name="job-hours-weekly[]" />
			</label> <label>Industry sector code <input type="text" value=""
				name="job-sector[]" />
			</label> <label>Hourly wage/salary <input type="text" value=""
				name="job-wage[]" />
			</label>
			<h3>Is this self-employment?</h3>
			<label><input type="radio" value="yes" name="job-self-employment[]" />
				Yes </label><input type="radio" value="no"
				name="job-self-employment[]" /> No </label>

			<h3>Number of other employees at his/her workplace</h3>
			<label><input type="radio" value="0" name="job-num-employees[]" /> 0
				(Self-employed, sole employee) </label> <label><input type="radio"
				value="1-9" name="job-num-employees[]" /> 1-9 </label> <label><input
				type="radio" value="10-19" name="job-num-employees[]" /> 10-19 </label>
			<label><input type="radio" value="20-49" name="job-num-employees[]" />
				20-49 </label> <label><input type="radio" value="50-99"
				name="job-num-employees[]" /> 50-99 </label> <label><input
				type="radio" value="100+" name="job-num-employees[]" /> 100+ </label>
			<label>Comments (if any) <input type="text" value=""
				name="job-comments[]" />
			</label>

		</section>


		<?php
Scaffold('cpanel.button', 
    array(
        'title' => 'Add Another Job',
        'className' => 'btn btn-success pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '


        '
    ));

?>
    <section>
			<h3>RWA Section</h3>
			<label>Facilitator / Coordinator <input type="text" value=""
				name="facilitator" />
			</label> <label>Participant’s ID <input type="text" value=""
				name="participant-id" />
			</label>

		</section>
	</section>



</form>