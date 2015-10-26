/**
 * 
 */

var UIUserList=new Class({
	initialize:function(options){
		var config=Object.append({
			 title:"All Schedule D Authors",
			showCreateButtons:true
		}, options);

		var url=config.url;
		var formManager=config.formManager;
		var listContainerEl=config.element;
	

		(new AjaxControlQuery(
				url,
				"list-users",
				{}
		)).addEvent("success",function(response){
			
			
			
			listContainerEl.innerHTML="<h3>"+config.title+"</h3>"; //also clears previous content
			var section=new Element("section");
			listContainerEl.appendChild(section);
			
			response.results.forEach(function(user){

				
				
				var item=section.appendChild(new Element("div", {
					"class":"scheduled-item",
					html:'<span>'+user.name+'</span><span>'+user.username+'</span><span>'+user.email+'</span><span>'+user.id+'</span>'
				}));
				section.appendChild(item);
			});
			
			
		}).execute();
	}
});

	