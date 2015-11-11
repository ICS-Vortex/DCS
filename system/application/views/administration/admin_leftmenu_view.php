
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/AdminLTE-master/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?=$login;?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">0</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>1</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> 1 - 1</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i>
                <span>2</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> 2 - 2</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa fa-th"></i>
                <span>3</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> 1</a></li>
              </ul>
            </li>
            <li class="header"> Статистика DCS</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Юниты DCS</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url();?>admin/units"><i class="fa fa-circle-o"></i> Категории</a></li>                
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>