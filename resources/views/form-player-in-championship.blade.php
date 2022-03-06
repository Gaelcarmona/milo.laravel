<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $championship_id) }}">{{ $championshipBread->title }}</a>
                </li>

                <li><span aria-current="page">Ajouter un joueur au championnat</span>
                </li>
            </ul>
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
    </main>
</x-app-layout>
