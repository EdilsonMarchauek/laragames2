@extends('adminlte::page')

@section('title', 'Gestão de Produtos')

@section('content_header')

    <span style="font-size: 20px;"><a href="{{ route('products.create') }}" class="btn btn-success">Add</a> 
        Produto
    </span>
  
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}"> Produtos</a></li>
        
    </ol>   
@stop

@section('content')
    <div class="content row">

        <div class="card card-outline card-success" >
            <div class="box-body" style="padding: 10px">
                <form action="{{ route('products.search')}}" method="POST" class="form form-inline">
                    
                    @csrf
                        <select name="category" class="form-control">
                            <option value="">Categoria</option>
                            {{-- Para utilizar a variavel $categories precisa criar no AppServiceProvider.php passando pra cá--}}
                            @foreach ($categories as $id => $category)
                                <option value="{{ $id }}" @if (isset($filters['category']) && $filters['category'] == $id)
                                    selected 
                                    @endif >{{ $category }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="name" placeholder="Nome:" class="form-control" value="{{ $filters['name'] ?? '' }}">
                        <button type="submit" class="btn btn-success">Pesquisar</button>  

                    @if (isset($filters))
                        <a href="{{ route('products.index') }}"> (x) Limpar Resultados da Pesquisa</a>
                    @endif

                </form>
            </div>
        </div>

        <div class="card card-outline card-success">
            <div class="box-body">

                @include('admin.includes.alerts')
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="100">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th width="200px" scope="col">Ações</th>
                        </tr>                   
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td valign="center">
                                @if ($product->photo && Storage::exists($product->photo))
                                <a style="text-decoration:none" href="{{ route('site.show', $product->id)}}">
                                <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}"></a>
                                @endif
                            </td>  
                            <td style="vertical-align:middle;">{{ $product->name }}</td>
                            <td style="vertical-align:middle;">{{ $product->category->title??null }}</td>
                            <td style="vertical-align:middle;">
                                <a style="text-decoration:none" href="{{ route('products.edit', $product->id)}}" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                                <a style="text-decoration:none" href="{{ route('products.show', $product->id)}}" class="btn btn-outline-secondary btn-sm">
                                    Detalhes
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

                 {{-- Verifica se existe a variável filters do método search passando pra cá appends($filters)--}}
                 @if (isset($filters))
                     {!! $products->appends($filters)->links("pagination::bootstrap-4") !!} 
                 @else
                    {!! $products->links("pagination::bootstrap-4") !!} 
                 @endif
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


 


