var baseUrl = APP_URL + "/";

$(document).on("click", ".editVendor", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getVendor/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
    }).done(function (response) {
            console.log(response);
            // alert(response);
            if (response.data.length != 0) {
                $.each(response.data, function (key, value) {
                    if (key == "vendor_uuid") {
                        $("#addVendor #vendor")
                            .val(value)
                            // .prop("selected", true);
                    }
                    if (key == "medium") {
                        $("#addVendor #medium")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "display_picture") {
                        $("#addVendor #display_picture").prop("src", value);
                        $(".display_picture").removeClass("d-none");
                    }
                    $("#" + key).val(value);
                });
                // localStorage.setItem('add-url',$('#addVendor form').prop('action'));
                $("#addVendor form").prop(
                    "action",
                    baseUrl + "vendor/edit/" + uuid
                );
                $("#addVendor").modal("show");
            } else {
                showToast("error", "Vendor", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "Vendor", "Something Went Wrong");
        });
});
