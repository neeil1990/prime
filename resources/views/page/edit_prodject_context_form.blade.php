@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-project-context') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя проекта</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name_project" value="{{$users->name_project}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$users->id}}">

                                    @foreach($user as $u)
                                        <input type="hidden" class="form-control" name="id_sort[]" value="{{$u->id}}">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Я.Директ </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ya_direct" value="{{$users->ya_direct}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Г.Адвордс</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="go_advords" value="{{$users->go_advords}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Остаток на балансе Яндекса</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ost_bslsnse_ya" value="{{$users->ost_bslsnse_ya}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Остаток на балансе Гугл</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ost_bslsnse_go" value="{{$users->ost_bslsnse_go}}">

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Специалист</label>

                                <div class="col-md-6">
                                    @foreach($user_all as $us)
                                        <label>
                                            <input type="checkbox" name="id_user[]" value="{{$us->id}}" @foreach($user as $u) @if($us->id == $u->id_user) checked @endif @endforeach> {{$us->name}}
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Назначить главным</label>

                                <div class="col-md-6">
                                    <select name="id_glavn_user">
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
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('id_user_gl') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">% от проекта</label>

                                <div class="col-md-6">
                                    <select name="procent_seo" class="form-control">
                                        <option value="{{$users->procent_seo}}">{{$users->procent_seo}}</option>
                                        @foreach($user_all as $us)
                                            <option value="{{$us->seo_procent}}">{{$us->seo_procent}}</option>
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