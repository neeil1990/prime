@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-9">
                <h3>Проекты SEO</h3>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">

                        <h3>Проекты SEO: {{$name_user->name}}</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            @if($setting_field_seo[0]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Имя проекта</th>
                                            @endif
                                            @if($setting_field_seo[1]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Бюджет</th>
                                            @endif
                                            @if($setting_field_seo[2]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Освоено</th>
                                            @endif
                                            @if($setting_field_seo[3]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Освоено %</th>
                                            @endif
                                            @if($setting_field_seo[5]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% от проекта</th>
                                            @endif
                                            @if($setting_field_seo[6]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Сумма на з.п.</th>
                                            @endif
                                            @if($setting_field_seo[7]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">SP</th>
                                            @endif
                                            @if($setting_field_seo[8]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">LP</th>
                                            @endif
                                            @if($setting_field_seo[9]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Старт</th>
                                            @endif
                                            @if($setting_field_seo[10]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Конец</th>
                                            @endif
                                            @if($setting_field_seo[11]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Остаток дней</th>
                                            @endif
                                            @if($setting_field_seo[12]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Цель</th>
                                            @endif
                                            @if($setting_field_seo[13]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Регион</th>
                                            @endif
                                            @if($setting_field_seo[14]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер договора</th>
                                            @endif
                                            @if($setting_field_seo[15]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Контактное лицо</th>
                                            @endif
                                            @if($setting_field_seo[16]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="number" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер телефона</th>
                                            @endif
                                            @if($setting_field_seo[17]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">e-mail</th>
                                            @endif
                                            @if($setting_field_seo[18]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2" data-type="string" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Дополнительная информация</th>
                                            @endif

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
                                                @if($setting_field_seo[0]->value == 1 or $admin == 1)
                                                <td class="favicon_url{{$user->id}}"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                <script>
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'https://www.google.com/s2/favicons?domain=' + '{{$user->name_project}}' ;
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                @endif
                                                @if($setting_field_seo[1]->value == 1 or $admin == 1)
                                                <td class="">{{$user->budget}}</td>
                                                @endif
                                                @if($setting_field_seo[2]->value == 1 or $admin == 1)
                                                <td class="">{{$user->osvoeno}}</td>
                                                @endif
                                                @if($setting_field_seo[3]->value == 1 or $admin == 1)
                                                <td class="">{{$user->osvoeno_procent}}</td>
                                                @endif
                                                @if($setting_field_seo[5]->value == 1 or $admin == 1)
                                                <td class="">{{$user->procent_seo}}</td>
                                                @endif
                                                @if($setting_field_seo[6]->value == 1 or $admin == 1)
                                                <td class="">{{$user->summa_zp}}</td>
                                                @endif
                                                @if($setting_field_seo[7]->value == 1 or $admin == 1)
                                                <td class=""><a id="startpoint" href="{{$user->startpoint}}"> >>>> </a></td>
                                                @endif
                                                @if($setting_field_seo[8]->value == 1 or $admin == 1)
                                                <td class=""><a id="lp" href="{{$user->lp}}"> >>>> </a></td>
                                                @endif
                                                @if($setting_field_seo[9]->value == 1 or $admin == 1)
                                                <td class="">{{$user->start}}</td>
                                                @endif
                                                @if($setting_field_seo[10]->value == 1 or $admin == 1)
                                                <td class="">{{$user->end}}</td>
                                                @endif
                                                @if($setting_field_seo[11]->value == 1 or $admin == 1)
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
                                                        ">{{$user->interval_date}}</td>
                                                @endif
                                                @if($setting_field_seo[12]->value == 1 or $admin == 1)
                                                <td class="">{{$user->aim}}</td>
                                                @endif
                                                @if($setting_field_seo[13]->value == 1 or $admin == 1)
                                                <td class="">{{$user->region}}</td>
                                                @endif
                                                @if($setting_field_seo[14]->value == 1 or $admin == 1)
                                                <td class="">{{$user->dogovor_number}}</td>
                                                @endif
                                                @if($setting_field_seo[15]->value == 1 or $admin == 1)
                                                <td class="">{{$user->contact_person}}</td>
                                                @endif
                                                @if($setting_field_seo[16]->value == 1 or $admin == 1)
                                                <td class="">{{$user->phone_person}}</td>
                                                @endif
                                                @if($setting_field_seo[17]->value == 1 or $admin == 1)
                                                <td class="">{{$user->e_mail}}</td>
                                                @endif
                                                @if($setting_field_seo[18]->value == 1 or $admin == 1)
                                                <td class="">
                                                    @if(!empty($user->value_serialize))
                                                        <ul style="    margin: 0px 0px 0px -43px;min-width: 200px;">
                                                            @foreach($user->value_serialize as $val)
                                                                <li style="border-bottom: 1px solid grey;list-style: none">{{$val}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                @endif

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

        </div>
        <div class="row">
            <div class="col-md-9">
                Количество активных проектов: {{$count_seo_prodject}} |
                Бюджет активных проектов: {{$budget_seo_osvoeno['budget']}} |
                Освоенный бюджет: {{$budget_seo_osvoeno['osvoeno']}}
            </div>
        </div>





        <div class="row">
            <div class="col-md-9">
                <h3>Проекты Контекст</h3>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        <h3>Проекты Контекст: {{$name_user->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow-y: auto;">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
                                    <table id="example3" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending"></th>
                                            @if($setting_field_context[0]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="string" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Имя проекта</th>
                                            @endif
                                            @if($setting_field_context[1]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Я.Директ</th>
                                            @endif
                                            @if($setting_field_context[2]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Г.Адвордс</th>
                                            @endif
                                            @if($setting_field_context[3]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Остаток на балансе Яндекса</th>
                                            @endif
                                            @if($setting_field_context[4]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Остаток на балансе Гугл</th>
                                            @endif
                                            @if($setting_field_context[6]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% от проекта</th>
                                            @endif
                                            @if($setting_field_context[7]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Сумма на з.п.</th>
                                            @endif
                                            @if($setting_field_context[8]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер договора</th>
                                            @endif
                                            @if($setting_field_context[9]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="string" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Контактное лицо</th>
                                            @endif
                                            @if($setting_field_context[10]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="number" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Номер телефона</th>
                                            @endif
                                            @if($setting_field_context[11]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="string" colspan="1" aria-label="Rendering engine: activate to sort column ascending">e-mail</th>
                                            @endif
                                            @if($setting_field_context[12]->value == 1 or $admin == 1)
                                            <th class="sorting" tabindex="0" aria-controls="example2_wrapper" rowspan="1" data-type="string" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Дополнительная информация</th>
                                            @endif
                                        </thead>
                                        <tbody>

                                        @foreach($project_context as $user)
                                            <tr role="row" class="odd">
                                                <td class=""><i class="fa fa-arrows" style="color: grey"></i></td>
                                                <td class="">
                                                    <input type="checkbox" class="check" value="{{$user->id}}">
                                                    <input type="hidden" class="positions" name="positions[]" value="{{$user->id}}">
                                                </td>
                                                <td class="favicon_view{{$user->id}}_2"></td>
                                                @if($setting_field_context[0]->value == 1 or $admin == 1)
                                                <td class="favicon_url{{$user->id}}_2"><textarea class="copytext" rows="1" type="text">{{$user->name_project}}</textarea></td>
                                                <script>
                                                    var view_fav = '.favicon_view'+'{{$user->id}}';
                                                    var url = 'https://www.google.com/s2/favicons?domain=' + '{{$user->name_project}}' ;
                                                    $(view_fav).html('<img src='+ url +' style="max-width:30px">');
                                                </script>
                                                @endif
                                                @if($setting_field_context[1]->value == 1 or $admin == 1)
                                                <td class="">{{$user->ya_direct}}</td>
                                                @endif
                                                @if($setting_field_context[2]->value == 1 or $admin == 1)
                                                <td class="">{{$user->go_advords}}</td>
                                                @endif
                                                @if($setting_field_context[3]->value == 1 or $admin == 1)
                                                <td class="">{{$user->ost_bslsnse_ya}}</td>
                                                @endif
                                                @if($setting_field_context[4]->value == 1 or $admin == 1)
                                                <td class="">{{$user->ost_bslsnse_go}}</td>
                                                @endif
                                                @if($setting_field_context[6]->value == 1 or $admin == 1)
                                                <td class="">{{$user->procent_seo}}</td>
                                                @endif
                                                @if($setting_field_context[7]->value == 1 or $admin == 1)
                                                <td class="">{{$user->sum_zp}}</td>
                                                @endif
                                                @if($setting_field_context[8]->value == 1 or $admin == 1)
                                                <td class="">{{$user->dogovor_number}}</td>
                                                @endif
                                                @if($setting_field_context[9]->value == 1 or $admin == 1)
                                                <td class="">{{$user->contact_person}}</td>
                                                @endif
                                                @if($setting_field_context[10]->value == 1 or $admin == 1)
                                                <td class="">{{$user->phone_person}}</td>
                                                @endif
                                                @if($setting_field_context[11]->value == 1 or $admin == 1)
                                                <td class="">{{$user->e_mail}}</td>
                                                @endif
                                                @if($setting_field_context[12]->value == 1 or $admin == 1)
                                                <td class="">
                                                    @if(!empty($user->value_serialize))
                                                        <ul style="    margin: 0px 0px 0px -43px;min-width: 200px;">
                                                            @foreach($user->value_serialize as $val)
                                                                <li style="border-bottom: 1px solid grey;list-style: none">{{$val}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                @endif
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

        </div>
        <div class="row">
            <div class="col-md-9">
                Количество активных проектов: {{$count_context_project}} |
                Бюджет активных проектов: {{$budget_context_project}}
            </div>
        </div>






    </section>


    <script>




            $('#example3').click(function(e){
            var tbody = this.getElementsByTagName('tbody')[0];

            // Составить массив из TR
            var rowsArray = [].slice.call(tbody.rows);

            // определить функцию сравнения, в зависимости от типа
            var compare;


            switch (e.target.getAttribute('data-type')) {
                case 'number':
                    compare = function(rowA, rowB) {
                        return rowA.cells[e.target.cellIndex].innerHTML - rowB.cells[e.target.cellIndex].innerHTML;
                    };
                    break;
                case 'string':
                    compare = function(rowA, rowB) {
                        return rowA.cells[e.target.cellIndex].innerHTML > rowB.cells[e.target.cellIndex].innerHTML ? 1 : -1;
                    };
                    break;
            }


            rowsArray.sort(compare);


                this.removeChild(tbody);

            for (var i = 0; i < rowsArray.length; i++) {
                tbody.appendChild(rowsArray[i]);
            }

                this.appendChild(tbody);



                });




    </script>

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