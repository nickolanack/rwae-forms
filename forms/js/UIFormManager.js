/**
 * 
 */
var UIFormManager = (function() {

	var ajaxUrl = null;
	var currentForm;


	var UIFormManager = new Class({
		Implements: Events,

		setAjaxUrl: function(url) {
			ajaxUrl = url;
		},

		addForm: function(config) {
			var me = this;
			if (!me._forms) {
				me._forms = {};
			}

			me._forms[config.name] = Object.append({}, config);

			me.loadFormData(me.getForm(config.name), me.getFormDefaultData(config.name));

			console.log("UIFormManager - Added Form: " + config.name);

		},

		getFormNames: function() {
			var me = this;
			return Object.keys(me._forms);

		},

		getFormConfiguration: function(name) {
			var me = this;
			if ((typeof me._forms[name]) == "undefined") {
				throw new Error("There is no form named: " + name);
			}
			return me._forms[name];
		},

		getFormContainer: function(name) {
			var me = this;
			return me.getFormConfiguration(name).container;

		},
		getForm: function(name) {
			var me = this;
			return me.getFormConfiguration(name).form;

		},

		getFormSubmitButtons: function(name) {
			var me = this;
			return me.getFormConfiguration(name).submitButtons;

		},

		getFormCancelButtons: function(name) {
			var me = this;
			return me.getFormConfiguration(name).cancelButtons;
		},

		getFormFnButtons: function(name) {
			var me = this;
			return me.getFormConfiguration(name).additionalFormButtons;
		},

		getFormDefaultData: function(name) {
			var me = this;
			return me.getFormConfiguration(name).defaultFormData;
		},



		getFieldsFrom: function(formDataObject, fieldNameArray) {

			var data = {};

			fieldNameArray.forEach(function(fieldName) {
				data[fieldName] = formDataObject[fieldName];
			});

			return data;

		},

		getFormData: function(form) {



			data = {};
			Array.prototype.slice.call(form, 0).forEach(function(i) {

				if (i.disabled) {
					return;
				}

				var name = i.name;
				var value = i.value;

				if (i.nodeName == "INPUT") {
					if ((i.type == "radio" || i.type == "checkbox") && (!i.checked)) {
						if ((typeof data[name]) == "undefined") {
							value = null; //set to null;
						} else {
							return;
						}
					}
				}



				if (name.indexOf("[]") == -1) {
					data[name] = value;

				} else {
					if ((typeof data[name]) == "undefined") {
						data[name] = [];
					}
					data[name].push(value);
				}

			});

			return data;


		},

		/**
		 * sets value, clear, or defualts all form fields
		 * 
		 * @param  element form html form element
		 * @param  object data key value pairs
		 */
		loadFormData: function(form, data) {
			var me = this;



			Array.prototype.slice.call(form, 0).forEach(function(i) {

				var name = i.name;
				var type = (typeof data[name])
				var value = data[name];


				if (type == "number") {
					value = "" + value;
					type = "string";
				}

				if (i.nodeName === "INPUT" && (i.type === 'checkbox' || i.type === 'radio')) {



					if (type === 'undefined' || value === undefined || value === null) {

						i.checked = false;
						return;
					}

					if (type === "string") {
						if (value === i.value) {
							i.checked = true;
							i.dispatchEvent(new Event('change'));
						} else {
							i.checked = false;
						}
						return;
					}

					if (value.indexOf(i.value) >= 0) {
						i.checked = true;
					} else {
						i.checked = false;
					}



				}

				if (type === 'undefined' || value === undefined) {
					i.value = "";
				} else {
					i.value = value;

				}


			});

		},


		/**
		 * sets form values for the currently visible form
		 * @param  object data key value pairs
		 */
		setFormData: function(data) {
			var me = this;

			var form = me.getForm(currentForm);

			Array.prototype.slice.call(form, 0).forEach(function(i) {

				var name = i.name;
				var type = (typeof data[name])
				var value = data[name];


				if (type == "number") {
					value = "" + value;
					type = "string";
				}

				if (i.nodeName === "INPUT" && (i.type === 'checkbox' || i.type === 'radio')) {



					if (type === 'undefined' || value === undefined || value === null) {
						return;
					}

					if (type === "string") {
						if (value === i.value) {
							i.checked = true;
							i.dispatchEvent(new Event('change'));
						} else {
							i.checked = false;
						}
						return;
					}

					if (value.indexOf(i.value) >= 0) {
						i.checked = true;
					} else {
						i.checked = false;
					}



				}

				if (type === 'undefined' || value === undefined) {

				} else {
					i.value = value;

				}


			});

		},

		saveForm: function(name, callback) {

			var me = this;
			var task = me.getFormConfiguration(name).ajaxTask;

			var form = me.getForm(name);
			(new AjaxControlQuery(
				ajaxUrl,
				task,
				me.getFormData(form))).addEvent("success", function(result) {

				console.log(result);
				me.fireEvent('saveForm', [name]);
				me.fireEvent('saveForm.' + name);
				me.loadFormData(form, me.getFormDefaultData(name));

				if ((typeof callback) == 'function') callback(true);

			}).execute();


			me.hideForms();

		},
		clearWarnings: function() {


			var me = this;
			me.getFormNames().forEach(function(name) {
				var area = me.getFormConfiguration(name).warningsArea;
				Array.prototype.slice.call(area.childNodes, 0).forEach(function(c) {
					area.removeChild(c);
				});

			});

			me._warnings = {};

		},
		setWarning: function(name, title, message) {

			var me = this;
			if (!me._warnings) {
				me._warnings = {};
			}

			var key = name + '.' + title;

			var area = me.getFormConfiguration(name).warningsArea;


			if (me._warnings[key]) {
				area.removeChild(me._warnings[key]);
				delete me._warnings[key];
			}

			if ((typeof message) == 'string') {

				var warning = new Element('div', {
					"class": "warning",
					"data-title": title,
					html: message
				});
				area.appendChild(warning)
				me._warnings[key] = warning;

			} else if (message) {

				var warning = new Element('div', {
					"class": "warning",
					"data-title": title
				});
				warning.appendChild(message);
				area.appendChild(warning)
				me._warnings[key] = warning;
			}



		},


		hideForms: function() {

			var me = this;


			me.getFormNames().forEach(function(name) {

				var container = me.getFormContainer(name);
				if (container.hasClass('enabled')) {
					var form = me.getForm(name);
					container.removeClass("enabled");
					me.loadFormData(form, me.getFormDefaultData("scheduled"));
					me.setEditable(form);
					me.fireEvent("hideForm." + name);
				}



			});



			me.clearWarnings();
			me.fireEvent("hideForms");


		},

		showForm: function(name) {
			var me = this;

			me.getFormContainer(name).addClass("enabled");
			currentForm = name;

			me.fireEvent("showForm");
			me.fireEvent("showForm." + name);

			window.scrollTo(0,0);

		},



		setReadOnly: function(form) {
			var me = this;
			Array.prototype.slice.call(form, 0).forEach(function(i) {

				i.setAttribute('disabled', true);

			});


			me.getFormSubmitButtons("scheduled").forEach(function(btn) {

				btn.setAttribute('disabled', true);
				btn.removeClass('btn-primary');

			});

			me.getFormFnButtons("scheduled").forEach(function(btn) {

				btn.setAttribute('disabled', true);
				(['btn-primary', 'btn-success', 'btn-danger']).forEach(function(c) {

					if (btn.hasClass(c)) {
						btn.setAttribute('data-btn-class', c);
						btn.removeClass(c);
					}

				});


			});


		},
		setEditable: function(form) {
			var me = this;
			Array.prototype.slice.call(form, 0).forEach(function(i) {


				if (!i.getAttribute('data-force-disabled')) {
					i.removeAttribute('disabled');
				}

			});

			me.getFormSubmitButtons("scheduled").forEach(function(btn) {

				btn.removeAttribute('disabled');
				btn.addClass('btn-primary');

			});

			me.getFormFnButtons("scheduled").forEach(function(btn) {

				btn.removeAttribute('disabled');
				(['btn-primary', 'btn-success', 'btn-danger']).forEach(function(c) {

					if (btn.getAttribute('data-btn-class') == c) {
						btn.addClass(c);
					}

				});


			});

		}



	});

	return new UIFormManager();
})();