@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить Сервисы & Пароли</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-service-and-password') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Активность</label>
                                <input type="checkbox" name="status" value="1" >
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

                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Логин</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="login" value="{{ old('login') }}">

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
                                    <input type="text" class="form-control" name="password" value="{{ old('password') }}">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dop_infa') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Дополнительная информация</label>

                                <div class="col-md-6">

                                    <textarea name="dop_infa" class="form-control">{{ old('dop_infa') }}</textarea>

                                    @if ($errors->has('dop_infa'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dop_infa') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Добавить
                                    </button>
                                    <a class="btn btn-link" href="/service-and-password">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


@stop