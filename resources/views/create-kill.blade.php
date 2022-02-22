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
            <form action="{{route('insert.kill')}}" class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
                    <label for="user_killed_id " class="form-label">Joueur éliminé <span
                            class="small text-secondary">(Obligatoire)</span></label>
                    <select
                        id="user_killed_id "
                        name="user_killed_id ">
                        <option value="">Choisis un joueur</option>
                        @foreach($matchUsers as $matchUser)
                            <option value="{{$matchUser->id}}">
                                {{ $matchUser->pseudo}}
                            </option>
                        @endforeach
                    </select>
                    <input
                        type='hidden'
                        name='result_id'
                        value="{{$id}}"
                    >
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
