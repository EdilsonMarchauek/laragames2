@extends('adminlte::page')

@section('title', 'Editar Jogo')

@section('content_header')

    <span style="font-size: 20px;">
        Editar Jogo: {{ $product->name }}
    </span>
  
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Jogos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.edit', $product->id) }}"> Editar</a></li>
        
    </ol>   
@stop

@section('content')
<div class="content row">

    <div align="left" style="padding-bottom:10px">
        @if ($product->photo)
        <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
        @endif
    </div>
    
    <div class="card card-outline card-success" >
        <div class="box-body" style="padding: 10px">

            @include ('admin.includes.alerts')
           
            {{-- <form action="{{ route('products.update', $product->id) }}" method="POST" class="form">
                @method('PUT')
                @include ('admin.products._partials.form')
            </form> --}}

            {{ Form::model($product, ['route' => ['products.update', $product->id ], 'class' => 'form', 'enctype' => 'multipart/form-data']) }}
                @method('PUT')
                @include ('admin.products._partials.form')
            {{ Form::close() }}    

        </div>
    </div>
</div>
   
@stop

@section('css')
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/js/app.js"></script>
@stop


 


