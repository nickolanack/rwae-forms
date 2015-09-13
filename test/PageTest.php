<?php
global $_html;
$_html = array(
    'js' => array(),
    'css' => array()
);

/**
 *
 * @author nblackwe
 *        
 */
class PageTest extends PHPUnit_Framework_TestCase {

    protected function _includeScaffolds() {

        include dirname(__DIR__) . '/Scaffolds/scaffolds/defines.php';
    }

    /**
     * @runInSeparateProcess
     */
    public function testWriteForms() {

        $this->_includeScaffolds();
        
        $this->assertTrue(file_exists(dirname(__DIR__) . '/forms/views'), 
            'scaffolds directory: ' . dirname(__DIR__) . '/forms/views');
        
        ob_start();
        
        HTML('document', 
            array(
                'buffered' => true,
                'header' => function () {
                    
                    // need a bunch of resources.
                    ?>

<base href="http://rwa.geolive.ca/index.php/forms-menu" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Forms Menu</title>
<link rel="stylesheet"
	href="http://s3-us-west-2.amazonaws.com/nickolanackbucket/pushbox/pb.css"
	type="text/css" />
<link rel="stylesheet"
	href="http://s3-us-west-2.amazonaws.com/nickolanackbucket/pushbox/pb-images.css"
	type="text/css" />
<link rel="stylesheet"
	href="http://s3-us-west-2.amazonaws.com/nickolanackbucket/spinner/spin.css"
	type="text/css" />
<link rel="stylesheet"
	href="http://s3-us-west-2.amazonaws.com/nickolanackbucket/popover/popover.css"
	type="text/css" />
<link rel="stylesheet" href="http://rwa.geolive.ca/forms/css/forms.css"
	type="text/css" />
<link rel="stylesheet"
	href="http://code.jquery.com/qunit/qunit-1.19.0.css" type="text/css" />
<script src="/media/system/js/mootools-core.js" type="text/javascript"></script>
<script src="/media/system/js/core.js" type="text/javascript"></script>
<script src="/media/system/js/mootools-more.js" type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/mootools/mootools_compat.js"
	type="text/javascript"></script>
<script src="http://rwa.geolive.ca/forms/php-core-app/js/JSConsole.js"
	type="text/javascript"></script>
<script
	src="http://rwa.geolive.ca/forms/php-core-app/js/Ajax/AjaxControlQuery.js"
	type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/pushbox/PushBox.js"
	type="text/javascript"></script>
<script src="http://rwa.geolive.ca/forms/php-core-app/js/JSUtilities.js"
	type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/spinner/Spinner.js"
	type="text/javascript"></script>
<script src="http://rwa.geolive.ca/forms/js/UIFormManager.js"
	type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/popover/Popover.js"
	type="text/javascript"></script>
<script
	src="http://rwa.geolive.ca/forms/php-core-app/js/Controls/UIPopover.js"
	type="text/javascript"></script>
<script src="http://code.jquery.com/qunit/qunit-1.19.0.js"
	type="text/javascript"></script>
<script type="text/javascript">
<?php
                    global $_html;
                    echo implode("\n\n", $_html['js']);
                    ?>
                    </script>
<?php
                },
                'body' => function () {
                    
                    ?><section id="schedule-d-area"><?php Scaffold('form.scheduled', array(), dirname(__DIR__) . '/forms/views');?></section>
<section id="quarterly-area"><?php Scaffold('form.quarterly', array(), dirname(__DIR__) . '/forms/views');?></section>
<section id="addendum-area"><?php Scaffold('form.addendum', array(), dirname(__DIR__) . '/forms/views');?></section><?php
                    
                    IncludeJSBlock(
                        '

    window.addEvent("load",function(){

        UIFormManager.setAjaxUrl(' . json_encode($params['url']) . ');



        UIFormManager.addForm({
            name:"scheduled",
            container:$("schedule-d-area"),
            form:$$("#schedule-d-area>form")[0],
            defaultFormData:' . json_encode(
                            array(
                                // the default values when creating a schedule d
                                'id' => -1,
                                'admin-year' => 2015,
                                'admin-quarter' => '1st',
                                'employed-quarter' => 'no',
                                'job-supports' => 'no',
                                'enrolled-quarter' => 'no',
                                'enrollment-supports' => 'no'
                            )) . '

        });


        UIFormManager.addForm({
            name:"addendum",
            container:$("addendum-area"),
            form:$$("#addendum-area>form")[0],

            defaultFormData:' . json_encode(
                            array(
                                // the default values when creating a schedule d
                                'id' => -1,
                                'admin-year' => 2015,
                                'admin-quarter' => '1st',
                                'employed-quarter' => 'no',
                                'job-supports' => 'no',
                                'enrolled-quarter' => 'no',
                                'enrollment-supports' => 'no'
                            )) . '

        });

        UIFormManager.addForm({
            name:"quarterly",
            container:$("quarterly-area"),
            form:$$("#quarterly-area>form")[0],

            defaultFormData:' . json_encode(
                            array(
                                // the default values when creating a schedule d
                                'id' => -1,
                                'admin-year' => 2015,
                                'admin-quarter' => '1st',
                                'employed-quarter' => 'no',
                                'job-supports' => 'no',
                                'enrolled-quarter' => 'no',
                                'enrollment-supports' => 'no'
                            )) . '

        });


        UIFormManager.displayList();


    });

');
                    
                    Scaffold('qunit.test', array(), dirname(__DIR__) . '/forms/views');
                }
            ));
        
        $page = ob_get_contents();
        ob_end_clean();
        
        file_put_contents(__DIR__ . '/page.html', $page);
        echo $page;
        $this->assertTrue(file_exists(__DIR__ . '/page.html'));
    }
}

function IncludeJSBlock($js) {

    global $_html;
    $_html['js'][] = $js;
    // echo 'block:' . $js;
}

function IncludeJS($js) {
    
    // echo 'scr:' . $js;
}

function IncludeCSS($css) {
    
    // echo 'scr:' . $css;
}

function IncludeCSSBlock($css) {
    
    // echo 'block:' . $css;
}

function Scaffold($name, $params = array(), $dir = null) {

    global $scaffold;
    return $scaffold->build($name, $params, $dir);
}