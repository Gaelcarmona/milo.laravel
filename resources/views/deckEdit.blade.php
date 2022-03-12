@section('title', 'Modifier '. $deck->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                <li>
                    <a href="{{ route('displayPlayerProfile', $deck->user_id) }}">{{ $deck->user->pseudo }}</a>
                </li>
                <li><span aria-current="page">Modification de {{ $deck->title }}</span>
                </li>
            </ul>
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
