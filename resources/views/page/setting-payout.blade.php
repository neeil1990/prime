@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Настройка Выплат</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/save-setting-payout') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Освоено начисление бонуса</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="% Освоено при котором начинается выплачиваться бонус" name="procent_bonus" value="{{$setting_payout->procent_bonus}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Количество дней штрафа</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="При каком кол-ве дней применяется штраф" name="count_day_fine" value="{{$setting_payout->count_day_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Освоено штрафы</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="При каком % Освоено применяется штраф" class="form-control" name="procent_fine" value="{{$setting_payout->procent_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Для штрафа</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="% бюджет - освоенно * % для штрафа" class="form-control" name="procent_for_fine" value="{{$setting_payout->procent_for_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% начисление бонуса для нового проекта</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="пока проект находиться на этапе вывода" class="form-control" name="bonus_add" value="{{$setting_payout->bonus_add}}">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Сохранить
                                    </button>
                                    <a class="btn btn-link" href="/project-seo">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

    @stop