@extends('site.layouts.app')

@section('title', 'Gestão de Jogos')

@section('content')
<div class="content row">
    
<h3><br>Lista de jogos</h3>  

<hr> 

    <form action="{{ route('site.search')}}" method="POST" class="form form-inline">
        @csrf
        <div class="input-group" style="max-width:400px;">
            <select name="category" class="form-control">
                <option value="">Console</option>
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

    @include('admin.includes.alerts')
    
    <div class="card card-outline card-success">
    <div class="box-body">    
        <table class="table table-striped" style="margin-top: 20px">
            <thead>
                <tr>
                    <th scope="col" width="100">Imagem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Console</th>
                    <th width="150px" scope="col">Ações</th>
                </tr>                   
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td valign="center">
                        @if ($product->photo)
                        <a style="text-decoration:none" href="{{ route('site.show', $product->id)}}">
                        <img width="130" height="165" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}"></a>
                        @endif
                    </td>
                    <td style="vertical-align:middle;">{{ $product->name }}</td>
                    <td style="vertical-align:middle;">{{ $product->category->title??null }}</td>
                    <td style="vertical-align:middle;">
                        <a class="btn btn-outline-primary" href="{{ route('site.show', $product->id)}}">
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

