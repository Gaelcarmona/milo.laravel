<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="images/frame57.svg">
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
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
