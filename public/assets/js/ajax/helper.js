var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editHelper", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getHelper/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () { },
    })
        .done(function (response) {
            if (response.data.length != 0) {
                $.each(response.data, function (key, value) {
                    if (key == "helper_uuid") {
                        $("#addHelper #helper")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "medium") {
                        $("#addHelper #medium")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "display_picture") {
                        $("#addHelper #display_picture").prop("src", value);
                        $(".display_picture").removeClass("d-none");
                    }
                    $("#" + key).val(value);
                });
                // localStorage.setItem('add-url',$('#addHelper form').prop('action'));
                $("#addHelper form").prop(
                    "action",
                    baseUrl + "helper/edit/" + uuid
                );
                $("#addHelper").modal("show");
            } else {
                showToast("error", "Helper", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "Helper", "Something Went Wrong");
        });
});

