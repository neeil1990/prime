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
                        <td>Update software</td>
                    </tr>

                    <tr>
                        <td>Всего освоенный бюджет</td>
                        <td>Update software</td>
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
                        <td></td>
                    </tr>

                    <tr>
                        <td>- Adwords</td>
                        <td>Update software</td>
                    </tr>

                    <tr>
                        <td>Всего оплата по контексту</td>
                        <td>Update software</td>
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


    <div class="col-md-6">
        <div id="topvisor_GPr"></div>
   </div>



        <script type="text/javascript" src="https://topvisor.ru/js/widget/apometr/apometr.php?region_action=1&searcher=0&region_key=213&div_id=topvisor_GPr&charset=utf-8&lang=ru"></script>






   </section>

    <script>
        $(function () {


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
