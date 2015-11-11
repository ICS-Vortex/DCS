<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="/AdminLTE-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/AdminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/AdminLTE-master/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url();?>" target="_blank"><b>CMS сайта </b><br>Flight School</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Введите данные для начала сессии</p>
        <form action="../../index2.html" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
          
            <div class="col-xs-8">    
                    <a href="#">Забыли пароль?</a><br>
                    <a href="#" class="text-center">Регистрация</a>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="button" id="authorize" class="btn btn-primary btn-block btn-flat">Войти</button>
            </div><!-- /.col -->
          </div>
        </form>

                <div id="server_answer">
                  <h4 style="color:red;display: none;" id="error_message">Некорректные данные!</h4>
                  <h4 style="color:red;display: none;" id="empty_message">Не оставляйте пустые поля!</h4>
                  <h4 style="color:green;display: none;" id="good_message">Авторизация выполнена успешно!<br /> Переадресация...</h4>
                  <h4 style="color:red;display: none;" id="ban_message">Ваш IP адрес заблокирован. Отдохните:)</h4>
                  <img id="loading" style="display: none;" src="/images/loading.gif" width="180px" height="100px;" />
                </div>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/AdminLTE-master/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/AdminLTE-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/AdminLTE-master/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
        <script>    
        $(document).ready(function(){
                                    
    // Ajax login
    
    $('#authorize').click(function(){
        var email = $("#email").val();
        var password = $("#password").val();
        if (email == '' || password =='')
        {
            $('#empty_message').show(500);
            setTimeout(function(){
                $('#empty_message').hide(500);    
            },5000);
        }
        else{
            $('#loading').show();
            $.ajax({
                type: 'post',
                url: '<?=base_url();?>admin/login',
                data: 'email=' + email + '&password=' + password,
                success: function(data){
                    $('#loading').hide();
                if(data == 'denied') 
                {
                    $('#error_message').show(300);
                    setTimeout(function(){                                                                                        
                        $('#error_message').hide(500);    
                    },5000);
                    $("#email,#password").val('');                                                       
                }
                                                                            
                else if(data=='banned')
                {
                    $("#auth_form").hide(500);
                    $('#ban_message').show(300);                       
                }
                else if (data=='accepted')
                {
                    $("#auth_form").hide(500);
                    $('#good_message').show(300);
                                        
                    setTimeout(function(){                                                                                        
                        location = '<?=base_url();?>admin/main';                                                                    
                    },2000);                                                                                                                                              
                }
                else alert(data);
                }
            });
        }    
    });

});

</script>
  </body>
</html>
