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
            <div class="col-md-6">
              <form method="post" action="<?=base_url();?>admin/add_user_cities">  
              <div class="box box-success">                
                <div class="box-header">
                  <h3 class="box-title">Виберіть користувача</h3>
                </div>
                <div class="box-body">
                  <!-- Date mm/dd/yyyy -->
                  
                  <div class="form-group">

                          <?foreach ($cities as $item): 
                          $name = $item['title'];
                            echo "<input type='hidden' name='names[]' value='".$name."'>";                                                           
                            if ($item['asset_bookkeeper']==$user)
                            {   
                                echo "<input type='hidden' name='old_checked[]' value='".$name."'>";
                                echo '<label><input type="checkbox" name="checked[]" class="flat-red" value="'.$name.'" checked/>'.$name.'</label><br />';
                            }
                            else 
                            {
                                echo '<label><input type="checkbox" name="checked[]" class="flat-red" value="'.$name.'" />'.$name.'</label><br />';
                            }
                          endforeach;                          
                          ?>  
                          <input type="hidden" name="user" value="<?=$user;?>" />                                               
                    

                  </div><!-- /.form group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
            <div class="col-md-6">
              <!-- iCheck -->

            </div><!-- /.col (right) -->
          </div><!-- /.row -->
          <input type="submit" class="btn .btn-sm	btn-warning" value="Прикріпити" />
          </form>
        </section><!-- /.content -->
         
      </div><!-- /.content-wrapper -->