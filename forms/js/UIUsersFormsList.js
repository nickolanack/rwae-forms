/**
 *  Displays the list of existing user forms, and add button behaviors for UIFormManager
 */


var UIUsersFormsList = new Class({
    initialize: function(config) {

        var me = this;


        //render list of existing forms, in element
        displayUsersFormsList(config);



        // refresh users list of forms whenever a form is edited or created
        UIFormManager.addEvent("saveForm", function() {
            displayUsersFormsList(config);
        });

        // refresh users list of forms whenever a form is edited or created
        UIFormManager.addEvent("deleteForm", function() {
            displayUsersFormsList(config);
        });

    }



});


var sortField = 'submitDate';
var sortOrder = 'DESC';


var displaySortOrder = function(element, options) {

    var list = new Element('ul', {
        html: 'Sort Order',
        'class': 'sorting'
    });

    var submittedDate = new Element('li', {
        html: 'created',
        'data-sort': 'submitDate'
    });
    var rwaDate = new Element('li', {
        html: 'form quarter',
        'data-sort': 'formDate'
    });
    var code = new Element('li', {
        html: 'agency',
        'data-sort': 'code'
    });

    var buttons = [code, submittedDate, rwaDate];


    buttons.forEach(function(button) {

        list.appendChild(button);

        if (button.getAttribute('data-sort') === sortField) {
            button.addClass('active');
            button.addClass(sortOrder === 'DESC' ? 'desc' : 'asc');
        }

        button.addEvent('click', function() {

            var newSortOrder = 'desc';

            buttons.forEach(function(otherButton) {
                if (otherButton !== button) {
                    otherButton.removeClass('active');
                    otherButton.removeClass('asc');
                    otherButton.removeClass('desc');
                } else {

                    if (otherButton.hasClass('desc')) {


                        otherButton.addClass('asc');
                        otherButton.removeClass('desc');
                        newSortOrder = 'ASC';
                    } else {
                        otherButton.removeClass('asc');
                        otherButton.addClass('desc');
                        newSortOrder = 'DESC';
                    }

                }

            });

            button.addClass('active')

            var newSortField = button.getAttribute('data-sort');

            if (newSortField !== sortField || newSortOrder !== sortOrder) {
                sortField = newSortField;
                sortOrder = newSortOrder;
                displayUsersFormsList(options);
            }

        });

    });


    element.appendChild(list);


};


