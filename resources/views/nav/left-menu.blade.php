

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
            <li class=""><a href="/"><i class="fa fa-home"></i> <span>Главная</span></a></li>

            <li class=""><a href="/project-seo"><i class="fa fa-search"></i> <span>Проекты SEO</span></a></li>

                    <li class=""><a href="/pass-seo"><i class="fa fa-lock"></i> <span>Пароли SEO</span></a></li>
                    <li class=""><a href="/pass-dev"><i class="fa fa-lock"></i> <span>Пароли DEV</span></a></li>

            <li class=""><a href="/project-context"><i class="fa fa-file-text-o"></i> <span>Проекты контекст</span></a></li>

                    <li class=""><a href="/pass-context"><i class="fa fa-lock"></i> <span>Пароли контекст</span></a></li>

            <li class=""><a href="/personal"><i class="fa fa-child"></i> <span>Сотрудники</span></a></li>
            <li class=""><a href="/work-graffik"><i class="fa fa-area-chart"></i> <span>График работы</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
