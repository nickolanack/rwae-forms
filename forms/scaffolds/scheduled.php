<form>

	<input type="hidden" name="id" value="-1" />

	<h2>Schedule D</h2>
	<h3>Administrative and Baseline</h3>
	<section class="a">

		<span class="group"><label><span class="lbl">Year </span> <input
				type="number" value="<?php echo date('Y'); ?>" name="admin-year" /></label><label
			class="pull-right">Quarter <input type="radio" value="1"
				name="admin-quarter"
				<?php
    
    $q = ((int) ((date('n') - 1) / 3)) + 1;
    
    if ($q == 1) {
        ?>
				checked="checked" <?php
    }
    
    ?> /> 1st <input type="radio" value="2" name="admin-quarter"
				<?php
    
    if ($q == 2) {
        ?> checked="checked"
				<?php
    }
    
    ?> /> 2nd <input type="radio" value="3" name="admin-quarter"
				<?php
    
    if ($q == 3) {
        ?> checked="checked"
				<?php
    }
    
    ?> /> 3rd <input type="radio" value="4" name="admin-quarter"
				<?php
    
    if ($q == 4) {
        ?> checked="checked"
				<?php
    }
    
    ?> /> 4th
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
						name="participant-disabilities" /> Autism Spectrum Disorder </label>
					<label><input type="checkbox" value=""
						name="participant-disabilities" /> Intellectual Disability </label></span>

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
	<section class="b">

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
			<hr />
			<?php Scaffold('scheduled.job');?>
		<?php

Scaffold('cpanel.button', 
    array(
        'title' => 'Add Job',
        'className' => 'btn btn-success pull-right',
        'icon' => Core::AssetsDir() . DS . 'Map Item Icons' . DS . 'sm_new.png?tint=rgb(255,255,255)',
        'script' => '


            button=this;
            $$(".jobs").forEach(function(el){
                if(!el.hasClass("two")){
                    el.addClass("two");

                    $("job-2-isactive").value="yes";

                }else{

                    if(!el.hasClass("three")){
                        el.addClass("three");

                         $("job-3-isactive").value="yes";

                        button.removeClass("btn-success");
                        button.setAttribute("disabled", true);
                    }else{



                    }

                }
            });

        '
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

		</span> <span class="jobs" style="display: none;">
			<h3>Supports For Employment</h3>
			<h4>Does this person require any supports from RWA for employment?</h4>
			<span class="inline"><label><input type="radio" value="yes"
					name="job-supports" id="cbx-supports" /> Yes </label><label><input
					type="radio" value="no" name="job-supports" id="cbx-no-supports"
					checked="checked" /> No </label></span>

<?php
IncludeJSBlock(
    '
           window.addEvent("load",function(){
                $("cbx-no-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.job-supports").forEach(function(s){
                            s.setStyle("display","none");
                        });

                    }

                });

                $("cbx-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.job-supports").forEach(function(s){
                            s.setStyle("display",null);
                        });
                    }

                });
            });
        ');

?>


         <span class="job-supports" style="display: none;">
				<hr />
				<?php
    
    Scaffold('scheduled.job.support');
    
    ?>


		</span>
		</span>




	</section>

	<h4>Post Secondary Education</h4>
	<section class="c">


		<h4>Was this person enrolled in post-secondary education as a result
			of RWA for any part of this quarter ?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="enrolled-quarter" id="cbx-enrolled" /> Yes </label><label><input
				type="radio" value="no" name="enrolled-quarter" id="cbx-no-enrolled"
				checked="checked" /> No </label></span>
				<?php
    IncludeJSBlock(
        '
           window.addEvent("load",function(){
                $("cbx-no-enrolled").addEvent("change",function(){

                    if(this.checked){
                        $$("span.enrolled").forEach(function(s){
                            s.setStyle("display","none");
                        });

                    }

                });

                $("cbx-enrolled").addEvent("change",function(){

                    if(this.checked){
                        $$("span.enrolled").forEach(function(s){
                            s.setStyle("display",null);
                        });
                    }

                });
            });
        ');
    
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
		</span> <span class="enrolled" style="display: none;">
			<h3>Supports for Post-Secondary Education</h3>
			<h4>Does this person require any supports from RWA for post-secondary
				education?</h4> <span class="inline"><label><input type="radio"
					value="yes" name="enrollment-supports" id="cbx-e-supports" /> Yes </label><label><input
					type="radio" value="no" name="enrollment-supports"
					id="cbx-no-e-supports" checked="checked" /> No </label></span>

<?php
IncludeJSBlock(
    '
           window.addEvent("load",function(){
                $("cbx-no-e-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.enroll-supports").forEach(function(s){
                            s.setStyle("display","none");
                        });

                    }

                });

                $("cbx-e-supports").addEvent("change",function(){

                    if(this.checked){
                        $$("span.enroll-supports").forEach(function(s){
                            s.setStyle("display",null);
                        });
                    }

                });
            });
        ');

?>

<span class="enroll-supports" style="display: none;">
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