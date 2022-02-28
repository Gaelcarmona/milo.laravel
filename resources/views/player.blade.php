<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <div class="row">
            <div class="col-6 padding">
                {{-- <figure> --}}
                    <img src="../images/players.jpg" alt="">
                {{-- </figure> --}}

            </div>
            <div class="col-6">
                <nav aria-label="Breadcrumb" class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('user') }}">Accueil</a></li>
                        <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                        <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                    </ul>
                </nav>
                <p></p>
                <h1>Les decks de {{ $player->pseudo }}</h1>
                <table class='col-12 bg-main'>
                    <thead class='text-white bg-dark'>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                        @foreach ($decks as $deck)
                            <tr>
                                <td>{{ $deck->id }}</td>
                                <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a></td>
                                <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>
                                <td><a href="{{ route('delete.deck', $deck->id) }}"
                                        onclick="
                            var result = alert('Vous ne pouvez pas supprimer ce deck alors que des résultats lui sont associés');return false">supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('form.deck', ['id' => $player->id]) }}">Créer un deck</a>
            </div>
        </div>
    </main>
</x-app-layout>
