<form>

	<input type="hidden" name="id" value="-1" id="scheduled-id" />

	<h2>Participant Information Form Addendum</h2>
	<h3>To be completed ONLY if the participant has a new employer, is newly self-employed or is newly enrolled in post-secondary education</h3>
	<section class="a">

		<?php Scaffold('form.section.admin');?>
		<hr />
		<?php Scaffold('form.section.agency');?>
		 
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
	<section class="b">
		<h4>did employment change?</h4>

		<?php
		Scaffold('form.switch',
		    array(
		        'name' => 'employed-quarter',
		        'className' => 'jobs two three',
		        'callback' => function () {

		            Scaffold('form.scheduled.job');
		            ?>
		            <h3>Supports For Employment</h3>
		<h4>Does this person require any supports from RWA for employment?</h4>
		
<?php
                

				Scaffold('form.switch', 
			                array(
			                    'name' => 'job-supports',
			                    'callback' => function () {
			                        ?>
								    <hr />

								    <?php
			                        
			                        	Scaffold('form.scheduled.job.support', 
					                    array(
					                        'class' => 'sch-job'
					                    ));

			                        }
			                	));


				},
			));
		?>




	</section>

	<h4>Post Secondary Education</h4>
	<section class="c">


		<h4>did enrollment change?</h4>

		<?php
		Scaffold('form.switch',
		    array(
		        'name' => 'enrolled-quarter',
		        'callback' => function () {
		            ?><hr />
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
					        },
		    	));
		?>



	</section>

</form>