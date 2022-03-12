<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - BSF </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="font-sans antialiased container ">
{{-- <div class="min-h-screen bg-gray-100"> --}}
<div class="d-flex flex-column min-vh-100 bg-gray-100">
{{-- @include('layouts.navigation') --}}

<!-- Page Heading -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid d-flex justify-content-end">
                        <div class="col-3">
                            @if (Auth::user() != null)

                                <a href="{{ route('user') }}"><img src="{{ asset('images/frame57.svg') }}"></a>

                            @else

                                <a href="{{ route('accueil') }}"><img src="{{ asset('images/frame57.svg') }}"></a>

                            @endif
                            <figure>
                            </figure>
                        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('statistic.home') }}">Statistiques</a>
          </li>
            @if (Auth::user() != null)
          <li class="nav-item">
            <a class="nav-link" href="{{ route('players') }}">Mes Joueurs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('championships') }}" >Mes championnats</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Mon compte</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown04">
              <li><a class="dropdown-item" href="{{ route('logout') }}">Se déconnecter</a></li>
              <li><a class="dropdown-item" href="{{ route('account.user',Auth::id()) }}">Gestion du compte</a></li>
            </ul>
          </li>
        </ul>
          @endif
      </div>
    </div>
  </nav>













{{--    <header class="bg-white shadow">--}}
{{--        <div class="">--}}
{{--            <header class='header bg-primary py-2 text-white'>--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-3">--}}
{{--                            @if (Auth::user() != null)--}}

{{--                                <a href="{{ route('user') }}"><img src="{{ asset('images/frame57.svg') }}"></a>--}}

{{--                            @else--}}

{{--                                <a href="{{ route('accueil') }}"><img src="{{ asset('images/frame57.svg') }}"></a>--}}

{{--                            @endif--}}
{{--                            <figure>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="col-9">--}}
{{--                            <nav class='navbar navbar-expand-lg d-flex justify-content-end'>--}}
{{--                                <ul class='navbar-nav me-right  mb-2 mb-lg-0'>--}}
{{--                                    <li class='nav-item'>--}}
{{--                                        <a class='nav-link text-white'--}}
{{--                                           href="{{ route('statistic.home') }}">Statistiques</a>--}}
{{--                                    </li>--}}
{{--                                    @if (Auth::user() != null)--}}
{{--                                        <li class='nav-item'>--}}
{{--                                            <a class='nav-link text-white' href="{{ route('players') }}">Mes--}}
{{--                                                joueurs</a>--}}
{{--                                        </li>--}}

{{--                                        <li class='nav-item'>--}}
{{--                                            <a class='nav-link text-white'--}}
{{--                                               href="{{ route('championships') }}">Mes--}}
{{--                                                championnats</a>--}}
{{--                                        </li>--}}
{{--                                        <li class='nav-item'>--}}
{{--                                            <a class='nav-link text-white'--}}
{{--                                               href="{{ route('image.upload') }}">Insérer une image</a>--}}
{{--                                        </li>--}}
{{--                                        <li class='nav-item'>--}}
{{--                                            <a class='nav-link text-white'--}}
{{--                                               href="{{ route('form.update.user', Auth::id()) }}">Mon compte</a>--}}
{{--                                        </li>--}}
{{--                                        <li class='nav-item text-white'>--}}
{{--                                            <!-- Authentication -->--}}
{{--                                            <form method="POST" action="{{ route('logout') }}">--}}
{{--                                                @csrf--}}

{{--                                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();--}}
{{--                                            this.closest('form').submit();" style="color:white">--}}
{{--                                                    {{ __('Log Out') }}--}}
{{--                                                </x-responsive-nav-link>--}}
{{--                                            </form>--}}
{{--                                        <li class="nav-item dropdown">--}}
{{--                                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown"--}}
{{--                                               role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                Link--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">--}}
{{--                                                <li><a class="dropdown-item" href="route('logout')">Se déconnecter</a>--}}
{{--                                                </li>--}}
{{--                                                <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                                                <li>--}}
{{--                                                    <hr class="dropdown-divider">--}}
{{--                                                </li>--}}
{{--                                                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}

{{--                                </ul>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </header>--}}
{{--        </div>--}}

{{--    </header>--}}

    <!-- Page Content -->
    <main class="mt-auto mb-auto">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
    {{-- Page footer --}}
    <footer class='footer mt-auto navbar bottom bg-dark  text-white py-3'>
        <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
    </footer>

</div>
</body>

</html>
