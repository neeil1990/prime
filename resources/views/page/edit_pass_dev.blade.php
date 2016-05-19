@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменить пароли Dev</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-create-pass-dev') }}">
                            {!! csrf_field() !!}

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

                            <div class="form-group{{ $errors->has('ssa') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">SSH</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ssa" value="{{$users->ssa}}">

                                    @if ($errors->has('ssa'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ssa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ftp') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">FTP</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ftp" value="{{$users->ftp}}">

                                    @if ($errors->has('ftp'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ftp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Логин</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="login" value="{{$users->login}}">

                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="password" value="{{$users->password}}">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Изменить
                                    </button>
                                    <a class="btn btn-link" href="/pass-dev">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

@stop