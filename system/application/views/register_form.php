<div id="register_form" >
    <div class="form-group" >
        <p> Введите email</p>
        <input type="text" class="form-control" id="email">
        <input type="hidden" id="pilot_id" name="pilot_id" value="<?=$pilot_id;?>" />
        <p><div id="check_email"></div></p>
    </div>
    <button class="btn btn-success" id="email_button">Отправить</button>
</div>
<div id="tickets_response"></div>
<script>
    $('#email').on('keyup change blur',function(){
        var email = $('#email').val();
        var pattern = /[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z]{2,6}){1,4}/;
        var check_email = pattern.test(email);
        if(check_email){
            $('#check_email').html('<p style="color:green"><b>email</b> корректный.</p>');
        }else{
            $('#check_email').html('<p style="color:red"><b>email</b> не корректный.</p>');
        }
    });

    $('#email_button').click(function(){
        var pilot_id = $('#pilot_id').val();
        var email = $('#email').val();
        $.post('/registration/make_ticket',{pilot_id:pilot_id,email:email},function(data){
            console.log(data);
            $('#register_form').hide(200);
            $('#find_form').hide(200);
            var ticket_response = $('#ticket_response');
            if(data == 0){
                $('#tickets_response').html('<div class="alert alert-danger alert-dismissible">ID никнейма не обнаружен в базе данных!</div>');
            }
            if(data == 1){
                $('#tickets_response').html('gg');
            }
        });
    });
</script>