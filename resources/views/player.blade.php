@section('title', $player->pseudo)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('players') }}">Mes joueurs</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $player->pseudo }}</li>
            </ol>
        </nav>
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
            <div class="card p-4">
                <div class=" image d-flex flex-column justify-content-center align-items-center"><img
                        src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url : 'players.jpg' }}"
                        alt=""></button>

                    <span><i class="fa fa-copy"></i></span>
                </div>

                <div class=" padding d-flex align-items-center justify-content-center flex-column">
                    <div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-1 mt-1 bg-info" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Modification de l'image du joueur
                        </button>
                        <!-- Modal -->
                        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sélectionne une image pour ce
                                            joueur
                                        </h5>
                                        <button type="button" class="btn-close bg-info" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('insert.image.player', ['id' => $player->id]) }}"
                                            class='mx-5 mt-5' method='post'>
                                            @csrf
                                            <div class="row">
                                                @foreach ($images as $image)
                                                    <div class="col-4">
                                                        <label>
                                                            <input type="radio" name='image_id' required
                                                                value="{{ $image->id }}">
                                                            <img
                                                                src="{{ asset('images/small') }}/{{ $image->url }}">
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
                    <div class=" d-flex mt-2 justify-content-center ">
                        <a href="{{ route('statistic.player', $player->id) }}" class="btn btn-primary mt-3 mb-3">Statistiques de {{ $player->pseudo }}</a>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Les decks
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <table class='col-12 bg-main table'>
                    <thead class='text-white bg-dark'>
                        <th>Nom</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                        @foreach ($decks as $deck)
                            <tr>
                                <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a>
                                </td>
                                <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>
                                <td><a href="{{ route('delete.deck', $deck->id) }}"
                                        onclick="
                            var result = alert('Vous ne pourrez pas supprimer ce deck si que des résultats lui sont associés');return true">supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a class="btn btn-primary mb-1 mt-1 bg-info mb-1"
                    href="{{ route('form.deck', ['id' => $player->id]) }}">Créer
                    un deck</a>


            </div>
        </div>
    </div>
    </div>
</x-app-layout>
