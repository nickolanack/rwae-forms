<?php
Behavior('ajax');

Scaffold('button.create.scheduled');

Scaffold('scheduled.workspace');
Scaffold('addendum.workspace');
Scaffold('quarterly.workspace');

Scaffold('list.scheduled');

$quarter = ((int) ((date('n') - 1) / 3));
$quarters = array(
    '1st',
    '2nd',
    '3rd',
    '4th'
);
$quarter = $quarters[$quarter];

IncludeJSBlock(
    '

    window.addEvent("load",function(){

        var ajaxUrl=' . json_encode($params['url']) . ';

        UIFormManager.setAjaxUrl(ajaxUrl);



        UIFormManager.addForm({
            name:"scheduled",
            ajaxUrl:null,
            ajaxTask:"create-new-scheduled",
            container:$("schedule-d-area"),
            form:$$("#schedule-d-area>form")[0],
            submitButtons:$$("#schedule-d-area .submit-btn"),
            cancelButtons:$$("#schedule-d-area .cancel-btn"),
            additionalFormButtons:$$("#schedule-d-area>form .btn"),
            warningsArea:$("sheduled-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
        )) . '

        });


        UIFormManager.addForm({
            name:"addendum",
            ajaxUrl:null,
            ajaxTask:"create-new-addendum",
            container:$("addendum-area"),
            form:$$("#addendum-area>form")[0],
            submitButtons:$$("#addendum-area .submit-btn"),
            cancelButtons:$$("#addendum-area .cancel-btn"),
            additionalFormButtons:$$("#addendum-area>form .btn"),
            warningsArea:$("addendum-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
        )) . '

        });

        UIFormManager.addForm({
            name:"quarterly",
            ajaxUrl:null,
            ajaxTask:"create-new-quarterly",
            container:$("quarterly-area"),
            form:$$("#quarterly-area>form")[0],
            submitButtons:$$("#quarterly-area .submit-btn"),
            cancelButtons:$$("#quarterly-area .cancel-btn"),
            additionalFormButtons:$$("#quarterly-area>form .btn"),
            warningsArea:$("quarterly-warnings-area"),
            defaultFormData:' . json_encode(
        array(
            // the default values when creating a schedule d
            'id' => - 1,
            'admin-year' => date('Y'),
            'admin-quarter' => $quarter,
            'employed-quarter' => 'no',
            'job-supports' => 'no',
            'enrolled-quarter' => 'no',
            'enrollment-supports' => 'no'
        )) . '

        });


        var displayUsersFormsList=function(url, formManager, listContainerEl){



				(new AjaxControlQuery(
						url,
						"list-scheduled",
						{}
				)).addEvent("success",function(response){

					if(response.success&&response.results.length){

						listContainerEl.innerHTML="<h3>Your Previously Completed Forms</h3>";
						var section=new Element("section");
						listContainerEl.appendChild(section);

						var last=null;
						var dateFn=function(str){

							var date=(new Date(str)).timeAgoInWords();
							if(date!==last){
								section.appendChild(new Element("div",{"class":"timeago", html:date}));
								last=date;
							}
						};

						response.results.forEach(function(data){

							dateFn(data.submitDate);

							var edit=new Element("span",{"class":"btn btn-primary"});
							var addendum=new Element("span",{"class":"btn btn-danger"});
							var quarterly=new Element("span",{"class":"btn btn-success"});

							var item=section.appendChild(new Element("div", {
								"class":"scheduled-item",
								html:data.html
							}));

							item.appendChild(edit);
							item.appendChild(quarterly);
							item.appendChild(addendum);


							new UIPopover(edit, {description:"Edit Schedule D",anchor:UIPopover.AnchorTo("top")});
							new UIPopover(addendum, {description:"Add Addendum",anchor:UIPopover.AnchorTo("top")});
							new UIPopover(quarterly, {description:"Complete Quarterly",anchor:UIPopover.AnchorTo("top")});

							edit.addEvent("click",function(){

								var form=formManager.getForm("scheduled");
								formManager.setReadOnly(form);

								var formData=Object.append({}, data.formData);

								formManager.loadFormData(form, Object.append(formData, {id:data.id}));
								formManager.showForm("scheduled");
								var message=new Element("span", {html:"this is an existing Schedule D, do you want to enable it for editing? "});
								message.appendChild(new Element("span",{"class":"btn btn-danger", html:"yes", events:{
									click:function(){
										formManager.clearWarnings();
										formManager.setEditable(form);
									}
								}}));
								formManager.setWarning("scheduled","update", message);


							});

							addendum.addEvent("click",function(){

								formManager.loadFormData(formManager.getForm("addendum"), Object.append(
										data.formData, //should load all data that matches.
										/*formManager.getFieldsFrom(data.formData,[

									   "participant-first-name",
									   "participant-id",

									   "agency-name",
									   "agency-contact-person",
									   "agency-contact-phone",
									   "agency-contact-email"

									   ]), */
										formManager.getFormDefaultData("scheduled")));
								formManager.showForm("addendum");
								var message=new Element("span", {html:"TODO: does not submit - needs backend work"});
								message.appendChild(new Element("span",{"class":"btn btn-danger", html:"close", events:{
									click:function(){
										formManager.clearWarnings();
									}
								}}));
								formManager.setWarning("addendum","update", message);

							});


							quarterly.addEvent("click",function(){

								formManager.loadFormData(formManager.getForm("quarterly"), Object.append(
										formManager.getFieldsFrom(data.formData,[

										                                         "participant-first-name",
										                                         "participant-id",

										                                         "agency-name",
										                                         "agency-contact-person",
										                                         "agency-contact-phone",
										                                         "agency-contact-email"

										                                         ]),
										                                         formManager.getFormDefaultData("scheduled")));
								formManager.showForm("quarterly");

								var message=new Element("span", {html:"TODO: not finished - it is basically just addendum-form right now"});
								message.appendChild(new Element("span",{"class":"btn btn-danger", html:"close", events:{
									click:function(){
										formManager.clearWarnings();
									}
								}}));
								formManager.setWarning("quarterly","update", message);

							});


							(new AjaxControlQuery(
									url,
									"list-addendums-quarterlys",
									formManager.getFieldsFrom(data.formData,["participant-id"])
							)).addEvent("success",function(response){

								if(response.success){




								}

							}).execute();



						});

					}else{
						listContainerEl.innerHTML="<section><div>you have not created any schedule d forms</div></section>"
					}

				}).execute();

			};

		displayUsersFormsList(ajaxUrl, UIFormManager, $("list-schedule-d"));

        /**
         * Users Form List Display Behavior
         */
        // hide users list of completed forms whenever any form becomes visible
        UIFormManager.addEvent("showForm",function(){
            $("list-schedule-d").removeClass("enabled");
        });

        // show users list of completed forms whenever all forms are hidden
        UIFormManager.addEvent("hideForms",function(){
            $("list-schedule-d").addClass("enabled");
        });

        // refresh users list of forms whenever a form is edited or created
        UIFormManager.addEvent("saveForm",function(){
            displayUsersFormsList(ajaxUrl, UIFormManager, $("list-schedule-d"));
        });

        // refresh users list of forms whenever a form is edited or created
        UIFormManager.addEvent("deleteForm",function(){
            displayUsersFormsList(ajaxUrl, UIFormManager, $("list-schedule-d"));
        });


    });

');

IncludeCSS(dirname(__DIR__) . DS . 'css' . DS . 'forms.css');

IncludeCSSBlock(
    '

section h6 {
    background-color: #F8EAF2;
    line-height: 20px;
    padding: 5px;
    width: 50%;
    border-radius: 4px;
    margin: 5px;
    color: rgb(235, 0, 139);
    border: 1px solid rgba(235, 0, 139, 0.2);
    position: relative;
    left: -100px;
}

section h6:before {
    content: "Temporary Note: ";
}

    ');

Scaffold('qunit.test');




