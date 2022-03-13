@section('title', 'Créer un match')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('players') }}">Mes joueurs</a></li>
          <li class="breadcrumb-item"><a href="{{ route('displayPlayerProfile', $player->id) }}">{{ $player->pseudo }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Créer un deck</li>
        </ol>
      </nav>
        <form action="{{route('insert.deck')}}" class='mx-5 mt-5' method='post'>
            @csrf
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
                    name='user_id'
                    required
                    value="{{ $player->id }}"
                >
            </div>
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
