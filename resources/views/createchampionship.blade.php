<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                    <li><span aria-current="page">Créer un championnat</span>
                    </li>
                </ul>
            </nav>
            <form action="{{route('insert.championship')}}" class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
                    <label for='title' class='form-label fw-bold px-3'>Nom du championnat</label>
                    <input
                        type='text'
                        name='title'
                        required
                    >
                    <input
                        type='hidden'
                        name='user_id'
                        value="{{\Illuminate\Support\Facades\Auth::id()}}"
                    >
                    @if($errors->has('title'))
                        <p>Le champ « title » a une erreur</p>
                        <p>{{$errors->first('title')}}</p>
                    @endif

                </div>
                <div>
                    <input type="checkbox" value="{{Auth::id()}}" id="{{Auth::user()->pseudo}}" name="player[]">
                    <label for="player[]">{{Auth::user()->pseudo}}</label>
                    @foreach($associateUsers as $associateUser)
                        <input type="checkbox" value="{{$associateUser->id}}"
                               id="{{$associateUser->pseudo}}"
                               name="player[]">
                        <label
                            for="player[]">{{ $associateUser->pseudo}}</label>
                    @endforeach
                </div>
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
</x-app-layout>
