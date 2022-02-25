<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><span aria-current="page">Mes joueurs</span></li>
                </ul>
            </nav>
            <table class='col-12 bg-main'>
                <thead class='text-white bg-dark'>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
                <tbody>
                <tr>
                    <td>{{Auth::id()}}</td>
                    <td><a href="{{ route('displayPlayerProfile', Auth::id()) }}">{{Auth::user()->pseudo}}</a></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($associateUsers as $associateUser)
                    <tr>
                        <td>{{$associateUser->user_id}}</td>
                        <td>
                            <a href="{{ route('displayPlayerProfile', $associateUser->user_id) }}">{{ $associateUser->user->pseudo}}</a>
                        </td>
                        <td><a href="{{ route('editPlayer', $associateUser->user_id) }}"> modifier</a></td>
                        <td><a href="{{ route('player.delete', $associateUser->user_id) }}">supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>
</x-app-layout>
