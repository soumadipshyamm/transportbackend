var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editVehicle", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getVehicle/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () { },
    })
        .done(function (response) {
            if (response.data.length != 0) {
                $.each(response.data, function (key, value) {
                    if (key == "vehicle_uuid") {
                        $("#addVehicle #vehicle")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "medium") {
                        $("#addVehicle #medium")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "display_picture") {
                        $("#addVehicle #display_picture").prop("src", value);
                        $(".display_picture").removeClass("d-none");
                    }
                    $("#" + key).val(value);
                });
                // localStorage.setItem('add-url',$('#addVehicle form').prop('action'));
                $("#addVehicle form").prop(
                    "action",
                    baseUrl + "vehicle/edit/" + uuid
                );
                $("#addVehicle").modal("show");
            } else {
                showToast("error", "vehicle", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "vehicle", "Something Went Wrong");
        });
});
