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
                        <td>{{$associateUser->id}}</td>
                        <td>
                            <a href="{{ route('displayPlayerProfile', $associateUser->id) }}">{{ $associateUser->pseudo}}</a>
                        </td>
                        <td><a href="{{ route('editPlayer', $associateUser->id) }}"> modifier</a></td>
                        <td><a href="{{ route('player.delete', $associateUser->id) }}">supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>
</x-app-layout>
