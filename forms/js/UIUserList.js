/**
 * 
 */

var UIUserList = new Class({
    initialize: function(options) {
        var config = Object.append({
            title: "All Participant Information Form Authors",
            showCreateButtons: true
        }, options);

        var url = config.url;
        var formManager = config.formManager;
        var listContainerEl = config.element;


        (new AjaxControlQuery(
            url,
            "list-users",
            {}
        )).addEvent("success", function(response) {



            listContainerEl.innerHTML = "<h3>" + config.title + "</h3>"; //also clears previous content
            var section = new Element("section");
            listContainerEl.appendChild(section);

            response.results.forEach(function(user) {



                var item = section.appendChild(new Element("div", {
                    "class": "scheduled-item",
                    html: '<span>' + user.name + '</span><span>' + user.username + '</span><span>' + user.email + '</span><span>' + user.id + '</span>'
                }));



                var assign = new Element("span", {
                    "class": "btn btn-warn"
                });
                new UIPopover(assign, {
                    description: "Assign Participants To User",
                    anchor: UIPopover.AnchorTo("top")
                });
                item.appendChild(assign);

                assign.addEvent('click', function() {

                    var form = formManager.getForm("userassign");

                    var formData = {};

                    formManager.loadFormData(form, Object.append(formData, {
                        id: user.id
                    }));
                    formManager.showForm("userassign");
                });


                var edit = new Element("span", {
                    "class": "btn btn-primary"
                });
                new UIPopover(edit, {
                    description: "Edit User Details",
                    anchor: UIPopover.AnchorTo("top")
                });
                item.appendChild(edit);

                edit.addEvent('click', function() {

                    var form = formManager.getForm("user");

                    var formData = {};

                    formManager.loadFormData(form, Object.append(formData, {
                        id: user.id
                    }));
                    formManager.showForm("user");
                });

                section.appendChild(item);
            });


        }).execute();
    }
});

