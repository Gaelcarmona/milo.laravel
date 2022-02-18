<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-black'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="images/frame57.svg">
                        </figure>
                    </div>
                    <div class="col-9">
                        <nav class='navbar navbar-expand-lg'>
                            <ul class='navbar-nav me-right  mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    {{--                                <form action="{{route('logout')}}" method="post">--}}
                                    {{--                                <button type="submit">Se déconnecter</button>--}}
                                    {{--                                </form>--}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="underline text-sm text-gray-600 hover:text-gray-900">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link'>Se connecter</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <body>
        <main>
            <div>
                <div class="statistiques row">
                    <div class="col-6">
                        <figure>
                            <img src="images/accueilwallpaper.jpg">
                        </figure>
                    </div>
                    <div class="col-6">
                        <h1 class="text-center">Mes statistiques</h1>
                    </div>
                </div>
                <div class="joueurs row">
                    <div class="col-6">
                        <h1 class="text-center">Mes joueurs</h1>
                        <div>
                            <a href="{{ route('createplayer') }}">Créer un joueur</a>
                            <a href="{{ route('players') }}">Voir mes joueurs</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <figure>
                            <img src="images/accueilwallpaper.jpg">
                        </figure>
                    </div>
                </div>
                <div class="championnats row">
                    <div class="col-6">
                        <figure>
                            <img src="images/accueilwallpaper.jpg">
                        </figure>
                    </div>
                    <div class="col-6">
                        <h1 class="text-center">Mes championnats</h1>
                        <div>
                            <a href="{{route('create.championship')}}">Créer un championnat</a>
                            <a href="{{ route('championships') }}">Voir mes championnats</a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <!--   --><?php //dd($data = Session::all()); ?>
        {{--<!--  --><?php // dd($session_id = Session::getId()); ?>--}}
        {{--@dd(Auth::id()); --}}
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
