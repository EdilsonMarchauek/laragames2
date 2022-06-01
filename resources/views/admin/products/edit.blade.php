@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')

    <span style="font-size: 20px;">
        Editar Produto: {{ $product->name }}
    </span>
  
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.edit', $product->id) }}"> Editar</a></li>
        
    </ol>   
@stop

@section('content')
<div class="content row">

    {{-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($images as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                <img width="800" height="100" src="{{ URL("{$slider->image}") }}" class="d-block w-100"  alt="..."> 
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}
    
    <div align="left" style="padding-bottom:10px">
    <hr>   
    Capa:<br>        
        @if ($product->photo)
        <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
        @endif 
    <hr>       
    Fotos:<br>          
        @foreach($images as $img)
            @if ($img->image)
                <img width="130" height="165" src="{{ URL("storage/{$img->image}") }}" alt="{{ $product->name }}">
            @endif
        @endforeach
    </div> 

    <div class="d-flex flex-row">
        <div class="p-2">
        <form action="{{ route('products.fotodestroyall', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Apagar todas</button>  
        </form>
        </div>    
        <div class="p-2">
        <form action="{{ route('products.fotodestroylast', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Apagar última</button>  
        </form> 
        </div> 
    </div>   

    <hr>
    
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


 


