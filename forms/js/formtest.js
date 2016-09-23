window.addEvent("load", function() {


	QUnit.test("Hello World", function(assert) {
		assert.ok(1 == "1", "QUnit is great!");
	});



	(['scheduled', 'addendum', 'quarterly']).forEach(function(name) {
		QUnit.test("Test Form: " + name, function(assert) {


			var uniqueNames = {};
			var currentName = null;

			try {
				var form = UIFormManager.getForm(name);
			} catch (e) {
				assert.ok(false, 'Expected form name: ' + name + ' ' + e.message);
				return;
			}


			assert.ok(form.nodeName == "FORM", "Form exists");

			Array.prototype.slice.call(form, 0).forEach(function(e) {


				if (currentName !== e.name) {
					assert.ok(!uniqueNames[e.name], "form name: " + e.name + '="' + e.value + '", current group name = ' + currentName + ' should not be disconnected (from group), or duplicated');
				} else {
					assert.ok((e.type == "radio" || e.type == "checkbox"), "only radio and checkbox types can be grouped");

				}
				currentName = e.name;

				if (!uniqueNames[e.name]) {
					uniqueNames[e.name] = [];
				}

				assert.ok(uniqueNames[e.name].indexOf(e.value) === -1, "form item value: " + e.name + '="' + e.value + '" should have a unique value');
				uniqueNames[e.name].push(e.value);



				if (e.nodeName == "INPUT") {

					if (e.type == "radio" || e.type == "checkbox") {

						var expected = e.nextSibling.textContent.trim().toLowerCase().replace(/[\s:'"`’,.–]/g, "-").replace(/\([^)]+\)/g, "-").replace(/[/]/g, '-or-').replace('+', '-plus-');


						while (expected.indexOf('--') >= 0) {
							expected = expected.replace('--', '-');
						}



						expected = expected.replace(/-+$/, '');
						assert.equal(expected.indexOf('--'), -1, "expected value does not contain 2 -- in a row: " + expected);


						//assert.notEqual(expected,"", "expected value is not an empty string for input "+e.name);
						//console.log(expected);
						if (expected === "") {
							if (e.type == "checkbox") {

								if (e.name.indexOf('[]')) {

									//this is a bit different than var expected!!!
									var outerExpected = e.parentNode.textContent.trim().toLowerCase().replace(/[\s:,.–]/g, "-").replace(/[\'"`’]/g, "").replace(/\([^)]+\)/g, "-").replace(/[/]/g, '-or-').replace('+', '-plus-');
									while (outerExpected.indexOf('--') >= 0) {
										outerExpected = outerExpected.replace('--', '-');
									}
									while (outerExpected[0] == '-') {
										outerExpected = outerExpected.substring(1);
									}
									while (outerExpected[outerExpected.length - 1] == '-') {
										outerExpected = outerExpected.substring(0, outerExpected.length - 1);
									}

									assert.ok((e.value == outerExpected) || (e.value == "true" || e.value == "false"), "Checkbox array (" + e.name + "=\"" + e.value + "\") value should be: " + outerExpected);

								} else {

									assert.ok((e.value == "true" || e.value == "false"), "Checkbox value can only be true or false only, when there is no label: " + e.name + '="' + e.value + '"')
								}
							}

						} else {
							assert.equal(e.value, expected, "form " + e.type + ":" + e.name + " has a value \"" + e.value + "\"");
						}

					}

					assert.notEqual(e.name, "", 'Input:' + e.type + ' has a name');
				} else {

					if (e.nodeName == "SELECT") {



					} else {
						assert.equal(e.nodeName, "TEXTAREA", 'only know about input, and textarea elements right now...');
					}
				}


				assert.equal(e.name.indexOf("--"), -1, 'input name:"' + e.name + '" does not contain "--"');


			});



		});


	});

});