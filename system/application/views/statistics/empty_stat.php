<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Сервер статистики | АВИАТОР СССР</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+Sans:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Nixie+One:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+SC:regular,italic,bold,bolditalic"/>
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"  media="screen"  />
    <link href="/assets/css/font-awesome.min" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/stat.css" rel="stylesheet" type="text/css" />
    <link href="/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/fancybox/jquery.fancybox.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/js/stat.js"></script>
</head>
<body class="skin-blue">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:25%;">
            <h1>Очистка БД</h1>
                <label for="password"><h3>Введите пароль</h3></label>
                <input type="password" class="form-control" id="pass" name="password" value="" /><br>
                <input type="button" id="clear_db" class="btn btn-danger" value="Очистить">
        </div>
    </div>
</div><!-- ./wrapper -->
<script>
    $(document).ready(function(){
        $('#clear_db').click(function(){
            var accept = confirm('Вы действительно желаете очистить базу данных сервера?');
            if(accept==true){
                var pass = $('#pass').val();
                if(pass == ''){
                    alert('Введите пароль!');
                }else{
                    $.post('/statistics/empty_db',{password:pass},function(data){
                        if(data==0){
                            alert('Не правильный пароль!');
                        }else{
                            $('#pass').val('');
                            alert('База данных очищена!');
                        }
                    });
                }

            }
        });
    });
</script>
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
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script src="/assets/jmosaicflow/jquery.mosaicflow.min.js"></script>
<script src="/assets/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery("a.fancyimage").fancybox();
    });
</script>









<script src="/assets/jmosaicflow/jquery.mosaicflow.min.js"></script>

<script type="text/javascript" src="/assets/fancybox/jquery.fancybox.pack.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function() {

      jQuery("a.fancyimage").fancybox();

    });

  </script>

</body>

</html>
















