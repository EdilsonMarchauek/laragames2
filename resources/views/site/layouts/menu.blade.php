<!-- Left Side Of Navbar -->
<ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size:16px;">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('site.inicio') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('site.quemsomos') }}">Quem Somos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('site.faleconosco') }}">Fale Conosco</a>
        </li>
                    
</ul>
<ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size:14px;">
       <li class="nav-item">
            <a class="flex-sm-fill text-sm-center nav-link">Tel: (41) 3779-1322</a>
       </li>    
       <li class="nav-item">
           <a class="flex-sm-fill text-sm-center nav-link"><img src="{{URL::asset('/imgs/whatts.png')}}" alt="contatowhats"> (41) 9 9751-8499</a>
       </li>    
</ul>