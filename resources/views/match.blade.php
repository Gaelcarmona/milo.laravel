<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="../images/frame57.svg">
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
            <p>hello</p>
            <p>Coucou je suis le match "{{ $match->title }}"</p>
            <p>Mon id est le {{ $match->id }}</p>
            <p>j'ai été créé le {{ $match->created_at }}</p>
            <p>J'appartiens au championnat
                nommé {{ $match->championship->title }} ayant pour id
                le n° {{ $match->championship_id }}</p>
            <p></p>


            <table>
                <thead>
                <th>ID</th>
                <th>Place</th>
                <th>Joueur</th>
                <th>Deck</th>
                <th>Joueurs éliminés</th>
                <th>Score</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{$result->id}}</td>
                        <td>{{$result->place}}</td>
                        <td>{{ $result->user->pseudo }}</td>
                        <td>{{ $result->deck->title }}</td>
                        <td>
                            @foreach($killed_players as $killed_player)
                                @if($killed_player->result_id === $result->id)
{{--                                    @dd($killed_player->user->pseudo);--}}
                                    <a href="{{ route('delete.kill', [ 'result_id'=> $result->id, 'user_killed_id' => $killed_player->user->id] ) }}">{{ $killed_player->user->pseudo }}</a>
                                    <br>
                                @endif
                            @endforeach
                            <a href="{{ route('form.kill',[ 'result_id'=> $result->id, 'match_id' => $match->id ]) }}">+</a>
                        </td>
                        <td>{{$result->score}}</td>
                        <td>
                            <a href="{{ route('editForm.result',['match_id' => $match->id, 'user_id'=>$result->user_id, 'championship_id'=> $match->championship_id, 'id' => $result->id] ) }}">modifier</a>
                        </td>
                        <td>
                            <a href="{{ route('delete.result', [ 'championship_id'=> $match->championship_id, 'id' => $result->id] ) }}">supprimer</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ route('form.result', ['match_id' => $match->id, 'championship_id'=> $match->championship_id]) }}">Entrer
                un résultat</a>


        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
