@extends('adminlte::page')

@section('title', 'Detalhes do Produto { $product->name }')

@section('content_header')
  

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}"> Detalhes</a></li>
    </ol>  
@stop

@section('content')

<div class="float-sm-start" style="padding-right:5%;">
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" width="300">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner" style="max-width:300px;">   
            <div class="carousel-item active" >
              @if ($product->photo)
              <img class="d-block w-110" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
              @endif
            </div>
            @foreach($images as $key => $slider)
             <div class="carousel-item" {{$key == 0 ? 'active' : ''}}>    
                <img src="{{ URL("storage/{$slider->image}") }}" class="d-block w-110" alt="{{ URL("{$product->name}") }}"> 
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev"> 
            <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button"  data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><br>
  </div>  

    {{-- @if ($product->photo)
    <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
    @endif --}}

    <div class="float-sm-start" style="vertical-align:middle;">
        <p><strong>ID: </strong>{{ $product->id }}</p>
        <p><strong>Nome: </strong>{{ $product->name }}</p>
        <p><strong>Categoria: </strong>{{ $product->category->title }}</p>
        <p><strong>Descrição: </strong>{{ $product->description }}</p><br>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Deletar {{ $product->name }}</button>  
            <a type="button" href="{{ route('products.index') }}" class="btn btn-success">Voltar</a>     
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


 


