<?php
IncludeCSS('http://code.jquery.com/qunit/qunit-1.19.0.css', array(
    'isUrl' => true
));

IncludeJS('http://code.jquery.com/qunit/qunit-1.19.0.js', array(
    'isUrl' => true
));

?><script type="text/javascript">

window.addEvent("load",function(){


	QUnit.test("Hello World", function( assert ) {
		  assert.ok( 1 == "1", "QUnit is great!" );
		});



	(['scheduled', 'addendum', 'quarterly']).forEach(function(name){
		QUnit.test("Test Form: "+name, function( assert ) {



			  try{
			  var form=UIFormManager.getForm(name);
			  catch(e){
                  assert.ok(false,'Expected form name: '+name+' '+e.message);
		      }

			  assert.ok( form.nodeName=="FORM", "Form exists" );

			  Array.prototype.slice.call(form,0).forEach(function(e){
				    if(e.nodeName=="INPUT"){

				        if(e.type=="radio"||e.type=="checkbox"){
				        	 var expected=e.nextSibling.textContent.trim().toLowerCase().replace(/[\s:'"`’,.–]/g, "-").replace(/\([^)]+\)/g, "-").replace(/[/]/g, '-or-').replace('+','-plus-');
				        	 while(expected.indexOf('--')>=0){
				        		    expected=expected.replace('--','-');
					         }



				        	 expected=expected.replace(/-+$/,'');
					         assert.equal(expected.indexOf('--'), -1, "expected value does not contain 2 -- in a row: "+expected);


					         //assert.notEqual(expected,"", "expected value is not an empty string for input "+e.name);
				        	 console.log(expected);
				        	 if(expected===""){
					        	 assert.ok((e.value=="true"||e.value=="false"), "Checkbox value can only be true or false only, when there is no label")

					         }else{
					        	 assert.equal( e.value,expected, "form "+e.type+":"+e.name+" has a value \""+e.value+"\"" );
						         }

					    }

				        assert.notEqual(e.name,"", 'Input:'+e.type+' has a name');
					}else{
						assert.equal(e.nodeName,"TEXTAREA", 'only know about input, and textarea elements right now...');
					}


				    assert.equal(e.name.indexOf("--"),-1, 'input name:"'+e.name+'" does not contain "--"');


		      });



			});


		});

});



</script>
<h3 style="margin-top: 100px;">Unit Test</h3>
<div id="qunit"></div>
<div id="qunit-fixture"></div>