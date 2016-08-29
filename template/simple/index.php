<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die();

include_once dirname(dirname(__DIR__)) . '/forms/php-core-app/core.php';
Behavior('mootools');

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$user = JFactory::getUser();
$this->language = $doc->language;
$this->direction = $doc->direction;

$doc->setGenerator('Created By Nick Blackwell at the University of British Columbia');
$doc->setMetaData('author', 'Nick Blackwell');

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task == "edit" || $layout == "form") {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
// if ($this->countModules('position-7') && $this->countModules('position-8')) {
//     $span = "span6";
// } elseif ($this->countModules('position-7') && !$this->countModules('position-8')) {
//     $span = "span9";
// } elseif (!$this->countModules('position-7') && $this->countModules('position-8')) {
//     $span = "span9";
// } else {

// }

$span = "span12";

if (key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
    $ln = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if ($ln === 'fr') {
        $lang = &JFactory::getLanguage();
        $lang->setLanguage('fr-FR');
        $lang->load();
    }
} else {
    $ln = 'en';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $this->language; ?>"
	lang="<?php echo $this->language; ?>"
	dir="<?php echo $this->direction; ?>">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" type="image/x-icon"
	href="http://readywillingable.ca/wp-content/uploads/2015/07/RWA-Favicon.png" />
<jdoc:include type="head" />
<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->

<style type="text/css">
.btn {
	background-image: none;
	border: none;
	border-radius: 0;
	height: 39px;
}

.btn.btn-primary {
	background-color: #01AEEF;
}

.btn.btn-success {
	background-color: #FFF200;
}

.btn.btn-danger {
	background-color: #EB008B;
}

.btn.btn-primary:hover {
	background-color: #0693C7;
}

.btn.btn-success:hover {
	background-color: #D8CD04;
}

.btn.btn-danger:hover {
	background-color: #B70A70;
}
</style>
</head>

<body
	class="site <?php

echo $option . ' view-' . $view . ($layout ? ' layout-' . $layout : ' no-layout') .
    ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') .
    ($params->get('fluidContainer') ? ' fluid' : '');

echo ' ' . ($ln = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
echo ' ' . JFactory::getLanguage()->getTag();

?>">

	<!-- Body -->
	<div class="body">
		<!-- Header -->
		<header class="header" role="banner">
			<div class="header-inner clearfix">
				<div style="max-width: 960px; margin: auto; text-align: left;">
					<img
						src="http://readywillingable.ca/wp-content/themes/RWA2015/public/images/logos/rwa-oneline-eng.png" />
					<div class="site-tagline" style="text-transform: uppercase;"><span class="lang" data-fr="Construire une force de travail inclusif"><span class="en">Building an inclusive labour force</span><span></div>
				</div>

				<div class="header-search pull-right">

					<jdoc:include type="modules" name="position-0" style="none" />
				</div>
			</div>
		</header>
		<div
			class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">

			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<main id="content" role="main" class="<?php echo $span; ?>"> <!-- Begin Content -->
				<jdoc:include type="modules" name="position-3" style="xhtml" /> <jdoc:include
					type="message" /> <jdoc:include type="component" /> <!-- End Content -->
				</main>

			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div
			class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p>
				&copy; <?php echo date('Y'); ?> <span class="lang" data-fr="Prêt Willing & Able"><span class="en"><?php echo $sitename; ?></span></span> | <span class="lang" data-fr="Conçu par le Spice Lab de l' Université de la British Columbia"><span class="en">Designed by the Spice Lab at the University of British Columbia</span></span>
			</p>
		</div>
	</footer>
</body>
</html>
