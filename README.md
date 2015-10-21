# rwae-forms
This is a small project for Ready, Willing & Abled. It is of no use to anyone other than 
me, or any future developer that they hire to continue work on this project. 

This projects consists of a small website (built with joomla) and provides
members the ability to create and manage a number of relatively simple forms

This project makes use of php-core-app which is not open source really, but is a 
collection of libraries intended to simplify development of web apps and works with 
joomla, drupal, wordpress, etc. php-core-app is not included in this repository
and must be installed seperately.

The forms in this project are html based but use javascript and especially ajax to provide
it's behavior

##Project##

###forms###

the forms directory in this repo contains the primary source for this project
the forms themselves are php generated html files in forms/views

there are three forms: scheduled, addendum, and quarterlys. The primary php file 
for each form is named form.[name].php and elements/sections of these forms are named 
similarly, however there are some shared form sections which are named form.section.[item].php
and are used by more than one form type.

for each of the three forms there is a [formName].workspace.php file which sets up the page to 
include the forms for UIFormManager.js

There is user.panel.php which in the main form page, it includes each [form name].workspace.php file
and configures UIFormManager.js to provide the form behavior etc.

```
Forms Page: user.panel.php
				|-sheduled.workspace
						|-form.scheduled
								|-section.admin
								|-form.scheduled.job
								|-...
				|-addendum.workspace
						|-...
				|-...
				|
				|-UIFormManager.js
				|-script:
					-configure UIFormManager with the current forms on the page,
					 set the default values for each form
				|
				|-UsersForms.js : TODO this is currently part of UIFormManager.js but it should be extracted
				|-script:
					-get users list scheduled forms (ie: list of participants) and add behavior for loading 
					 and editing as well as initiating new addendums and quarterlys for existing scheduled forms.
```

##Template##

this repo also contains a joomla template based off of one of the defualt templates and modified to look like rwa's website.
/template/simple 

