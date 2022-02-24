<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="../../images/frame57.svg">
                        </figure>
                    </div>
                    <div class="col-9">a
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
        <body id="test">
        <main>
            {{--            @dd($match_id);--}}
            <p>Modification de résultat pour {{ \App\Models\User::where('id',$user_id)->first()->pseudo }} </p>
{{--            <p>Modification de résultat pour {{ \App\Models\User::where('id',$user_id)->first()->pseudo }} </p>--}}
{{--            <p>dans le match {{ \App\Models\Matchs::where('id',$match_id[0]->id)->first()->title }}</p>--}}
            {{--            <p>{{ $match_id[0]->id }}</p>--}}
            <form action="{{route('update.result')}}" class='mx-5 mt-5' method='post'>
                @csrf

                <input
                    type='hidden'
                    name='match_id'
                    required
                    value="{{ $match_id }}"
                >
                <input
                    type='hidden'
                    name='id'
                    required
                    value="{{ $id }}"
                >
                </div>
                <div>
                    <label for="place" class="form-label">Placement du joueur <span class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="place"
                        name="place">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div id="decks">
                    <label for="deck_id" class="form-label">Nom du deck <span
                            class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="deck_id"
                        name="deck_id">
                        <option value="">Choisis un deck</option>
                        @foreach($decksUser as $deck)
                            <option

                                value="{{ $deck->id }}">
                                {{$deck->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
        <script src="{{ asset('js/createResults.js') }}"></script>
    </x-slot>

</x-app-layout>
