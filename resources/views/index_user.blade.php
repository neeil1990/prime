@extends('layouts.main')


@section('content')
    <section class="content" data-text="Главная">

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
                <div id="topvisor_4Kr"></div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$seo_progect_all}}</h3>

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
                        <h3>{{$project_contexts_user}}</h3>

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
                        <h3>1</h3>

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

        <div class="row">

            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                        {{--<div class="widget-user-image">--}}
                            {{--<img class="img-circle" src="/dist/img/user2-160x160.jpg" alt="User Avatar">--}}
                        {{--</div>--}}
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Внимание на проекты</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            @foreach($SeeForProject as $k => $p)
                            <li><a href="#">{{$p}} <span class="pull-right badge bg-blue">{{$k}} %</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>

            <div class="col-md-4">

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

            <div class="col-md-4">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bar Chart</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:295px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="tablesorter table table-striped zebra">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Проект</th>
                                <th>Макс.Бюджет</th>
                                <th>Освоено сейчас</th>
                                <th>Освоенный % сейчас</th>
                                <th>Неделя 1</th>
                                <th>Неделя 2</th>
                                <th>Неделя 3</th>
                                <th>Неделя 4</th>
                                <th>Неделя 5</th>
                                <th>Неделя 6</th>
                                <th>Неделя 7</th>
                            </tr>
                            </thead>
                            <tbody class="all">

                            @foreach($users_table_stat as $k => $s)
                                <tr>
                                    <td>{{$k}}</td>
                                    <td>{{$s['name_project']}}</td>
                                    <td>{{$s['budget']}}</td>
                                    <td>{{$s['osvoeno']}}</td>
                                    <td>{{$s['osvoeno_procent']}}</td>
                                    @if(isset($s['osvoeno_procent_day']))
                                        @foreach($s['osvoeno_procent_day'] as $date => $stat_procent)
                                            <td style="text-align: center">@if(isset($stat_procent)) {{$stat_procent}}<br> <span style="font-size: 10px;color: blue;">{{$date}}</span>@endif</td>
                                        @endforeach
                                    @endif

                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>








        <script type="text/javascript" src="https://topvisor.ru/js/widget/apometr/apometr.php?region_action=0&region_index=1&div_id=topvisor_4Kr&charset=utf-8&lang=ru"></script>






    </section>

    <script>
        $(function () {




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
                    {label: "Освоено %", value: "{{$all_osv_progect_seo_user}}"},
                    {label: "Не освоено %", value: "{{$all_not_osv_progect_seo_user}}"}
                ],
                hideHover: 'auto'
            });


            var areaChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Electronics",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Digital Goods",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };


            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            };

            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);


        });
    </script>

@stop
