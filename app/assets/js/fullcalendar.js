$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            right: 'prev,next',
        },
        events: "http://todolist.local/work",
        displayEventTime: false,
        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        // handle create function.
        select: function(start, end, allDay) {
            $("#select-status option:selected").prop("selected", false);
            $("#create-name").val("");
            var today = formatDate();
            var startDateSelect = $.fullCalendar.formatDate(start, "Y-MM-DD");
            var endDateSelect = $.fullCalendar.formatDate(end, "Y-MM-DD");
            if (today <= startDateSelect) {
                $('#createModal').modal('show');
                $("#createModal").off("click", "#created-work").on('click','#created-work', function(e) {
                    e.preventDefault();
                        $('#createModal').modal('hide');
                        let title = document.getElementById("create-name").value;
                        let status = document.getElementById("select-status").value;
                        if (title == null || title == "") {
                            displayMessage("Create your work fail !", "fail");
                        } else {
                            $.ajax({
                                url: 'http://todolist.local/work/create',
                                data: 'title=' + title + '&start=' + startDateSelect + '&end=' + endDateSelect + '&status=' + status,
                                type: "POST",
                                success: function(data) {
                                    $('#calendar').fullCalendar('refetchEvents');
                                    displayMessage("Added your work success !", "success");
                                }
                            });
                        }
                    });

                calendar.fullCalendar('unselect');
            }
        },
        editable: true,
        // event handle edit and delete function
        eventClick: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
            var today = formatDate();

            if (today <= start) {
                $('#update-name').val(event.title);
                $('#update-status').val(event.status);
                $('#start-date').val(start);
                $('#end-date').val(end);
                $('#updateModal').modal('show');

                // handle delete function
                $("#updateModal").off("click", "#delete-work").on('click','#delete-work', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "http://todolist.local/work/delete",
                        data: "&id=" + event.id,
                        success: function(response) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted success", "delete");
                        }
                    });
                    $('#updateModal').modal('hide');
                });

                // handle delete function
                $("#updateModal").off("click", "#edit-work").on('click','#edit-work', function(e) {
                    e.preventDefault();
                    let title = document.getElementById("update-name").value;
                    let startDate = document.getElementById("start-date").value;
                    let endDate = document.getElementById("end-date").value;
                    let status = document.getElementById("update-status").value;

                    if (endDate > startDate) {
                        $.ajax({
                            url: 'http://todolist.local/work/update',
                            data: 'title=' + title + '&start=' + startDate + '&end=' + endDate + '&id=' + event.id + '&status=' + status,
                            type: "POST",
                            success: function(response) {
                                $('#calendar').fullCalendar('refetchEvents');
                                displayMessage("Updated your work success !", "success");
                            }
                        });
                    } else {
                        displayMessage("Date Error !", "delete");
                    }

                    $('#updateModal').modal('hide');
                });
            }
        }
    });

    // show notification when have event
    function displayMessage(message, className) {
        $(".show-message").html("<div class='notification " + className +"'>" + message + "</div>");
        setInterval(function() {
            $(".notification").fadeOut();
        }, 3000);
    }

    // format date : yyyy-mm-dd
    function formatDate() {
        var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }
});
