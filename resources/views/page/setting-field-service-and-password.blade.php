@extends('layouts.main')


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-5">
                <h4><a href="/service-and-password"> << Back</a></h4>
            </div>
        </div>

        <div class="row">

            <div class="col-md-5">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Настройка полей таблицы Сервисы & Пароли</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>Поле</th>
                                <th>Состояние</th>
                            </tr>


                            @foreach($settings_sield as $field)
                                <tr>
                                    <td>{{$field->name}}</td>
                                    <td>
                                        вкл. <input type="radio" class="radio_sc" table_value="{{$field->table_value}}" name="{{$field->field}}" value="1" @if($field->value == '1') checked @endif style="margin-left: 9.04px;"><br>
                                        выкл. <input type="radio" class="radio_sc" table_value="{{$field->table_value}}" name="{{$field->field}}" @if($field->value == '0') checked @endif value="0">
                                    </td>
                                </tr>
                            @endforeach


                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <h4><a href="/service-and-password"> << Back</a></h4>
            </div>
        </div>

    </section>

    <script>

        $(function(){

            $('.radio_sc').change(function(){
                var value = $(this).val();
                var name = $(this).attr('name');
                var table_value = $(this).attr('table_value');

                $.ajax({
                    url: '/update-setting-field', //Адрес подгружаемой страницы
                    type: "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: 'value=' + value + '&name=' + name + '&table_value=' + table_value + '',
                    success: function (response) {
                        console.log(response);
                    }
                });

            })


        });

    </script>

@stop