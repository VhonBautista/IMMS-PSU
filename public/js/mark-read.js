function markNotificationAsReadAndRedirect(element, markAsReadRoute) {
    $.ajax({
        url: markAsReadRoute,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        data: JSON.stringify({}),
        success: function(data) {
            if (data.success) {
                window.location.href = $(element).attr('href');
            }
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

function markAllNotificationsAsRead(markAllAsReadRoute) {
    $.ajax({
        url: markAllAsReadRoute,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        data: JSON.stringify({}),
        success: function(data) {
            if (data.success) {
                location.reload();
            }
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}