@extends('layouts.main')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменить ссылки пользователя</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit-add-link-user') }}">
                            {!! csrf_field() !!}


                            <div class="form-group">
                                <label class="col-md-4 control-label">Название</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{$data->name}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ссылка</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="link" value="{{$data->link}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Позиция</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="position" value="{{$data->position}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                         Изменить
                                    </button>
                                    <a class="btn btn-link" href="/">Back</a>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/delite-link-user') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-primary">
                                 Удалить
                            </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

@stop