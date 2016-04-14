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

                            <div class="form-group{{ $errors->has('name_project') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="{{$users->name_project}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$users->id}}">

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
                                    <select class="form-control" name="id_user" id="">
                                        <option value="{{$users->id_user}}">{{$users->name}}</option>
                                        <option value="" disabled="disabled"></option>
                                        @foreach($user_all as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('specialist'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('specialist') }}</strong>
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

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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

@stop