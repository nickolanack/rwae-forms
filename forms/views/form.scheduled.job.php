<?php
$config = array_merge(array(
    'n' => 1,
    'class' => '',
    'style' => ''
), $params);

$num = [
    'One',
    'Two',
    'Three'
];

$idsuffix = "-" . rand(0000, 9999);

?><section class="job <?php echo $config['class'];?> h4-bar" style="<?php echo $config['style'];?>">
	<h4>Job <?php echo $num[$config['n']-1];?></h4>

    <?php
    
    Scaffold('form.scheduled.job_', array(
        'prefix' => 'job-' . $config['n']
    ));
    
    if ($config['n'] == 1) {
        
        Scaffold('form.scheduled.job', array(
            'n' => 2,
            'class' => 'two'
        ));
        Scaffold('form.scheduled.job', array(
            'n' => 3,
            'class' => 'three'
        ));
    }
    ?>
</section>
