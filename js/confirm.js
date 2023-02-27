$(document).on('click', '.confirmthis', function (e) {
    e.preventDefault();
    var request_id = $(this).val();

    if(confirm('Are you sure you want Approve this Request?'))
    {
        $.ajax({
            type: "POST",
            url: "php/function.php",
            data: {
                'approve_request': true,
                'request_id': request_id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    };
});


$(document).on('click', '.dropthis', function (e) {
    e.preventDefault();
    var request_id = $(this).val();

    if(confirm('Are you sure you want to drop this Request?'))
    {
        $.ajax({
            type: "POST",
            url: "php/function.php",
            data: {
                'drop_request': true,
                'request_id': request_id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    };
});

