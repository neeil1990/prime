

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@if(!empty($users_now->name)){{$users_now->name}}@endif</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active"><a href="/"><i class="fa fa-circle-o"></i> Главная</a></li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Проекты контекст</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/pass-context"><i class="fa fa-circle-o"></i> Пароли контекст</a></li>
                </ul>
            </li>
            <li class="active"><a href="/personal"><i class="fa fa-circle-o"></i> Сотрудники</a></li>






        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
