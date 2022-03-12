@section('title', 'Mes joueurs')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><span aria-current="page">Mes joueurs</span></li>
            </ul>
        </nav>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
{{--                    <img src="images/small/players.jpg" alt="">--}}
                    <img src="{{ asset('images/small') }}/{{ isset($user_creator->image->url) ? $user_creator->image->url  : 'players.jpg' }}" alt="">
                    <div class="card-body">
                        <p class="card-text">{{ $user_creator->pseudo }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a role="button" href="{{ route('displayPlayerProfile', $user_creator->id) }}"
                                   class="btn btn-sm btn-outline-secondary">Voir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($associateUsers as $associateUser)
                <div class="col">
                    <div class="card shadow-sm">
{{--                        <img src="images/small/players.jpg" alt="">--}}
                        <img src="{{ asset('images/small') }}/{{ isset($associateUser->image->url) ? $associateUser->image->url  : 'players.jpg' }}" alt="">
                        <div class="card-body">
                            <p class="card-text">{{ $associateUser->pseudo }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('displayPlayerProfile', $associateUser->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                    <a role="button" href="{{ route('editPlayer', $associateUser->id) }}"
                                       class="btn btn-sm btn-outline-secondary">Modifier</a>
                                    <a role="button" href="{{ route('player.delete', $associateUser->id) }}"
                                       class="btn btn-sm btn-outline-secondary">supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</x-app-layout>
