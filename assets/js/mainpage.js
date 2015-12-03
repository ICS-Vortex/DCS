$(document).ready(function(){
    $('#enter_button').on('click', function(){
        var email = $('#email').val();
        var pattern = /[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z]{2,6}){1,4}/;
        var check_email = pattern.test(email);
        if(!check_email){
            $('#check_email').html('<p style="color:red">Не верный формат <b>email</b>-а.</p>');
        }
    });
});