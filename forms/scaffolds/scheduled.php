<form>
	<h2>Schedule D</h2>
	<section class="b">
		<h3>Administrative and Baseline</h3>
		<span class="group"><label><span class="lbl">Year </span> <input
				type="text" value="<?php echo date('Y'); ?>" name="year" /></label><label
			class="pull-right">Quarter <input type="radio" value="1"
				name="quarter" /> 1st <input type="radio" value="2" name="quarter" />
				2nd <input type="radio" value="3" name="quarter" /> 3rd <input
				type="radio" value="4" name="quarter" /> 4th
		</label></span>
		<hr />
		<label><span class="lbl">Agency name </span><input type="text"
			value="" name="agency_name" /> </label><label><span class="lbl">Agency
				contact person </span><input type="text" value=""
			name="agency_contact_person" /> </label> <label><span class="lbl">Contact
				person’s phone </span><input type="text" value=""
			name="agency_contact_phone" /> </label><label><span class="lbl">Contact
				person’s email </span><input type="text" value=""
			name="agency_contact_email" /> </label>

	</section>

	<section>
		<h3>Participant</h3>
		<span class="group"> <span class="left"> <label>First name or nickname
					<input type="text" value="" name="participant_first_name" />
			</label> <label>Province/Territory <input type="text" value=""
					name="participant_province_territory" />
			</label><label>Start date with RWA <input type="text" value=""
					name="participant_start_date" />
			</label> <label>Individual's community <input type="text" value=""
					name="participant_age" />
			</label>
		</span><span class="right"> <!-- right -->
				<h4>His/her gender</h4> <span class="inline"><label><input
						type="radio" value="M" name="participant_gender" /> Male</label> <label><input
						type="radio" value="F" name="participant_gender" /> Female</label></span>
				<h4>Age (best estimate)</h4> <span class="inline"> <label><input
						type="radio" value="" name="participant_age" /> 15-24</label> <label><input
						type="radio" value="" name="participant_age" /> 25-34</label> <label><input
						type="radio" value="" name="participant_age" /> 35-44</label> <label><input
						type="radio" value="" name="participant_age" /> 45-54</label> <label><input
						type="radio" value="" name="participant_age" /> 55-64</label> <label><input
						type="radio" value="" name="participant_age" /> 65 + </label>
			</span>
		</span><span class="left">
				<h4>His/her disability (Check any that apply.)</h4> <span
				class="inline"><label><input type="checkbox" value=""
						name="participant_disability[]" /> Autism Spectrum Disorder </label>
					<label><input type="checkbox" value=""
						name="participant_disability[]" /> Intellectual Disability </label></span>

		</span>
		</span>
		<hr />
		<h4>His/her sources of income in the year before coming into RWA.
			(Check any that apply.)</h4>
		<label><input type="checkbox" value="employment-or-self-employment"
			name="participant_previous_income[]" /> Earnings from employment or
			self-employment </label> <label><input type="checkbox"
			value="employment-insurance" name="participant_previous_income[]" />
			Employment insurance </label> <label><input type="checkbox"
			value="quebec-canada-pension" name="participant_previous_income[]" />
			Canada/Quebec Pension Plan (Disability) </label> <label><input
			type="checkbox" value="workers-compensation"
			name="participant_previous_income[]" /> Workers’ compensation </label>
		<label class="longtext"><input type="checkbox"
			value="social-assistance" name="participant_previous_income[]" />
			Social assistance, incl. provincial / territorial disability program
		</label> <label><input type="checkbox" value="other"
			name="participant_previous_income[]" /> Other </label>
	</section>

	<h2>Initial Activities</h2>

	<section class="a">
		<h3>Employment</h3>
		<h4>Was this person employed as a result of RWA for any part of this
			quarter?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="employed-quarter" id="cbx-employ" /> Yes </label><label><input
				type="radio" value="no" name="employed-quarter" id="cbx-no-employ"
				checked="checked" /> No </label></span>
				<?php
    IncludeJSBlock(
        '
           window.addEvent("load",function(){
                $("cbx-no-employ").addEvent("change",function(){

                    if(this.checked){
                        $$("span.jobs").forEach(function(s){
                            s.setStyle("display","none");
                        });

                    }

                });

                $("cbx-employ").addEvent("change",function(){

                    if(this.checked){
                        $$("span.jobs").forEach(function(s){
                            s.setStyle("display",null);
                        });
                    }

                });
            });
        ');
    
    ?>

		<span class="jobs" style="display: none;">
			<section>
				<h4>Job One</h4>
				<label>Start date <input type="text" value=""
					name="job-start-date[]" />
				</label> <label>Name of firm <input type="text" value=""
					name="job-firm[]" />
				</label><label>Community <input type="text" value=""
					name="job-community[]" />
				</label>
				<h4>Type of Job</h4>
				<span class="inline"><label><input type="radio" value=""
						name="job-type[]" /> Permanent part-time </label> <label><input
						type="radio" value="" name="job-type[]" /> Permanent full-time </label>
					<label><input type="radio" value="" name="job-type[]" /> Seasonal
						part-time </label> <label><input type="radio" value=""
						name="job-type[]" /> Seasonal full-time </label> </span> <label>Job
					title <input type="text" value="" name="job-title[]" />
				</label> <label>Number of work hours per week <input
					style="width: 20px;" type="text" value="" name="job-hours-weekly[]" />
				</label> <label>Industry sector code <input style="width: 100px;"
					type="text" value="" name="job-sector[]" />
				</label> <label>Hourly wage/salary <input style="width: 100px;"
					type="text" value="" name="job-wage[]" />
				</label>
				<h4>Is this self-employment?</h4>
				<span class="inline"><label><input type="radio" value="yes"
						name="job-self-employment[]" /> Yes </label><input type="radio"
					value="no" name="job-self-employment[]" /> No </label> </span>
				<h4>Number of other employees at his/her workplace</h4>
				<span class="inline"><label><input type="radio" value="0"
						name="job-num-employees[]" /> 0 (Self-employed, sole employee) </label>
					<label><input type="radio" value="1-9" name="job-num-employees[]" />
						1-9 </label> <label><input type="radio" value="10-19"
						name="job-num-employees[]" /> 10-19 </label> <label><input
						type="radio" value="20-49" name="job-num-employees[]" /> 20-49 </label>
					<label><input type="radio" value="50-99" name="job-num-employees[]" />
						50-99 </label> <label><input type="radio" value="100+"
						name="job-num-employees[]" /> 100+ </label></span>
				<h4>Comments (if any)</h4>
				<textarea type="text" name="job-comments[]"
					style="resize: vertical; width: 250px;"></textarea>

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


            <section style="margin-top: 110px;">
				<h3>RWA Section</h3>
				<label>Facilitator / Coordinator <input type="text" value=""
					name="facilitator" />
				</label> <label>Participant’s ID <input type="text" value=""
					name="participant-id" />
				</label>

			</section>
		</span> <span class="jobs" style="display: none;">
			<h3>Supports For Employment</h3>
			<h4>Does this person require any supports from RWA for employment?</h4>
			<span class="inline"><label><input type="radio" value="yes"
					name="supports" id="cbx-supports" /> Yes </label><label><input
					type="radio" value="no" name="supports" id="cbx-no-supports"
					checked="checked" /> No </label></span>

<?php
IncludeJSBlock(
    '
           window.addEvent("load",function(){
                $("cbx-no-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.supports").forEach(function(s){
                            s.setStyle("display","none");
                        });

                    }

                });

                $("cbx-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.supports").forEach(function(s){
                            s.setStyle("display",null);
                        });
                    }

                });
            });
        ');

