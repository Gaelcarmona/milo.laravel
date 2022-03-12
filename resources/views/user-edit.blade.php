@section('title', 'Modifier le compte')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <form action="{{ route('update.user') }}" class='mx-5 mt-5' method='post'>
        @csrf
        <div class='mb-3'>
            <label for='pseudo' class='form-label fw-bold px-3'>Pseudo</label>
            <input
                type='text'
                name='pseudo'
                required
                value="{{$user->pseudo}}"
            >
            @if($errors->has('pseudo'))
                <p>Le champ « pseudo » a une erreur</p>
                <p>{{$errors->first('pseudo')}}</p>
            @endif
        </div>
        <div class='mb-3'>
            <label for='email' class='form-label fw-bold px-3'>Adresse e-mail</label>
            <input
                type='mail'
                required
                name='email'
                value="{{$user->email}}"
            >
            @if($errors->has('mail'))
                <p>Le champ « mail » a une erreur</p>
                <p>{{$errors->first('mail')}}</p>
            @endif
            <input
                type='hidden'
                name='id'
                required
                value="{{ $id }}"
            >
        </div>
        <div class='mb-3'>
            <label for='password' class='form-label fw-bold px-3'>Mot de passe</label>
            <input
                type='password'
                id="password"
                required
                name='password'
            >
            @if($errors->has('password'))
                <p>Le champ « password » a une erreur</p>
                <p>{{$errors->first('password')}}</p>
            @endif
        </div>
        <div class='mb-3'>
            <label for='confirmpassword' class='form-label fw-bold px-3'>Confirmer le mot de passe</label>
            <input
                type='password'
                id="confirmpassword"
                required
                name='confirmpassword'
            >
            @if($errors->has('confirmpassword'))
                <p>Le champ « confirmpassword » a une erreur</p>
                <p>{{$errors->first('confirmpassword')}}</p>
            @endif
        </div>

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
