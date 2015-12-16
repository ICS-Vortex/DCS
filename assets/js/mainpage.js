$(document).ready(function(){
    //$('.error').hide();

    $('#enter_button').on('click', function(){
        var email = $('#email').val();
        var pattern = /[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z]{2,6}){1,4}/;
        var check_email = pattern.test(email);
        var password = $('#password').val();
        console.log(check_email);
        if(check_email == true){
            $('#check_email').html('<p style="color:green"><b>Ok</b>-а.</p>');

        }else{
            $('#check_email').html('<p style="color:red">Не верный формат <b>email</b>-а.</p>');
            if(password == ''){
                $('.error').html('<h3 style="color:red;"><b>Заполните все поля.</b></h3>');
            }else{
                alert(1);
            }

        }
    });
});