<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                <li><span aria-current="page">Modifier le nom du championnat</span></li>
            </ul>
        </nav>
        <form action="{{route('update.championship')}}" class='mx-5 mt-5' method='post'>
            @csrf
            <div class='mb-3'>
                <label for='title' class='form-label fw-bold px-3'>Titre</label>
                <input
                    type='text'
                    name='title'
                    required
                    value="{{ $championship->title }}"
                >
                <input
                    type='hidden'
                    name='id'
                    required
                    value="{{ $id }}"
                >
                @if($errors->has('title'))
                    <p>Le champ « title » a une erreur</p>
                    <p>{{$errors->first('title')}}</p>
                @endif
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-1 mt-1 bg-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Modification de l'image du joueur
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
                                <button type='button' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
                        </div>
                    </div>
                </div>
            </div>
                        <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
