<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $championship->id) }}">{{ $championship->title }}</a>
                </li>
                <li><span aria-current="page">Créer un match</span>
                </li>
            </ul>
        </nav>
        <form action="{{route('insert.match')}}" class='mx-5 mt-5' method='post'>
            @csrf
            {{--        @dd($player);--}}
            <div class='mb-3'>
                <label for='pseudo' class='form-label fw-bold px-3'>Titre</label>
                <input
                    type='text'
                    name='title'
                    required
                >
                @if($errors->has('title'))
                    <p>Le champ « title » a une erreur</p>
                    <p>{{$errors->first('title')}}</p>
                @endif
                <input
                    type='hidden'
                    name='championship_id'
                    required
                    value="{{ $championship->id }}"
                >
            </div>
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
    </main>
</x-app-layout>
