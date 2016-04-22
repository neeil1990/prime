@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-project-context') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Я.Директ </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ya_direct" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Г.Адвордс</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="go_advords" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Остаток на балансе Яндекса</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ost_bslsnse_ya" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Остаток на балансе Гугл</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ost_bslsnse_go" value="">

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">
                                    @foreach($users as $user)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$user->id}}"> {{$user->name}}
                                        </label><br>
                                    @endforeach
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

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта</label>

                                <div class="col-md-6">
                                    <select name="procent_seo" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{$user->seo_procent}}">{{$user->seo_procent}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Инд. % от проекта </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo_ind" value="">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Добавить
                                    </button>
                                    <a class="btn btn-link" href="/project-context">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>

            $(function () {
                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                });
                $('#datepicker2').datepicker({
                    autoclose: true
                });

            });

        </script>



    </section>

@stop