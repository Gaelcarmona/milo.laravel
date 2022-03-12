@section('title', '')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
            <div class="joueurs row">
                <div class="col-12 col-sm-6 padding d-flex align-items-center justify-content-center flex-column">
                    <div>
                        <a href="{{ route('createplayer') }}" class="btn btn-primary mt-3 mb-3 ">Créer un joueur</a>
                        <a href="{{ route('players') }}" class="btn btn-info text-white mt-3 mb-3">Voir mes joueurs</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 padding">
                    <figure>
                        <img src="{{ asset('images/large/players') }}.jpg">
                    </figure>
                </div>
            </div>
            <div class="championnats row">
                <div class="col-12 col-sm-6 padding">
                    <figure>
                        <img src="{{ asset('images/large/championships') }}.jpg">
                    </figure>
                </div>
                <div class="col-12 col-sm-6 padding d-flex align-items-center justify-content-center flex-column">
                    <div>
                        <a href="{{route('create.championship')}}" class="btn btn-primary mt-3 mb-3">Créer un championnat</a>
                        <a href="{{ route('championships') }}" class="btn btn-info text-white mt-3 mb-3">Voir mes championnats</a>
                    </div>
                </div>
            </div>
</x-app-layout>
