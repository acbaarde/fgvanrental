$.fn.extend({
    navs: function(option = new Array()) {
        $(this).each(function() {
            const id = $(this)[0].id;
            const self = this;
            const selector = $(self);
            let navtype = option.navtype == undefined ? "tab" : option.navtype;
            const justified = option.justified == undefined ? false : option.items;
            const items = option.items == undefined ? new Array() : option.items;
            const header = option.header == undefined ? false : option.header;
            const link = option.link == undefined ? new Array() : option.link;
            let navs = "";
            let navs_body = "";
            if (items.length == 0) {
                alert("No Data Item");
                return false;
            }
            const genfunction = {
                linkgen: function() {
                    for (let i = 0; i < link.length; i++) {
                        $("#" + id + "_li_menu" + i).on("click", function() {
                            $("." + id + "_menubody").html("");
                            $.ajax({
                                url: link[i],
                                dataType: 'html',
                                success: function(result) {
                                    $("#" + id + "_menubody" + i).html(result);
                                },
                                error: function(data) {
                                    alert("Somethings Happened!!!");
                                }
                            });
                        });
                        if (i == 0) { $("#" + id + "_li_menu" + i).click(); }
                    }
                },
            }

            navtype = navtype == "tab" ? "tabs" : "pills";
            navs += "<ul class=\"nav nav-" + navtype + " nav-justified\">\n";
            navs_body += "<div class=\"tab-content\">\n";
            for (let i = 0; i < items.length; i++) {
                const active = i == 0 ? "active" : "";
                const active_header = i == 0 ? " active show" : "";
                const header_item = header == false ? "<h3>" + items[i] + "</h3>" : "";
                navs += "<li class=\"nav-item\" id=\"" + id + "_li_menu" + i + "\"><a class=\"nav-link " + active + "\" href=\"#" + id + "_menuheader" + i + "\" data-toggle=\"tab\">" + items[i] + "</a></li>\n";
                navs_body += "<div id=\"" + id + "_menuheader" + i + "\" class=\"tab-pane fade" + active_header + "\">\n";
                // navs_body += "<div class=\"container-fluid\">\n";
                // navs_body += header_item + "\n";
                navs_body += "<div id=\"" + id + "_menubody" + i + "\" class=\"" + id + "_menubody\">\n";
                navs_body += "</div>\n</div>\n";
            }
            navs += "</ul>\n";
            selector.html(navs + navs_body);
            genfunction.linkgen();

            // $("portal").each(function() {
            //     let portalid = $(this).attr("to");
            //     let portalcount = portalid[portalid.length - 1];
            //     let selector_portal = $("portal[to=" + portalid + "]");
            //     let selector_portal_to = $("#menuheader" + portalcount + " > .container-fluid");
            //     selector_portal.appendTo("#menuheader" + portalcount + " > .container-fluid");
            // });

        });
    },

    dropdownlist: function(option = new Array()) {
        $(this).each(function() {
            const id = $(this)[0].id;
            const self = this;
            const selector = $(self);
            const append = option.append == undefined ? "" : option.append;
            selector.children()
                .remove()
                .end()
                .append(append);
        });
    },

    confirmation: function(callback) {
        // const self = this;
        // <br> <br> <div class="form-inline float-right"><div class="form-group mr-3"><button type="button" id="btnConfirm" class="btn btn-primary"><i class="fas fa-check"></i> Confirm</button></div><div class="form-group"><button type="button" data-dismiss="modal" class="btn btn-danger" id="btnCancel"><i class="fas fa-times"></i> Cancel</button></div></div>
        const body = ['Are You Sure You Want To Proceed This Process?'];
        callback.body == undefined ? false : body.push(callback.body);
        // body.push()
        const confirmmodal = createmodal({
            header: "Confirmation",
            size: "lg",
            body: body,
            footer: '<button type="button" id="btnConfirm" class="btn btn-primary"><i class="fas fa-check"></i> Confirm</button><button type="button" data-dismiss="modal" class="btn btn-danger" id="btnCancel"><i class="fas fa-times"></i> Cancel</button>',
            loading: false,
            callback: function() {
                if (callback != undefined) {
                    $("#btnConfirm").click(function() {
                        confirmmodal.LoadingOverlay('show', {
                            backgroundClass: "dimoverlay_modal",
                            zIndex: 10000,
                            image: "",
                            text: " ",
                            textClass: "dimoverlaytext_modal",
                        });
                        $('.dimoverlaytext_modal').html('<i class="fas fa-cog fa-spin"></i><label class="loadingtext_overlay">Please Wait...</label>');
                        $.when(callback.call()).then(function() {
                            if ($.active == 0) {
                                confirmmodal.LoadingOverlay('hide');
                            } else {
                                $(document).ajaxStop(function() {
                                    confirmmodal.LoadingOverlay('hide');
                                    $(this).unbind("ajaxStop");
                                });
                            }
                        });
                    });
                }
            }
        });
        return confirmmodal;
        // return body;
    }


});


var g_messageDialogViewModel = {
    showWaitDialog: function() {
        jQuery.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '5px',
                '-moz-border-radius': '5px',
                'border-radius': '5px',
                opacity: .5,
                color: '#fff'
            }
        });
    },

    hideWaitDialog: function() {
        setTimeout(jQuery.unblockUI, 10);
    },
}