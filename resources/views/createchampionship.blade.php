<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="images/frame57.svg">
                        </figure>
                    </div>
                    <div class="col-9">
                        <nav class='navbar navbar-expand-lg'>
                            <ul class='navbar-nav me-right  mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    <a class='nav-link'>Statistiques</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link'>Se connecter</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <body>
        <main>
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
                        <input type="checkbox" value="{{$associateUser->user_id}}"
                               id="{{ \App\Models\User::where('id',$associateUser->user_id)->first()->pseudo}}"
                               name="player[]">
                        <label
                            for="player[]">{{ \App\Models\User::where('id',$associateUser->user_id)->first()->pseudo}}</label>
                    @endforeach
                </div>
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
