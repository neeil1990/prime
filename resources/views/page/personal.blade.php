@extends('layouts.main')


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                        <h3 class="box-title"> <a href="/personal/create">Добавить сотрудника</a></h3>
                            @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">№</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Сотрудник</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специализация</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Уровень</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специалист</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% от проекта SEO</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Сумма на зп</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">% от проекта контекста</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Сумма на зп</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Итог</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                        <tr role="row" class="odd">
                                            <td class=""><input type="checkbox" class="check" value="{{$user->id}}"></td>
                                            <td class="">{{$user->id}}</td>
                                            <td class="">{{$user->name}}</td>
                                            <td class="">{{$user->specialism}}</td>
                                            <td class="">{{$user->level}}</td>
                                            <td class="">{{$user->personal_specialism}}</td>
                                            <td class="">{{$user->seo_procent}}</td>
                                            <td class="">{{$user->sum_many_first}}</td>
                                            <td class="">{{$user->contecst_procent}}</td>
                                            <td class="">{{$user->sum_many_last}}</td>
                                            <td class="">{{$user->itog}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>

            <div class="row">
                @if($admin == 1)
                <div class="col-md-9">
                    <a href="" class="add_check">Выделить все |</a>
                    <a href="" style="display: none" class="old_check">Снять все |</a>
                    <a href="" class="button">Удалить |</a>
                    <a href="" class="edit">Изменить</a>
                </div>
                    @endif
            </div>

        <div class="row">
            <div class="col-md-9">
                <h3>Группы</h3>
            </div>
        </div>


        @if($admin == 1)
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title"> <a href="/groups/create">Добавить группу</a></h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">№</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специальность</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Уровень</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Оклад</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% по SEO</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">% по Контексты</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($user_groups as $user)
                                            <tr role="row" class="odd">
                                                <td class=""><input type="checkbox" class="check2" value="{{$user->id}}"></td>
                                                <td class="">{{$user->id}}</td>
                                                <td class="">{{$user->specialnost}}</td>
                                                <td class="">{{$user->level}}</td>
                                                <td class="">{{$user->oklad}}</td>
                                                <td class="">{{$user->procent_seo}}</td>
                                                <td class="">{{$user->procent_context}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>

        @endif

        <div class="row">
            @if($admin == 1)
            <div class="col-md-9">
                <a href="" class="add_check2">Выделить все |</a>
                <a href="" style="display: none" class="old_check2">Снять все |</a>
                <a href="" class="button2">Удалить |</a>
                <a href="" class="edit2">Изменить</a>
            </div>
                @endif
        </div>

    </section>

    <script>
        $(function(){






            $('.old_check').click(function() {
                $(".check").prop('checked', false);
                $(this).css('display','none');
                $(".add_check").removeAttr('style');
                return false;
            });

            $('.add_check').click(function() {

                $(".check").prop('checked', true);
                $(this).css('display','none');
                $(".old_check").removeAttr('style');
                return false;
            });


            $('.old_check2').click(function() {
                $(".check2").prop('checked', false);
                $(this).css('display','none');
                $(".add_check2").removeAttr('style');
                return false;
            });

            $('.add_check2').click(function() {

                $(".check2").prop('checked', true);
                $(this).css('display','none');
                $(".old_check2").removeAttr('style');
                return false;
            });

            $('.edit').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get(0);
                window.location.href='/personal/'+arr+'/edit';
                return false;
            });

            $('.edit2').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get(0);
                window.location.href='/groups/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();
                var url = '/delite';

                var DeliteOk = confirm("Точно удалить???");
                if(DeliteOk) {
                    $.ajax({
                        url: url, //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'arr=' + arr + '',
                        success: function (response) {

                        }
                    });
                    window.location.href = "/personal";
                }
                return false;
            });

            $('.button2').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-group';
                var DeliteOk = confirm("Точно удалить???");
                if(DeliteOk) {
                    $.ajax({
                        url: url, //Адрес подгружаемой страницы
                        type: "POST", //Тип запроса
                        dataType: "html", //Тип данных
                        data: 'arr=' + arr + '',
                        success: function (response) {

                        }
                    });
                    window.location.href = "/personal";
                }
                return false;
            });

        });

    </script>



    @stop