$(document).on('submit', '#form-login', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("loginform", true);
    $.ajax({
        type: "POST",
        url: "php/function.php",
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
            if(res.message == "Login Successfully"){
                alertify.success(res.message);
            } else {
                alertify.error(res.message);
            }   
            var seconds = 1;  
            setInterval(function () {  
                seconds--;  
                if (seconds == 0) {  
                    window.location = "index.php";  
                }  
            }, 1000);  

            }else if(res.status == 500) {
                $('#errorMessage').addClass('d-none');
                alertify.set('notifier','position', 'top-right');
                alertify.error(res.message);
            }
            setTimeout('page_redirect()', 5000);  
            
        }
        
    });

});

