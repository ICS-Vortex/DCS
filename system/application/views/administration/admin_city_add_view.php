      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Advanced Form Elements
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE -->

          <div class="row">
            <div class="col-md-12">
            <?if($result != ''){?>
            <div class="alert alert-success alert-dismissable" id="result_user_city">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>	<i class="icon fa fa-check"></i> Операцію успішно виконано</h4>
                <?=$result;?>
            </div>
            <?}?>
              <form method="post" action="<?=base_url();?>admin/get_cities">  
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Виберіть користувача</h3>
                </div>
                <div class="box-body">
                  <!-- Date mm/dd/yyyy -->
                  <div class="form-group">
                    <div class="input-group">
                      <select style="width: 200px;" class="form-control" id="users" name="user">
                          <option value=""></option>
                          <?foreach ($users as $item):?>                                                  
                          <option value="<?=$item['login'];?>"><?=$item['login'];?></option>
                          <?endforeach;?>                                                   
                      </select><br /><br />                     
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
            <div class="col-md-6">
              <!-- iCheck -->

            </div><!-- /.col (right) -->
          </div><!-- /.row -->
          <input type="submit" class="btn .btn-sm	btn-warning" value="Далі" />
          </form>
        </section><!-- /.content -->
         
      </div><!-- /.content-wrapper -->
      <script>
        $(document).ready(function(){
            
            setTimeout(function(){                                                                                        
                $('#result_user_city').slideUp(900);                                                                    
            },8000);
        })
      </script>