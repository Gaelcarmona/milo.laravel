<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li>
                    <a href="{{ route('displayChampionshipProfile', $resultBread->match->championship_id) }}">{{ $resultBread->match->championship->title }}</a>
                </li>
                <li>
                    <a href="{{ route('displayMatchProfile',$resultBread->match->id ) }}">{{ $resultBread->match->title }}</a>
                </li>
                <li><span aria-current="page">Entrer un joueur éliminé </span></li>
            </ul>
        </nav>
        <form action="{{ route( 'insert.kill' ) }}" class='mx-5 mt-5' method='post'>
            @csrf
            <div class='mb-3'>
                <label for="user_killed_id" class="form-label">Joueur éliminé<span
                        class="small text-secondary">(Obligatoire)</span></label>
                <select
                    id="user_killed_id"
                    name="user_killed_id">
                    <option value="">Choisis un joueur</option>
                    @foreach($resultMatchUsers as $resultMatchUser)
                        <option value="{{$resultMatchUser->user->id}}">
                            {{ $resultMatchUser->user->pseudo}}
                        </option>
                    @endforeach
                </select>
                <input
                    type='hidden'
                    name='result_id'
                    value="{{$result_id}}"
                >
            </div>
            <button type='submit' class='btn btn-primary bg-info my-3'>Envoyer</button>
        </form>
    </main>
</x-app-layout>
