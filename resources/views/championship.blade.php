@section('title', $championship->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('championships') }}">Mes championnats</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $championship->title }}</li>
        </ol>
      </nav>
        <table class='col-12 bg-main table'>
            <thead class='text-white bg-dark'>
            <th>Nom</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            </thead>
            <tbody>
            @foreach($matchs as $match)
                <tr>
                    <td>
                        <a href="{{ route('displayMatchProfile', $match->id) }}">{{ $match->title}}</a>
                    </td>
                    <td><a href="{{ route('editForm.match', $match->id) }}"> modifier</a></td>
                    <td><a href="{{ route('delete.match', $match->id) }}"
                           onclick=" var result = confirm('Êtes vous sur de vouloir supprimer le match ? Tous les résultats associés seront supprimés');return result">supprimer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a  class="btn btn-primary mb-1 mt-1 bg-info d-flex align-items-center justify-content-center" href="{{ route('form.match', ['id' => $championship->id]) }}">Créer un match</a>
        <table class='col-12 bg-main table'>
            <thead class='text-white bg-dark'>
            <th>Nom</th>
            <th>Supprimer</th>
            </thead>
            <tbody>
            @foreach($championshipUsers as $championshipUser)
                <tr>
                    <td>{{$championshipUser->pseudo}}</td>
                    <td>
                        <a href="{{ route('delete.player.in.championship', ['user_id' => $championshipUser->id ,'championship_id' => $championship->id]) }}"
                           onclick=" var championshipUserDelete = confirm('Êtes vous sur de vouloir supprimer ce joueur du championnat ? Tous les résultats associés seront supprimés');return championshipUserDelete">supprimer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary mb-1 mt-1 bg-info d-flex align-items-center justify-content-center" href="{{ route('form.player.in.championship', ['championship_id' => $championship->id]) }}">Ajouter un
            joueur au championnat</a>
</x-app-layout>
