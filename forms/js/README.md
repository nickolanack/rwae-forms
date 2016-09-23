# UIFormManager

UIFormManager is responsible for displaying the correct form and populating the current
form elements with data, depending on user actions. Each form is rendered on the page as
a blank form, and is generally set to be hidden. when a user wants to create a form the 
UIFormManager will show the desired form and prepopulate it with any initial data. 
when a user wants to submit, UIFormManager parses the form element data and submits
the data to a server ajax method, generally the user list of forms is refreshed 
after a submit event to show the new form 


the user list of forms is currently also included within UIFormManager, but will be extracted into its
own class or placed inline on the user.panel.php page. since it is very specific.