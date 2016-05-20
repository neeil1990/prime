@extends('layouts.main')


@section('content')

    <style>
        textarea{
            border:none;
        }
        textarea:hover{
            background-color:#f4f4f4 ;
        }
    </style>

    <section class="content">

        <div class="row palv_settings">
            @if($admin == 1)
                <div class="col-md-12 dinamic_block">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-cogs"></i></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: block;">

                            <a href="" class="add_check">
                                <small class="label label-primary">Выделить все</small>
                            </a>

                            <a href="" style="display: none" class="old_check">
                                <small class="label label-primary">Снять все</small>
                            </a>

                            <a href="" class="button">
                                <small class="label label-primary">Удалить</small>
                            </a>

                            <a href="" class="edit">
                                <small class="label label-primary">Изменить</small>
                            </a>

                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            @endif
        </div>


        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                            <h3 class="box-title"> <a href="/pass-dev/create">Добавить</a></h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Имя проекта</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специалист</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Админка</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Логин</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Пароль</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">SSH</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">FTP</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Логин</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Пароль</th>
                                        </thead>
                                        <tbody>

                                        @foreach($users as $user)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" name="positions[]" class="positions" value="{{$user->id}}">
                                                </td>
                                                <td class="favicon_view{{$user->id}}"></td>
                                                <td class="favicon_url{{$user->id}}"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                <script>
                                                    var url_fav = '.favicon_url'+'{{$user->id}}';
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'http://' + $(url_fav).text() + '/favicon.ico';
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                <td class="">
                                                    @foreach($name as $n)
                                                        @if($n->id == $user->id)
                                                            @if($n->id_user == $user->id_glavn_user)
                                                                <small class="label label-danger">
                                                                    <i class="fa fa-user"></i>&nbsp;
                                                                    {{$n->name}}
                                                                </small><br>
                                                            @else
                                                                <small class="label label-default">
                                                                    <i class="fa fa-user"></i>&nbsp;
                                                                {{$n->name}}
                                                                    </small><br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->admin_url}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->admin_login}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->admin_pass}}</textarea></td>
                                                <td class="">{{$user->ssa}}</td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->ftp}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->login}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->password}}</textarea></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>

    </section>

    <script>
        $(function(){

            $("tbody").sortable({
                items:             "tr",
                tolerance:         "pointer",
                scrollSensitivity: 40,
                opacity:           0.7,
                forcePlaceholderSize: true,
                axis: 'y',

                update:function(event, ui)
                {
                    var values = $(".positions").map(function(){return $(this).val();}).get();

                    $.ajax({
                        url: '/update-pass-dev-positions', //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'arr=' + values + '',
                        success: function (response) {
                            console.log(response);
                        }
                    });

                }

            });



            $('.old_check').click(function() {
                $(".check").prop('checked', false);
                $(this).css('display','none');
                $(".add_check").removeAttr('style');
                return false;
            });

            $('.add_check').click(function() {

                $(".check").prop('checked', true);
                $(this).css('display','none');
                $(".old_check").removeAttr('style');
                return false;
            });



            $('.edit').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get(0);
                window.location.href='/pass-dev/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-pass-dev';
                var DeliteOk = confirm("Точно удалить???");
                if(DeliteOk) {
                    $.ajax({
                        url: url, //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'arr=' + arr + '',
                        success: function (response) {
                            console.log(response);
                        }
                    });
                    window.location.href = "/pass-dev";
                }
                return false;
            });

        });

    </script>
@stop