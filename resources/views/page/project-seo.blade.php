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

                            <a href="/setting-field-seo" >
                                <small class="label label-primary">Настройка полей</small>
                            </a>

                            <a href="/setting-payout">
                                    <small class="label label-primary">Настройка Выплат</small>
                            </a>
                            @endif

                            <div class="row">
                                <div class="col-md-9">

                                    Всего активных: {{$count_seo_prodject}} |
                                    Бюджет активных: {{$budget_seo_osvoeno['budget']}} |
                                    Освоенный бюджет: {{$budget_seo_osvoeno['osvoeno']}} <br/>
                                    Клиентские кол-во: {{$count_client_project}} |
                                    Бюджет клиентские: {{$budget_seo_osvoeno['budget_client']}} |
                                    Освоенный бюджет клиентские: {{$budget_seo_osvoeno['osvoeno_client']}}<br/>
                                    Наши проекты кол-во: {{$count_our_project}} |
                                    Бюджет наши проекты: {{$budget_seo_osvoeno['budget_our']}} |
                                    Освоенный бюджет наши проекты: {{$budget_seo_osvoeno['osvoeno_our']}} <br/>
                                    @if($admin == 1)
                                    Архив: <a href="/archive-page-project/project-seo">{{$count_status}}</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>

        </div>



        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                            <h3 class="box-title"> <a class="btn btn-block btn-default btn-sm" href="/project-seo/create">Добавить</a></h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row"><div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div><div class="row"><div class="col-sm-12">
                                    <table id="example2" class="tablesorter table table-bordered table-hover dataTable zebra" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting scroll_right_table" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting scroll_right_table" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>

                                            @foreach($setting_field as $key=>$val)
                                                @if($val->value == 1 or $admin == 1)
                                                    <th class="sorting @if($key == 0) scroll_right_table @endif"
                                                        @if($val->field == "osvoeno_seo") data-toggle="tooltip" data-placement="top" title="Сумма полученная за 8 дней включая текущий. Sum / 8*30 = Освоено" @endif
                                                        @if($val->field == "osvoeno_procent_seo") data-toggle="tooltip" data-placement="top" title="Процент высчитанный из сумы Освоено" @endif
                                                        tabindex="0"
                                                        data-type="{{$val->data_type}}"
                                                        aria-controls="example2"
                                                        rowspan="1"
                                                        colspan="1"
                                                        aria-label="Rendering engine: activate to sort column ascending"> @if($val->value == 0) <i style="color:red" class="fa fa-close"></i> @endif {{$val->name}}</th>
                                                @endif
                                            @endforeach

                                        </thead>
                                        <tbody>


                                        @foreach($users as $user)
                                            @if($user->status == $archive)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="scroll_right_table" id="demoItem<?=$user->id;?>">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" class="positions" name="positions[]" value="{{$user->id}}">
                                                </td>
                                                <td class="scroll_right_table"><img src="https://www.google.com/s2/favicons?domain={{$user->name_project}}" style="max-width:30px"></td>
                                                @if($setting_field[0]->value == 1 or $admin == 1)
                                                <td class="scroll_right_table"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                @endif
                                                @if($setting_field[1]->value == 1 or $admin == 1)
                                                <td class="">{{$user->budget}}</td>
                                                @endif
                                                @if($setting_field[2]->value == 1 or $admin == 1)
                                                <td class="">{{$user->osvoeno}}</td>
                                                @endif
                                                @if($setting_field[3]->value == 1 or $admin == 1)
                                                <td class="">{{$user->osvoeno_procent}}</td>
                                                @endif
                                                @if($setting_field[4]->value == 1 or $admin == 1)
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
                                                @if($setting_field[5]->value == 1 or $admin == 1)
                                                <td class="">{{$user->procent_seo}}</td>
                                                @endif
                                                @if($setting_field[6]->value == 1 or $admin == 1)
                                                <td class="">{{$user->summa_zp}}</td>
                                                @endif
                                                @if($setting_field[7]->value == 1 or $admin == 1)
                                                <td class=""><a id="startpoint" href="{{$user->startpoint}}"> >>>> </a></td>
                                                @endif
                                                @if($setting_field[8]->value == 1 or $admin == 1)
                                                <td class=""><a id="lp" href="{{$user->lp}}"> >>>> </a></td>
                                                @endif
                                                @if($setting_field[9]->value == 1 or $admin == 1)
                                                <td class="">{{$user->start}}</td>
                                                @endif
                                                @if($setting_field[10]->value == 1 or $admin == 1)
                                                <td class="">{{$user->end}}</td>
                                                @endif
                                                @if($setting_field[11]->value == 1 or $admin == 1)
                                                <td class="" style="
                                                @if($user->interval_date < 500)
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
                                                        ">{{$user->interval_date}}</td>
                                                @endif
                                                @if($setting_field[12]->value == 1 or $admin == 1)
                                                <td class="">{{$user->aim}}</td>
                                                @endif
                                                @if($setting_field[13]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->region}}</textarea></td>
                                                @endif
                                                @if($setting_field[14]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->dogovor_number}}</textarea></td>
                                                @endif
                                                @if($setting_field[15]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->contact_person}}</textarea></td>
                                                @endif
                                                @if($setting_field[16]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->phone_person}}</textarea></td>
                                                @endif
                                                @if($setting_field[17]->value == 1 or $admin == 1)
                                                <td class=""><textarea class="copytext" rows="1" type="text">{{$user->e_mail}}</textarea></td>
                                                @endif
                                                @if($setting_field[18]->value == 1 or $admin == 1)
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
                                                @if($setting_field[19]->value == 1 or $admin == 1)
                                                    <td class="">
                                                        <ul class="nav nav-stacked" style="width:240px">
                                                            <li><a href="#">% Освоено бонус <span class="pull-right badge bg-blue">{{$user->procent_bonus}} %</span></a></li>
                                                            <li><a href="#">Количество дней штрафа <span class="pull-right badge bg-aqua">{{$user->count_day_fine}}</span></a></li>
                                                            <li><a href="#">% Освоено штрафы <span class="pull-right badge bg-green">{{$user->procent_fine}} %</span></a></li>
                                                            <li><a href="#">% Начисление бонуса <span class="pull-right badge bg-red">{{$user->bonus_add}} %</span></a></li>
                                                        </ul>
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

            $('th[data-toggle="tooltip"]').tooltip({
                container: 'body'
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