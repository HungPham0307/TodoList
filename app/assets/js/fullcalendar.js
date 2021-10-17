$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            right: 'prev,next',
        },
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
    });
});
