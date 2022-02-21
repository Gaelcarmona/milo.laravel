<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="../images/frame57.svg">
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
            <p>hello</p>
            <p>Coucou je suis le match "{{ $match->title }}"</p>
            <p>Mon id est le {{ $match->id }}</p>
            <p>j'ai été créé le {{ $match->created_at }}</p>
            <p>mon championnat a pour id le n° {{ $match->championship_id }}</p>


{{--                        <table>--}}
{{--                <thead>--}}
{{--                <th>ID</th>--}}
{{--                <th>Nom</th>--}}
{{--                <th>Modifier</th>--}}
{{--                <th>Supprimer</th>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($results as $result)--}}
{{--                    <tr>--}}
{{--                        <td>{{$deck->id}}</td>--}}
{{--                        <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ \App\Models\Deck::where('id',$deck->id)->first()->title}}</a></td>--}}
{{--                        <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>--}}
{{--                        <td><a href="{{ route('delete.deck', $deck->id) }}">supprimer</a></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}

            <a href="{{ route('form.result', ['match_id' => $match->id, 'championship_id'=> $match->championship_id]) }}">Entrer un résultat</a>



        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
