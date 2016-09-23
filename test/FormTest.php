<?php
global $_html;
$_html = array(
    'js' => array(),
    'css' => array(),
);

/**
 *
 * @author nblackwe
 *
 */
class FormTest extends PHPUnit_Framework_TestCase
{

    protected function _includeScaffolds()
    {
        if (file_exists(dirname(__DIR__) . '/forms/php-core-app')) {
            include dirname(__DIR__) . '/forms/php-core-app/library/scaffold/defines.php';
        } else {
            include dirname(__DIR__) . '/Scaffolds/scaffolds/defines.php';
        }
    }

    /**
     * @runInSeparateProcess
     */
    public function testFormsMetadata()
    {

        $this->_includeScaffolds();

        include_once dirname(__DIR__) . '/forms/lib/RWAForm.php';

        $formFields = json_decode(file_get_contents(__DIR__ . '/fields.json'));

        $this->assertEquals(json_encode($formFields->scheduled, JSON_PRETTY_PRINT), json_encode(RWAForm::GetFieldNames('scheduled'), JSON_PRETTY_PRINT));
        $this->assertEquals(json_encode($formFields->addendum, JSON_PRETTY_PRINT), json_encode(RWAForm::GetFieldNames('addendum'), JSON_PRETTY_PRINT));
        $this->assertEquals(json_encode($formFields->quarterly, JSON_PRETTY_PRINT), json_encode(RWAForm::GetFieldNames('quarterly'), JSON_PRETTY_PRINT));

    }

}

/**
 * stub methods that are expected to have been implemented by php-core-app
 */

function IncludeJSBlock($js)
{
    global $_html;
    $_html['js'][] = $js;
    // echo 'block:' . $js;
}

function IncludeJS($js)
{

    // echo 'scr:' . $js;
}

function IncludeCSS($css)
{

    // echo 'scr:' . $css;
}

function IncludeCSSBlock($css)
{

    // echo 'block:' . $css;
}

function Scaffold($name, $params = array(), $dir = null)
{
    global $scaffold;
    return $scaffold->build($name, $params, $dir);
}
