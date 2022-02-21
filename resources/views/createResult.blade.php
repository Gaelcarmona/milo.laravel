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
        <body id="test">
        <main>
            <form action="{{route('insert.result')}}" class='mx-5 mt-5' method='post'>
                @csrf
                <div>
                    <label for="user" class="form-label">Nom du joueur <span
                            class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="user"
                        name="user">
                        <option value="">Choisis un joueur</option>

                        @foreach($users as $user)
                            <option data-url="{{ route('select.deck', ['user' => $user->id]) }}" value="{{$user->id}}">
                                {{ $user->pseudo}}
                            </option>
                        @endforeach
                    </select>
                    <input
                        type='hidden'
                        name='match_id'
                        required
                        {{--                        value="{{ $match->id }}"--}}
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
                    <label for="deck" class="form-label">Nom du deck <span
                            class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="deck"
                        name="deck">
                        <option value="">Choisis un deck</option>
{{--                        @foreach($decksUser as $deck)--}}
{{--                            <option--}}

{{--                                value="{{ $deck->id }}">--}}
{{--                                {{$deck->title}}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
{{--        <script>--}}
{{--            window.listOfDecks = @json($decksUser)--}}
{{--        </script>--}}
        <script src="{{ asset('js/createResults.js') }}"></script>
    </x-slot>

</x-app-layout>
