@extends('layouts.main')


@section('content')

    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        @if($admin == 1)
                        <h3 class="box-title"> <a href="/pass-context/create">Добавить</a></h3>
                            @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">*</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">№</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Имя проекта</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Специалист</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">SSA</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">FTP</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Логин</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Пароль</th>
                                        </thead>
                                        <tbody>

                                        @foreach($users as $user)
                                            <tr role="row" class="odd">
                                                <td class=""><input type="checkbox" class="check" value="{{$user->id}}"></td>
                                                <td class="">{{$user->id}}</td>
                                                <td class="">{{$user->name_project}}</td>
                                                <td class="">{{$user->name}}</td>
                                                <td class="">{{$user->ssa}}</td>
                                                <td class="">{{$user->ftp}}</td>
                                                <td class="">{{$user->login}}</td>
                                                <td class="">{{$user->password}}</td>
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
                <a href="" class="button">Удалить |</a>
                <a href="" class="edit">Изменить</a>
            </div>
            @endif
        </div>

    </section>

    <script>
        $(function(){

            $('.add_check').click(function() {
                $(".check").prop('checked', true);
                return false;
            });

            $('.edit').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get(0);
                window.location.href='/pass-context/'+arr+'/edit';
                return false;
            });


            $('.button').click(function() {
                var arr = $('input:checkbox:checked').map(function() {return this.value;}).get();

                var url = '/delite-pass-context';
                $.ajax({
                    url:     url, //Адрес подгружаемой страницы
                    type:     "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: 'arr='+arr+'',
                    success: function(response) {
                        console.log(response);
                    }
                });
                window.location.href="/pass-context";
                return false;
            });

        });

    </script>
    @stop