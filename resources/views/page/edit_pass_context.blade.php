@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить пароли контекста</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-create-pass-context') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Активность</label>
                                <input type="checkbox" name="status" value="1" @if($users->status == 1) checked="checked" @endif >
                            </div>

                            <div class="form-group{{ $errors->has('name_project') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="{{$users->name_project}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$users->id}}">

                                    @foreach($user as $u)
                                        <input type="hidden" class="form-control" name="id_sort[]" value="{{$u->id}}">
                                    @endforeach

                                    @if ($errors->has('name_project'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name_project') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('specialist') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">
                                    @foreach($user_all as $us)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$us->id}}" @foreach($user as $u) @if($us->id == $u->id_user) checked @endif @endforeach> {{$us->name}}
                                        </label><br>
                                    @endforeach
                                    @if ($errors->has('id_user'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id_user') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Назначить главным</label>

                                <div class="col-md-6">
                                    <select name="id_user_gl">
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

                                    @if ($errors->has('id_user_gl'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id_user_gl') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loginYandex') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Логин Яндекс</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="loginYandex" value="{{$users->loginYandex}}">

                                    @if ($errors->has('loginYandex'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loginYandex') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('passYandex') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль Яндекс</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="passYandex" value="{{$users->passYandex}}">

                                    @if ($errors->has('passYandex'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('passYandex') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loginGoogle') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Логин Гугл</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="loginGoogle" value="{{$users->loginGoogle}}">

                                    @if ($errors->has('loginGoogle'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loginGoogle') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('passGoogle') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль Гугл</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="passGoogle" value="{{$users->passGoogle}}">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('passGoogle') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
                                    <a class="btn btn-link" href="/pass-context">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <script>

        $(function () {

            var i = $('input').size() + 1;

            $('#add_input').click(function () {
                $('<label class="col-md-4 control-label field2"></label><div class="col-md-6 field" style="margin-bottom: 10px;"><input type="text" name="value_serialize[]" class="form-control"></div>').fadeIn('slow').appendTo('.one');
                return false;
            });

            $('#remove').click(function () {
                if (i > 1) {
                    $('.field:last').remove();
                    $('.field2:last').remove();
                    i--;
                }
                return false;
            });
        });

    </script>

@stop