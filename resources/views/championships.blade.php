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
                        <td><a href="{{ route('displayChampionshipProfile', $championship->id) }}">{{ \App\Models\Championship::where('id',$championship->id)->first()->title}}</a></td>
                        <td><a href="{{ route('editChampionship', $championship->id) }}"> modifier</a></td>
                        <td><a href="{{ route('championship.delete', $championship->id) }}">supprimer</a></td>
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
