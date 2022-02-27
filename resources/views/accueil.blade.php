{{-- <x-app-layout>
    <x-slot name="header">
    </x-slot> --}}
<x-guest-layout>

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



        {{-- </x-slot> --}}

</x-guest-layout>
{{-- </x-app-layout> --}}
