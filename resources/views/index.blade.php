@extends('layouts.main')


@section('content')
    <section class="content">

        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <style>
                    #topvisor_apometr .topvisor-footer {
                        background: transparent!important;
                        line-height: 35px!important;
                    }
                    #topvisor_apometr .topvisor-middle {
                        height: 65px!important;
                    }
                    #topvisor_apometr .topvisor-header {
                        height: 30px!important;
                    }
                    #topvisor_apometr {
                        width: 388px!important;
                        height: 128px!important;
                    }
                </style>
                    <div id="topvisor_GPr"></div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{count($progect_seo)}}</h3>

                        <p>Всего проектов SEO</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/project-seo" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{count($progect_context)}}</h3>

                        <p>Всего проектов контекст</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/project-context" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{count($all_user)}}</h3>

                        <p>Специалисты</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/personal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

    <div class="col-md-6">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Всего проектов SEO: {{count($progect_seo)}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>Всего максимальный бюджет</td>
                        <td>{{$max_budjet_seo}}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Всего освоенный бюджет</td>
                        <td class="seo">{{$osvoeno_all}}</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" type-input="seo" size="1" class="form-control datepicker">
                                <span class="input-group-btn"><button type="button" class="btn btn-info btn-flat">Go!</button></span>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Всего проектов контекст: {{count($progect_context)}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>

                    <tr>
                        <td>- MyTarget</td>
                        <td>{{$MyTarget}}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>- Директ</td>
                        <td>{{$ya_direct}}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>- Adwords</td>
                        <td>{{$go_advords}}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Всего оплата по контексту</td>
                        <td class="context">{{$context_ya_go}}</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" type-input="context" size="1" class="form-control datepicker">
                                <span class="input-group-btn"><button type="button" class="btn btn-info btn-flat">Go!</button></span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Итог Seo + Context</td>
                        <td class="itog">{{$MyTarget+$go_advords+$ya_direct+$osvoeno_all}}</td>
                        <td></td>
                    </tr>


                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>



        <div class="col-md-6">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Освоено</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Специалисты: {{count($all_user)}}</h3>
                    <div class="col-xs-2 pull-right">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" type-input="all" size="1" class="form-control datepicker">
                            <span class="input-group-btn"><button type="button" class="btn btn-info btn-flat">Go!</button></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody class="all">
                        <tr>
                            <th></th>
                            <th>Имя</th>
                            <th>Количество проектов SEO</th>
                            <th>Бюджет SEO</th>
                            <th>Бюджет освоенный SEO</th>
                            <th>Контекст <br> Директ/Adwords</th>
                            <th>Оплата по контексту</th>
                        </tr>

                        @if(is_array($all_user))
                        @foreach($all_user as $k => $u)
                        <tr>
                            <td><i class="fa fa-user"></i></td>
                            <td>{{$k}}</td>
                            <td>@if(isset($u['count_project'])) {{$u['count_project']}} @endif</td>
                            <td>@if(isset($u['budjet'])) {{$u['budjet']}} @endif</td>
                            <td>@if(isset($u['osvoeno'])) {{$u['osvoeno']}} @endif</td>
                            <td>@if(isset($u['context_ya_direct_count'])) {{$u['context_ya_direct_count']}} @endif / @if(isset($u['context_go_advords_count'])) {{$u['context_go_advords_count']}} @endif</td>
                            <td>@if(isset($u['context_ya_direct_go_advords'])) {{$u['context_ya_direct_go_advords']}} @endif</td>
                        </tr>
                        @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


        <div class="col-xs-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Внимание на проекты</h3>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @foreach($arSeeForProjectUserAdmin as $key => $val)
                            @if($key < 40)
                        <li><a href="#">{{$val['name']}} - {{$val['name_project']}} <span class="pull-right badge bg-blue">{{$key}} %</span></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>


    <div class="row">


        <div class="col-xs-12">

            <div id="accordion">
                @foreach($arStatForAdminUser as $key => $stat)
                <h3>{{$key}}</h3>
                <div>
                    <div class="col-xs-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table id="example-{{str_slug($key)}}" class="tablesorter table table-striped zebra">
                                    <thead>
                                    <tr>
                                        <th data-type="string">Проект</th>
                                        <th data-type="number">Макс.Бюджет</th>
                                        <th data-type="number">Освоено сейчас</th>
                                        <th data-type="number">Освоенный % сейчас</th>
                                        <th data-type="number">День 1</th>
                                        <th data-type="number">День 2</th>
                                        <th data-type="number">День 3</th>
                                        <th data-type="number">День 4</th>
                                        <th data-type="number">День 5</th>
                                        <th data-type="number">День 6</th>
                                        <th data-type="number">День 7</th>
                                    </tr>
                                    </thead>
                                    <tbody class="all">
                                    {{ ($count = 0) ? '' : '' }}
                                    {{ ($sum = '') ? '' : '' }}
                                    @foreach($stat as $key => $stat)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td> {{$stat['budget']}} </td>
                                        <td> {{$stat['osvoeno']}} </td>
                                        <td> {{$stat['osvoeno_procent']}} </td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][0])) {{$stat['osvoeno_procent_day'][0]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][1])) {{$stat['osvoeno_procent_day'][1]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][2])) {{$stat['osvoeno_procent_day'][2]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][3])) {{$stat['osvoeno_procent_day'][3]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][4])) {{$stat['osvoeno_procent_day'][4]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][5])) {{$stat['osvoeno_procent_day'][5]}} @endif</td>
                                        <td>@if(isset($stat['osvoeno_procent_day'][6])) {{$stat['osvoeno_procent_day'][6]}} @endif</td>

                                    </tr>
                                    {{ ($count++) ? '' : '' }}
                                    {{ ($sum += $stat['osvoeno_procent']) ? '' : '' }}
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <p style="text-align: center;font-size: 22px;font-weight: bold">Среднии освоенный процент: {{round($sum/$count,2)}} %</p>

                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                @endforeach


            </div>

        </div>

    </div>




        <script type="text/javascript" src="https://topvisor.ru/js/widget/apometr/apometr.php?region_action=1&searcher=0&region_key=213&div_id=topvisor_GPr&charset=utf-8&lang=ru"></script>






   </section>

    <script>

        $(function () {

            $( "#accordion" ).accordion({
                collapsible : true,
                active: false,
                heightStyle: "content"
            });

            $('.btn').click(function(){
                var input = $(this).parent().parent().find('input');

                    $.ajax({
                        url: '/get-ajax-stat', //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'date=' + input.val() + '&type=' + input.attr('type-input') + '',
                        success: function (response) {
                            if(input.attr('type-input') == 'seo'){
                                $('.seo').html(response);
                            }
                            if(input.attr('type-input') == 'context'){
                                $('.context').html(response);
                            }
                            if(input.attr('type-input') == 'all'){
                                $('.all').html(response);
                            }

                        }
                    });
                return false;
            });

            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                language: "ru"
            });


            //DONUT CHART
            var donut = new Morris.Donut({
                element: 'sales-chart',
                colors: ["#3c8dbc", "#f56954"],
                data: [
                    {label: "Освоено %", value: "{{$all_osv_procent_admin}}"},
                    {label: "Не освоено %", value: "{{$all_not_osv_procent_admin}}"}
                ],
                hideHover: 'auto'
            });


        });
    </script>
    @stop
