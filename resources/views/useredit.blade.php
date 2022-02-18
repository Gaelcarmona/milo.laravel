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
            <form action="{{ route('user.update', $user->id) }}" class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
                    <label for='pseudo' class='form-label fw-bold px-3'>Pseudo</label>
                    <input
                        type='text'
                        name='pseudo'
                        required
                        value="{{$user->pseudo}}"
                    >
                    @if($errors->has('pseudo'))
                        <p>Le champ « pseudo » a une erreur</p>
                        <p>{{$errors->first('pseudo')}}</p>
                    @endif
                </div>
                <div class='mb-3'>
                    <label for='email' class='form-label fw-bold px-3'>Adresse e-mail</label>
                    <input
                        type='mail'
                        required
                        name='email'
                        value="{{$user->email}}"
                    >
                    @if($errors->has('mail'))
                        <p>Le champ « mail » a une erreur</p>
                        <p>{{$errors->first('mail')}}</p>
                    @endif
                </div>
                <div class='mb-3'>
                    <label for='password' class='form-label fw-bold px-3'>Mot de passe</label>
                    <input
                        type='password'
                        id="password"
                        required
                        name='password'
                    >
                    @if($errors->has('password'))
                        <p>Le champ « password » a une erreur</p>
                        <p>{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class='mb-3'>
                    <label for='confirmpassword' class='form-label fw-bold px-3'>Confirmer le mot de passe</label>
                    <input
                        type='password'
                        id="confirmpassword"
                        required
                        name='confirmpassword'
                    >
                    @if($errors->has('confirmpassword'))
                        <p>Le champ « confirmpassword » a une erreur</p>
                        <p>{{$errors->first('confirmpassword')}}</p>
                    @endif
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
