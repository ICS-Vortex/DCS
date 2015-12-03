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
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!--<script src="/assets/js/stat.js"></script>-->
</head>
<body class="skin-blue">
<div class="container">
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
                    <li class=""><a href="http://digitalcombatsimulator.com" target="_blank"><b>DCS Site</b></a></li>
                    <li class=""><a href="http://forums.eagle.ru/forumdisplay.php?f=54" target="_blank"><b>Русский ED форум</b></a></li>
                    <li class=""><a href="https://www.facebook.com/burningskieswwii/" target="_blank"><b>Facebook</b></a></li>


                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <p class="bg-info">Статус сервера : <?= $server_status; ?></p>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
            <div class="row text-center">
                <h4>"<b style="color: orange;">Наблюдатели</b>"</h4>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Ник</th>
                </tr>
                </thead>
                <tbody>
                <? if (!empty($spectators)){?>
                            <?foreach ($spectators as $item):?>
                                <tr>
                                    <td style="color: green;"><a id="" target="_blank" href="<?=base_url();?>statistics/show/<?=$item['id'];?>"><?=$item['nickname'];?></a></td>
                                </tr>
                            <?endforeach;?>
                        <?}else{?>
                            </tr><td>------</td></tr>
                         <?} ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="row text-center">
                <h4>"<b style="color: red;">Красные</b>"</h4>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Ник</th>
                    <th>ЛА</th>
                </tr>
                </thead>
                <tbody>
                <? if (!empty($red_team)) { ?>
                    <? foreach ($red_team as $item): ?>
                        <tr>
                            <td style="color: green;">
                                <a id="red_team" target="_blank" href="<?= base_url(); ?>statistics/show/<?= $item['id']; ?>"><?= $item['nickname']; ?></a>
                            </td>
                            <td><?= $item['plane']; ?></td>
                        </tr>
                    <? endforeach; ?>
                <? } else { ?>
                    <tr>
                        <td>------</td>
                        <td>------</td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-right">
            <div class="row text-center">
                <h4>"<b style="color: blue;">Синие</b>"</h4>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Ник</th>
                    <th>ЛА</th>
                </tr>
                </thead>
                <tbody>
                <? if (!empty($blue_team)) { ?>
                    <? foreach ($blue_team as $item): ?>
                        <tr>
                            <td style="color: green;">
                                <a id="blue_team" target="_blank" href="<?= base_url(); ?>statistics/show/<?= $item['id']; ?>"><?= $item['nickname']; ?></a>
                            </td>
                            <td><?= $item['plane']; ?></td>
                        </tr>
                    <? endforeach; ?>
                <? } else { ?>
                    <tr>
                        <td>------</td>
                        <td>------</td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            <h3>Статистика пилотов</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Позиция</th>
                    <th>Ник</th>
                    <th>Общий налёт</th>
                    <th>Уничтожил техники</th>
                    <th>Воздушных побед</th>
                    <th>Текущий стрик</th>
                    <th>W/L</th>
                    <th>Количество очков</th>
                </tr>
                </thead>
                <tbody>
                <? $counter = 1;?>
                <? if (!empty($flight_players)) { ?>
                    <? foreach ($flight_players as $players): ?>
                        <tr>
                            <td><?=$counter;?></td>
                            <td>
                                <a class="" id="nicks" style="color: blue;" href="<?= base_url(); ?>statistics/show/<?= $players['id']; ?>"><b><?= $players['nickname']; ?></b></a>
                            </td>
                            <td>
                                <? if ($players['total_flights'] == null) {
                                    echo "00:00:00";
                                } else {
                                    $time = $players['total_flights'];
                                    $sec = $time % 60;
                                    $time = floor($time / 60);
                                    $min = $time % 60;
                                    $time = floor($time / 60);
                                    if ($sec < 10) {
                                        $sec = "0" . $sec;
                                    }
                                    if ($min < 10) {
                                        $min = "0" . $min;
                                    }
                                    if ($time < 10) {
                                        $time = "0" . $time;
                                    }
                                    echo $time . ":" . $min . ":" . $sec;
                                } ?>
                            </td>
                            <td>
                                <?
                                if ($players['total_kills'] == null) {
                                    echo 0;
                                } else {
                                    echo $players['total_kills'];
                                }
                                ?>
                            </td>
                            <td>
                                <? if(empty($players['total_victims'])){echo 0;}
                                    else{echo $players['total_victims'];}
                                ?>
                            </td>
                            <td>
                                <?
                                    if(!empty($players['last_streak'])){
                                        echo $players['last_streak'];
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </td>
                            <td>
                                <?
                                    if(!empty($players['total_fail'])){
                                        if(!empty($players['total_victims'])){
                                            $kl = $players['total_victims']/$players['total_fail'];
                                            $KL = round($kl, 2);
                                            echo number_format($KL,2,',',' ');
                                        }else{
                                            echo number_format(0,2,',',' ');
                                        }
                                    }else{
                                        echo number_format($players['total_victims'],2,',',' ');
                                    }
                                ?>
                            </td>
                            <td>
                                <?
                                    if(!empty($players['points'])){
                                        echo $players['points'];
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </td>
                        </tr>
                        <?$counter++;?>
                    <? endforeach; ?>
                <? } else { ?>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- ./wrapper -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='/assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function () {
    $("#example2").DataTable();
    $("#example1").DataTable({
        "paging": true,
          "lengthChange": true,
          "searching": true,
          "bFilter":true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "order": [[ 7, "desc" ]],
          "pageLength" : 25,
    });
});
</script>
</body>
</html>

    