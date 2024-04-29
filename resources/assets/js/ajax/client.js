var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).on("click", ".editClient", function () {
    var uuid = $(this).data("uuid");
    // alert(uuid);
    $.ajax({
        url: baseUrl + "ajax/getClient/" + uuid,
        datatype: "json",
        type: "get",
        beforeSend: function () { },
    })
        .done(function (response) {
            if (response.data.length != 0) {
                $.each(response.data, function (key, value) {
                    if (key == "client_uuid") {
                        $("#addClient #client")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "medium") {
                        $("#addClient #medium")
                            .val(value)
                            .prop("selected", true);
                    }
                    if (key == "display_picture") {
                        $("#addClient #display_picture").prop("src", value);
                        $(".display_picture").removeClass("d-none");
                    }
                    $("#" + key).val(value);
                });
                // localStorage.setItem('add-url',$('#addClient form').prop('action'));
                $("#addClient form").prop(
                    "action",
                    baseUrl + "client/edit/" + uuid
                );
                $("#addClient").modal("show");
            } else {
                showToast("error", "Client", response.message);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            showToast("error", "Client", "Something Went Wrong");
        });
});

// Event delegation for adding a location
$(".modal-content").on("click", ".add_loc", function () {
    var timingSec = $(this).closest(".timing_sec");
    var length = timingSec.find(".timing_row").length;

    var newLocation = `
        <div class="col-md-8 my-2 timing_row">
            <div class="form-group">
                <label for="location">Enter Location</label>
                <input type="text" class="form-control" placeholder="Enter Location" name="location[${length}][name]">
            </div>
            <div class="col-md-8 my-2 ml-3 sub_loc">
                <div class="form-group break_flex">
                    <label for="sub_location">Enter Sub-location</label>
                    <input type="text" class="form-control" placeholder="Enter Sub-location" name="location[${length}][sub_locations][${length}]">
                    <a href="#" class="add_sub_loc">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <a href="#" class="add_loc" data-length="${length}">
                <i class="fa fa-plus"></i>
            </a>
            <div class="col-md-1">
                <a href="#" class="remove-input-field"> <i class="fa fa-trash"></i></a>
            </div>
        </div>`;

    timingSec.append(newLocation);
});

// Event delegation for adding a sub-location
$(".modal-content").on("click", ".add_sub_loc", function () {
    var subLoc = $(this).closest(".sub_loc");
    var length = $('.timing_sec').find(".timing_row").length;
    var breakLength = subLoc.find(".break_flex").length;

    var newSubLocation = `
        <div class="form-group break_flex">
            <label for="sub_location">Enter Sub-location</label>
            <input type="text" class="form-control" placeholder="Enter Sub-location" name="location[${length}][sub_locations][${breakLength}]">
            <a href="#" class="remove-break"> <i class="fa fa-trash"></i></a>
        </div>`;

    subLoc.append(newSubLocation);
});

// Remove location entry
$(".modal-content").on("click", ".remove-input-field", function () {
    $(this).closest(".timing_row").remove();
});

// Remove sub-location entry
$(".modal-content").on("click", ".remove-break", function () {
    $(this).closest(".break_flex").remove();
});

// /// Event delegation for adding a location
// $(".modal-content").on("click", ".add_loc", function () {
//     var timingRow = $(this).closest('.timing_sec').find('.timing_row:last');
//     var clone = timingRow.clone();
//     clone.find('input').val('');
//     clone.appendTo('.timing_sec');
// });

// // Event delegation for adding a sub-location
// $(".modal-content").on("click", ".add_sub_loc", function () {
//     var subLoc = $(this).closest(".sub_loc");
//     var clone = subLoc.find('.break_flex:last').clone();
//     clone.find('input').val('');
//     clone.appendTo(subLoc);
// });

// // Remove location entry
// $(".modal-content").on("click", ".remove-input-field", function () {
//     $(this).closest(".timing_row").remove();
// });

// // Remove sub-location entry
// $(".modal-content").on("click", ".remove-break", function () {
//     $(this).closest(".break_flex").remove();
// });
