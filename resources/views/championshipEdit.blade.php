<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <main>
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('user') }}">Accueil</a></li>
                    <li><a href="{{ route('championships') }}">Mes championnats</a></li>
                    <li><span aria-current="page">Modifier le nom du championnat</span></li>
                </ul>
            </nav>
            <form action="{{route('update.championship')}}" class='mx-5 mt-5' method='post'>
                @csrf
                {{--        @dd($id);--}}
                <div class='mb-3'>
                    <label for='title' class='form-label fw-bold px-3'>Titre</label>
                    <input
                        type='text'
                        name='title'
                        required
                        value=""
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
                <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
            </form>
        </main>

</x-app-layout>
