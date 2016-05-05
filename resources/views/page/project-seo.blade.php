@extends('layouts.main')


@section('content')

    <section class="content">
        <style>
            textarea{
                border:none;
            }
            textarea:hover{
                background-color:#f4f4f4 ;
            }
        </style>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                            <h3 class="box-title"> <a href="/project-seo/create">Добавить</a></h3>
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
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Бюджет</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Освоено</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Освоено %</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специалист</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% от проекта</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Сумма на з.п.</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Стартпоинт</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">LP</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Старт</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Конец</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Остаток дней</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Цель</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Регион</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер договора</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Контактное лицо</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер телефона</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">e-mail</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Дополнительная информация</th>

                                        </thead>
                                        <tbody>


                                        @foreach($users as $user)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" class="positions" name="positions[]" value="{{$user->id}}">
                                                </td>
                                                <td class="favicon_view{{$user->id}}"></td>
                                                <td class="favicon_url{{$user->id}}"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                <script>
                                                    var url_fav = '.favicon_url'+'{{$user->id}}';
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'http://' + $(url_fav).text() + '/favicon.ico';
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                <td class="">{{$user->budget}}</td>
                                                <td class="">{{$user->osvoeno}}</td>
                                                <td class="">{{$user->osvoeno_procent}}</td>
                                                <td class="">
                                                    @foreach($name as $n)
                                                        @if($n->id == $user->id)
                                                            @if($n->id_user == $user->id_glavn_user)
                                                                <span style="color: red">{{$n->name}}</span><br>
                                                            @else
                                                                {{$n->name}}<br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="">{{$user->procent_seo}}</td>
                                                <td class="">{{$user->summa_zp}}</td>
                                                <td class=""><a id="startpoint" href="{{$user->startpoint}}"> >>>> </a></td>
                                                <td class=""><a id="lp" href="{{$user->lp}}"> >>>> </a></td>
                                                <td class="">{{$user->start}}</td>
                                                <td class="">{{$user->end}}</td>
                                                <td class="" style="
                                                @if($user->interval_date < 90)
                                                        background-color: #7CC045;
                                                @endif
                                                @if($user->interval_date < 80)
                                                        background-color: #C8DA2A;
                                                @endif
                                                @if($user->interval_date < 70)
                                                        background-color: #F37F1F;
                                                @endif
                                                @if($user->interval_date < 60)
                                                        background-color: #F4711F;
                                                @endif
                                                @if($user->interval_date < 50)
                                                        background-color: #F16523;
                                                @endif
                                                @if($user->interval_date < 40)
                                                        background-color: #EF5924;
                                                @endif
                                                @if($user->interval_date < 30)
                                                        background-color: #F04723;
                                                @endif
                                                @if($user->interval_date < 20)
                                                        background-color: #EB3625;
                                                @endif
                                                @if($user->interval_date < 10)
                                                        background-color: #ED1B24;
                                                @endif
                                                @if($user->interval_date == 0)
                                                        background-color: #F5F5F5;
                                                @endif
                                                        ">{{$user->interval_date}}
                                                </td>
                                                <td class="">{{$user->aim}}</td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->region}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->dogovor_number}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->contact_person}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->phone_person}}</textarea></td>
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->e_mail}}</textarea></td>

                                                        <td class="">
                                                            @if(!empty($user->value_serialize))
                                                                <ul style="    margin: 0px 0px 0px -43px;min-width: 200px;">
                                                                @foreach($user->value_serialize as $val)
                                                                    <li style="border-bottom: 1px solid grey;list-style: none"> <textarea class="copytext" rows="1" type="text">{{$val}}</textarea></li>
                                                                @endforeach
                                                                </ul>
                                                            @endif
                                                        </td>

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
        <div class="row">
            <div class="col-md-9">
                Количество активных проектов: {{$count_seo_prodject}} |
                Бюджет активных проектов: {{$budget_seo_osvoeno['budget']}} |
                Освоенный бюджет: {{$budget_seo_osvoeno['osvoeno']}}
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
                        url: '/update-project-seo-positions', //Адрес подгружаемой страницы
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
                window.location.href='/project-seo/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-project-seo';
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
                    window.location.href = "/project-seo";
                }
                return false;
            });

        });

    </script>
@stop