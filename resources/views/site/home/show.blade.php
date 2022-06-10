@extends('site.layouts.details')

@section('title', 'Detalhes do jogo { $product->name }')

@section('content_header')
    <span style="font-size: 20px;">
        Jogo: {{ $product->name }}
    </span>
@stop

@section('content')

<div class="float-sm-start" style="padding-right:5%; margin-top:3%;">
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" width="300">
      <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      </ol>
      <div class="carousel-inner" style="max-width:300px;">   
          <div class="carousel-item active" >
            @if ($product->photo && Storage::exists($product->photo))
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

{{-- 
@if ($product->photo)
<img width="130" height="165" class="img-fluid img-thumbnail" src="{{ URL("storage/{$product->photo}") }}" alt="{{ $product->name }}">
@endif --}}

<div class="float-md-start" style="max-width: 310px; border:transparent; margin-top:3%;"> 
  <div class="card border-secondary mb-3">
      <div class="card-header">
        ID: {{ $product->id }} - Detalhes do produto
      </div>  
      <div class="card-body text-secondary">
        <h5 class="card-title">Nome: {{ $product->name }}</h5>
        <p class="card-text"></p>
        <p class="card-text">Categoria: {{ $product->category->title }}</p>
        <p class="card-text">Descrição: {{ $product->description }}</p>
    </div>
      <div class="card-footer bg-transparent border-transparent">
        {{-- Informar número do whatss app --}}
        <a href="https://api.whatsapp.com/send?phone=5541997518499&amp;text=Olá gostaria de uma informação sobre o {{ $product->id . ' - ' . $product->name }}" target="_blank" rel="noopener noreferrer"><img src="{{URL::asset('/imgs/contatowhats.png')}}" alt="contatowhats" class="whatsapp"></a>
        <a href="{{ route('orcamento', $product->id) }}" class="btn" style="background-color: #03a9f4; color: white;">Solicitar Orçamento</a> 
        <a href="{{ route('site.inicio') }}" class="btn btn-success">Voltar</a> 
    </div>
    </div>
</div>
<br>   

{{-- <button type="button" class="btn" style="background-color: #03a9f4; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal">Solicitar Orçamento</button> --}}

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>     --}}

@endsection



 