?>


         <span class="supports" style="display: none;">

				<section>
					<h4>Job One</h4>
					<h4>Job Coach</h4>
					<label>Number of hours per week <input style="width: 50px;"
						type="text" value="" name="support-coach-hours-weekly[]" />
					</label> <label>Hourly rate <input type="text" value=""
						name="support-coach-rate[]" />
					</label><label>Number of weeks needed <input style="width: 20px;"
						type="text" value="" name="support-coach-weeks[]" />
					</label> <span class="group"><span class="left"><label>Total $
								needed for job coach at this request <input type="text" value=""
								name="support-coach-total[]" />
						</label></span></span>
					<h4>Transportation</h4>
					<label>Number of trips <input type="text" value=""
						name="support-trans-trips[]" />
					</label> <label>Rate per trip <input type="text" value=""
						name="support-trans-rate[]" />
					</label><label>Number of weeks needed <input style="width: 20px;"
						type="text" value="" name="support-trans-weeks[]" />
					</label> <span class="group"><span class="left"><label>Other
								justification if applicable<input type="text" value=""
								name="support-trans-justification[]" />
						</label></span></span> <span class="group"><span class="right"><label>Total
								$ needed for transportation at this request <input type="text"
								value="" name="support-trans-total[]" />
						</label></span></span> <label>Provider <input type="text" value=""
						name="support-trans-provider[]" />
					</label>
					<h4>Other</h4>
					<span class="group"><span class="left"> Please describe any other
							charge not captured above (e.g., for uniform, supplies, fees,
							devices, ramps, etc.) <textarea type="text"
								name="support-trans-other[]"
								style="resize: vertical; width: 250px;"></textarea>
					</span><span class="right"><label>Provider <input type="text"
								value="" name="support-trans-other-provider[]" />
						</label></span></span>
				</section>


		</span>
		</span>




	</section>



</form>