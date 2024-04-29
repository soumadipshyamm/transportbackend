var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editClientAlloction", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getClientAlloction/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
    }).done(function (response) {
            console.log(response.data.id);
            let temArr = [];
            if (response.data.length != 0) {
                $('#client_'+response.data.id).prop("selected", true);
                for ( var i = 0; i < response.data.clients_alloction.length;i++) {
                    if (response.data.clients_alloction[i].uuid == "uuid") {
                        $("#addClientAlloction #clientAlloction")
                            .val(value)
                            .prop("selected", true);
                    }
                    temArr.push(response.data.clients_alloction[i].id);
                }
                // console.log(temArr);
                $('#multiselect').val(temArr);
                $('#multiselect').multiselect('refresh');

                // localStorage.setItem('add-url',$('#addClientAlloction form').prop('action'));
                $("#addClientAlloction form").prop(
                    "action",
                    baseUrl + "client/edit-alloction/" + uuid
                );
                $("#addClientAlloction").modal("show");
            } else {
                showToast("error", "Client Alloction", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "Client Alloction", "Something Went Wrong");
        });
});
