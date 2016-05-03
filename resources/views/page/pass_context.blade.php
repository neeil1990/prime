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

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                            <h3 class="box-title"> <a href="/pass-context/create">Добавить</a></h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div><div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Имя проекта</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специалист</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Логин Яндекс</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Пароль Яндекс</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Логин Гугл</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Пароль Гугл</th>
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
                                                <td class="favicon_url{{$user->id}}">{{$user->name_project}}</td>
                                                <script>
                                                    var url_fav = '.favicon_url'+'{{$user->id}}';
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'http://' + $(url_fav).text() + '/favicon.ico';
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                <td class="">@foreach($name as $n)
                                                        @if($n->id == $user->id)
                                                            @if($n->id_user == $user->id_glavn_user)
                                                                <span style="color: red">{{$n->name}}</span><br>
                                                            @else
                                                                {{$n->name}}<br>
                                                            @endif
                                                        @endif
                                                    @endforeach</td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->loginYandex}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->passYandex}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->loginGoogle}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->passGoogle}}</textarea></td>
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

        <div class="row">
            @if($admin == 1)
                <div class="col-md-9">
                    <a href="" class="add_check">Выделить все |</a>
                    <a href="" style="display: none" class="old_check">Снять все |</a>
                    <a href="" class="button">Удалить |</a>
                    <a href="" class="edit">Изменить</a>
                </div>
            @endif
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
                        url: '/update-pass-context-positions', //Адрес подгружаемой страницы
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
                window.location.href='/pass-context/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-pass-context';
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
                    window.location.href = "/pass-context";
                }
                return false;
            });

        });

    </script>
@stop