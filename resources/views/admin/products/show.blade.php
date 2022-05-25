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
        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" width="300">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            </ol>
            <div class="carousel-inner" style="max-width:300px;">
                @foreach($images as $key => $slider)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img src="{{ URL("storage/{$slider->image}") }}" class="d-blockw-30 "  alt="{{ URL("{$product->name}") }}"> 
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><br>
    </div>  

    <div class="float-sm-start">
        @if ($product->photo)
        <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
        @endif
        <p style="font-size: 20px;">Jogo:</p>
        <p><strong>Nome: </strong>{{ $product->name }}</p>
        <p><strong>ID: </strong>{{ $product->id }}</p>
        <p><strong>Console: </strong>{{ $product->category->title }}</p>
        <p><strong>Descrição: </strong>{{ $product->description }}</p><br>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <a type="button" href="{{ route('products.index') }}" class="btn btn-success">Voltar</a> 
            <button type="submit" class="btn btn-danger">
                Deletar {{ $product->name }}</button>  
        </form>       
    </div>

@stop

@section('css')
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/js/app.js"></script>
@stop


 


