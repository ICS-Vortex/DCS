$(document).ready(function(){
    $('#nickname').keyup(function(){
        var nickname = $('#nickname').val();
        $.post('/registration/checking',{nickname:nickname},function(data){
            if(data==0){
                $('#not_found').show(200);
                //setTimeout(function(){$('#not_found').slideUp(200);},3000);
                $('#register_form').hide();
            }else{
                $('#not_found').hide();
                $('#response').html(data);
            }
        });
    });
});