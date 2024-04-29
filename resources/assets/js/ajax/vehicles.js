var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editVehicle", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getVehicle/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () {},
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

$(document).ready(function () {
    $("#download").click(function () {
        screenshot();
    });
});

function screenshot() {
    html2canvas(document.getElementById("generate-qr")).then(function (canvas) {
        downloadImage(canvas.toDataURL(), "UsersInformation.png");
    });
}

function downloadImage(uri, filename) {
    var link = document.createElement("a");
    if (typeof link.download !== "string") {
        window.open(uri);
    } else {
        link.href = uri;
        link.download = filename;
        accountForFirefox(clickLink, link);
    }
}

function clickLink(link) {
    link.click();
}

function accountForFirefox(click) {
    var link = arguments[1];
    document.body.appendChild(link);
    click(link);
    document.body.removeChild(link);
}

// $(document).on("click", ".qrgenerate", function () {
//     var uuid = $(this).data("uuid");
//     // alert(uuid);
//     $.ajax({
//         url: baseUrl + "ajax/getQrGenerateDetails/" + uuid,
//         datatype: "json",
//         type: "get",
//         beforeSend: function () {},
//     })
//         .done(function (response) {
//             console.log(response);
//             alert(response);
//             if (response.data.length != 0) {
//                 $.each(response.data, function (key, value) {
//                     // if (key == "vehicle_uuid") {
//                     //     $("#generateQRModal #vehicle")
//                     //         .val(value)
//                     //         .prop("selected", true);
//                     // }
//                     // if (key == "medium") {
//                     //     $("#generateQRModal #medium")
//                     //         .val(value)
//                     //         .prop("selected", true);
//                     // }
//                     // if (key == "display_picture") {
//                     //     $("#generateQRModal #display_picture").prop(
//                     //         "src",
//                     //         value
//                     //     );
//                     //     $(".display_picture").removeClass("d-none");
//                     // }
//                     $("#" + key).val(value);
//                 });
//                 // localStorage.setItem('add-url',$('#addVehicle form').prop('action'));
//                 $("#generateQRModal form").prop(
//                     "action",
//                     baseUrl + "vehicle/edit/" + uuid
//                 );
//                 $("#generateQRModal").modal("show");
//             } else {
//                 showToast("error", "vehicle", response.message);
//             }
//         })
//         .fail(function (jqXHR, ajaxOptions, thrownError) {
//             showToast("error", "vehicle", "Something Went Wrong");
//         });
// });
