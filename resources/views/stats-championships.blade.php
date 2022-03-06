<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                <li><span aria-current="page">Les championnats</span></li>
            </ul>
        </nav>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($championships as $championship)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/small') }}/{{ isset($championship->image->url) ? $championship->image->url  : 'championships.jpg' }}" alt="">
                        <div class="card-body">
                            <p class="card-text">{{ $championship->title }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('statistic.championship', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</x-app-layout>
