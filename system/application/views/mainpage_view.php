<div class="wrapper style1">
    <div class="inner">
        <!-- Feature 1 -->
        <section class="container box feature1">
            <div class="row">
                <div class="12u">
                    <header class="first major">
                        <h2>Споживання електроенергії по школах за період</h2>
                    </header>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Никнейм</th>
                            <th>Новий пароль</th>
                            <th>e-mail</th>
                            <th>П.І.Б</th>
                            <th>Перевірений</th>
                            <th>Адміністратор</th>
                            <th>Видалити</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Логін</th>
                            <th>Новий пароль</th>
                            <th>e-mail</th>
                            <th>П.І.Б</th>
                            <th>Перевірений</th>
                            <th>Адміністратор</th>
                            <th>Видалити</th>
                          </tr>
                        </tfoot>
                  </table>
                  </script>           
        <script src="/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="/AdminLTE-master/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

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
              "autoWidth": true
            });
          });
        </script>            
                </div>
            </div>
        </section>                    
    </div>        
</div>

