/**
 * 
 */
var page = require('webpage').create();
var fs=require('fs');

page.onError(function(msg, trace){
	
	console.log('error: '+ msg);
	console.log(trace);
	phantom.exit(1);
	
});

page.open('file://' + fs.absolute('test/page.html'), function(status) {
  console.log("Status: " + status);
  if(status === "success") {
 
	 
    phantom.exit();
	  
  }else{
  	phantom.exit(1);
  }

});