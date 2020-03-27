<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pet It</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body style="background-color:var(--primary);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mh-10 fixed-top" style="box-shadow: rgba(0, 0, 0, 0.50) 0px 9px 7px 0px !important;" >
            <div class="w-100 d-flex ml-1 mr-1 d-flex align-items-center">
             
                <!-- Logo -->
                <a class="navbar-brand bg-info d-flex align-items-center pr-3 pl-1 rounded text-white mr-5" style="height:2.5rem;" href="{{ url('/') }}">                    
                    <img class="mh-100" src="/images/Logo_01.png" />
                    <div class="nav-link p-0 pl-1 pr-1 small">
                        HOME
                    </div>
                </a>
        
                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item ml-3">
                        <a class="nav-link bg-info rounded text-white" href="{{ url('/users') }}">GET ALL USERS </a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link bg-info rounded text-white" href="{{ url('/animals')  }}">GET ALL ANIMALS</a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="nav-link bg-info rounded text-white" href="{{url('/user/create')  }}">CREATE A NEW USER</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link bg-info rounded text-white" href="{{ url('/animal/create') }}">CREATE A NEW ANIMAL</a>
                    </li>
                </ul>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- TODO change users auth -->
                            <li class="nav-item">
                                <a class="nav-link bg-info rounded text-white" href="{{ route('login') }}">{{ __('LOGOUT') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item ml-4">
                                    <a class="nav-link bg-info rounded text-white" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->user_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="mt-5" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
            @yield('content')
            </div>
        </main>

    </div>
</body>
</html>
