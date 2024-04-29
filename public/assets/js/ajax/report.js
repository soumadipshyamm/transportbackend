var baseUrl = APP_URL + "/";
// alert(baseUrl);
$(document).ready(function () {
    $("#searching").on("change", function () {
        let vehicle_id = $("select[name='vehicle']").val();
        let client_id = $("select[name='client']").val();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let fromDate = $("input[name='start_date']").val();
        let toDate = $("input[name='end_date']").val();
        let startTime = $("input[name='start_time']").val();
        let endTime = $("input[name='end_time']").val();

        $.ajax({
            type: "GET",
            url: baseUrl + "report/searching",
            data: {
                vehicle_id: vehicle_id,
                client_id: client_id,
                fromDate: fromDate,
                toDate: toDate,
                startTime: startTime,
                endTime: endTime,
            },
            success: function (response) {
                $("#reportDiv").html(response);
            },
        });
    });
});
