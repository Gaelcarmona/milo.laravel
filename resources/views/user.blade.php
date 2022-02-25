<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <div>
                <div class="statistiques row">
                    <div class="col-6 padding ">
                        <figure>
                            <img src="images/statistiques.jpeg">
                        </figure>
                    </div>
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <h1 class="text-center">Mes statistiques</h1>
                    </div>
                </div>
                <div class="joueurs row">
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <h1 class="text-center pb-5">Mes joueurs</h1>
                        <div>
                            <a href="{{ route('createplayer') }}">Créer un joueur</a>
                            <a href="{{ route('players') }}">Voir mes joueurs</a>
                        </div>
                    </div>
                    <div class="col-6 padding">
                        <figure>
                            <img src="images/players.jpg">
                        </figure>
                    </div>
                </div>
                <div class="championnats row">
                    <div class="col-6 padding">
                        <figure>
                            <img src="images/championships.jpg">
                        </figure>
                    </div>
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <h1 class="text-center pb-5">Mes championnats</h1>
                        <div>
                            <a href="{{route('create.championship')}}">Créer un championnat</a>
                            <a href="{{ route('championships') }}">Voir mes championnats</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</x-app-layout>
