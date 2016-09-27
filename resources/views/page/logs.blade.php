@extends('layouts.main')


@section('content')

    <style type="text/css">

        #filterTable1{
        margin: 10px 50px;
        }
        td, th {
            padding: 10px;
        }

        table tr th {
            background-color: #d3DADE;
            padding: 3px;
        }
        table tr.rowb { background-color:#CDB38B!important; }

        table tr.filterColumns td { padding:2px; }




    </style>


    <table id="filterTable1" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Проект</th><th>что сделано</th><th>Кем</th><th>Дата</th>
        </tr>
        </thead>
        <tfoot></tfoot>
        <tbody>

        @foreach($all as $a)
        <tr>
            <td>{{$a->progect}}</td><td>{{$a->what_is_done}}</td><td>{{$a->who_did}}</td><td>{{$a->created_at}}</td>
        </tr>
            @endforeach

        </tbody>
    </table>



    <script>
        $(document).ready(function() {
            $('table#filterTable1').columnFilters({alternateRowClassNames:['rowa','rowb']});
        });
    </script>



@stop