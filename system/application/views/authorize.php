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
												<li class="current_page_item"><a href="<?=base_url();?>">Авторизація</a></li>
												<li><a href="<?=base_url();?>registration">Реєстрація</a></li>
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
                                        <form id="auth_form" class="form-horizontal" role="form" onsubmit="return false;">
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                              <input type="email" class="form-control" id="signin_email" placeholder="Email">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                                            <div class="col-sm-10">
                                              <input type="password" class="form-control" id="password" placeholder="Пароль">
                                            </div>
                                          </div><br />
                                          <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <button type="submit" id="authorize"  class="btn btn-default">Увійти</button>
                                            </div>
                                          </div>
                                        </form><br />
                                        
                                        <div id="server_answer">
                                            <h2 style="color:red;display: none;" id="error_message">Ви ввели невірні дані!</h2>
                                            <h2 style="color:red;display: none;" id="empty_message">Не залишайте пусті поля!</h2>
                                            <h2 style="color:green;display: none;" id="good_message">Авторизація пройдена успішно!<br /> Переадресація...</h2>
                                            <h2 style="color:red;display: none;" id="ban_message">Ваш IP адрес заблоковано. Перепочиньте:)</h2>
                                            <img id="loading" style="display: none;" src="/images/loading.gif" width="180px" height="100px;" />
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
                                    
    // Ajax login
    
    $('#authorize').click(function(){
        $('#loading').show();
        var params = $('#authorisation_form').serialize();
        console.log(params); // для дебага, дабы узнать что мы передаем все то, что нужно. Потом можно убрать.
        var email = $("#signin_email").val();
        var password = $("#password").val();
        if (email == '' || password =='')
        {
            $('#loading').hide();
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
                    $('#loading').hide();
                    $('#error_message').show(300);
                    setTimeout(function(){                                                                                        
                        $('#error_message').hide(500);    
                    },5000);
                    $("#signin_email,#password").val('');                                                       
                }
                                                                            
                else if(data=='banned')
                {
                    $('#loading').hide();
                    $("#auth_form").hide(500);
                    $('#ban_message').show(300);                       
                }
                else if (data=='accepted')
                {   
                    $('#loading').hide();
                    $("#auth_form").hide(500);
                    $('#good_message').show(300);                                        
                    setTimeout(function(){                                                                                        
                        location = '<?=base_url();?>main';                                                                    
                    },5000);                                                                                                                                              
                }
                else alert(data);
                }
            });
        }    
    });/*************************Ajax login************************/

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