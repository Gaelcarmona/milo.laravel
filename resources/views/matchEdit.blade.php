@section('title', 'Modifier le match')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('championships') }}">Mes championnats</a></li>
          <li class="breadcrumb-item"><a href="{{ route('displayChampionshipProfile', $matchBread->championship_id) }}">{{ $matchBread->championship->title }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Modification de {{ $matchBread->title }}</li>
        </ol>
      </nav>
            <form action="{{route('update.match')}}" class='mx-5 mt-5' method='post'>
                @csrf
                {{--        @dd($id);--}}
                <div class='mb-3'>
                    <label for='title' class='form-label fw-bold px-3'>Titre</label>
                    <input
                        type='text'
                        name='title'
                        required
                        value="{{ $matchBread->title }}"
                    >
                    <input
                        type='hidden'
                        name='id'
                        required
                        value="{{ $id }}"
                    >
                    <input
                        type='hidden'
                        name='championship_id'
                        required
                        value="{{ $id }}"
                    >
                    @if($errors->has('title'))
                        <p>Le champ « title » a une erreur</p>
                        <p>{{$errors->first('title')}}</p>
                    @endif
                </div>
                <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
            </form>
</x-app-layout>
