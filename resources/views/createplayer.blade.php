@section('title', 'Créer un joueur')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('players') }}">Mes joueurs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Créer un joueur</li>
        </ol>
      </nav>
            <form action="{{route('insert.player')}}" class='mx-5 mt-5 ' method='post'>
                @csrf
                <div class=''>
                    <label for='pseudo' class='form-label fw-bold px-3'>Pseudo</label>
                    <input
                        type='text'
                        name='pseudo'
                        required
                    >
                    @if($errors->has('pseudo'))
                        <p>Le champ « pseudo » a une erreur</p>
                        <p>{{$errors->first('pseudo')}}</p>
                    @endif
                </div>
                <button type='submit' class='btn p btn-primary mb-1 mt-1 mx-3 bg-info my-3'>Envoyer</button>
            </form>
</x-app-layout>
