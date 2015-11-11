

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Управління користувачами та доступом
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Список користувачів</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?if($result != '' && $result != 0){?>
                    <div class="alert alert-success alert-dismissable" id="success_import">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Операцію успішно виконано</h4>
                    </div>
                <?}else if ($result==0 && $result != ''){?>
                    <div class="alert alert-danger alert-dismissable" id="fail_import">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Сталася помилка...
                    </div>
            
                <?}?>
                <style>
                    tbody tr td,thead tr th,tfoot tr th{
                        text-align:center;
                        vertical-align: middle;
                    } 
                    tbody tr td input{
                        width:100%;
                        text-align: center;
                    }  
                    .delete_user_button{
                        opacity:0.5;
                    } 
                    .delete_user_button:hover{
                        cursor: pointer;
                        opacity: 1.0;
                    }
                </style>
                <form method="post" action="<?=base_url();?>admin/edit_units">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Имя</th>
                        <th>Категория</th>
                        <th>Страна</th>
                        <th>Тип</th>
                        
                      </tr>
                    </thead>
                    <tbody>                    
                      <?foreach ($units as $item):?>
                      <tr>                                                
                        <td><?=$item['name'];?></td> 
                        <td><input name="unit_category" value="<?=$item['category'];?>" /></td>
                        <td><?=$item['country'];?></td>
                        <td><?=$item['type_unit'];?></td>
                                            
                      </tr>
                      <?endforeach;?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Имя</th>
                        <th>Страна</th>
                        <th>Тип</th>
                        <th>Категория</th>
                      </tr>
                    </tfoot>
                  </table>
                  <input type="submit" class="btn .btn-sm	btn-warning" value="Змінити" />
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->          
        <script src="/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="/AdminLTE-master/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='/AdminLTE-master/plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="/AdminLTE-master/dist/js/app.min.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/AdminLTE-master/dist/js/demo.js" type="text/javascript"></script>
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
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            