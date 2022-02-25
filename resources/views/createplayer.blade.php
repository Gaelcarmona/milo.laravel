<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                    <li><span aria-current="page">Créer un joueur</span>
                    </li>
                </ul>
            </nav>
            <form action="{{route('insert.player')}}" class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
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
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
</x-app-layout>
