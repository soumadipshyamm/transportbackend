var baseUrl = APP_URL + "/";

$(document).on("click", ".editExpense", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getExpenses/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
    }).done(function (response) {
            if (response.data.length != 0) {
                $.each(response.data, function (key, value) {
                    if (key == "expenses_uuid") {
                        $("#addExpense #expenses")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "medium") {
                        $("#addExpense #medium")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "display_picture") {
                        $("#addExpense #display_picture").prop("src", value);
                        $(".display_picture").removeClass("d-none");
                    }
                    $("#" + key).val(value);
                });
                // localStorage.setItem('add-url',$('#addExpense form').prop('action'));
                $("#addExpense form").prop(
                    "action",
                    baseUrl + "expense/edit/" + uuid
                );
                $("#addExpense").modal("show");
            } else {
                showToast("error", "expenses", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "expenses", "Something Went Wrong");
        });
});
