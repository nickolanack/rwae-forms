/**
 * 
 */
var page = require('webpage').create();
var fs=require('fs');

page.open('file://' + fs.absolute('page.html'), function(status) {
  console.log("Status: " + status);
  if(status === "success") {
 
	 
    phantom.exit();
	  
  }else{
  	phantom.exit(1);
  }

});