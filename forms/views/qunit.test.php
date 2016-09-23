<?php
IncludeCSS('http://code.jquery.com/qunit/qunit-1.19.0.css', array(
    'isUrl' => true,
));

IncludeJS('http://code.jquery.com/qunit/qunit-1.19.0.js', array(
    'isUrl' => true,
));

IncludeJS(dirname(__DIR__) . DS . 'js' . DS . 'formtest.js');

?>

<h3 style="margin-top: 100px;">Unit Test</h3>
<h4>This section is for developement purposes only - you can completely
	ignore it</h4>
<div id="qunit"></div>
<div id="qunit-fixture"></div>
