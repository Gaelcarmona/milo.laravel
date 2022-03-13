@section('title', 'Mes championnats')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mes championnats</li>
        </ol>
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
                                    <a role="button" href="{{ route('displayChampionshipProfile', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                    <a role="button" href="{{ route('editChampionship', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Modifier</a>
                                    <a role="button" href="{{ route('championship.delete', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</x-app-layout>
