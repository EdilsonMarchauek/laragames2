@extends('adminlte::page')

@section('title', 'Detalhes do jogo { $product->name }')

@section('content_header')
  

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Jogos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}"> Detalhes</a></li>
    </ol>  
@stop

@section('content')

<div class="container">

    <div class="float-sm-start" style="padding-right:5%;">
        @if ($product->photo)
        <img src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
        @endif
    </div><br>
    <div class="float-md-start">
        <p style="font-size: 20px;">Jogo:</p>
        <p><strong>Nome: </strong>{{ $product->name }}</p>
        <p><strong>ID: </strong>{{ $product->id }}</p>
        <p><strong>Console: </strong>{{ $product->category->title }}</p>
        <p><strong>Descrição: </strong>{{ $product->description }}</p><br>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <a type="button" href="{{ route('site.inicio') }}" class="btn btn-success">Voltar</a> 
            <button type="submit" class="btn btn-danger">
                Deletar {{ $product->name }}</button>  
        </form>       
    </div><br>
@stop

@section('css')
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/js/app.js"></script>
@stop


 


