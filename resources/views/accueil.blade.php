@section('title', 'Entrée')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4">
            <div class=" image d-flex flex-column justify-content-center align-items-center"><img
                    src="{{ asset('images/large/158926.jpg') }}"
                    alt="Image de bienvenue">
            </div>

            <div class=" padding d-flex align-items-center justify-content-center flex-column">
                <div class=" d-flex mt-2 justify-content-center ">
                    <div class="container accueil">
                        <h1>Bienvenue</h1>
                        <p>Ce site te permet d'organiser des tournois de carte Magic entre amis.</p>
                        <p>En quelques étapes tu peux :</p>
                        <ul>
                            <li>Créer un championnat</li>
                            <li>Y ajouter des joueurs</li>
                            <li>Leur attribuer des decks</li>
                            <li>Créer des matchs et rentrer des résultats</li>
                            <li>Profiter de toutes ces statistiques créées et envoyer le lien aux copains</li>
                        </ul>
                        <button class="btn btn-primary mb-1 mt-1 bg-info"><a href="{{ route('register') }}">Créer un compte</a></button>
                        <button class="btn btn-primary mb-1 mt-1 bg-info"><a href="{{ route('login') }}">Se connecter</a></button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

</x-app-layout>
