@extends('adminlte::page')

@section('title', 'Relatório mensal de vendas')

@section('content_header')
    <span style="font-size: 20px;">
       Relatório Mensal de Vendas
    </span>

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#" class="active"> Gráficos</a></li>
    </ol> 
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">

                {{-- Renderização do gráfico     --}}
                {!! $chart->container() !!}

            </div>
        </div>
    </div>
@stop

@push('js')
    {!! $chart->script() !!}
@endpush

@section('css')
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/js/app.js"></script>
@stop


 


