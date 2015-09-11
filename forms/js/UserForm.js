/**
 * 
 */
var UserForm=(function(){ 

	var ajaxUrl=null;


	var UserForm= new Class({
		Implements:Events,

		setAjaxUrl:function(url){
			ajaxUrl=url;
		},
		displayList:function(){

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

					$("list-schedule-d").innerHTML="<h3>Your Previously Completed Forms</h3>";
					var section=new Element("section");
					$("list-schedule-d").appendChild(section);

					var dateFn=function(str){

						var date=new Date(str);
						section.appendChild(new Element("div",{"class":"timeago", html:date.timeAgoInWords()}))
					};

					response.results.forEach(function(item){

						dateFn(item.submitDate);

						var edit=new Element('span',{"class":"btn btn-primary"});
						var ammend=new Element('span',{"class":"btn btn-danger"});
						var quarterly=new Element('span',{"class":"btn btn-success"});

						var item=section.appendChild(new Element("div", {
							"class":"scheduled-item",
							html:item.html
						}));

						item.appendChild(edit);
						item.appendChild(quarterly);
						item.appendChild(ammend);


						new UIPopover(edit, {description:"edit Schedule D",anchor:UIPopover.AnchorTo('top')});
						new UIPopover(ammend, {description:"ammend Schedule d",anchor:UIPopover.AnchorTo('top')});
						new UIPopover(quarterly, {description:"Schedule D Quarterly",anchor:UIPopover.AnchorTo('top')});

						item.addEvent('click',function(){

							me.loadScheduleD(item.formData, item.id);
							me.showScheduleD();

						});

					});

				}else{
					$("list-schedule-d").innerHTML="<section><div>you have not created any schedule d forms</div></section>"
				}

			}).execute();



		},

		getScheduleDForm:function(){
			return $$("#new-rwa-schedule-d>form")[0];
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

		loadScheduleD:function(data){

			


		},

		saveScheduleD:function(){

			var me=this;		
			(new AjaxControlQuery(
					ajaxUrl,
					"create-new-scheduled",
					me.getFormData(me.getScheduleDForm()))
			).addEvent("success",function(result){

				console.log(result);
				me.displayList();

			}).execute();


			me.hideScheduleD();

		},

		hideScheduleD:function(){

			var me=this;

			$("new-rwa-schedule-d").removeClass("enabled");
			$("list-schedule-d").addClass("enabled");

			me.fireEvent("hideForm");
			me.fireEvent("hideForm.scheduled");

		},

		showScheduleD:function(){
			var me=this;

			$("new-rwa-schedule-d").addClass("enabled");
			$("list-schedule-d").removeClass("enabled");

			me.fireEvent("showForm");
			me.fireEvent("showForm.scheduled");

		}

	});

	return new UserForm();
})();




