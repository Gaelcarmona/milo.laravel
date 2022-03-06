<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $matchBread->championship_id) }}">{{ $matchBread->championship->title }}</a>
                </li>
                <li>
                    <a href="{{ route('displayMatchProfile',$matchBread->id ) }}">{{ $matchBread->title }}</a>
                </li>
                <li><span aria-current="page">Entrer un résultat</span>
                </li>
            </ul>
        </nav>
        <form action="{{route('insert.result')}}" class='mx-5 mt-5' method='post'>
            @csrf
            <div>
                <label for="user_id" class="form-label">Nom du joueur <span
                        class="small text-secondary">(Obligatoire)</span></label>
                <select
                    id="user_id"
                    name="user_id">
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
                    value="{{ $match_id }}"
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
                </select>
            </div>
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
        <script src="{{ asset('js/createResults.js') }}"></script>
    </main>
</x-app-layout>
