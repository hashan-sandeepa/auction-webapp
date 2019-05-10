var maxLength = 1000;
$(function () {
    $('#startingBid').maskMoney({prefix: '$ ', allowNegative: true, thousands: ',', decimal: '.', affixesStay: false});
    $.ajax({
        url: "/category/categories",
        type: "GET",
        success: function (response) {
            $.each(JSON.parse(response), function (index, obj) {
                $('#category')
                    .append($("<option></option>")
                        .attr("value", obj.id)
                        .text(obj.name));
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert.danger(_alert_container, "Unexpected error occurred when fetching categories : Error Code - " +
                jqXHR.status);
        }
    });

    $('#description').keyup(function (e) {
        if (this.value.length == maxLength) {
            e.preventDefault();
        } else if (this.value.length > maxLength) {
            // Maximum exceeded
            this.value = this.value.substring(0, maxLength);
        }
        $("#charCount").html(this.value.length);
    });

    $("#images").on("change", function () {
        $("#image-container").empty();
        if ($(this)[0].files.length > 5) {
            $(this).val('');
            alert.danger(_alert_container, "You can select only 5 images");
        } else {

            $.each($(this)[0].files, function (index, img) {
                $("#image-container").append('<img class="loaded-img" id="img' + index + '" width="100px" height="100px">');
                var reader = new FileReader();

                var imgtag = $("#img" + index);
                imgtag.title = img.name;

                reader.onload = function (event) {
                    imgtag.attr('src', event.target.result);
                };

                reader.readAsDataURL(img);
            });
        }
    });

    $("#browse-images").on("click", function () {
        $("#images").click();
    });

});

