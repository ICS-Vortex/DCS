<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Статистика пилота <?=$pilot['nickname'];?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="/AdminLTE-master/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  

    <link href="/AdminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/stat.css" rel="stylesheet" type="text/css" />
    <script src="/AdminLTE-master/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/AdminLTE-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>     
    <script src="/assets/js/stat.js"></script>   
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
    <div></div>
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
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-01-AirMedal.png" title="Текст"/>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-02-PurpleHeart.png" title="Текст" />
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-03-BronzeStar.png" title="Текст" />
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-04-AirmansMedal.png" title="Текст" />
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-05-DistinguishedFlyingCross.png" title="Текст" />
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <img src="<?=base_url();?>images/medals/Countries/USA/Awards/US-06-SilverStar.png" title="Текст" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12 pull-right">
                <h3>Общее количество очков - <b>0</b>.</h3>
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
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 pull-left">
                <h3>Уничтожил техники : </h3>
                <table  class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Тип наземной техники</th>
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
                            <?if (!empty($dogfights)){?>
                                <?if ($dogfights['counts_kills']==null){echo 0;}
                                else {echo $dogfights['counts_kills'];}}?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: red;"><b>Поражения (Сбит)</b></td>
                            <td>
                                 <?if (!empty($dogfights)){?>
                                <?if ($dogfights['counts_death_kills']==null){echo 0;}
                                else {echo $dogfights['counts_death_kills'];}}?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> 
            
        </div>
 
        
    </div>  
    </div><!-- ./wrapper -->
     <script src="/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->

     <!-- FastClick -->
     <script src='/AdminLTE-master/plugins/fastclick/fastclick.min.js'></script>

        <!-- AdminLTE for demo purposes -->
     <script src="/AdminLTE-master/dist/js/demo.js" type="text/javascript"></script>
        <!-- page script -->
  </body>
</html>
<!--
SELECT pilots_kills.pilot_id,
	pilots_kills.object,
        dcs_units.category,
        dcs_categories.title
FROM pilots_kills
LEFT JOIN dcs_units ON dcs_units.name=pilots_kills.object
JOIN dcs_categories ON dcs_categories.id=dcs_units.id
WHERE pilot_id=2
ORDER BY object ASC




SELECT pilots_kills.pilot_id,
 pilots_kills.object,
        dcs_units.category,
        dcs_units.id,
        dcs_categories.title
FROM pilots_kills
LEFT JOIN dcs_units ON dcs_units.name=pilots_kills.object
LEFT JOIN dcs_categories ON dcs_categories.id=dcs_units.id
WHERE pilots_kills.pilot_id=2
ORDER BY object ASC
-->
    