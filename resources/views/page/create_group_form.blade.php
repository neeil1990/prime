@extends('layouts.main')

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить группу</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/create-groups') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Специальность</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="specialnost" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Уровень</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="level" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Оклад</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="oklad" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% по SEO</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_seo" value="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">% по Контексты</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="procent_context" value="">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Добавить
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