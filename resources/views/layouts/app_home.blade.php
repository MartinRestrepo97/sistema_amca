<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script src="{{ asset('js/pagina.js') }}" defer></script>    
    <style>
        .select2-selection--multiple {
            min-width: 25em !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm shadow sticky-top">
            <div class="container">
                <a class="navbar-brand mt-1" href="{{ url('/') }}">
                    <img src="{{ url('/') }}/img/logo.png" class="img-fluid logo-principal" alt="Responsive image">
                </a>
                <a class="navbar-brand" href="{{ url('/') }}">AMCA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                       
                       
                    </ul>
                    <!--<form method="GET" action="{{ url('/') }}/pagina_resultados" class="form-inline my-2 my-lg-0"
                    onSubmit="if(document.getElementById('texto_busqueda') == ''){ return false; }">-->
                    <input class="form-control mr-sm-2" id="texto_busqueda" name="texto_busqueda" type="search" placeholder="Buscar.." aria-label="Search"
                    @if(isset($texto_busqueda)) 
                        value="{{$texto_busqueda}}"
                    @endif>

                    <button class="btn btn-primary my-2 my-sm-0" type="button" onclick="if(document.getElementById('texto_busqueda').value!=''){ document.location.href='{{ url('/') }}/pagina_resultados/'+document.getElementById('texto_busqueda').value; }else{ alert('Digite el valor de la búsqueda');}">Buscar</button>
                    <!--</form>-->
                </div>
            </div>
        </nav>

        <main class="py-1">
            @yield('content')
        </main>
        <!----footer---->
<footer id="footer" class="bg-secondary pb-4 pt-4">
    <div class="container">
        <div class="row text-center">
          <div class="col-12">
            <h3>Sitio desarrollado por <b>MARTIN ERNESTO RESTREPO PALACIOS</b></h3>
          </div>   
          <div class="col-12">
            Programa de Análisis y Desarrollo de Software
          </div> 
          <div class="col-12">
            SERVICIO - Nacional de Aprendizaje - SENA
          </div>
          <div class="col-12">
            Puerto Asís - Putumayo 
          </div>
          <div class="col-12">
            2025
          </div>
        </div>
    </div>
</footer>
<!---/footer--->
    </div>
</body>
</html>
