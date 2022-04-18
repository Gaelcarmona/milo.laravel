@section('title', $match->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('championships') }}">Mes championnats</a></li>
          <li class="breadcrumb-item"><a href="{{ route('displayChampionshipProfile', $match->championship_id) }}">{{ $match->championship->title }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $match->title }}</li>
        </ol>
      </nav>
        <table class='col-12 bg-main table w-100'>
            <thead class='text-white bg-dark'>
            <th class="d-none d-md-table-cell">Place</th>
            <th>Joueur</th>
            <th class="d-none d-md-table-cell">Deck</th>
            <th>a éliminé</th>
            <th>Score</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td class="d-none d-md-table-cell">{{$result->place}}</td>
                    <td>{{ $result->user->pseudo }}</td>
                    <td class="d-none d-md-table-cell">{{ $result->deck->title }}</td>
                    <td>
                        @foreach($killed_players as $killed_player)
                            @if($killed_player->result_id == $result->id)
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
        <a class="btn btn-primary mb-1 mt-1 bg-info" href="{{ route('form.result', ['match_id' => $match->id, 'championship_id'=> $match->championship_id]) }}">Entrer
            un résultat</a>
</x-app-layout>
