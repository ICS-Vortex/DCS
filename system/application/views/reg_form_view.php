<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Сервер статистики | Burning Skies</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+Sans:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Nixie+One:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+SC:regular,italic,bold,bolditalic"/>
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/assets/css/font-awesome.min" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/stat.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/assets/js/registration.js"></script>

    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!--<script src="/assets/js/stat.js"></script>-->
</head>
<body class="skin-blue">
<div class="wrapper">
    <nav id="navbar" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Статистика сервера "<b>Burning Skies</b>"</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="<?=base_url();?>" target="_blank"><b>Главная</b></a></li>
                    <li class=""><a href="http://digitalcombatsimulator.com" target="_blank"><b>DCS Site</b></a></li>
                    <li class=""><a href="http://forums.eagle.ru/forumdisplay.php?f=54" target="_blank"><b>Русский ED форум</b></a></li>
                    <li class=""><a href="https://www.facebook.com/burningskieswwii/" target="_blank"><b>Facebook</b></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<div class="container">
    <div class="jumbotron">
        <h2 style="display: block;" class="text-center" >Регистрация</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="nickname" placeholder="Введите свой игровой никнейм"><br>
            <div class="alert alert-danger" role="alert" id="not_found" style="display: none;">Пользователь не найден </div>
        </div>
        <div class="form-group" id="response"></div>

    </div>
</div>


<script src="/assets/dist/js/app.min.js" type="text/javascript"></script>
<script src="/assets/dist/js/demo.js" type="text/javascript"></script>
</body>
</html>

