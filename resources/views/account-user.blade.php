@section('title', 'Gestion du compte')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('user') }}">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Gestion de compte</li>
            </ol>
          </nav>
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
            <div class="card p-4">
                <div class=" image d-flex flex-column justify-content-center align-items-center"><img
                        src="{{ asset('images/large') }}/{{ isset($user->image->url) ? $user->image->url  : 'players.jpg' }}"
                        alt="Image du joueur"> <span class="name mt-3">{{$user->pseudo}}</span> <span
                        class="idd">{{$user->email}}</span>

                    <span><i class="fa fa-copy"></i></span></div>

                <div class=" d-flex mt-2 justify-content-center ">
                    <a href="{{route('form.update.user',Auth::id())}}" class="btn btn-primary mt-3 mb-3">Modifier le compte</a>
                </div>
                <div class=" px-2 rounded mt-4 date d-flex justify-content-center"><span
                        class="join">Nous a rejoint le {{date('d-m-Y', strtotime($user->created_at))}}</span></div>
                <div class=" d-flex mt-2 justify-content-center ">
                    <a href="{{route('user.delete',Auth::id())}}" class="btn btn-primary mt-3 mb-3">Supprimer le compte</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
