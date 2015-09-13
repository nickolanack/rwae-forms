/**
 * 
 */
var page = require('webpage').create();
var fs=require('fs');

page.onError(function(msg, trace){
	
	console.log('error: '+ msg);
	//console.log(trace);
	phantom.exit(1);
	
});

page.open('file://' + fs.absolute('test/page.html'), function(status) {
  console.log("Status: " + status);
  if(status === "success") {
 
	setTimeout(function(){
		
		var content = page.content;
		console.log('Content: ' + content);
		
		phantom.exit();
	}, 10000);
	  
	  
   
	  
  }else{
  	phantom.exit(1);
  }

});