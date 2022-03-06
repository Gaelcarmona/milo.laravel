<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $resultBread->match->championship_id) }}">{{ $resultBread->match->championship->title }}</a>
                </li>
                <li>
                    <a href="{{ route('displayMatchProfile',$resultBread->id ) }}">{{ $resultBread->match->title }}</a>
                </li>
                <li><span
                        aria-current="page">Modification d'un résultat (celui de {{ $resultBread->user->pseudo }})</span>
                </li>
            </ul>
        </nav>
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
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
        <script src="{{ asset('js/createResults.js') }}"></script>
</x-app-layout>
