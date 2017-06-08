@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить пароли контекста</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-pass-context') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Активность</label>
                                <input type="checkbox" name="status" value="1">
                            </div>

                            <div class="form-group{{ $errors->has('name_project') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="{{ old('name_project') }}">

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
                                    @foreach($users as $user)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$user->id}}"> {{$user->name}}
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
                                    <select name="id_glavn_user">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
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
                                    <input type="text" class="form-control" name="loginYandex" value="{{ old('loginYandex') }}">

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
                                    <input type="text" class="form-control" name="passYandex" value="{{ old('passYandex') }}">

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
                                    <input type="text" class="form-control" name="loginGoogle" value="{{ old('loginGoogle') }}">

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
                                    <input type="text" class="form-control" name="passGoogle" value="{{ old('passGoogle') }}">

                                    @if ($errors->has('passGoogle'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('passGoogle') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('loginMyTarget') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Логин MyTarget</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="loginMyTarget" value="{{ old('passMyTarget') }}">

                                    @if ($errors->has('loginMyTarget'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('loginMyTarget') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('passMyTarget') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль MyTarget</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="passMyTarget" value="{{ old('passGoogle') }}">

                                    @if ($errors->has('passMyTarget'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('passMyTarget') }}</strong>
                                    </span>
                                    @endif
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

        });

    </script>

@stop