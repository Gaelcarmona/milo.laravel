@section('title', 'Accueil')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="decks row">
        <div class="col-12 col-md-6 px-0">
            <figure class="figure">
                <img src="{{ asset('images/large/114446') }}.jpg">
                <a class="btn btn-info d-sm-flex d-md-none d-xl-none d-xxl-none text-white mt-3 mb-3 text-center centered" href="{{ route('statistic.home') }}">Les statistiques</a>
            </figure>
        </div>
        <div class="col-12 col-md-6 d-none d-md-flex d-flex align-items-center justify-content-center flex-column px-0">
            <a class="btn btn-info text-white mt-3 mb-3 text-center" href="{{ route('statistic.home') }}">Les statistiques</a>
        </div>
    </div>
    <div class="joueurs row marginMenu">
        <div class="col-12 col-md-6 d-none d-md-flex d-flex align-items-center justify-content-center flex-column px-0">
            <a class="btn btn-info text-white mt-3 mb-3 text-center" href="{{ route('players') }}" >Mes joueurs</a>
        </div>
        <div class="col-12 col-md-6 px-0">
            <figure class="figure">
                <img src="{{ asset('images/large/players') }}.jpg">
                <a class="btn btn-info d-sm-flex d-md-none d-xl-none d-xxl-none text-white mt-3 mb-3 text-center centered" href="{{ route('players') }}">Mes joueurs</a>
            </figure>
        </div>
    </div>
    <div class="championnats row">
        <div class="col-12 col-md-6 px-0">
            <figure class="figure">
                <img src="{{ asset('images/large/championships') }}.jpg">
                <a class="btn btn-info d-sm-flex d-md-none d-xl-none d-xxl-none text-white mt-3 mb-3 text-center centered" href="{{ route('championships') }}">Mes championnats</a>
            </figure>
        </div>
        <div class="col-12 col-md-6 d-none d-md-flex d-flex align-items-center justify-content-center flex-column px-0">
            <a class="btn btn-info text-white mt-3 mb-3 text-center" href="{{ route('championships') }}">Mes championnats</a>
        </div>
    </div>
</x-app-layout>
