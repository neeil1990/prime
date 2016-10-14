@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row palv_settings">

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
                            @if($admin == 1)

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

                            <a href="/setting-field-context" >
                                <small class="label label-primary">Настройка полей</small>
                            </a>
                            @endif

                            <div class="row">
                                <div class="col-md-9">
                                    Количество активных проектов: {{$count_context_project}} |
                                    Бюджет активных проектов: {{$budget_context_project}} |
                                    @if($admin == 1)
                                    Архив: <a href="/archive-page-project/project-context">{{$count_status}}</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>

        </div>


        <style>
            textarea{
                border:none;
            }
            textarea:hover{
                background-color:#f4f4f4 ;
            }

            .close_token_yandex_form_none{
                display: none;
            }
        </style>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                            <h3 class="box-title"> <a href="/project-context/create">Добавить</a></h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">

                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting scroll_right_table" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting scroll_right_table" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            @foreach($setting_field as $key=>$val)
                                                @if($val->value == 1 or $admin == 1)
                                                    <th class="sorting @if($key == 0) scroll_right_table @endif" tabindex="0" data-type="{{$val->data_type}}" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"> @if($val->value == 0) <i style="color:red" class="fa fa-close"></i> @endif {{$val->name}}</th>
                                                @endif
                                            @endforeach
                                        </thead>
                                        <tbody>

                                        @foreach($users as $user)
                                            @if($user->status == $archive)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="scroll_right_table">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" class="positions" name="positions[]" value="{{$user->id}}">
                                                </td>
                                                <td class="favicon_view{{$user->id}} scroll_right_table"></td>
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class="favicon_url{{$user->id}} scroll_right_table"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                <script>
                                                    var url_fav = '.favicon_url'+'{{$user->id}}';
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'https://www.google.com/s2/favicons?domain=' + $(url_fav).text() ;
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                @endif
                                                @if($setting_field[1]->value == 1 or $admin == 1)
                                                <td class="">{{$user->ya_direct}}</td>
                                                @endif
                                                @if($setting_field[2]->value == 1 or $admin == 1)
                                                <td class="">{{$user->go_advords}}</td>
                                                @endif
                                                @if($setting_field[3]->value == 1 or $admin == 1)
                                                <td class="">

                                                    <span class="info-box-number">{{$user->ost_bslsnse_ya}}</span>


                                                    <div class="update_token_yandex">
                                                        <small class="label label-primary obnovit" style="cursor: pointer">Обновить/Закрыть</small>

                                                        <form method="POST" action="/update-token-yandex-form" class="update_token_yandex_form" style="display: none;">
                                                        <div class="input-group input-group-sm">
                                                                {!! csrf_field() !!}
                                                            <input type="hidden" class="form-control" name="yandex_token_id" value="{{$user->id}}">
                                                            <input type="text" style="width: 150px;" class="form-control" placeholder="введите логин яндекс" name="yandex_login_token" value="">
                                                            <span class="input-group-btn">
                                                              <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                                            </span>

                                                        </div>

                                                        </form>
                                                    </div>
                                                </td>
                                                @endif
                                                @if($setting_field[4]->value == 1 or $admin == 1)
                                                <td class="">

                                                    <span class="info-box-number ost_bslsnse_go" now-bslsnse-go="{{$user->now_bslsnse_go}}" data-id-project="{{$user->id}}" style="cursor: pointer">{{$user->ost_bslsnse_go}}</span>


                                                    <div class="update_id_google">
                                                        <small class="label label-primary obnovit_google" style="cursor: pointer">Обновить/Закрыть</small>

                                                        <form method="POST" action="/update-id-google-form" class="update_google_form" style="display: none;">
                                                            <div class="input-group input-group-sm">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" class="form-control" name="google_project_id" value="{{$user->id}}">
                                                                <input type="text" style="width: 150px;" class="form-control" placeholder="введите ID google" name="google_id_client" value="">
                                                            <span class="input-group-btn">
                                                              <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                                            </span>

                                                            </div>

                                                        </form>
                                                    </div>
                                                </td>
                                                @endif
                                                @if($setting_field[5]->value == 1 or $admin == 1)
                                                <td class="">
                                                    @foreach($name as $n)
                                                        @if($n->id == $user->id)
                                                            @if($n->id_user == $user->id_glavn_user)
                                                                <small class="label label-danger">
                                                                    <i class="fa fa-user"></i>
                                                                    {{trim($n->name)}}
                                                                </small><br>
                                                            @else
                                                                <small class="label label-default">
                                                                    <i class="fa fa-user"></i>
                                                                {{trim($n->name)}}
                                                                </small><br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                @endif
                                                @if($setting_field[6]->value == 1 or $admin == 1)
                                                <td class="">{{$user->procent_seo}}</td>
                                                @endif
                                                @if($setting_field[7]->value == 1 or $admin == 1)
                                                <td class="">{{$user->sum_zp}}</td>
                                                @endif
                                                @if($setting_field[8]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->dogovor_number}}</textarea></td>
                                                @endif
                                                @if($setting_field[9]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->contact_person}}</textarea></td>
                                                @endif
                                                @if($setting_field[10]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->phone_person}}</textarea></td>
                                                @endif
                                                @if($setting_field[11]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->e_mail}}</textarea></td>
                                                @endif
                                                @if($setting_field[12]->value == 1 or $admin == 1)
                                                <td class="">
                                                    @if(!empty($user->value_serialize))
                                                        <ul style="    margin: 0px 0px 0px -43px;min-width: 200px;">
                                                            @foreach($user->value_serialize as $val)
                                                                <li style="border-bottom: 1px solid grey;list-style: none"><textarea class="copytext" rows="1" type="text">{{$val}}</textarea></li>
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
            $('.ost_bslsnse_go').click(function(){
                $( "#dialog" ).dialog({
                    closeText: "X",
                    minWidth: 500
                });
               var ost = $(this).attr('now-bslsnse-go');
                $('.now_balanse').text('Пополнено: ' + ost);
               var id = $(this).attr('data-id-project');
                $('.id_progect_jq').val(id);
            });
            $('.btn-default').click(function(){
            $( "#dialog" ).dialog( "close" );
                return false;
            });

            $('.obnovit').click(function(){
               var rod = $(this).parent(".update_token_yandex")
               var doch = $(rod).children(".update_token_yandex_form").toggle('slow')
            });

            $('.obnovit_google').click(function(){
                var rod = $(this).parent(".update_id_google")
                var doch = $(rod).children(".update_google_form").toggle('slow')
            });





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
                        url: '/update-project-context-positions', //Адрес подгружаемой страницы
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
                window.location.href='/project-context/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-project-context';
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
                    window.location.href = "/project-context";
                }
                return false;
            });

        });

    </script>
@stop