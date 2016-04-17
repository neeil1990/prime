@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">edit</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-personal') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Ф.И.О</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">

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

                                    <select name="specialism" class="form-control">
                                        <option value="{{ $user->specialism }}">{{ $user->specialism }}</option>
                                        <option value="" disabled="disabled"></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->specialnost}}">{{$group->specialnost}}</option>
                                        @endforeach
                                    </select>

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
                                    <select name="level" class="form-control">
                                        <option value="{{ $user->level }}">{{ $user->level }}</option>
                                        <option value="" disabled="disabled"></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->level}}">{{$group->level}}</option>
                                        @endforeach
                                    </select>

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
                                    <input type="text" class="form-control" name="personal_specialism" value="{{ $user->personal_specialism }}">

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
                                    <select name="seo_procent" class="form-control">
                                        <option value="{{ $user->seo_procent }}">{{ $user->seo_procent }}</option>
                                        <option value="" disabled="disabled"></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->procent_seo}}">{{$group->procent_seo}}</option>
                                        @endforeach
                                    </select>

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
                                    <input type="text" class="form-control" name="sum_many_first" value="{{ $user->sum_many_first }}">

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
                                    <select name="contecst_procent" class="form-control">
                                        <option value="{{ $user->contecst_procent }}">{{ $user->contecst_procent }}</option>
                                        <option value="" disabled="disabled"></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->procent_context}}">{{$group->procent_context}}</option>
                                        @endforeach
                                    </select>

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
                                    <input type="text" class="form-control" name="sum_many_last" value="{{ $user->sum_many_last }}">

                                    @if ($errors->has('sum_many_last'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sum_many_last') }}</strong>
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