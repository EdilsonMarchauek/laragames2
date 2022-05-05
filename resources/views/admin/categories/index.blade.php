@extends('adminlte::page')

@section('title', 'Lista de Console')

@section('content_header')

    <span style="font-size: 20px;"><a href="{{ route('categories.create') }}" class="btn btn-success">Add</a> 
        Console
    </span>
  
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Consoles</a></li>      
    </ol>   
@stop

@section('content')
    <div class="content row">

        <div class="card card-outline card-success" >
            <div class="box-body" style="padding: 10px">
                <form action="{{ route('categories.search') }}" class="form form-inline" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="Nome:" class="form-control" value="{{ $data['title'] ?? '' }}">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                </form>

                @if (isset($data))
                    <a href="{{ route('categories.index') }}">(x) Limpar Resultados da Pesquisa</a>
                @endif 
            </div>
        </div>

        <div class="card card-outline card-success">
            <div class="box-body">

                @include('admin.includes.alerts')
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Console</th>
                            <th width="200px" scope="col">Ações</th>
                        </tr>                   
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td style="vertical-align:middle;">{{ $category->title }}</td>
                            <td style="vertical-align:middle;">
                                <a style="text-decoration:none" href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-primary">
                                    Editar
                                </a>
                                <a style="text-decoration:none" href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-secondary">
                                    Detalhes
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                      
                  @if (isset($data))
                        {{ $categories->appends($data)->links("pagination::bootstrap-4") }}
                  @else
                        {{ $categories->links("pagination::bootstrap-4") }}
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


 


