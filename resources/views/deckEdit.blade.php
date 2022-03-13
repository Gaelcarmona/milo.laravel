@section('title', 'Modifier '. $deck->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('players') }}">Mes joueurs</a></li>
          <li class="breadcrumb-item"><a href="{{ route('displayPlayerProfile', $deck->user_id) }}">{{ $deck->user->pseudo }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Modification de {{ $deck->title }}</li>
        </ol>
      </nav>
        <form action="{{route('update.deck')}}" class='mx-5 mt-5' method='post'>
            @csrf
            {{--        @dd($id);--}}
            <div class='mb-3'>
                <label for='title' class='form-label fw-bold px-3'>Titre</label>
                <input
                    type='text'
                    name='title'
                    required
                    value="{{ $deck->title }}"
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
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
