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

![alt tag](https://raw.github.com/nickolanack/rwae-forms/master/screen2.png)

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
						|-submit/cancel buttons
				|-addendum.workspace
						|-...
						|-submit/cancel buttons
				|-... (quarterly)
				|
				|-UIFormManager.js
				|-script:
					-configure UIFormManager with the current forms on the page, set the default values for each form, 
					 and other params like dom elements for sumbit buttons all will be managed by UIFormManager.
					 UIFormManager handles display and populating the forms and extracting and submiting form data
				|
				|-UsersForms.js : TODO this is currently part of UIFormManager.js but it should be extracted
				|-script:
					-get users list scheduled forms (ie: list of participants) and add behavior for loading 
					 and editing as well as initiating new addendums and quarterlys for existing scheduled forms.
```

##Template##

this repo also contains a joomla template based off of one of the defualt templates and modified to look like rwa's website.
/template/simple 

