$(document).on('submit', '#barangayform', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("add_brgy", true);
    $.ajax({
        type: "POST",
        url: "php/addbrgy.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
                                                        
        var res = jQuery.parseJSON(response);
        if(res.status == 422) {
            $('#errorMessage').removeClass('d-none');
            $('#errorMessage').text(res.message);
        }else if(res.status == 200){

            $('#errorMessage').addClass('d-none');

            alertify.set('notifier','position', 'top-right');
            alertify.success(res.message);

            $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });
});

$(document).on('click', '.dropthisbrgy', function (e) {
    e.preventDefault();
    var request_id = $(this).val();

    if(confirm('Are you sure you want to delete this Barangay?'))
    {
        $.ajax({
            type: "POST",
            url: "php/addbrgy.php",
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