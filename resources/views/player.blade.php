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
                    <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                    <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                </ul>
            </nav>
            <p>hello</p>
            <p>Coucou je m'appelle {{ $player->pseudo }}</p>
            <p>Mon id est le {{ $player->id }}</p>
            <p>j'ai été créé le {{ $player->created_at }}</p>
            @if($player->email == null)
                <p>J'ai été créé par un utilisateur, je n'ai donc ni mail ni mot de passe</p>
            @else
                <p>mon email est {{ $player->email }}</p>
            @endif

            <h1>Les decks de {{ $player->pseudo }}</h1>
            {{--@dd($decks);--}}

            <table class='col-12 bg-main'>
                <thead class='text-white bg-dark'>
                <th>ID</th>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
                <tbody>
                @foreach($decks as $deck)
                    <tr>
                        <td>{{$deck->id}}</td>
                        <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title}}</a></td>
                        <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>
                        <td><a href="{{ route('delete.deck', $deck->id) }}">supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table class='col-12 bg-main'>

            <a href="{{ route('form.deck', ['id' => $player->id]) }}">Créer un deck</a>

        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
