<!DOCTYPE HTML>
<!--
	ZeroFour by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Відділ Освіти | Бухгалтерія</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />    

	</head>
	<body class="homepage">
 
        <div id="page-wrapper">
        <!-- Header -->
				<div id="header-wrapper">
					<div class="container">

						<!-- Header -->
							<header id="header">
								<div class="inner">

									<!-- Logo -->
										<h1><a href="<?=base_url();?>" id="logo">Відділ Освіти</a></h1>

									<!-- Nav -->
										<nav id="nav">
											<ul>
												<li><a href="<?=base_url();?>">Авторизація</a></li>
												<li class="current_page_item"><a href="<?=base_url();?>registration">Реєстрація</a></li>
												<li><a href="#">Забули пароль?</a></li>
											</ul>
										</nav>

								</div>
							</header>

						<!-- Banner -->
							<!--<div id="banner">
								<h2>Статистика споживання електроенергії
								<br />	
								<a href="#" class="button big icon fa-check-circle">Yes it does</a>
							</div>-->

					</div>
				</div>
                			<!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style1">


							<!-- Feature 1 -->
								<section class="container box feature1">
									<div class="container">
                                    <div class="col-sm-9">
                                        <form id="reg_form" class="form-horizontal" role="form" onsubmit="return false;">
                                              <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Логін</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="signup-username" placeholder="Логін">
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Прізвище, ім’я, по батькові</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="signup-full-name" placeholder="П.І.Б">
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control" id="signup-email" placeholder="Email"><br />
                                                        <h2 style="color:green;display: none;" id="email_correct">Email вірний.</h2>
                                                        <h2 style="color:red;display: none;" id="email_incorrect">Не вірний Email.</h2>
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                                                    <div class="col-sm-10">
                                                      <input type="password" class="form-control" id="password" placeholder="Пароль">
                                                    </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-2 control-label">Повторіть пароль</label>
                                                    <div class="col-sm-10">
                                                      <input type="password" class="form-control" id="repeat_password" placeholder="Пароль">
                                                    </div>
                                              </div><br />
                                              <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" id="register_button" class="btn btn-default">Реєстрація</button>
                                                    </div>
                                              </div>                                             
                                        </form> <br /> 
                                        <div id="server_answer">                                                
                                                <h3 style="color:green;display: none;" id="registered_message">Реєстрація пройшла успішно!<br /> Переадресація...</h3>
                                                <img id="loading" style="display: none;" src="/images/loading.gif" width="180px" height="100px;" />
                                                <h3 style="color:red;display: none;" id="fail_passwords_message">Паролі не співпадають</h3>
                                                <h3 style="color:red;display: none;" id="empty_reg">Не залишайте пусті поля!</h3>                   
                                                <h3 style="color:red;display: none;" id="user_error_message">Користувач з даним іменем або(та) Email вже існує!</h3>
                                                <h3 style="color:green;display: none;" id="ban_message">Ваша IP-адреса заблокована! Перепочиньте:)</h3>
                                        </div>                                      
                                      </div>
									</div>
                            <div id="rem_answer"></div><!-----ТАБЛИЦЯ------>                        

                        </section>
					</div>
			</div><!-- Wrapper -->
            <!-- Footer Wrapper -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="12u">
								<div id="copyright">
									<ul class="menu">
										<li> Відділ Освіти &copy; Всі права захищені.</li><li>Дизайн: <a target="_blank" href="https://vk.com/wing_man">Vortex</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

		</div>
<script>
$(document).ready(function(){
    // Ajax register
    $('#signup-email').blur(function(){
    var email = $("#signup-email").val();
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;                                               
    if(!pattern.test(email))
    {
        $('#email_incorrect').show();
        setTimeout(function(){
            $('#email_incorrect').hide(500);    
        },5000);  
    } 
    });
                                            
    $('#register_button').click(function(){  /********************Registration click******************/                                              
        var username = $('#signup-username').val();
        var email = $("#signup-email").val();
        var password = $("#password").val();
        var repeat_password = $('#repeat_password').val();
        var name = $('#signup-full-name').val();
        var params = $('#register_form').serialize();
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        console.log(params); // для дебага, дабы узнать что мы передаем все то, что нужно. Потом можно убрать.
        if (email == '' || password =='' || username=='' || name =='')
        {
            $('#empty_reg').show(500);
            setTimeout(function(){
                $('#empty_reg').hide(500);    
            },3000);
        }
        else if(!pattern.test(email))
        {
            $('#email_correct').show();
            setTimeout(function(){
                $('#email_correct').hide(500);    
            },3000);   
        }
        else if(password != repeat_password)
        {   
            alert(password + " " + repeat_password);
            $('#fail_passwords_message').show();
            setTimeout(function(){
                $('#fail_passwords_message').hide(500);    
            },3000);   
        }
        else{
            $.ajax({
                type: 'post',
                url: '<?=base_url();?>registration/register',
                data: 'username=' + username + '&email=' + email + '&password=' + password + '&name=' + name,
                success: function(data){
                    if(data == 'registered') 
                    {
                        $('#reg_form').slideUp(300);
                        $('#registered_message').show(300);
                        $('#loading').show();
                        setTimeout(function(){
                            window.location = '<?=base_url();?>';    
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

		<!-- Scripts -->
        
        <script src="/assets/js/bootstrap.min.js"></script>
         
		<script src="/assets/js/jquery.dropotron.min.js"></script>
		<script src="/assets/js/skel.min.js"></script>
		<script src="/assets/js/skel-viewport.min.js"></script>
		<script src="/assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="/assets/js/main.js"></script>
			

	</body>
</html>