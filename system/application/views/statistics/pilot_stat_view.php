<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Статистика пилота <?=$pilot['nickname'];?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/stat.css" rel="stylesheet" type="text/css" />
    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/js/stat.js"></script>
  </head>
  <body class="skin-blue sidebar-mini" style='background-image: url(<?=base_url();?>images/background.jpg);background-size:cover;'>
    <!--backgorund-->
    <style>
    body{
        background-image:url(http://burningskies-stats.16mb.com/images/background.jpg);
        background-position: left top;
        background-repeat: repeat;
    }
    </style>
        <div class="wrapper">
        <nav id="navbar" class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?=base_url();?>statistics/">Главная</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="" ><a href="http://digitalcombatsimulator.com" target="_blank"><b>DCS Site</b></a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Страница статистики пилота "<b style="color: black;"><?=$pilot['nickname'];?></b>"</h2>
                    </div>
                </div>
                <div class="row text-center medals">
                    <? if(isset($medals) && !empty($medals)):?>
                        <? foreach ($medals as $medal):?>
                            <? $file = base_url().'images/medals/Countries/awards/'.$medal['image_url']; ?>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <img src="<?=$file;?>"
                                     title="<?=$medal['name'];?>"/>
                            </div>
                        <? endforeach;?>
                    <? endif;?>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 pull-left">
                        <h3>
                            Общий налёт
                            <b>
                                <?
                                if ($total_hours['total'] == null) {
                                    echo "00:00:00";
                                } else {
                                    $time = $total_hours['total'];
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
                                }
                                ?>
                            </b>.
                        </h3>
                    </div>
                    <div class="col-md-4 col-sm-12 pull-right">
                        <h3>Общее количество очков <b><? echo $total_points;?></b>.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 pull-left">
                        <h3>Статистика вылетов.</h3>
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>События</th>
                                    <th>Абсолютное количество</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Взлёты</td>
                                    <td>
                                        <?
                                            //print_r($statistics);exit();
                                            if($statistics[0]['count_takeoffs']==null){echo 0;}
                                            else{echo $statistics[0]['count_takeoffs'];}
                                        ?>
                                    </td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Посадки</td>
                                    <td>
                                        <?
                                            if($statistics[0]['count_lands']==null){echo 0;}
                                            else{echo $statistics[0]['count_lands'];}
                                        ?>
                                    </td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Потери самолётов</td>
                                    <td>
                                        <?
                                            if($statistics[0]['count_crashes']==null){echo 0;}
                                            else{echo $statistics[0]['count_crashes'];}
                                        ?>
                                    </td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Катапультирования</td>
                                    <td>
                                        <?
                                            if($statistics[0]['count_eject']==null){echo 0;}
                                            else{echo $statistics[0]['count_eject'];}
                                        ?>
                                    </td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Смерти</td>
                                    <td>
                                        <?
                                            if($statistics[0]['count_death']==null){echo 0;}
                                            else{echo $statistics[0]['count_death'];}
                                        ?>
                                    </td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-sm-12 pull-right">
                        <h3>Разное</h3>
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Air wins/Aircraft lost (W/L) </th>
                                    <th>
                                        <?
                                            if(empty($statistics[0]['count_crashes'])){
                                                echo $dogfights['kills'];
                                            }else{
                                                $kl = $dogfights['kills'] / $statistics[0]['count_crashes'];
                                                $KL = round($kl, 2);
                                                echo $KL;
                                            }
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Текущий стрик
                                    </th>
                                    <th>
                                        <?
                                            echo $now_streak['now_streak'];
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        Наилучший стрик
                                    </th>
                                    <th>
                                        <?
                                            if(!empty($best_streak['streak'])){
                                                echo $best_streak['streak'];
                                            }else{
                                                echo $now_streak['now_streak'];
                                            }
                                        ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 pull-left">
                        <h3>Уничтожил техники : </h3>
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Тип техники</th>
                                    <th>Всего</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach($unit_types as $item):?>
                                <tr>
                                    <td>
                                        <?
                                            if($item['title']==null){echo "Вертолёты";}
                                            else{echo $item['title']; }
                                        ?>
                                    </td>
                                    <td><?=$item['count_kills'];?></td>
                                </tr>
                                <?endforeach;?>
                                <tr>
                                    <td><b>ВСЕГО</b></td>
                                    <td><b><?=$total_count['total_count'];?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-sm-12 pull-right">
                        <h3>Статистика воздушных побед</h3>
                        <table  class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="color: green;"><b>Победы (Сбил)</b></td>
                                    <td>
                                    <?
                                        if ($dogfights['kills']==null){
                                            echo 0;
                                        }else {
                                            echo $dogfights['kills'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: red;"><b>Поражения (Сбит)</b></td>
                                    <td>
                                         <? if(!empty($dogfights['death'])){
                                             echo $dogfights['death'];
                                         }else{
                                             echo 0;
                                         }
                                         ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
             <script src="/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
             <script src='/AdminLTE-master/plugins/fastclick/fastclick.min.js'></script>
             <script src="/AdminLTE-master/dist/js/demo.js" type="text/javascript"></script>
        </body>
</html>










    