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
                                <label class="col-md-4 control-label">Ф.И.О</label>

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
                                    <select name="specialism" class="form-control" id="special">
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
                                    <select name="level" class="form-control" id="level">
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
                                    <input type="text" class="form-control" name="seo_procent" value="{{ old('personal_specialism') }}">

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
                                    <input type="text" class="form-control" name="contecst_procent" value="{{ old('personal_specialism') }}">
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
                                <label class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <a href="#" id="genirate_password">Сгенерировать пароль</a>
                                    <input type="text" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <script>
                                $(function(){
                                    function getRandomArbitrary(min, max) {
                                        var rand = min + Math.random() * (max - min)
                                        rand = Math.round(rand);
                                        return rand;
                                    }
                                    $('#genirate_password').click(function(){
                                        var mi = 100000;
                                        var ma = 999999;
                                       var rand_number = getRandomArbitrary(mi,ma);
                                        $('input[name=password]').val(rand_number);
                                        $('input[name=password_confirmation]').val(rand_number);
                                        return false;

                                    });

                                });
                            </script>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" name="password_confirmation">

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

    <script>
        $(function(){

            $('#special').change(function(){
                var specialnost = $(this).val();
                var level = $('#level').val();
                $('input[name=contecst_procent]').val('');
                $('input[name=seo_procent]').val('');

                $.ajax({
                    url: '/show-procent-group', //Адрес подгружаемой страницы
                    type: "POST", //Тип запроса
                    dataType: 'json',
                    data: 'arr1=' + specialnost + '&arr2=' + level + '',
                    success: function (response) {

                        $('input[name=contecst_procent]').val(response.procent_context);
                        $('input[name=seo_procent]').val(response.procent_seo);
                    }
                });

            });

            $('#level').change(function(){
                var specialnost = $('#special').val();
                var level = $(this).val();
                $('input[name=contecst_procent]').val('');
                $('input[name=seo_procent]').val('');

                $.ajax({
                    url: '/show-procent-group', //Адрес подгружаемой страницы
                    type: "POST", //Тип запроса
                    dataType: 'json',
                    data: 'arr1=' + specialnost + '&arr2=' + level + '',
                    success: function (response) {

                        $('input[name=contecst_procent]').val(response.procent_context);
                        $('input[name=seo_procent]').val(response.procent_seo);
                    }
                });

            });



        });

    </script>

@stop