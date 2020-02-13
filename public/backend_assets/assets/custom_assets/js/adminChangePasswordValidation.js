$(document).ready(function() {

    $('#new_pwd').focus(function() {
        var current_pwd = $('#current_pwd').val();
        //alert(current_pwd);
        $.ajax({
            type: 'get',
            url: '/admin/check_password',
            data: { current_pwd: current_pwd },
            success: function(resp) {
                // alert(resp);
                if (resp == 'false') {
                    $("#chkPwd").html("<font color=red>Current Password is not correct.</font>");
                } else if (resp == 'true') {
                    $("#chkPwd").html("<font color=green>Current Password is correct.</font>");
                }
            },
            error: function() {
                alert('error!!!');
            }
        });
    });

    $("#password_validate").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 8,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 8,
                maxlength: 20
            },
            confirm_pwd: {
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.input-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.input-group').removeClass('error');
            $(element).parents('.input-group').addClass('success');
        }
    });

});