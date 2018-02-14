@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Настройка Выплат</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/save-setting-payout-context') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">  % от проекта</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="" class="form-control" name="procent_seo" value="{{$setting_payout->procent_seo}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Сохранить
                                    </button>
                                    <a class="btn btn-link" href="/project-context">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>

@stop