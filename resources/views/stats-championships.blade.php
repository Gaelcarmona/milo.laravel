@section('title', 'Les championnats')
@section('description', 'Voici la liste de tous les championnats joués')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
          <li class="breadcrumb-item active" aria-current="page">Les championnats</li>
        </ol>
      </nav>
      <h1 class="fs-2 text-center">Les championnats</h1>
      <hr class="mb-3">
        <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach ($championships as $championship)
                <article class="col">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/small') }}/{{ isset($championship->image->url) ? $championship->image->url  : 'championships.jpg' }}" alt="image du championnat">
                        <div class="card-body">
                            <h2 class="card-text">{{ $championship->title }}</h2>
                            <p class="card-text">de {{ $championship->user->pseudo }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('statistic.championship', $championship->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
</x-app-layout>
