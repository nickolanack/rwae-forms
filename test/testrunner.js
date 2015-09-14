/**
 * 
 */
var page = require('webpage').create();
var fs=require('fs');

page.onError=function(msg, trace){
	
	console.log('error: '+ msg);
	console.log(trace);
	phantom.exit(1);
	
};

page.open('file://' + fs.absolute('test/page.html'), function(status) {
  console.log("Status: " + status);
  if(status === "success") {
 
	setTimeout(function(){
		
		try{
		//var content = page.content;
		//console.log('Content: ' + content);
		
		
		var status=page.evaluate(function(){ 
			
			console.log("Parsing Qunit output");
			var result={
					failed:parseInt($$('span.failed')[0].innerHTML),
					passed:parseInt($$('span.passed')[0].innerHTML),
					total:parseInt($$('span.total')[0].innerHTML),
					errors:[]
			};
			
			$$('li li.fail').forEach(function(l){ result.errors.push(l.textContent); });
			
			return result;
			});
		console.log(JSON.stringify(status));
		}catch(e){
			console.log(e);
		}
		phantom.exit(status.failed);
	}, 10000);
	  
	  
   
	  
  }else{
  	phantom.exit(1);
  }

});