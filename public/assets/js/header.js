var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function showMenu() {
    document.getElementById("sub-menu").classList.toggle("show");
}

function showModal(modalId) {
    document.getElementById(modalId).classList.toggle("show");
    document.getElementsByTagName("body")[0].style.overflow = "hidden";
}

function hideModal(modalId) {
    document.getElementById(modalId).classList.remove("show");
    document.getElementsByTagName("body")[0].style.overflow = "scroll";
}

$(function () {
    $.ajax({
        url: "/category/categories",
        type: "GET",
        success: function (response) {
            $.each(JSON.parse(response), function (index, obj) {
                $("#search-category ul").append('<li><label class="container"><span>' + obj.name
                    + '</span> <input type="checkbox" name="category[]" value="' + obj.id + '"> <span class="checkmark"></span></label></li>');
            });
            $("#search-category ul li,#search-category ul li .container,#search-category ul li .container span").click(function (e) {
                var ckBox;
                if (e.target.tagName.toLowerCase() == 'span') {
                    ckBox = $(e.target).parent().find('[type=checkbox]');
                } else {
                    ckBox = $(e.target).find('[type=checkbox]');
                }
                ckBox.attr("checked", !ckBox.attr("checked"));
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert.danger(_alert_container, "Unexpected error occurred when fetching categories : Error Code - " +
                jqXHR.status);
        }
    });
    $("#searchBox").focusin(function () {
        $('#search-category').addClass('show');
    });

    $('#searchBox').keyup(function (e) {
        if (e.keyCode == 13) {
            doSearch();
        }
    });
});

function doSearch() {
    var criteria = $("#searchBox").val();
    var href = '/?criteria=' + criteria + '&' + $("#search-category").serialize();
    console.log(href);
    window.location.href = href;
}

window.onclick = function (event) {
    // Close the menu if the user clicks outside of it
    var target = event.target;
    if (!target.matches('#search-category,#search-category ul li,' +
        '#search-category ul li .container,#search-category ul li .container span,' +
        '#search-category ul li input,#search-category ul li span,#searchBox')) {
        var menu = document.getElementById("search-category");
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }

    if (!target.matches('#user-profile,#user-profile-img')) {
        var menu = document.getElementById("sub-menu");
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }

    // Close the modal if the user clicks outside of it
    var els = [];
    while (target) {
        if (target.classList) {
            target.classList.forEach(function (element) {
                els.unshift(element);
            });
            target = target.parentNode;
        } else {
            target = null;
        }
    }

    if (target && !els.includes("modal-container") && !target.matches('#modal') && !target.matches('.btn')) {
        var modal = document.getElementById("modal-container");
        if (modal.classList.contains('show')) {
            hideModal(modal.id);
        }
    }
}

var alert_type_success = "alert-success";
var alert_type_info = "alert-info";
var alert_type_warning = "alert-warning";
var alert_type_danger = "alert-danger";
var alert_icon_class_success = "s7-check";
var alert_icon_class_info = "s7-info";
var alert_icon_class_warning = "s7-attention";
var alert_icon_class_danger = "s7-close";
var alert_icon_class_message = "s7-comment";

alert = function () {
}
alert.warning = function (container, message) {
    $(container).html(getAlert(alert_type_warning, alert_icon_class_warning, message));
    /*animate();*/
    setTimeout(function () {
        $(container).empty()
    }, 20000);
}

alert.success = function (container, message) {
    $(container).html(getAlert(alert_type_success, alert_icon_class_success, message));
    /*animate();*/
    setTimeout(function () {
        $(container).empty()
    }, 20000);
}

alert.message = function (container, message) {
    $(container).html(getAlert(alert_type_success, alert_icon_class_message, message));
    /*animate();*/
    setTimeout(function () {
        $(container).empty()
    }, 20000);
}

alert.danger = function (container, message) {
    $(container).html(getAlert(alert_type_danger, alert_icon_class_danger, message));
    /*animate();*/
    setTimeout(function () {
        $(container).empty()
    }, 20000);
}

alert.info = function (container, message) {
    $(container).html(getAlert(alert_type_info, alert_icon_class_info, message));
    /*animate();*/
    setTimeout(function () {
        $(container).empty()
    }, 20000);
}

function getAlert(type, icon, message) {
    return '<div role="alert" class="alert alert-contrast ' + type + ' alert-dismissible' +
        ' my-alert"><div class="icon"><span class="' + icon + '"></span></div><div' +
        ' class="message"><button type="button" data-dismiss="alert" aria-label="Close"' +
        ' class="close" onclick="close()"><span aria-hidden="true" class="s7-close" onclick="close()"></span></button>' + message +
        '</div></div>';
}

function close() {
    $("#alert-container").empty();
}