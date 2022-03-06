<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main class="">
            <div>

                <div class="joueurs row">
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <div>
                            <a href="{{ route('createplayer') }}" class="btn btn-primary mb-1 mt-1 ">Créer un joueur</a>
                            <a href="{{ route('players') }}" class="btn btn-info text-white">Voir mes joueurs</a>
                        </div>
                    </div>
                    <div class="col-6 padding">
                        <figure>
                            <img src="{{ asset('images/large/players') }}.jpg">
                        </figure>
                    </div>
                </div>
                <div class="championnats row">
                    <div class="col-6 padding">
                        <figure>
                            <img src="{{ asset('images/large/championships') }}.jpg">
                        </figure>
                    </div>
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <div>
                            <a href="{{route('create.championship')}}" class="btn btn-primary mb-1 mt-1">Créer un championnat</a>
                            <a href="{{ route('championships') }}" class="btn btn-info text-white">Voir mes championnats</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</x-app-layout>
