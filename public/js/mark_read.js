function sendMarkRead(id = null) {
    return $.ajax("{{ route('notification.read') }}", {
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        }
    });
}

$(function() {
    $(".mark-as-read").click(function() {
        let request = sendMarkRead($(this).data('id'));

        request.done(() => {
            $(this).remove();
            window.location.href = $(this).attr('href');
        });
    })
});