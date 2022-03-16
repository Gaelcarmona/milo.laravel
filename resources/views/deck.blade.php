@section('title', $deck->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('players') }}">Mes joueurs</a></li>
            <li class="breadcrumb-item"><a
                        href="{{ route('displayPlayerProfile', $deck->user_id) }}">{{ $deck->user->pseudo }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $deck->title }}</li>
        </ol>
    </nav>
    <div class="">
        <img
                src="{{ asset('images/large') }}/{{ isset($deck->image->url) ? $deck->image->url  : 'players.jpg' }}"
                alt="">
        <div class=" padding d-flex align-items-center justify-content-center flex-column">
            <div>
            {{-- <a href="{{ route('image.upload') }}" class="btn btn-primary mb-1 mt-1 bg-info">Insérer une
                image</a> --}}
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-1 mt-1 bg-info" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    Modification de l'image du deck
                </button>
                <!-- Modal -->
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sélectionne une image pour ce joueur
                                </h5>
                                <button type="button" class="btn-close bg-info" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('insert.image.deck', ['id' => $deck->id]) }}"
                                      class='mx-5 mt-5'
                                      method='post'>
                                    @csrf
                                    <div class="row">
                                        @foreach ($images as $image)
                                            <div class="col-4">
                                                <label>
                                                    <input type="radio" name='image_id' required
                                                           value="{{ $image->id }}">
                                                    <img src="{{ asset('images/small') }}/{{ $image->url }}">
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <p>hello</p>
        <p>Coucou je suis le deck "{{ $deck->title }}"</p>
        <p>Mon id est le {{ $deck->id }}</p>
        <p>j'ai été créé le {{ $deck->created_at }}</p>
        <p>mon propriétaire a pour id le n° {{ $deck->user_id }}</p>
    </div>
</x-app-layout>

