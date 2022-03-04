<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $match->championship_id) }}">{{ $match->championship->title }}</a>
                </li>
                <li><span aria-current="page">{{ $match->title }}</span></li>
            </ul>
        </nav>
        <table class='col-12 bg-main'>
            <thead class='text-white bg-dark'>
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
        <a class="btn btn-primary bg-info" href="{{ route('form.result', ['match_id' => $match->id, 'championship_id'=> $match->championship_id]) }}">Entrer
            un résultat</a>
    </main>
</x-app-layout>
