@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-personal') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('specialism') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Специализация</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="specialism" value="{{ old('specialism') }}">

                                    @if ($errors->has('specialism'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('specialism') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Уровень</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="level" value="{{ old('level') }}">

                                    @if ($errors->has('level'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('personal_specialism') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="personal_specialism" value="{{ old('personal_specialism') }}">

                                    @if ($errors->has('personal_specialism'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('personal_specialism') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('seo_procent') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта SEO</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="seo_procent" value="{{ old('seo_procent') }}">

                                    @if ($errors->has('seo_procent'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('seo_procent') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sum_many_first') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Сумма на зп</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sum_many_first" value="{{ old('sum_many_first') }}">

                                    @if ($errors->has('sum_many_first'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sum_many_first') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contecst_procent') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта контекста</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="contecst_procent" value="{{ old('contecst_procent') }}">

                                    @if ($errors->has('contecst_procent'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contecst_procent') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sum_many_last') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Сумма на зп</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sum_many_last" value="{{ old('sum_many_last') }}">

                                    @if ($errors->has('sum_many_last'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sum_many_last') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('itog') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Итог</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="itog" value="{{ old('itog') }}">

                                    @if ($errors->has('itog'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('itog') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                    <a class="btn btn-link" href="/personal">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

@stop