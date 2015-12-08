<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Participant Information Form</h2>
	<h3>Administrative and Baseline</h3>
	<section class="c">

		<?php Scaffold('form.section.admin');?>
		<hr />
		<?php Scaffold('form.section.agency');?>
		<hr />
		<?php Scaffold('form.section.participant');?>
	</section>

	<h3>Initial Activities</h3>
	<h4>Employment</h4>
	<section class="a">

		<h4>Was this person employed as a result of RWA for any part of this quarter?</h4>

					<?php
    Scaffold('form.switch', 
        array(
            'name' => 'employed-quarter',
            'className' => 'jobs sch-jobs two three',
            'callback' => function () {
                ?>
           <hr />
			<?php
                
                Scaffold('form.scheduled.job');
                /*
                 * Scaffold('form.button.addjob',
                 * array(
                 * 'elementsArray' => '$$(".sch-jobs")'
                 * ));
                 */
                ?>



        <hr />
		<h3>RWA Section</h3>
		<section>

			<label>Facilitator / Coordinator <input type="text" value=""
				name="participant-facilitator" />
			</label> <label>Participant’s ID <input type="text" value=""
				name="participant-id" />
			</label>
		</section>


		<h3>Supports For Employment</h3>
		<h4>Does this person require any supports from RWA for employment?</h4>
		<span class="inline"><label><input type="radio" value="yes"
				name="job-supports" id="sch-cbx-supports" /> Yes </label><label><input
				type="radio" value="no" name="job-supports" id="sch-cbx-no-supports"
				checked="checked" /> No </label></span>

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
                
                Scaffold('form.scheduled.job.support', 
                    array(
                        'class' => 'sch-job'
                    ));
                
                ?>


		</span>

           <?php
            }
        ))?>





	</section>

	<h4>Post Secondary Education</h4>
	<section class="b">

		<h4>Was this person enrolled in post-secondary education as a result of RWA for any part of this quarter ?</h4>
	<?php

Scaffold('form.switch', 
    array(
        'name' => 'enrolled-quarter',
        'callback' => function () {
            ?>
<hr />
		<?php
            Scaffold('form.scheduled.enrollment');
            ?>

		<h3>Supports for Post-Secondary Education</h3>
		<h4>Does this person require any supports from RWA for post-secondary education?</h4>

				<?php
            Scaffold('form.switch', 
                array(
                    'name' => 'enrollment-supports',
                    'callback' => function () {
                        ?>
    <hr />

    <?php
                        Scaffold('form.scheduled.enrollment.support');
                    }
                ));
        }
    ));

?>



	</section>

</form>