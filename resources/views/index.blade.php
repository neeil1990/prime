@extends('layouts.main')


@section('content')

    <h1>{{$sum_accaunt}}</h1>
    <h1>{{$click_accaunt}}</h1>
    <h1>{{$avgCost}}</h1>


    <section class="content">
        <div id="topvisor_GPr"></div>
    </section>

    <script type="text/javascript" src="https://topvisor.ru/js/widget/apometr/apometr.php?region_action=1&searcher=0&region_key=213&div_id=topvisor_GPr&charset=utf-8&lang=ru"></script>
    @stop
