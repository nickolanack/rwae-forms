<?php
$config = array_merge(array(
    'n' => 1,
    'class' => '',
    'style' => ''
), $params);

$num = array(
    'One',
    'Two',
    'Three'
);

$idsuffix = "-" . rand(0000, 9999);

?><section class="job <?php echo $config['class'];?> h4-bar" style="<?php echo $config['style'];?>">
	<h4>Job <?php echo $num[$config['n']-1];?></h4>

	<h4>Working This Quarter?</h4>
	<?php
Scaffold('form.switch', 
    array(
        'name' => 'job-' . $config['n'] . '-working',
        'className' => 'jobs qtr-jobs',
        'value' => "yes",
        'callback' => array(
            function () use($config) {
                ?><hr /><?php
                Scaffold('form.quarterly.job.working', 
                    array(
                        'prefix' => 'job-' . $config['n']
                    ));
            },
            function () use($config) {
                ?><hr /><?php
                Scaffold('form.quarterly.job.notworking', 
                    array(
                        'prefix' => 'job-' . $config['n']
                    ));
            }
        )
    ));
?>


    <?php
    
    if ($config['n'] == 1) {
        
        Scaffold('form.quarterly.job', array(
            'n' => 2,
            'class' => 'two'
        ));
        Scaffold('form.quarterly.job', array(
            'n' => 3,
            'class' => 'three'
        ));
    }
    ?>
</section>
