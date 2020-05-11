@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-project-seo') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Активность</label>
                                <input type="checkbox" name="status" value="1" @if($users->status == 1) checked="checked" @endif >
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Наши проекты</label>
                                <input type="checkbox" name="our_project" value="1" @if($users->our_project == 1) checked="checked" @endif >
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="{{$users->name_project}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$users->id}}">

                                    @foreach($user as $u)
                                        <input type="hidden" class="form-control" name="id_sort[]" value="{{$u->id}}">
                                    @endforeach
                                    @if ($errors->first('name_project'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name_project') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('promotion_type') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    <i class="fa fa-arrows" style="color: grey"></i>
                                    Способ продвижения
                                </label>

                                <div class="col-md-6">
                                    <select name="promotion_type" id="promotion_type" class="form-control" required>
                                        <option value="position" @if($users->promotion_type == 'position') selected @endif>Позиции</option>
                                        <option value="traffic" @if($users->promotion_type == 'traffic') selected @endif>Трафик</option>
                                    </select>
                                    @if ($errors->first('promotion_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('promotion_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Бюджет</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="budget" value="{{$users->budget}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Освоено</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno" value="{{$users->osvoeno}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Освоено %</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno_procent" value="{{$users->osvoeno_procent}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">

                                    @foreach($user_all as $us)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$us->id}}" @foreach($user as $u) @if($us->id == $u->id_user) checked @endif @endforeach> {{$us->name}}
                                        </label><br>
                                    @endforeach
                                        @if ($errors->first('id_user'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('id_user') }}</strong>
                                    </span>
                                        @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Назначить главным</label>

                                <div class="col-md-6">
                                    <select name="id_glavn_user" id="id_glavn_user" class="form-control">
                                        @foreach($user_all as $us)
                                            @if($users->id_glavn_user == $us->id)
                                                <option value="{{$us->id}}">{{$us->name}}</option>
                                            @endif
                                        @endforeach
                                        <option value="" disabled="disabled"></option>
                                        @foreach($user_all as $us)

                                            <option value="{{$us->id}}">{{$us->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('id_glavn_user'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id_glavn_user') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo" value="{{$users->procent_seo}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Включить глобальный % от проекта</label>
                                Вкл. <input type="radio" name="enable_procent_seo" value="1" @if($users->enable_procent_seo == 1) checked="checked" @endif >
                                Выкл. <input type="radio" name="enable_procent_seo" value="0" @if($users->enable_procent_seo == 0) checked="checked" @endif >
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Сумма на з.п.</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="summa_zp" value="{{$users->summa_zp}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">SP</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="startpoint" value="{{$users->startpoint}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">LP</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lp" value="{{$users->lp}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Старт</label>

                                <div class="col-md-6">
                                    <input type="text" name="start" value="{{$users->start}}" class="form-control pull-right" id="datepicker">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Конец</label>

                                <div class="col-md-6">
                                    <input type="text" name="end" value="{{$users->end}}" class="form-control pull-right" id="datepicker2">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Цель</label>

                                <div class="col-md-6">
                                    <input type="text" name="aim" class="form-control" value="{{$users->aim}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Регион</label>

                                <div class="col-md-6">
                                    <input type="text" name="region" class="form-control" value="{{$users->region}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Номер договора</label>

                                <div class="col-md-6">
                                    <input type="text" name="dogovor_number" class="form-control" value="{{$users->dogovor_number}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Контактное лицо</label>

                                <div class="col-md-6">
                                    <input type="text" name="contact_person" class="form-control" value="{{$users->contact_person}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Номер телефона</label>

                                <div class="col-md-6">
                                    <input type="text" name="phone_person" class="form-control" value="{{$users->phone_person}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">e-mail</label>

                                <div class="col-md-6">
                                    <input type="text" name="e_mail" class="form-control" value="{{$users->e_mail}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Освоено начисление бонуса</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="% Освоено при котором начинается выплачиваться бонус" name="procent_bonus" value="{{$users->procent_bonus}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Количество дней штрафа</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="При каком кол-ве дней применяется штраф" name="count_day_fine" value="{{$users->count_day_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Освоено штрафы</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="При каком % Освоено применяется штраф" class="form-control" name="procent_fine" value="{{$users->procent_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% Для штрафа</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="% бюджет - освоенно * % для штрафа" class="form-control" name="procent_for_fine" value="{{$users->procent_for_fine}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% начисление бонуса для нового проекта</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="пока проект находиться на этапе вывода" class="form-control" name="bonus_add" value="{{$users->bonus_add}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Включить бонус проекта</label>
                               Вкл. <input type="radio" name="bonus_enable" value="1" @if($users->bonus_enable == 1) checked="checked" @endif >
                               Выкл. <input type="radio" name="bonus_enable" value="0" @if($users->bonus_enable == 0) checked="checked" @endif >
                            </div>


                            <div class="form-group one">

                                @if(!empty($users->value_serialize))
                                @foreach($users->value_serialize as $val)
                                    <label class="col-md-4 control-label field2"></label>

                                    <div class="col-md-6 field" style="margin-bottom: 10px;">
                                        <input type="text" name="value_serialize[]" value="{{$val}}" class="form-control">
                                    </div>
                                    @endforeach
                                    @endif

                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="#" id="add_input">Добавить поле</a> |
                                    <a href="#" id="remove">Удалить поле</a><br><br>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Изменить
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

                var i = $('input').size() + 1;

                $('#add_input').click(function() {
                    $('<label class="col-md-4 control-label field2"></label><div class="col-md-6 field" style="margin-bottom: 10px;"><input type="text" name="value_serialize[]" class="form-control"></div>').fadeIn('slow').appendTo('.one');
                    return false;
                });

                $('#remove').click(function() {
                    if(i > 1) {
                        $('.field:last').remove();
                        $('.field2:last').remove();
                        i--;
                    }
                    return false;
                });





                $('#id_glavn_user').change(function(){
                    var specialnost = $(this).val();

                    $('input[name=procent_seo]').val('');

                    $.ajax({
                        url: '/show-procent-users', //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: 'json',
                        data: 'arr1=' + specialnost + '',
                        success: function (response) {

                            $('input[name=procent_seo]').val(response.seo_procent);
                        }
                    });

                });


                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });
                $('#datepicker2').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });

            });

        </script>



    </section>

@stop
