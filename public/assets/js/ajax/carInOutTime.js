var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editCarInOutTime", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getCarInOutTime/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
    }).done(function (response) {
        if (response.data.length != 0) {
            $.each(response.data, function (key, value) {
                if (key == "carInOutTime_uuid") {
                    $("#addCarInOutTime #carInOutTime").val(value).prop("selected", true);
                }
                if (key == "medium") {
                    $("#addCarInOutTime #medium").val(value).prop("selected", true);
                }
                if (key == "display_picture") {
                    $("#addCarInOutTime #display_picture").prop("src", value);
                    $(".display_picture").removeClass("d-none");
                }
                $("#" + key).val(value);
            });
            // localStorage.setItem('add-url',$('#addCarInOutTime form').prop('action'));
            $("#addCarInOutTime form").prop(
                "action",
                baseUrl + "carTime/edit/" + uuid
            );
            $("#addCarInOutTime").modal("show");
        } else {
            showToast("error", "carInOutTime", response.message);
        }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
        showToast("error", "carInOutTime", "Something Went Wrong");
    });
});
