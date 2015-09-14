/**
 * 
 */
var UIFormManager=(function(){ 

	var ajaxUrl=null;


	var UIFormManager= new Class({
		Implements:Events,

		setAjaxUrl:function(url){
			ajaxUrl=url;
		},
		
		addForm:function(config){
			var me=this;
			if(!me._forms){
				me._forms={};
			}
			
			me._forms[config.name]=Object.append({},config);

			me.loadFormData(me.getForm(config.name), me.getFormDefaultData(config.name));
			
			console.log("UIFormManager - Added Form: "+config.name);
			
		},
		
		getFormNames:function(){
			var me=this;
			return Object.keys(me._forms);

		},
		
		getFormConfiguration(name){
			if((typeof me._forms[name])=="undefined"){
				throw new Error("There is no form named: "+name);
			}
			return me._forms[name];
		}
		
		getFormContainer:function(name){
			var me=this;
			return me.getFormConfiguration(name).container;
			
		},
		getForm:function(name){
			var me=this;
			return me.getFormConfiguration(name).form;
			
		},
		
		getFormSubmitButtons:function(name){
			var me=this;
			return me.getFormConfiguration(name).submitButtons;
			
		},
		
		getFormCancelButtons:function(name){
			var me=this;
			return me.getFormConfiguration(name).cancelButtons;
		},
		
		getFormFnButtons:function(name){
			var me=this;
			return me.getFormConfiguration(name).additionalFormButtons;
		},
		
		getFormDefaultData:function(name){
			var me=this;
			return me.getFormConfiguration(name).defaultFormData;
		},
		
		
		
		getFieldsFrom:function(formDataObject, fieldNameArray){
			
			var data={};
			
			fieldNameArray.forEach(function(fieldName){
				data[fieldName]=formDataObject[fieldName];
			});
		
			return data;
		
		},

		getListContainer:function(){
			return $("list-schedule-d");
		},
		
		displayList:function(){

			//TODO: this section should be taken out of UIFormManager. and use UIFormManager events to trigger
			
			var me=this;

			if((typeof url)=="undefined"){
				url=ajaxUrl;
			}else{
				ajaxUrl=url;
			}


			(new AjaxControlQuery(
					url,
					"list-scheduled",
					{}
			)).addEvent("success",function(response){

				if(response.success&&response.results.length){

					me.getListContainer().innerHTML="<h3>Your Previously Completed Forms</h3>";
					var section=new Element("section");
					me.getListContainer().appendChild(section);

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

						var edit=new Element('span',{"class":"btn btn-primary"});
						var addendum=new Element('span',{"class":"btn btn-danger"});
						var quarterly=new Element('span',{"class":"btn btn-success"});

						var item=section.appendChild(new Element("div", {
							"class":"scheduled-item",
							html:data.html
						}));

						item.appendChild(edit);
						item.appendChild(quarterly);
						item.appendChild(addendum);


						new UIPopover(edit, {description:"Edit Schedule D",anchor:UIPopover.AnchorTo('top')});
						new UIPopover(addendum, {description:"Add Addendum",anchor:UIPopover.AnchorTo('top')});
						new UIPopover(quarterly, {description:"Complete Quarterly",anchor:UIPopover.AnchorTo('top')});

						edit.addEvent('click',function(){
							
							var form=me.getForm("scheduled");
							me.setReadOnly(form);
							
							var formData=Object.append({}, data.formData);
							
							me.loadFormData(form, Object.append(formData, {id:data.id}));
							me.showForm("scheduled");
							var message=new Element('span', {html:'this is an existing Schedule D, do you want to enable it for editing? '});
							message.appendChild(new Element('span',{"class":"btn btn-danger", html:"yes", events:{
								click:function(){
									me.clearWarnings();
									me.setEditable(form);
								}
							}}));
							me.setWarning('scheduled','update', message);


						});
						
						addendum.addEvent('click',function(){
							
							me.loadFormData(me.getForm("addendum"), Object.append(
									data.formData, //should load all data that matches.
									/*me.getFieldsFrom(data.formData,[
									                       
									   'participant-first-name',
									   'participant-id',

									   'agency-name',
									   'agency-contact-person',
									   'agency-contact-phone',
									   'agency-contact-email'
									   
									   ]), */
									me.getFormDefaultData("scheduled")));
							me.showForm("addendum");
							var message=new Element('span', {html:'TODO: does not submit - needs backend work'});
							message.appendChild(new Element('span',{"class":"btn btn-danger", html:"close", events:{
								click:function(){
									me.clearWarnings();
								}
							}}));
							me.setWarning('addendum','update', message);

						});
						
						
						quarterly.addEvent('click',function(){
							
							me.loadFormData(me.getForm("quarterly"), Object.append(
									me.getFieldsFrom(data.formData,[
									                       
									   'participant-first-name',
									   'participant-id',

									   'agency-name',
									   'agency-contact-person',
									   'agency-contact-phone',
									   'agency-contact-email'
									   
									   ]), 
									me.getFormDefaultData("scheduled")));
							me.showForm("quarterly");
							
							var message=new Element('span', {html:'TODO: not finished - it is basically just addendum-form right now'});
							message.appendChild(new Element('span',{"class":"btn btn-danger", html:"close", events:{
								click:function(){
									me.clearWarnings();
								}
							}}));
							me.setWarning('quarterly','update', message);

						});

					});

				}else{
					me.getListContainer().innerHTML="<section><div>you have not created any schedule d forms</div></section>"
				}

			}).execute();



		},

		
		getFormData:function(form){



			data={};
			Array.prototype.slice.call(form, 0).forEach(function(i){

				if(i.disabled){
					return;
				}

				var name=i.name;
				var value=i.value;

				if(i.nodeName=="INPUT"){
					if((i.type=="radio"||i.type=="checkbox")&&(!i.checked)){
						if((typeof data[name])=="undefined"){
							value=null; //set to null;
						}else{
							return;
						}
					}
				}




				if(name.indexOf("[]")==-1){
					data[name]=value;

				}else{
					if((typeof data[name])=="undefined"){
						data[name]=[];
					}
					data[name].push(value);
				}

			});

			return data;


		},

		loadFormData:function(form, data){
			var me=this;



			Array.prototype.slice.call(form, 0).forEach(function(i){

				var name=i.name;
				var type=(typeof data[name])
				var value=data[name];


				if(type=="number"){
					value=""+value;
					type="string";
				}

				if(i.nodeName==="INPUT"&&(i.type==='checkbox'||i.type==='radio')){



					if(type==='undefined'||value===undefined||value===null){

						i.checked=false;
						return;
					}

					if(type==="string"){
						if(value===i.value){
							i.checked=true;
							i.dispatchEvent(new Event('change'));
						}else{
							i.checked=false;
						}
						return;
					}

					if(value.indexOf(i.value)>=0){
						i.checked=true;
					}else{
						i.checked=false;
					}



				}

				if(type==='undefined'||value===undefined){
					i.value="";
				}else{
					i.value=value;

				}


			});

		},

		saveForm:function(name, callback){

			var me=this;	
			var task=me.getFormConfiguration(name).ajaxTask;
			
			var form=me.getForm(name);
			(new AjaxControlQuery(
					ajaxUrl,
					task,
					me.getFormData(form))
			).addEvent("success",function(result){

				console.log(result);
				me.displayList();
				me.loadFormData(form, me.getFormDefaultData(name));
				if((typeof callback)=='function')callback(true);

			}).execute();


			me.hideForms();

		},
		clearWarnings:function(){
			
			
			var me=this;
			me.getFormNames().forEach(function(name){
				var area=me.getFormConfiguration(name).warningsArea;
				Array.prototype.slice.call(area.childNodes,0).forEach(function(c){
					area.removeChild(c);
				});
				
			});
			
			me._warnings={};

		},
		setWarning:function(name, title, message){

			var me=this;
			if(!me._warnings){
				me._warnings={};
			}

			var key=name+'.'+title;
			
			var area=me.getFormConfiguration(name).warningsArea;


			if(me._warnings[key]){
				area.removeChild(me._warnings[key]);
				delete me._warnings[key];
			}

			if((typeof message)=='string'){

				var warning=new Element('div', {"class":"warning", "data-title":title, html:message});
				area.appendChild(warning)
				me._warnings[key]=warning;

			}else if(message){

				var warning=new Element('div', {"class":"warning", "data-title":title});
				warning.appendChild(message);
				area.appendChild(warning)
				me._warnings[key]=warning;
			}



		},

		hideListContainer:function(){
			var me=this;
			me.getListContainer().removeClass("enabled");
		},
		showListContainer:function(){
			var me=this;
			me.getListContainer().addClass("enabled");
		},
		hideForms:function(){

			var me=this;

			
			me.getFormNames().forEach(function(name){
				
				var container=me.getFormContainer(name);
				if(container.hasClass('enabled')){
					var form=me.getForm(name);
					container.removeClass("enabled");
					me.loadFormData(form, me.getFormDefaultData("scheduled"));
					me.setEditable(form);
					me.fireEvent("hideForm."+name);
				}
				
				
				
			});

			

			me.clearWarnings();
			me.showListContainer();
			me.fireEvent("hideForms");
			

		},

		showForm:function(name){
			var me=this;

			me.getFormContainer(name).addClass("enabled");
			me.hideListContainer();

			me.fireEvent("showForm");
			me.fireEvent("showForm."+name);

		},
		

	

		setReadOnly:function(form){
			var me=this;
			Array.prototype.slice.call(form, 0).forEach(function(i){

				i.setAttribute('disabled', true);

			});


			me.getFormSubmitButtons("scheduled").forEach(function(btn){

				btn.setAttribute('disabled', true);
				btn.removeClass('btn-primary');

			});

			me.getFormFnButtons("scheduled").forEach(function(btn){

				btn.setAttribute('disabled', true);
				(['btn-primary', 'btn-success', 'btn-danger']).forEach(function(c){

					if(btn.hasClass(c)){
						btn.setAttribute('data-btn-class', c);
						btn.removeClass(c);
					}

				});


			});


		},
		setEditable:function(form){
			var me=this;
			Array.prototype.slice.call(form, 0).forEach(function(i){

				i.removeAttribute('disabled');


			});

			me.getFormSubmitButtons("scheduled").forEach(function(btn){

				btn.removeAttribute('disabled');
				btn.addClass('btn-primary');

			});

			me.getFormFnButtons("scheduled").forEach(function(btn){

				btn.removeAttribute('disabled');
				(['btn-primary', 'btn-success', 'btn-danger']).forEach(function(c){

					if(btn.getAttribute('data-btn-class')==c){
						btn.addClass(c);
					}

				});


			});

		}



	});

	return new UIFormManager();
})();




