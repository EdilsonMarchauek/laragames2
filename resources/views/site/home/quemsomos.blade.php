@extends('site.layouts.details')

@section('title', 'Detalhes do jogo { $product->name }')

@section('content')

<div class="container">

    <br>

    <p>A <strong>Luna Design</strong> é uma agência digital especializada em soluções para Internet e Marketing Digital.</p>
    <p>Contamos com profissionais qualificados e experientes com formação nas áreas de Marketing, Web Design, Programação e Sistemas para Internet, Fotografia e Design Gráfico, com mais de 10 anos de experiência.</p>
    <p>Oferecemos a todos os nossos clientes atendimento personalizado e serviços de qualidade.</p>

   <strong>Entre nossos serviços estão:</strong>
   
   <br>
   
   <ul>
       <li>Desenvolvimento de web sites responsivos, editáveis e layouts personalizados;</li>
       <li>Lojas virtuais em plataforma segura integrada com Correios e Pag Seguro;</li>
       <li>Criação de Logomarcas;</li>
       <li>Criação e administração de campanhas de Publicidade no Google;</li>
       <li>Fotografia de Produtos;</li>
       <li>E-mail Marketing;</li>
       <li>Hospedagem de Web Sites;</li>
       <li>Registro de domínios.</li>
   </ul>   
    
    Somos parceiros comerciais do maior datacenter da América Latina e também especializados em administração de campanhas de publicidade on-line.
    <a href="{{ route('email') }}">Entre em Contato</a> conosco e saiba mais sobre nossos serviços!

</div>

@include ('site.layouts.footer')

@endsection



