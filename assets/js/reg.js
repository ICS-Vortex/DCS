$(document).ready(function(){
    //alert(1);
    $('#reg').click(function(event){
        var check_conditions = $('#check_conditions').prop("checked");
        if(!check_conditions){
            alert('Вы не подтвердили соглашение');
            event.preventDefault();
        }
    });
});