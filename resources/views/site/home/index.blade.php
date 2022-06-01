@extends('site.layouts.app')

@section('title', 'Gestão de Jogos')

@section('content')

<div class="content row"> 

    <h3><br>Produtos</h3>  

    <hr> 

    <div class="content">
    <form action="{{ route('site.search')}}" method="POST" class="form form-inline" style="margin-bottom: 10px;">
        @csrf
        <div class="input-group" style="max-width:400px;">
            <select name="category" class="form-control">
                <option value="">Categoria</option>
                {{-- Para utilizar a variavel $categories precisa criar no AppServiceProvider.php passando pra cá--}}
                @foreach ($categories as $id => $category)
                    <option value="{{ $id }}" @if (isset($filters['category']) && $filters['category'] == $id)
                        selected 
                        @endif >{{ $category }}</option>
                @endforeach
            </select>
            <input type="text" name="name" placeholder="Nome:" value="{{ $filters['name'] ?? '' }}" class="form-control">
            <button type="submit" class="btn btn-success">Pesquisar</button>
        </div>
    </form>  
    </div>

    @include('admin.includes.alerts')
 
   
   @foreach ($products as $product)
        <div class="card mx-auto" style="width: 12rem; margin:7px;" >
            @if ($product->photo)
            <a style="text-decoration:none" href="{{ route('site.show', $product->id)}}"><img style="max-width: 100%; height: auto;" src="{{ URL("storage/{$product->photo}") }}" class="card-img-top" alt="{{ $product->name }}"></a>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->category->title??null }}</h5>
                <p class="card-text" style="max-height:50px;">{{ $product->name }}</p>    
            </div>
            <span style="text-align:center; display:block;"><a class="btn btn-outline-primary btn-sm" href="{{ route('site.show', $product->id)}}">
            Detalhes</a></span>
        </div>  
    @endforeach

</div>
 
        {{-- Verifica se existe a variável filters do método search passando pra cá appends($filters)--}}
        @if (isset($filters))
            {!! $products->appends($filters)->links("pagination::bootstrap-4") !!} 
        @else
            {!! $products->links("pagination::bootstrap-4") !!} 
        @endif
    
@stop
