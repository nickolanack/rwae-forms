<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Schedule D Quarterly</h2>
	<section class="b">
		<?php Scaffold('form.section.admin');?>
		<hr />
		<?php Scaffold('form.section.agency');?>
		<hr />
        <?php Scaffold('form.section.participant.b');?>
        <hr />
		<h3>RWA Section</h3>
		<section>
			<label>Facilitator / Coordinator <input type="text" value=""
				name="participant-facilitator" />
			</label>
		</section>
	</section>

	<h4>Employment</h4>
	<section class="c">
		<h6>Here I should be able to detect if they are employed - and if not
			indicate the need for an addendum</h6>
		<h4>Any changes in this person’s employment through RWA?</h4>
		<?php
Scaffold('form.switch', 
    array(
        'name' => 'employed-quarter',
        'className' => 'jobs qtr-jobs two three',
        'callback' => function () {
            ?><h4>Please complete this section only if there have been
			changes in this person’s employment though RWA since their Schedule D
			or last Quarterly Update (or Addendum).</h4>
		<hr />
		<h6>should detect job count</h6>
		<?php
            Scaffold('form.quarterly.job');
        }
    ));
?>



		<hr />
		<h6>same as note abov,e</h6>
		<h4>Any changes in this person’s need for or use of supports for
			employment from RWA?</h4>

			<?php
Scaffold('form.switch', 
    array(
        'name' => 'job-supports',
        'className' => 'job-supports two three',
        'callback' => function () {
            ?>
         <h4>Please complete this section only if there have been
			changes in this person’s need for or use of supports from RWA for
			employment since their Schedule D or last Quarterly Update (or
			Addendum).</h4>
		<hr />
		<span class="jobs qtr-jobs" style="">
			<h6>should detect support count via job count</h6>
				<?php
            
            Scaffold('form.scheduled.job.support', array(
                'class' => 'qtr-job'
            ));
            
            ?>


		</span>

            <?php
        }
    ));
?>








	</section>

	<h4>Post Secondary Education</h4>
	<section class="a">

		<h6>Here I should be able to detect if they are enrolled - and if not
			indicate the need for an addendum</h6>
		<h4>Was this person enrolled in post-secondary education as a result
			of RWA?</h4>


						<?php
    Scaffold('form.switch', 
        array(
            'name' => 'enrolled-quarter',
            'callback' => function () {
                ?>
			<h4>Please complete this section only if this person was enrolled in
			post-secondary education as a result of RWA for any part of this
			quarter.</h4>
		<hr />


		<span class="group"><span class="left">
				<h4>Enrollment Status</h4> <span class="inline"> <label><input
						type="radio" value="still-in-same-program-as-last-quarter"
						name="enrolled-quarter-status" /> Still in same program as last
						quarter</label> <label><input type="radio"
						value="finished-graduated" name="enrolled-quarter-status" />
						Finished: Graduated</label> <label><input type="radio"
						value="finished-did-not-graduate" name="enrolled-quarter-status" />
						Finished: Did not graduate</label> <label><input type="radio"
						value="withdrew-illness-or-disability"
						name="enrolled-quarter-status" /> Withdrew – Illness or disability</label>
					<label><input type="radio" value="withdrew-other-reason"
						name="enrolled-quarter-status" /> Withdrew – Other reason</label>
			</span>
		</span><span class="right">

				<h4>If withdrew or did not graduate, please briefly explain</h4> <textarea
					type="text" name="enrolled-quarter-did-not-graduate-reason"
					style="resize: vertical; width: 380px; box-sizing: border-box;">
	</textarea>
				<h4>Comments</h4> <textarea type="text"
					name="enrolled-quarter-comments"
					style="resize: vertical; width: 380px; box-sizing: border-box;">
	</textarea>
		</span></span>
		<?php
            }
        ));
    ?>

			<hr />
		<h6>same as above</h6>
		<h4>Any changes in this person’s need for or use of supports for post
			secondary education from RWA?</h4>


			<?php
Scaffold('form.switch', 
    array(
        'name' => 'enrollment-supports',
        'callback' => function () {
            ?>
            <h4>Please complete this section only if there have been any
			changes in this person’s need for or use of supports from RWA for
			post-secondary education since their Schedule D or last Quarterly
			Update (or Addendum).</h4>
		<hr />



                            <?php
            Scaffold('form.scheduled.enrolment.support');
        }
    ));
?>
	</section>

</form>