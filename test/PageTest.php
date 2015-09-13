<?php
global $html;
$html = array(
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

<?php
                },
                'body' => function () {
                    
                    Scaffold('form.scheduled', array(), dirname(__DIR__) . '/forms/views');
                    Scaffold('form.quarterly', array(), dirname(__DIR__) . '/forms/views');
                    Scaffold('form.addendum', array(), dirname(__DIR__) . '/forms/views');
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

    echo 'block:' . $js;
}

function IncludeJS($js) {

    echo 'scr:' . $js;
}

function IncludeCSS($css) {

    echo 'scr:' . $css;
}

function IncludeCSSBlock($css) {

    echo 'block:' . $css;
}

function Scaffold($name, $params = array(), $dir = null) {

    global $scaffold;
    return $scaffold->build($name, $params, $dir);
}