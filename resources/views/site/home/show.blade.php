@extends('site.layouts.details')

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

    <div class="float-sm-start" style="padding-right:3%;">
        @if ($product->photo)
        <img class="img-fluid img-thumbnail" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
        @endif
    </div><br>
   
    <div class="float-md-start">
      <div class="card border-secondary mb-3" style="max-width: 18rem; border:transparent;">
          <div class="card-header">ID: {{ $product->id }} - Detalhes</div>
            <div class="card-body text-secondary">
              <h5 class="card-title">Jogo: {{ $product->name }}</h5>
              <p class="card-text"></p>
              <p class="card-text">Console: {{ $product->category->title }}</p>
              <p class="card-text">Descrição: {{ $product->description }}</p>
            </div>
            <div class="card-footer bg-transparent border-transparent">
              <button type="button" class="btn" style="background-color: #03a9f4; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal">Solicitar Orçamento</button>
              <a href="{{ route('site.inicio') }}" class="btn btn-success">Voltar</a>
            </div>
        </div>
    </div><br>     

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitar Orçamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Informe seu E-mail:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Messagem:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>    
@endsection



 


