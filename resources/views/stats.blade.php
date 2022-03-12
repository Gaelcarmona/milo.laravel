@section('title', 'Statistiques')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
                <div class="championnats row">
                <div class="col-12 col-sm-6 padding">
                    <figure>
                        <img src="{{ asset('images/large/championships') }}.jpg">
                    </figure>
                </div>
                <div class="col-12 col-sm-6 padding d-flex align-items-center justify-content-center flex-column">
                    <a class="btn btn-info text-white mt-3 mb-3 text-center" href="{{ route('statistic.championships') }}">Les championnats</a>
                </div>
            </div>
            <div class="joueurs row">
                <div class="col-12 col-sm-6 padding d-flex align-items-center justify-content-center flex-column">
                    <a class="btn btn-info text-white mt-3 mb-3 text-center " href="{{ route('statistic.players') }}" >Les joueurs</a>
                </div>
                <div class="col-12 col-sm-6 padding">
                    <figure>
                        <img src="{{ asset('images/large/players') }}.jpg">
                    </figure>
                </div>
            </div>
            <div class="decks row">
                <div class="col-12 col-sm-6 padding">
                    <figure>
                        <img src="{{ asset('images/large/114446') }}.jpg">
                    </figure>
                </div>
                <div class="col-12 col-sm-6 padding d-flex align-items-center justify-content-center flex-column">
                    <a class="btn btn-info text-white mt-3 mb-3 text-center" href="{{ route('statistic.decks') }}">Les decks</a>
                </div>
            </div>
</x-app-layout>
