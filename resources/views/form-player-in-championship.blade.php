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
                        <a href="{{ route('displayChampionshipProfile', $championship_id) }}">{{ $championshipBread->title }}</a>
                    </li>

                    <li><span aria-current="page">Ajouter un joueur au championnat</span>
                    </li>
                </ul>
            </nav>
            <form action="{{route('insert.player.in.championship')}}"
                  class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
                    <input
                        type='hidden'
                        name='championship_id'
                        value="{{ $championship_id }}"
                    >
                </div>
                <div>
                    <label for="user_id" class="form-label">Nom du joueur <span
                            class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="user_id"
                        name="user_id">
                        <option value="">Choisis un joueur</option>
                        <option value="{{Auth::id()}}">{{Auth::user()->pseudo}}</option>
                        {{--                            @dd($associateUsers);--}}
                        @foreach($associateUsers as $associateUser)
                            <option value="{{$associateUser->user_id}}">
                                {{ $associateUser->user->pseudo}}
                            </option>
                        @endforeach
                    </select>
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
