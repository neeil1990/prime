@extends('layouts.main')


@section('content')
    <section class="content">

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
                        <td>{{$osvoeno_all}}</td>
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
                        <td>{{$context_ya_go}}</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" type-input="context" size="1" class="form-control datepicker">
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

    </div>



        <div class="col-md-6">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Donut Chart</h3>

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
                    <h3 class="box-title">Всего проектов контекст: {{count($progect_context)}}</h3>
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
                        <tbody>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Количество проектов SEO</th>
                            <th>Бюджет SEO</th>
                            <th>Бюджет освоенный SEO</th>
                            <th>Контекст <br> Директ/Adwords</th>
                            <th>Оплата по контексту</th>
                        </tr>

                        @foreach($all_user as $k => $u)
                        <tr>
                            <td>1</td>
                            <td>{{$k}}</td>
                            <td>@if(isset($u['count_project'])) {{$u['count_project']}} @endif</td>
                            <td>@if(isset($u['budjet'])) {{$u['budjet']}} @endif</td>
                            <td>@if(isset($u['osvoeno'])) {{$u['osvoeno']}} @endif</td>
                            <td>@if(isset($u['context_ya_direct_count'])) {{$u['context_ya_direct_count']}} @endif / @if(isset($u['context_go_advords_count'])) {{$u['context_go_advords_count']}} @endif</td>
                            <td>@if(isset($u['context_ya_direct_go_advords'])) {{$u['context_ya_direct_go_advords']}} @endif</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


    <div class="col-md-6">
        <div id="topvisor_GPr"></div>
   </div>



        <script type="text/javascript" src="https://topvisor.ru/js/widget/apometr/apometr.php?region_action=1&searcher=0&region_key=213&div_id=topvisor_GPr&charset=utf-8&lang=ru"></script>






   </section>

    <script>
        $(function () {

            $('.btn').click(function(){
                var input = $(this).parent().parent().find('input');

                    $.ajax({
                        url: '/get-ajax-stat', //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'date=' + input.val() + '&type=' + input.attr('type-input') + '',
                        success: function (response) {
                            console.log(response);
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
                    {label: "Download Sales", value: 70},
                    {label: "In-Store Sales", value: 30}
                ],
                hideHover: 'auto'
            });


        });
    </script>
    @stop
