<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><span aria-current="page">Mes championnats</span></li>
                </ul>
            </nav>
            <table class='col-12 bg-main'>
                <thead class='text-white bg-dark'>
                <th>ID</th>
                <th>Titre</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
                <tbody>
                @foreach($championships as $championship)
                    <tr>
                        <td>{{ $championship->id }}</td>
                        <td>
                            <a href="{{ route('displayChampionshipProfile', $championship->id) }}">{{ $championship->title}}</a>
                        </td>
                        <td><a href="{{ route('editChampionship', $championship->id) }}"> modifier</a></td>
                        <td><a href="{{ route('championship.delete', $championship->id) }}">supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>

</x-app-layout>
