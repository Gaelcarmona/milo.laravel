<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                <li><span aria-current="page">Les joueurs</span></li>
            </ul>
        </nav>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($users as $user)
                <div class="col">
                    <div class="card shadow-sm">
{{--                        <img src="images/players.jpg" alt="">--}}
                        <img src="{{ asset('images/small') }}/{{ isset($user->image->url) ? $user->image->url  : 'players.jpg' }}" alt="">
                        <div class="card-body">
                            <p class="card-text">{{ $user->pseudo }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('statistic.player', $user->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
</x-app-layout>
