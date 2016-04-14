@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update-groups') }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя</label>

                                <div class="col-md-6">
                                    <select name="id_user" class="form-control">
                                            <option value="{{$users->id_user}}">{{$users->name}}</option>
                                            <option value="" disabled="disabled"></option>
                                        @foreach($users_all as $ul)
                                            <option value="{{$ul->id}}">{{$ul->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Специальность</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="specialnost" value="{{$users->specialnost}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$users->id}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Уровень</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="level" value="{{$users->level}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Оклад</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="oklad" value="{{$users->oklad}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% по SEO</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo" value="{{$users->procent_seo}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% по Контексты</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_context" value="{{$users->procent_context}}">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Изменить
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