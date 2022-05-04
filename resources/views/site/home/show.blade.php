@extends('site.layouts.app')

@section('title', 'Detalhes do jogo { $product->name }')

@section('content_header')
    <span style="font-size: 20px;">
        Jogo: {{ $product->name }}
    </span>

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Jogos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}"> Detalhes</a></li>
    </ol>  
@stop

@section('content')

<div align="left">
    @if ($product->photo)
    <img src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
    @endif
</div>

<hr>

    <div class="content row">
        <div class="box">
            <div class="box-body">
                <p><strong>ID: </strong>{{ $product->id }}</p>
                <p><strong>Nome: </strong>{{ $product->name }}</p>
                <p><strong>Console: </strong>{{ $product->category->title }}</p>
                <p><strong>Descrição: </strong>{{ $product->description }}</p>

                <hr>

                <a href="{{ route('site.inicio') }}" class="btn btn-success">Voltar</a>
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


 


