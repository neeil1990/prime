@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-project-seo') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_project" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Бюджет</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="budget" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Освоено</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Освоено %</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno_procent" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">
                                    @foreach($users as $user)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$user->id}}"> {{$user->name}}
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Назначить главным</label>

                                <div class="col-md-6">
                                    <select name="id_glavn_user">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта</label>

                                <div class="col-md-6">
                                    <select name="procent_seo" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{$user->seo_procent}}">{{$user->seo_procent}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Инд. % от проекта </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo_ind" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Сумма на з.п.</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="summa_zp" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Стартпоинт</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="startpoint" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">LP</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lp" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Старт</label>

                                <div class="col-md-6">
                                    <input type="text" name="start" class="form-control pull-right" id="datepicker">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Конец</label>

                                <div class="col-md-6">
                                    <input type="text" name="end" class="form-control pull-right" id="datepicker2">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Цель</label>

                                <div class="col-md-6">
                                    <input type="text" name="aim" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Регион</label>

                                <div class="col-md-6">
                                    <input type="text" name="region" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Номер договора</label>

                                <div class="col-md-6">
                                    <input type="text" name="dogovor_number" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Контактное лицо</label>

                                <div class="col-md-6">
                                    <input type="text" name="contact_person" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">e-mail</label>

                                <div class="col-md-6">
                                    <input type="text" name="e_mail" class="form-control">

                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Добавить
                                    </button>
                                    <a class="btn btn-link" href="/project-seo">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>

            $(function () {
                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                });
                $('#datepicker2').datepicker({
                    autoclose: true
                });

            });

        </script>



    </section>

@stop