<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <div>

                <div class="joueurs row">
                    <div class="col-6 padding d-flex align-items-center justify-content-center flex-column">
                        <a href="{{ route('statistic.players') }}" class="text-center pb-5">Les joueurs</a>
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
                        <a href="{{ route('statistic.championships') }}" class="text-center pb-5">Les championnats</a>
                    </div>
                </div>
            </div>
        </main>
</x-app-layout>
