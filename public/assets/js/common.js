// JavaScript Document
'use strict';
var baseUrl = APP_URL + '/';
var flashstatus = $('span.flashstatus').text();
var flashmessage = $('span.flashmessage').text();
var pagetype = jQuery('input[name="pagetype"]').val();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function (e)
 {
    filterData();

    if (flashstatus == 'SUCCESS') {
        $.toast({
            heading: 'Success',
            text: flashmessage,
            loader: true,
            icon: 'success',
            position: TOAST_POSITION
        });
    }

    if (flashstatus == 'ERROR') {
        $.toast({
            heading: 'Error',
            text: flashmessage,
            loader: true,
            icon: 'error',
            position: TOAST_POSITION
        })
    }

    if (flashstatus == 'INFORMATION') {
        $.toast({
            heading: 'Information',
            text: flashmessage,
            loader: true,
            icon: 'info',
            position: TOAST_POSITION
        })
    }

    if (flashstatus == 'WARNING') {
        $.toast({
            heading: 'Warning',
            text: flashmessage,
            loader: true,
            icon: 'warning',
            position: TOAST_POSITION
        })
    }
    $(document).on('click', '.cancel-btn', function (e) {
        //    alert('Cancel');
        location.reload();
    });

    $(document).on("change", ".getPopulate", function () {
        var optHtml = '<option value="">Select a ' + $(this).data('message') + '</option>';
        if ($(this).val != '') {
            populateData($(this));
        } else {
            $('.' + $(this).data('location')).html('').html(optHtml);
        }
    });

    $(document).on('click', '.statusChange', function (e) {
        changeStatus($(this));
    });

    $(document).on('click', '.modal button.resetBtn', function (e) {
        if ($('form.formSubmit .password_section').length > 0) $('form.formSubmit .password_section').removeClass('d-none');
        if ($('form.formSubmit .cv_section label span').length > 0) $('form.formSubmit .cv_section label span').removeClass('d-none');
        $('form.formSubmit').trigger('reset');
        $('form.formSubmit').prop('action', $('form.formSubmit').data('url'));
        $('form.formSubmit #email').prop('disabled', false);
        $('.display_picture').addClass("d-none");
    });

    $(document).on('click', '.deleteData', function (e) {
        // console.log('here');
        deleteData($(this));
    });
    $('.customdatatable').on('click', '.changeStatus', function (e) {
        changeStatus($(this));
    });
    $('.customdatatable').on('click', '.deleteData', function (e) {
        deleteData($(this));
    });
    $('.deleteDocument').on('click', function (e) {
        var $this = $(this);
        var uuid = $this.data('uuid');
        var find = $this.data('table');
        Swal.fire({
            title: 'Are you sure you want to delete it?',
            text: 'You wont be able to revert this action!!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: baseUrl + 'ajax/deleteData',
                    data: { 'uuid': uuid, 'find': find },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'We are facing some technical issue now.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'We are facing some technical issue now. Please try again after some time',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    /* ,
                    complete: function(response){
                        location.reload();
                    } */
                });
            }
        });
    });

    $('.customdatatable').on('click', '.changeUserStatus,.changeUserBlock', function (e) {
        var $this = $(this);
        var uuid = $this.data('uuid');
        if ($this.hasClass('changeUserStatus')) {
            var value = {
                'is_active': $this.data('value')
            };
        } else {
            var value = {
                'is_blocked': $this.data('block')
            };
        }
        var find = $this.data('table');
        var message = $this.data('message') ?? 'test message';
        Swal.fire({
            title: 'Are you sure you want to ' + message + ' it?',
            text: 'The status will be changed to ' + message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + message + ' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "put",
                    url: baseUrl + 'ajax/updateStatus',
                    data: { 'uuid': uuid, 'find': find, 'value': value },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'We are facing some technical issue now.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'We are facing some technical issue now. Please try again after some time',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    /* ,
                    complete: function(response){
                        location.reload();
                    } */
                });
            }
        });
    });

});
//profile tab height adjust with footer
function calcProfileHeight() {
    setTimeout(() => {
        var leftbarHeight = $('.o-post-inner-lft').outerHeight();
        $('.profile-info-tab').css('min-height', leftbarHeight);
    }, 200);
}


$(window).on('resize', function () {
    calcProfileHeight();
});

