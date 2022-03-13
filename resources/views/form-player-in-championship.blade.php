@section('title', 'Ajouter un joueur au championnat')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('championships') }}">Mes championnats</a></li>
          <li class="breadcrumb-item"><a href="{{ route('displayChampionshipProfile', $championship_id) }}">{{ $championshipBread->title }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ajouter un joueur au championnat</li>
        </ol>
      </nav>
        <form action="{{route('insert.player.in.championship')}}"
              class='mx-5 mt-5' method='post'>
            @csrf
            <div class='mb-3'>
                <input
                    type='hidden'
                    name='championship_id'
                    value="{{ $championship_id }}"
                >
            </div>
            <div>
                <label for="user_id" class="form-label">Nom du joueur <span
                        class="small text-secondary">(Obligatoire)</span></label>
                <select
                    id="user_id"
                    name="user_id">
                    <option value="">Choisis un joueur</option>

                    <option value="{{Auth::id()}}">{{Auth::user()->pseudo}}</option>

                        {{--                            @dd($associateUsers);--}}
                    @foreach($users as $associateUser)
                        <option value="{{$associateUser->id}}">
                            {{ $associateUser->pseudo}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
