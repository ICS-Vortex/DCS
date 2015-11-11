<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/regform/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/regform/css/style_auth.css"> <!-- Gem style -->
    <link rel="stylesheet" href="/regform/css/bootstrap.min.css"> <!-- Gem style -->
    <script src="/regform/js/jquery-1.11.3.min.js"></script> <!-- Gem jQuery -->
    <script src="/regform/js/bootstrap.min.js"></script>
	<script src="/regform/js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Відділ Освіти / Старий Самбір</title>
</head>
<body>
	<header role="banner">
		<div id="cd-logo"><a href="#"><img src="/regform/img/cd-logo.svg" alt="Logo"></a></div>
        
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#0" id="auth">Авторизація</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	</header>
	
	<div class="cd-intro">
		<h1>Відділ Освіти / Старий Самбір</h1>
		<!--<div class="cd-nugget-info">
			<a href="http://dbmast.ru/adaptivnye-modalnye-formy-vhoda-i-registracii">
				&larr; Статья &amp; Скачать
			</a>  
		</div>-->
	</div>

	<div class="cd-user-modal"> <!-- все формы на фоне затемнения-->
		<div class="cd-user-modal-container"> <!-- основной контейнер -->
			<ul class="cd-switcher">
				<li><a href="#0" id="enter">Вхід</a></li>
				<li><a href="#0" id="register">Реєстрація</a></li>
			</ul>

			<div id="cd-login"> <!-- форма входа -->
				<form class="cd-form" id="authorisation_form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signin_email" type="email" placeholder="E-mail">
						<span class="cd-error-message"></span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Пароль</label>
						<input class="full-width has-padding has-border" id="password" type="password"  placeholder="Пароль">
						<a href="#0" class="hide-password">Показати</a>
						<span class="cd-error-message" id="password-error-message">Здесь сообщение об ошибке!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" id="remember-me" checked>
						<label for="remember-me">Запам’ятати мене</label>
					</p>
                    <p id="server_answer">
                        <h2 style="color:red;display: none;" id="error_message">Ви ввели невірні дані!</h2>
                        <h2 style="color:red;display: none;" id="empty_message">Не залишайте пусті поля!</h2>
                        <h2 style="color:green;display: none;" id="good_message">Авторизація пройдена успішно!<br /> Переадресація...</h2>
                        <h2 style="color:red;display: none;" id="ban_message">Ваш IP адрес заблоковано. Перепочиньте:)</h2>
                    </p> 

					<p class="fieldset">
						<input class="full-width" id="authorize" type="submit" value="Увійти">
                    </p>
				</form>
                
                                <script>
                                    $(document).ready(function(){
                                    
                                    // Ajax login

                                        $('#authorize').click(function(){
                                            var params = $('#authorisation_form').serialize();
                                            console.log(params); // для дебага, дабы узнать что мы передаем все то, что нужно. Потом можно убрать.
                                            var email = $("#signin_email").val();
                                            var password = $("#password").val();
                                            if (email == '' || password =='')
                                            {
                                                $('#empty_message').show(500);
                                                setTimeout(function(){
                                                    $('#empty_message').hide(500);    
                                                },5000);
                                            }
                                            else{
                                                $.ajax({
                                                        type: 'post',
                                                        url: '<?=base_url();?>authorize/login',
                                                        data: 'email=' + email + '&password=' + password,
                                                        success: function(data){
                                                            if(data == 'denied') 
                                                            {
                                                                $('#error_message').show(300);
                                                                setTimeout(function(){
                                                                    
                                                                    $('#error_message').hide(500);    
                                                                },5000);                                                       
                                                            }
                                                            
                                                            else if(data=='banned')
                                                            {
                                                                $('#ban_message').show(300);
                                                                setTimeout(function(){
                                                                    
                                                                    $('#ban_message').hide(500);    
                                                                },5000);   
                                                            }
                                                            else if (data=='accepted')
                                                            {
                                                                $('#good_message').show(300);
                                                                setTimeout(function(){
                                                                    
                                                                    $('#good_message').hide(500);                                                                    
                                                                },3000);
                                                                setTimeout(function(){
                                                                    
                                                                    location = '<?=base_url();?>main';                                                                    
                                                                },3000);
                                                                
                                                                   
                                                            }
                                                            else alert(data);
                                                        }
                                                });
                                            }    
                                        });

                                    });
                                </script>
				
				<p class="cd-form-bottom-message"><a href="#0">Забули пароль?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- форма регистрации -->
				<form class="cd-form" id="register_form">
					<p class="fieldset">
						<label class="image-replace cd-username" for="signup-username">Имя пользователя</label>
						<input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Логін">

					</p>

					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
                        <h2 style="color:green;display: none;" id="email_correct">Email вірний.</h2>
                        <h2 style="color:red;display: none;" id="email_incorrect">Не вірний Email.</h2>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signup-password">Пароль</label>
						<input class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Пароль">
						<a href="#0" class="hide-password">Скрыть</a>
					</p>

					<!--<p class="fieldset">
						<input type="checkbox" id="accept-terms">
						<label for="accept-terms">Я согласен с <a href="#0">Условиями</a></label>
					</p>-->

					<p class="fieldset">
						<input class="full-width has-padding" type="button" id="register_button" value="Створити акаунт">
					</p>
                    <p id="server_answer">
                        <h2 style="color:green;display: none;" id="registered_message">Реєстрація пройшла успішно!</h2>
                        <h2 style="color:red;display: none;" id="empty_reg">Не залишайте пусті поля!</h2>
                        
                        
                        
                        <h2 style="color:red;display: none;" id="user_error_message">Користувач з даним іменем або(та) Email вже існує!</h2>
                        <h2 style="color:green;display: none;" id="ban_message">Ваша IP-адреса заблокована! Перепочиньте:)</h2>
                    </p>                              
				</form>
                 <script>
                                    $(document).ready(function(){

                                    // Ajax login
                                    $('#signup-email').blur(function(){
                                        var email = $("#signup-email").val();
                                       var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;                                               
                                                if(pattern.test(email)){
                                                        $('#email_correct').show();
                                                                setTimeout(function(){
                                                                    $('#email_correct').hide(500);    
                                                                },5000);   
                                                    } else {
                                                        $('#email_incorrect').show();
                                                                setTimeout(function(){
                                                                    $('#email_incorrect').hide(500);    
                                                                },5000);  
                                                    } 
                                    });
                                        
                                        $('#register_button').click(function(){
                                            
                                            var username = $('#signup-username').val();
                                            var email = $("#signup-email").val();
                                            var password = $("#signup-password").val();
                                            var params = $('#register_form').serialize();
                                            console.log(params); // для дебага, дабы узнать что мы передаем все то, что нужно. Потом можно убрать.
                                            if (email == '' || password =='' || username=='')
                                            {
                                                $('#empty_reg').show(500);
                                                setTimeout(function(){
                                                    $('#empty_reg').hide(500);    
                                                },5000);
                                            }
                                            else{
                                                $.ajax({
                                                        type: 'post',
                                                        url: '<?=base_url();?>registration/register',
                                                        data: 'username=' + username + '&email=' + email + '&password=' + password,
                                                        success: function(data){
                                                            if(data == 'registered') 
                                                            {
                                                                $('#registered_message').show(300);
                                                                setTimeout(function(){
                                                                    $('#registered_message').hide(500);    
                                                                },5000);                                                       
                                                            }
                                                            
                                                            else if(data=='error_user')
                                                            {
                                                                $('#user_error_message').show(300);
                                                                setTimeout(function(){
                                                                    $('#user_error_message').hide(500);    
                                                                },5000);   
                                                            }
                                                            else alert(data);
                                                        }
                                                      });
                                            }    
                                        });

                                    });
                                </script>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- форма восстановления пароля -->
				<p class="cd-form-message">Забыли пароль? Пожалуйста, введите адрес своей электронной почты. Вы получите ссылку, чтобы создать новый пароль.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Здесь сообщение об ошибке!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Восстановить пароль">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Вернуться к входу</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Закрыть</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->

<script src="/regform/js/main.js"></script> <!-- Gem jQuery -->
</body>
</html>