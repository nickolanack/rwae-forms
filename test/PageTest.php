<?php

/**
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
        
        ob_start();
        
        HTML('document', 
            array(
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
                    
                    Scaffold('form.scheduled');
                    Scaffold('form.quarterly');
                    Scaffold('form.addendum');
                }
            ));
        
        $page = ob_get_contents();
        ob_end_clean();
        
        file_put_contents('page.html', page);
        
        $this->assertTrue(true);
    }
}

function Scaffold($name, $params = array()) {

    global $scaffold;
    return $scaffold->build($name, $params);
}