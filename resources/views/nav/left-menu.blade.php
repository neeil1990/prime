
<div class="left_menu_palv_settings">
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
            <li class="header">Панель навигации</li>
            <li class="menu3"><a href="/"><i class="fa fa-home"></i> <span>Главная</span></a></li>

            <li class="treeview nav_mouseover1">
                <a href="/project-seo">
                    <i class="fa fa-search"></i><span>Проекты SEO</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            <ul class="treeview-menu menu1">
                    <li class="menu4"><a href="/pass-seo"><i class="fa fa-lock"></i> Пароли SEO</a></li>
                    <li class="menu5"><a href="/pass-dev"><i class="fa fa-lock"></i> Пароли DEV</a></li>
            </ul>
            </li>

            <li class="treeview nav_mouseover2">
                <a href="/project-context">
                    <i class="fa fa-file-text-o"></i> <span>Проекты контекст</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            <ul class="treeview-menu menu2">
                    <li class="menu6"><a href="/pass-context"><i class="fa fa-lock"></i> <span>Пароли контекст</span></a></li>
            </ul>
            </li>

            <li class="menu9"><a href="/service-and-password"><i class="fa fa-qrcode"></i> <span>Сервисы & Пароли</span></a></li>
            <li class="menu7"><a href="/personal"><i class="fa fa-child"></i> <span>Сотрудники</span></a></li>
            @if($admin == 1)
            <li class="menu8"><a href="https://docs.google.com/spreadsheets/d/1_OPH74-bEFS50D9tlTjQi69rH__PzIw4JFdzQlXZd3Y/edit"><i class="fa fa-area-chart"></i> <span>График работы</span></a></li>
            @endif
        </ul>

    </section>

    <!-- /.sidebar -->
</aside>
</div>