var displayUsersFormsList = function(options) {


    var lang = function(str) {
        return str;
    }

    if (window.Language) {
        lang = window.Language.Instance.localize.bind(window.Language.Instance);
    }


    var config = Object.append({
        title: lang('Your Previously Completed Forms'),
        showCreateButtons: true
    }, options);

    var url = config.url;
    var formManager = config.formManager;
    var listContainerEl = config.element;
    var endDate = config.endDate;

    (new AjaxControlQuery(
        url,
        "list-scheduled", {
            'sortField': sortField,
            'sortOrder': sortOrder

        }
    )).addEvent("success", function(response) {

        if (response.success && response.results.length) {

            listContainerEl.innerHTML = "<h3>" + config.title + "</h3>"; //also clears previous content

            displaySortOrder(listContainerEl, options);


            var section = new Element("section");
            listContainerEl.appendChild(section);

            var last = null;
            var dateFn = function(str) {

                var date = (new Date(str)).timeAgoInWords();
                if (date !== last) {
                    section.appendChild(new Element("div", {
                        "class": "timeago",
                        html: date
                    }));
                    last = date;
                }
            };

            var prefixFn = function(str) {

                var prefix = str.split('-')[0].toUpperCase();
                if (prefix !== last) {
                    section.appendChild(new Element("div", {
                        "class": "timeago",
                        html: prefix
                    }));
                    last = prefix;
                }
            };

            var displayFn = {
                submitDate: dateFn,
                formDate: dateFn,
                code: prefixFn
            };


            response.results.forEach(function(data) {

                displayFn[sortField](data[sortField]);

                var item = section.appendChild(new Element("div", {
                    "class": "scheduled-item",
                    html: data.html
                }));

                if (data.user) {
                    item.appendChild(new Element('span', {
                        "class": 'user-details',
                        html: 'Authored by: ' + data.user.name + ' <span class="user-id">' + data.user.id + '</span>'
                    }))
                }


                var expand = new Element("span", {
                    "class": "btn btn-activate"
                });
                item.appendChild(expand);
                expand.addEvent('click', function() {
                    if (item.hasClass('activated')) {
                        item.removeClass('activated');
                        expand.removeClass('active');
                    } else {
                        item.addClass('activated');
                        expand.addClass('active');
                    }

                });

                var edit = new Element("span", {
                    "class": "btn btn-primary"
                });
                new UIPopover(edit, {
                    description: "Edit Participant Information Form",
                    anchor: UIPopover.AnchorTo("top")
                });
                item.appendChild(edit);

                if (config.showCreateButtons) {
                    var addendum = new Element("span", {
                        "class": "btn btn-danger"
                    });
                    var quarterly = new Element("span", {
                        "class": "btn btn-success"
                    });
                    new UIPopover(addendum, {
                        description: "Add Addendum",
                        anchor: UIPopover.AnchorTo("top")
                    });
                    new UIPopover(quarterly, {
                        description: "Add Quarterly",
                        anchor: UIPopover.AnchorTo("top")
                    });
                    item.appendChild(quarterly);
                    item.appendChild(addendum);
                }

                var remove = new Element("span", {
                    "class": "btn btn-remove"
                });
                new UIPopover(remove, {
                    description: "Delete Participant Information Form",
                    anchor: UIPopover.AnchorTo("top")
                });
                item.appendChild(remove);



                edit.addEvent("click", function() {

                    var form = formManager.getForm("scheduled");
                    formManager.setReadOnly(form);

                    var formData = Object.append({}, data.formData);

                    formManager.loadFormData(form, Object.append(formData, {
                        id: data.id
                    }));
                    formManager.showForm("scheduled");
                    var message = new Element("span", {
                        html: lang("this is an existing Participant Information Form, do you want to enable it for editing?")
                    });
                    message.appendChild(new Element("span", {
                        "class": "btn btn-danger",
                        html: "yes",
                        events: {
                            click: function() {
                                formManager.clearWarnings();
                                formManager.setEditable(form);
                            }
                        }
                    }));
                    formManager.setWarning("scheduled", "update", message);


                });

                if (config.showCreateButtons) {
                    addendum.addEvent("click", function() {

                        formManager.loadFormData(formManager.getForm("addendum"), Object.append(
                            //data.formData, //should load all data that matches.
                            formManager.getFieldsFrom(data.formData,[
    
                                       "participant-first-name",
                                       "participant-id",
    
                                       "agency-name",
                                       "agency-contact-person",
                                       "agency-contact-phone",
                                       "agency-contact-email"
    
                                       ]), 
                            formManager.getFormDefaultData("addendum")));
                        formManager.showForm("addendum");
                        /*
                         * 
                        var message=new Element("span", {html:"TODO: does not submit - needs backend work"});
                        message.appendChild(new Element("span",{"class":"btn btn-danger", html:"close", events:{
                            click:function(){
                                formManager.clearWarnings();
                            }
                        }}));
                        formManager.setWarning("addendum","update", message);
                        *
                        */

                    });
                }

                var displayNewQuarterlyFromData = function(data, override) {

                    var fieldData = Object.append(
                        formManager.getFieldsFrom(data.formData, [

                            "participant-first-name",
                            "participant-id",
                            "participant-facilitator",

                            "agency-name",
                            "agency-contact-person",
                            "agency-contact-phone",
                            "agency-contact-email"


                        ]),
                        formManager.getFormDefaultData("quarterly"));

                    if (override) {
                        Object.append(fieldData, override);
                    }

                    formManager.loadFormData(formManager.getForm("quarterly"), fieldData);
                    formManager.showForm("quarterly");


                };

                if (config.showCreateButtons) {
                    quarterly.addEvent("click", function() {

                        displayNewQuarterlyFromData(data);

                        /*
                         * 
                        var message=new Element("span", {html:"TODO: not finished - it is basically just addendum-form right now"});
                        message.appendChild(new Element("span",{"class":"btn btn-danger", html:"close", events:{
                            click:function(){
                                formManager.clearWarnings();
                            }
                        }}));
                        formManager.setWarning("quarterly","update", message);
                        *
                        */

                    });
                }


                remove.addEvent('click', function() {

                    if (confirm(lang("This will delete the Participant Information Form, and all it's related Quarterlies and Addendums. Are you sure you want to proceed"))) {



                        (new AjaxControlQuery(
                            url,
                            "delete-scheduled", {
                                id: data.id
                            }
                        )).addEvent("success", function(response) {

                            displayUsersFormsList(config);

                        }).execute();



                    }

                });


                (new AjaxControlQuery(
                    url,
                    "list-addendums-quarterlys",
                    formManager.getFieldsFrom(data.formData, ["participant-id"])
                )).addEvent("success", function(response) {

                    if (response.success) {



                        var addendums = response.results.addendums;
                        var quarterlys = response.results.quarterlys

                        var totalAddendums = addendums.length;
                        var totalQuarterlys = quarterlys.length;
                        var total = totalAddendums + totalQuarterlys;


                        var startDate = data.formDate;
                        var _d = Date.parse(startDate);
                        var _e = Date.parse(endDate);

                        var incrementQuarter = function(date) {


                            date.setMonth((date.getMonth() + 3));
                            if (date.getMonth == 0) {
                                date.getYear(date.getYear() + 1);
                            }

                        }
                        incrementQuarter(_d);

                        var calcQs = [];
                        var q = 1;
                        var qStr = ['st', 'nd', 'rd', 'th'];
                        while (_d.getYear() < _e.getYear() || (_d.getYear() == _e.getYear() && _d.getMonth() <= _e.getMonth())) {
                            q = (_d.getMonth()) / 3;
                            calcQs.push({
                                formDate: _d.toISOString().slice(0, 10) + ' 00:00:00',
                                html: '<span>' + _d.toISOString().slice(0, 4) + '</span><span>' + (q + 1) + qStr[q] + '</span>',
                                formData: {
                                    'admin-year': _d.toISOString().slice(0, 4),
                                    'admin-quarter': (q + 1) + qStr[q]
                                }
                            });


                            incrementQuarter(_d);
                        }



                        if (total > 0 || calcQs.length > 0) {

                            var subUl = new Element('ul', {
                                "class": "subforms-list"
                            });



                            var insertExpectedQuarterly = function(expected, data) {


                                var li = new Element('li', {
                                    "class": "subform-expected-quarterly",
                                    html: expected.html
                                });

                                if (config.showCreateButtons) {
                                    var insert = new Element("span", {
                                        "class": "btn btn-primary"
                                    });
                                    new UIPopover(insert, {
                                        description: "Insert Quarterly",
                                        anchor: UIPopover.AnchorTo("top")
                                    });
                                    li.appendChild(insert);

                                    insert.addEvent('click', function() {
                                        displayNewQuarterlyFromData(data, expected.formData);
                                    });
                                }

                                subUl.appendChild(li);



                            }



                            var last = null; //keep track of last form entry for comparison/warnings
                            var lastDataForExpectedQuarterly = data;
                            addendums.map(function(a) {
                                a.form = "addendum";
                                return a;
                            }).concat(quarterlys.map(function(q) {
                                q.form = "quarterly";
                                return q;

                            })).sort(function(a, b) {

                                if (a.formDate == b.formDate) {

                                    if (a.form == b.form) {

                                    } else {

                                        return (a.form == 'quarterly') ? 1 : -1;

                                    }


                                }
                                return a.formDate > b.formDate ? 1 : -1;


                            }).forEach(function(entry) {
                                var formStr = entry.form.charAt(0).toUpperCase() + entry.form.slice(1);



                                while (calcQs.length && entry.formDate > calcQs[0].formDate) {
                                    insertExpectedQuarterly(calcQs.shift(), lastDataForExpectedQuarterly);
                                }

                                if (calcQs.length && calcQs[0].formDate == entry.formDate) {
                                    calcQs.shift(); //discard
                                }


                                if (last) {

                                    if (last.form == entry.form && last.formDate == entry.formDate) {

                                        entry.warning = [lang('Multiple ' + formStr + 's', 'There should only be one ' + formStr + ' per quarter. Consolidate and remove extra ' + formStr + '.')];

                                    }



                                }
                                last = entry;

                                if (entry.form == 'quarterly') {
                                    lastDataForExpectedQuarterly = entry;
                                }



                                var li = new Element('li', {
                                    "class": "subform-" + entry.form,
                                    html: entry.html
                                });
                                var edit = new Element("span", {
                                    "class": "btn btn-primary"
                                });
                                li.appendChild(edit);
                                new UIPopover(edit, {
                                    description: "Edit " + formStr,
                                    anchor: UIPopover.AnchorTo("top")
                                });

                                edit.addEvent('click', function() {


                                    var form = formManager.getForm(entry.form);
                                    formManager.setReadOnly(form);

                                    var formData = Object.append({}, entry.formData);

                                    formManager.loadFormData(form, Object.append(formData, {
                                        id: entry.id
                                    }));
                                    formManager.showForm(entry.form);



                                    var message = new Element("span", {
                                        html: lang("this is an existing " + formStr + ", do you want to enable it for editing? ")
                                    });
                                    message.appendChild(new Element("span", {
                                        "class": "btn btn-danger",
                                        html: "yes",
                                        events: {
                                            click: function() {
                                                formManager.clearWarnings();
                                                formManager.setEditable(form);
                                            }
                                        }
                                    }));
                                    formManager.setWarning(entry.form, "update", message);

                                });

                                var remove = new Element("span", {
                                    "class": "btn btn-remove"
                                });
                                li.appendChild(remove);
                                new UIPopover(remove, {
                                    description: "Remove " + formStr,
                                    anchor: UIPopover.AnchorTo("top")
                                });

                                remove.addEvent('click', function() {

                                    if (confirm(lang("Are you sure you want to remove this " + formStr))) {



                                        (new AjaxControlQuery(
                                            url,
                                            "delete-" + entry.form, {
                                                id: entry.id
                                            }
                                        )).addEvent("success", function(response) {

                                            displayUsersFormsList(config);

                                        }).execute();

                                    };

                                });

                                subUl.appendChild(li);


                                if (entry.warning) {

                                    li.addClass('has-warning');
                                    new UIPopover(li, {
                                        title: entry.warning[0],
                                        description: entry.warning[1],
                                        anchor: UIPopover.AnchorTo("top"),
                                        className: 'popover tip-wrap hoverable warn'

                                    });

                                }
                            });


                            while (calcQs.length) {

                                insertExpectedQuarterly(calcQs.shift(), lastDataForExpectedQuarterly);


                            }


                            item.addClass('has-subforms');
                            item.appendChild(subUl);

                        } else {
                            item.addClass('empty-subforms');
                        }



                    }

                }).execute();



            });

        } else {
            listContainerEl.innerHTML = "<section><div>" + lang("you have not created any schedule d forms") + "</div></section>"
        }

    }).execute();

};