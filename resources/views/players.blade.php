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
                    <td>{{ Auth::id() }}</td>
                    <td><a href="{{ route('displayPlayerProfile', Auth::id()) }}">{{ Auth::user()->pseudo }}</a></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach ($associateUsers as $associateUser)
                    <tr>
                        <td>{{ $associateUser->id }}</td>
                        <td>
                            <a
                                href="{{ route('displayPlayerProfile', $associateUser->id) }}">{{ $associateUser->pseudo }}</a>
                        </td>
                        <td><a href="{{ route('editPlayer', $associateUser->id) }}"> modifier</a></td>
                        <td><a href="{{ route('player.delete', $associateUser->id) }}">supprimer</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($associateUsers as $associateUser)
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                dy=".3em">Thumbnail</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">{{ $associateUser->pseudo }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('displayPlayerProfile', $associateUser->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Voir</a>
                                    <a role="button" href="{{ route('editPlayer', $associateUser->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Modifier</a>
                                    <a role="button" href="{{ route('player.delete', $associateUser->id) }}"
                                        class="btn btn-sm btn-outline-secondary">supprimer</a>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
</x-app-layout>
