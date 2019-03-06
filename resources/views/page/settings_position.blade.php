@extends('layouts.main')


@section('content')

<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Выбрать проект</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="get">
                        {!! csrf_field() !!}
                        <!-- select -->
                        <div class="form-group">
                            <label>Проект</label>
                            <select name="id_project" class="form-control">
                                @if(isset($_REQUEST['id_project']) AND $req = explode('_',$_REQUEST['id_project'])) <option value="{{$_REQUEST['id_project']}}">{{$req[1]}}</option> @endif
                                @foreach($project as $p)
                                <option value="{{$p->id}}_{{$p->name}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Период</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date_stat" class="form-control pull-right" value="@if(isset($_REQUEST['date_stat'])){{$_REQUEST['date_stat']}}@endif" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-6">


            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Корректировать позиции</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <input name="start_pos" type="text" class="form-control" placeholder="С">
                        </div>
                        <div class="col-xs-3">
                            <input name="end_pos" type="text" class="form-control" placeholder="До">
                        </div>
                        <div class="col-xs-3">
                            <select name="plus_pos" class="form-control">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <input name="col_pos" type="text" class="form-control" placeholder="Позиции">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </div>
                </form>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-6">

            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Откатить позиции</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: none;">
                    <table class="table">
                        <tbody>
                        @foreach($back_up_se_ran_pos as $b)
                            <tr>
                                <th style="width:50%"><a href="/back-up-se-ran-pos-get/{{$b->id}}">{{$b->name_project}}</a></th>
                                <td>{{$b->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>


        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody><tr>
                            <th>Проект</th>
                            <th>Максимальный бюджет</th>
                            <th>Освоено</th>
                        </tr>

                        <tr>
                            <td>{{$ArTotalSum['name']}}</td>
                            <td>{{$ArTotalSum['max_budjet']}}</td>
                            <td>{{$ArTotalSum['total_sum']}}</td>
                        </tr>



                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
    <script>
        $(function(){

            $('#reservation').daterangepicker({
                format: "YYYY-MM-DD"
            });


        });
    </script>
@stop