function populateData(selector) {
    var optHtml = '';
    var populatelocation = selector.data('location');
    var selected = $('.' + populatelocation).data('auth') ?? '';
    var populatemessage = selector.data('message');
    var populateStr = selector.find('option:selected').data("populate");
    optHtml += (populateStr.length == 0) ? '<option value="" selected="selected" disabled >No ' + populatemessage + '</option>' : '<option value="">Select A ' + populatemessage + '</option>';
    for (var key in populateStr) {
        var select = (selected && selected == key) ? 'selected' : '';
        optHtml += '<option value="' + key + '" ' + select + '>' + populateStr[key] + '</option>';
    }
    $('#' + populatelocation).html('').html(optHtml);
}
function showToast(type, title, message) {
    $.toast({
        heading: title,
        text: message,
        loader: true,
        icon: type,
        position: 'bottom-right',
    });
}
function changeStatus(selector) {
    var $this = selector;
    var state = $this.prop('checked') == true ? 1 : 0;
    var uuid = $this.data('uuid');
    var is_active = state;
    var find = $this.data('table');
    var message = $this.data('message') ?? 'test message';
    Swal.fire({
        title: 'Are you sure you want to ' + message + ' it?',
        text: 'The status will be changed to ' + message,
        icon: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#1D9300',
        cancelButtonColor: '#F90F0F',
        confirmButtonText: 'Yes, ' + message + ' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "put",
                url: baseUrl + 'ajax/updateStatus',
                data: { 'uuid': uuid, 'find': find, 'is_active': is_active },
                cache: false,
                dataType: "json",
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $this.data('message', message == 'deactive' ? 'active' : 'deactive');
                        if ($this.parent().hasClass('inTable')) {
                            $this.parent().closest('tr.manage-enable').toggleClass('block-disable');
                            let divRight = $this.parent().parent().siblings().find('div.dot-right');
                            divRight.hasClass('pe-none') ? divRight.removeClass('pe-none') : divRight.addClass('pe-none');
                        } else {
                            $this.parent().closest('div.manage-data').toggleClass('block-disable');
                            let divRight = $this.parent().closest('div.dot-right');
                            divRight.hasClass('pe-none') ? divRight.removeClass('pe-none') : divRight.addClass('pe-none');
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'We are facing some technical issue now.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $this.prop('checked', !state);

                    }
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $this.prop('checked', !state);
                }
                /* ,
                complete: function(response){
                    location.reload();
                } */
            });
        } else {
            $this.prop('checked', !state);
        }

    });
}
function deleteData(selector) {
    var $this = selector;
    var uuid = $this.data('uuid');
    var find = $this.data('table');
    var message = $this.data('message') ?? 'test message';
    Swal.fire({
        title: 'Are you sure you want to delete it?',
        text: 'You wont be able to revert this action!!',
        icon: 'warning',
        width: '350px',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#1D9300',
        cancelButtonColor: '#F90F0F',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: baseUrl + 'ajax/deleteData',
                data: { 'uuid': uuid, 'find': find },
                cache: false,
                dataType: "json",
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'We are facing some technical issue now.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                /* ,
                complete: function(response){
                    location.reload();
                } */
            });
        }
    });
}


// $(document).ready(function () {
    if ($("#adminProfilePasswordUpdate").length > 0) {
        $("#adminProfilePasswordUpdate").validate({
            errorClass: "text-danger",
            errorElement: "span",
            rules: {
                old_password: {
                    required: true,
                    rangelength: [5, 20],
                },
            },
            messages: {
                old_password: {
                    required: "Please enter  your old password.",
                    rangelength:
                        "Please enter length of your old password must be between 5 and 20",
                },
            },
            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                // var editFormId=
                var data = new FormData($("#adminProfilePasswordUpdate")[0]);
                // alert(data);
                console.log(data);
                $.ajax({
                    url: baseUrl + "dashboard/password-update",
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        // console.log(data);
                        // alert(data);
                        // $(".control-sidebar").hide();
                        swal.fire(
                            "Updated Successfully",
                            data.message,
                            "success"
                        ).then(function () {
                            location.reload();
                        });
                    },
                    error: function (data) {
                        $(".control-sidebar").hide();
                        swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            error: data,
                        });
                    },
                });
            },
        });
    }
// });


function filterData(){
    var table = $(".userTable").DataTable({
        // scrollX: true,
        searching: true,
    });
}
