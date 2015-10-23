/**
 * 
 */

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

						
						
						
						var addendums=response.results.addendums;
						var quarterlys=response.results.quarterlys
						
						var totalAddendums=addendums.length;
						var totalQuarterlys=quarterlys.length;
						var total=totalAddendums+totalQuarterlys;
						
						if(total>0){
							
							var subUl=new Element('ul',{"class":"subforms-list"});
							
							addendums.map(function(a){
								a.form="addendum";
								return a;
								
							}).concat(quarterlys.map(function(q){
								q.form="quarterly";
								return q;
								
							})).sort(function(a,b){
								
								return a.formDate<b.formDate
								
								
							}).forEach(function(entry){
								
								var edit=new Element("span",{"class":"btn btn-primary"});
								var li=new Element('li', {"class":"subform-"+entry.form, html:entry.html});
								li.appendChild(edit);
								edit.addEvent('click',function(){
									
									
									var form=formManager.getForm(entry.form);
									formManager.setReadOnly(form);

									var formData=Object.append({}, entry.formData);

									formManager.loadFormData(form, Object.append(formData, {id:entry.id}));
									formManager.showForm(entry.form);
									var message=new Element("span", {html:"this is an existing "+entry.form+", do you want to enable it for editing? "});
									message.appendChild(new Element("span",{"class":"btn btn-danger", html:"yes", events:{
										click:function(){
											formManager.clearWarnings();
											formManager.setEditable(form);
										}
									}}));
									formManager.setWarning(entry.form, "update", message);
									
									
									
								});
								subUl.appendChild(li);
								
								new UIPopover(edit, {description:"Edit "+entry.form, anchor:UIPopover.AnchorTo("top")});
							});
						
							item.addClass('has-subforms');
							item.appendChild(subUl);
							
						}else{
							item.addClass('empty-subforms');
						}
						
						
						


					}

				}).execute();



			});

		}else{
			listContainerEl.innerHTML="<section><div>you have not created any schedule d forms</div></section>"
		}

	}).execute();

};