var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editSupervisor", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getSupervisor/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
    }).done(function (response) {
        if (response.data.length != 0) {
            $.each(response.data, function (key, value) {
                if (key == "supervisor_uuid") {
                    $("#addSupervisor #supervisor").val(value).prop("selected", true);
                }
                if (key == "medium") {
                    $("#addSupervisor #medium").val(value).prop("selected", true);
                }
                if (key == "display_picture") {
                    $("#addSupervisor #display_picture").prop("src", value);
                    $(".display_picture").removeClass("d-none");
                }
                $("#" + key).val(value);
            });
            // localStorage.setItem('add-url',$('#addsupervisor form').prop('action'));
            $("#addSupervisor form").prop(
                "action",
                baseUrl + "supervisor/edit/" + uuid
            );
            $("#addSupervisor").modal("show");
        } else {
            showToast("error", "supervisor", response.message);
        }
    });
    // .fail(function (jqXHR, ajaxOptions, thrownError) {
    //     showToast("error", "supervisor", "Something Went Wrong");
    // });
});
