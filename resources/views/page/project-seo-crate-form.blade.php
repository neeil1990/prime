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
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Имя проекта</label>

                                <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_project" value="">

                                    @if ($errors->first('name_project'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name_project') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Бюджет</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="budget" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Освоено</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Освоено %</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="osvoeno_procent" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Специалист</label>

                                <div class="col-md-6">
                                    @foreach($users as $user)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$user->id}}"> {{$user->name}}
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
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Назначить главным</label>

                                <div class="col-md-6">
                                    <select name="id_glavn_user" id="id_glavn_user">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
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
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> % от проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo" value="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Сумма на з.п.</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="summa_zp" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Стартпоинт</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="startpoint" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> LP</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lp" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Старт</label>

                                <div class="col-md-6">
                                    <input type="text" name="start" class="form-control pull-right" id="datepicker">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Конец</label>

                                <div class="col-md-6">
                                    <input type="text" name="end" class="form-control pull-right" id="datepicker2">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Цель</label>

                                <div class="col-md-6">
                                    <input type="text" name="aim" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Регион</label>

                                <div class="col-md-6">
                                    <input type="text" name="region" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Номер договора</label>

                                <div class="col-md-6">
                                    <input type="text" name="dogovor_number" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Контактное лицо</label>

                                <div class="col-md-6">
                                    <input type="text" name="contact_person" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> Номер телефона</label>

                                <div class="col-md-6">
                                    <input type="text" name="phone_person" class="form-control" data-inputmask="'mask': '(999) 999-9999'" data-mask="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><i class="fa fa-arrows" style="color: grey"></i> e-mail</label>

                                <div class="col-md-6">
                                    <input type="text" name="e_mail" class="form-control">

                                </div>
                            </div>



                            <div class="form-group one">

                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="#" id="add_input">Добавить поле</a> |
                                    <a href="#" id="remove">Удалить поле</a><br><br>
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

        <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script>


            $(function () {

                $(".form-horizontal").sortable({
                    items:             ".form-group",
                    tolerance:         "pointer",
                    scrollSensitivity: 40,
                    opacity:           0.7,
                    forcePlaceholderSize: true,
                    axis: 'y',

                    update:function(event, ui)
                    {

                    }

                });


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
                    autoclose: true
                });
                $('#datepicker2').datepicker({
                    autoclose: true
                });

                $("[data-mask]").inputmask();

            });

        </script>



    </section>

@stop