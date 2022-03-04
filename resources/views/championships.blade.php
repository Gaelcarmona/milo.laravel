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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($championships as $championship)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/small') }}/{{ isset($championship->image->url) ? $championship->image->url  : 'championships.jpg' }}" alt="">
                        <div class="card-body">
                            <p class="card-text">{{ $championship->title }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('displayChampionshipProfile', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                    <a role="button" href="{{ route('editChampionship', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Modifier</a>
                                    <a role="button" href="{{ route('championship.delete', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
{{--        <table class='col-12 bg-main'>--}}
{{--            <thead class='text-white bg-dark'>--}}
{{--            <th>ID</th>--}}
{{--            <th>Titre</th>--}}
{{--            <th>Modifier</th>--}}
{{--            <th>Supprimer</th>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($championships as $championship)--}}
{{--                <tr>--}}
{{--                    <td>{{ $championship->id }}</td>--}}
{{--                    <td>--}}
{{--                        <a href="{{ route('displayChampionshipProfile', $championship->id) }}">{{ $championship->title}}</a>--}}
{{--                    </td>--}}
{{--                    <td><a href="{{ route('editChampionship', $championship->id) }}"> modifier</a></td>--}}
{{--                    <td><a href="{{ route('championship.delete', $championship->id) }}">supprimer</a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
    </main>

</x-app-layout>
