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

                            <a href="/setting_field_pass_context" class="">
                                <small class="label label-primary">Настройка полей</small>
                            </a>

                            <div class="row">
                                <div class="col-md-9">
                                    Архив: <a href="/archive-page-project/pass-context">{{$count_archive}}</a>
                                </div>
                            </div>

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
                            <h3 class="box-title"> <a href="/pass-context/create">Добавить</a></h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div><div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="tablesorter table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            @foreach($setting_field as $val)
                                                @if($val->value == 1 or $admin == 1)
                                                    <th class="sorting" tabindex="0" data-type="{{$val->data_type}}" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"> @if($val->value == 0) <i style="color:red" class="fa fa-close"></i> @endif {{$val->name}}</th>
                                                @endif
                                             @endforeach
                                        </thead>
                                        <tbody>



                                        @foreach($users as $user)
                                            @if($user->status == $archive)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" name="positions[]" class="positions" value="{{$user->id}}">
                                                </td>

                                                <td class="scroll_right_table"><img src="https://www.google.com/s2/favicons?domain={{$user->name_project}}" style="max-width:30px"></td>
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class="">@foreach($name as $n)
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
                                                    @endforeach</td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->loginYandex}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->passYandex}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->loginGoogle}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->passGoogle}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                    <td class=""><textarea class="copytext" rows="1" type="text">{{$user->loginMyTarget}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                    <td class=""><textarea class="copytext" rows="1" type="text">{{$user->passMyTarget}}</textarea></td>
                                                @endif
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                    <td class="">
                                                        @if(!empty($user->value_serialize))
                                                            <ul style="    margin: 0px 0px 0px -43px;min-width: 200px;">
                                                                @foreach($user->value_serialize as $val)
                                                                    <li style="border-bottom: 1px solid grey;list-style: none"> <textarea class="copytext" rows="1" type="text">{{$val}}</textarea></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                            @endif
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