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

		<?php
Scaffold('form.switch', 
    array(
        'name' => 'employed-quarter',
        'className' => 'jobs two three',
        'callback' => function () {
            
            Scaffold('form.scheduled.job');
            
            ?>


                <hr />
		<h3>RWA Section</h3>
		<section>

			<label>Facilitator / Coordinator <input type="text" value=""
				name="participant-facilitator" />
			</label>
		</section>
        <?php
        }
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
        }
    ));
?>
	</section>

</form>