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
        select: function(start, end, allDay) {
            var today = formatDate();
            var startDateSelect = $.fullCalendar.formatDate(start, "Y-MM-DD");
            var endDateSelect = $.fullCalendar.formatDate(end, "Y-MM-DD");
            if (today <= startDateSelect) {
                $('#createModal').modal('show');
                $("#created-work").click(function(){
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
                                    displayMessage("Added your work success !", "success");
                                }
                            });
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    });

                calendar.fullCalendar('unselect');
            }
        },
        editable: true,
        eventClick: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            $('#update-name').val(event.title);
            $('#update-status').val(event.status);
            $('#start-date').val(start);
            $('#end-date').val(end);
            $('#updateModal').modal('show');
            $("#delete-work").click(function(){
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

            $("#edit-work").click(function(){
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
    });

    function displayMessage(message, className) {
        $(".show-message").html("<div class='notification " + className +"'>" + message + "</div>");
        setInterval(function() {
            $(".notification").fadeOut();
        }, 2000);
    }

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
