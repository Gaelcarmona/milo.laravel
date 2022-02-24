<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
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
                                    <a class='nav-link'>Statistiques</a>
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
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                    <li>
                        <a href="{{ route('displayChampionshipProfile', $championship->id) }}">{{ $championship->title }}</a>
                    </li>
                    <li><span aria-current="page">Créer un match</span>
                    </li>
                </ul>
            </nav>
            <form action="{{route('insert.match')}}" class='mx-5 mt-5' method='post'>
                @csrf
                {{--        @dd($player);--}}
                <div class='mb-3'>
                    <label for='pseudo' class='form-label fw-bold px-3'>Titre</label>
                    <input
                        type='text'
                        name='title'
                        required
                    >
                    @if($errors->has('title'))
                        <p>Le champ « title » a une erreur</p>
                        <p>{{$errors->first('title')}}</p>
                    @endif
                    <input
                        type='hidden'
                        name='championship_id'
                        required
                        value="{{ $championship->id }}"
                    >
                </div>
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
