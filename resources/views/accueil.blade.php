<body>
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
<main>
    <div class="container accueil">
        <h1>Bienvenue</h1>
        <p>Ce site te permet d'organiser des tournois de carte Magic entre amis.</p>
        <p>En quelques étapes tu peux :</p>
        <ul>
            <li>Créer un championnat</li>
            <li>Y ajouter des joueurs (tes amis trop fainéants pour s'inscrire)</li>
            <li>Leur attribuer des decks</li>
            <li>Créer des matchs et rentrer des résultats</li>
            <li>Profiter de toutes ces statistiques créées et envoyer le lien aux copains</li>
        </ul>
        <button><a href="{{ route('register') }}">Créer un compte</a></button>
        <button><a href="{{ route('login') }}">Se connecter</a></button>
    </div>
</main>
<footer class='footer navbar bottom bg-dark  text-white py-3'>
    <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
</footer>
</body>


{{--    </x-slot>--}}

{{--</x-app-layout>--}}








