@section('title', 'Créer un championnat')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('championships') }}">Mes championnats</a></li>
          <li class="breadcrumb-item active" aria-current="page">Créer un championnat</li>
        </ol>
      </nav>
            <form action="{{route('insert.championship')}}" class='mx-5 mt-5' method='post'>
                @csrf
                <div class='mb-3'>
                    <label for='title' class='form-label fw-bold px-3'>Nom du championnat</label>
                    <input
                        type='text'
                        name='title'
                        required
                    >
                    <input
                        type='hidden'
                        name='user_id'
                        value="{{\Illuminate\Support\Facades\Auth::id()}}"
                    >
                    @if($errors->has('title'))
                        <p>Le champ « title » a une erreur</p>
                        <p>{{$errors->first('title')}}</p>
                    @endif
                </div>
                <div>
                    <ul class="list-group">
                        <li class="list-group-item">
                          <input class="form-check-input me-1" type="checkbox" value="{{Auth::id()}}" id="{{Auth::user()->pseudo}}" name="player[]" aria-label="player[]">
                          {{Auth::user()->pseudo}}
                        </li>
                        @foreach($associateUsers as $associateUser)
                        <li class="list-group-item">
                          <input class="form-check-input me-1" type="checkbox" value="{{$associateUser->id}}" name="player[]" aria-label="player[]">
                          {{ $associateUser->pseudo}}
                        </li>
                        @endforeach
                </div>
                <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
            </form>
</x-app-layout>
