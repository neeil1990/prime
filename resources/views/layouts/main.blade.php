<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/public/dist/img/user2-160x160.jpg" type="image/x-icon">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>@if(!empty($users_now->name)){{$users_now->name}}@endif</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/style.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <script src="{{ asset('/dist/js/jquery.form.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/dist/js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('/dist/js/jquery-zclip-master/jquery.zclip.js') }}"></script>


    <script src="{{ asset('/dist/js/hcsticky/jquery.hc-sticky.min.js') }}"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script>

        $(function(){

            $('.copytext').click(function(){
                $(this).select();
            });
        });
    </script>


</head>
<body class="hold-transition skin-blue sidebar-mini  @if(Auth::guest()) sidebar-collapse @endif">
<div id="dialog2" style="display: none" title="Настройка уведомлений">
    <form class="form-horizontal" action="/settings-notice-mail-update" method="post">
        {!! csrf_field() !!}
        <div class="box-body">

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="notice_email" value="@if(isset($notice->mail)){{$notice->mail}}@endif" placeholder="Поле не должно быть пустым">
                </div>
            </div>

            <div class="form-group">
                <div class="radio">
                    <label>
                        <input style="top: 0px;" type="radio" name="notice_enable_disable" @if(isset($notice->status) and $notice->status == 2) checked @endif value="2">
                        Отправлять копию
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input style="top: 0px;" type="radio" name="notice_enable_disable" @if(isset($notice->status) and $notice->status == 1) checked @endif value="1">
                        Включить режим отладки
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input style="top: 0px;" type="radio" name="notice_enable_disable" @if(isset($notice->status) and $notice->status == 0) checked @endif value="0">
                        Выключить режим отладки
                    </label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default btn-default-notice">Закрыть</button>
            <button type="submit" class="btn btn-info pull-right">Отправить</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
<div id="dialog" style="display: none" title="Корректировка остатка">
    <form class="form-horizontal" action="/update-ost-google-balanse-api" method="post">
        {!! csrf_field() !!}
        <div class="box-body">

            <div class="form-group">
                <label for="inputEmail3" style="width: 500px;" class="col-sm-3 control-label now_balanse"> </label>
                </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ost_bslsnse_go" placeholder="">
                    <input type="hidden" name="id_progect" class="id_progect_jq">
                    <input type="hidden" name="client_name_project" class="client_name_project">
                    <input type="hidden" name="client_email" class="client_email">
                </div>
            </div>

            <div class="form-group">
                <div class="radio">
                    <label>
                        <input style="top: 0px;" type="radio" name="plus_minus" id="optionsRadios1" checked value="+">
                        Плюс
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input style="top: 0px;" type="radio" name="plus_minus" id="optionsRadios2" value="-">
                        Минус
                    </label>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input style="top: 0px;" type="checkbox" name="send_client_mail" value="1"> Отправить клиенту
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default">Закрыть</button>
            <button type="submit" class="btn btn-info pull-right">Отправить</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>PRIME</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle one_click" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">@if(!empty($users_now->name)){{$users_now->name}}@endif</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    @if(!empty($users_now->name)){{$users_now->name}}
                                    <small>{{$users_now->specialism}}</small>@endif
                                </p>
                            </li>


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->


                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @if (!Auth::guest())
    @include('nav.left-menu')
            @endif
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if (!Auth::guest())
                <script>
                    $(function(){
                        var url = window.location.pathname;
                       if(url == '/'){
                           $('.title_dashboard').text('Главная');
                           $('.menu3').addClass('active');
                       }
                        if(url == '/pass-seo'){
                            $('.title_dashboard').text('Пароли SEO');
                            $('.menu4').addClass('active');
                            $('.menu1').addClass('menu-open');
                            $('.menu1').css('display','block');

                        }
                        if(url == '/pass-dev'){
                            $('.title_dashboard').text('Пароли Develop');
                            $('.menu5').addClass('active');
                            $('.menu1').addClass('menu-open');
                            $('.menu1').css('display','block');

                        }
                        if(url == '/pass-context'){
                            $('.title_dashboard').text('Пароли контекст');
                            $('.menu6').addClass('active');
                            $('.menu2').addClass('menu-open');
                            $('.menu2').css('display','block');

                        }
                        if(url == '/personal'){
                            $('.title_dashboard').text('Сотрудники');
                            $('.menu7').addClass('active');
                        }
                        if(url == '/work-graffik'){
                            $('.title_dashboard').text('График работы');
                            $('.menu8').addClass('active');
                        }
                        if(url == '/service-and-password'){
                            $('.title_dashboard').text('Сервисы & Пароли');
                            $('.menu9').addClass('active');
                        }
                        if(url == '/project-seo'){
                            $('.title_dashboard').text('Проекты SEO');
                            $('.nav_mouseover1').addClass('active');
                            $('.menu1').addClass('menu-open');
                            $('.menu1').css('display','block');
                        }
                        if(url == '/project-context'){
                            $('.title_dashboard').text('Проекты контекст');
                            $('.nav_mouseover2').addClass('active');
                            $('.menu2').addClass('menu-open');
                            $('.menu2').css('display','block');
                        }

                        var a = new Array(
                                {"attr1":".nav_mouseover1","attr2":".menu1"},
                                {"attr1":".nav_mouseover2","attr2":".menu2"}
                        );

                        $('.nav_mouseover1').click(function(){
                            window.location.href = '/project-seo';
                        });
                        $('.nav_mouseover2').click(function(){
                            window.location.href = '/project-context';
                        });

                        $.each(a,function(data,li){

                            $(li.attr1).mouseover(function(){
                                $(this).addClass('active');
                                $(li.attr2).addClass('menu-open');
                                $(li.attr2).css('display','block');
                            });


                                $(li.attr2).mouseover(function () {
                                    $(this).addClass('active');
                                    $(li.attr2).addClass('menu-open');
                                    $(li.attr2).css('display', 'block');
                                });


                            if(url != '/project-seo' && url != '/pass-seo' && url != '/pass-dev'){
                                $(li.attr2).mouseleave(function () {
                                    $(li.attr1).removeClass('active');
                                    $(li.attr2).removeClass('menu-open');
                                    $(li.attr2).removeAttr('style');
                                });
                            }


                            if(url != '/pass-context' && url != '/project-context') {
                                $(li.attr1).mouseleave(function () {
                                    $(li.attr1).removeClass('active');
                                    $(li.attr2).removeClass('menu-open');
                                    $(li.attr2).removeAttr('style');
                                });

                            }

                            });






                    });

                </script>
            <h1 class="title_dashboard"></h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active title_dashboard"></li>
            </ol>
                @endif
        </section>
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">

        <script>


            var grid = document.getElementById('example2');


            grid.onclick = function(e) {
                if (e.target.tagName != 'TH') return;

                // Если TH -- сортируем
                sortGrid(e.target.cellIndex, e.target.getAttribute('data-type'));
            };

            function sortGrid(colNum, type) {
                var tbody = grid.getElementsByTagName('tbody')[0];


                // Составить массив из TR
                var rowsArray = [].slice.call(tbody.rows);

                // определить функцию сравнения, в зависимости от типа
                var compare;

                switch (type) {
                    case 'number':
                        compare = function(rowA, rowB) {
                            return rowA.cells[colNum].innerHTML - rowB.cells[colNum].innerHTML;
                        };
                        break;
                    case 'string':
                        compare = function(rowA, rowB) {
                            return rowA.cells[colNum].innerHTML > rowB.cells[colNum].innerHTML ? 1 : -1;
                        };
                        break;
                }


                rowsArray.sort(compare);


                grid.removeChild(tbody);

                for (var i = 0; i < rowsArray.length; i++) {
                    tbody.appendChild(rowsArray[i]);
                }

                grid.appendChild(tbody);

            }
        </script>

        <script>
            $(function(){

                function explode( delimiter, string ) {	// Split a string by string
                    //
                    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                    // +   improved by: kenneth
                    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

                    var emptyArray = { 0: '' };

                    if ( arguments.length != 2
                            || typeof arguments[0] == 'undefined'
                            || typeof arguments[1] == 'undefined' )
                    {
                        return null;
                    }

                    if ( delimiter === ''
                            || delimiter === false
                            || delimiter === null )
                    {
                        return false;
                    }

                    if ( typeof delimiter == 'function'
                            || typeof delimiter == 'object'
                            || typeof string == 'function'
                            || typeof string == 'object' )
                    {
                        return emptyArray;
                    }

                    if ( delimiter === true ) {
                        delimiter = '1';
                    }

                    return string.toString().split ( delimiter.toString() );
                }


                $('.sidebar-toggle').click(function(){

                    var doc_w = $(document).width() - 280;
                    $('.dinamic_block').css('width',''+doc_w+'');

                   var clas_b = $('body').attr('class');
                   var b = explode( ' ', clas_b );

                    if(b[2] == 'sidebar-collapse'){
                        $('.dinamic_block').removeAttr('style');
                    }
                });

                $('.palv_settings').css('z-index','10');
                $('.palv_settings').hcSticky({
                    top: 0,
                    bottomEnd: 155,
                    noContainer: true
                });

                $('.left_menu_palv_settings').hcSticky({
                    top: 0,
                    bottomEnd: 155,
                    noContainer: true
                });

                $('.box-body').scroll(function(){
                    if($(this).scrollLeft() == 0){
                        console.log('123');
                        $('.scroll_right_table').removeAttr('style');
                    }else {
                        $('.scroll_right_table').css({
                            'right': 42  - $(this).scrollLeft(),
                            'background': '#fff',
                            'position': 'relative'
                        });
                    }

                });

            });
        </script>

        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-user bg-yellow"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Other sets of options are available
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div><!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->

<script src="{{ asset('/dist/js/raphael-min.js')}}"></script>
<script src="{{ asset('/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('/plugins/fastclick/fastclick.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/dist/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('/dist/js/favicon.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js')}}"></script>

<script src="{{ asset('/dist/js/jquery.columnfilters.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</body>
</html>
