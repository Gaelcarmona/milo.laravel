@section('title', 'Gestion du compte')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        {{--     <div class="col-lg-6 col-12 padding">--}}
        {{--    <img src="{{ asset('images/large') }}/{{ isset($user->image->url) ? $user->image->url  : 'players.jpg' }}" alt="">--}}
        {{--     </div>--}}
        {{--        <div class="col-6 border-5">--}}

        {{--            <h1 class="display-5 d-flex align-items-center justify-content-center">Gestion de compte</h1>--}}
        {{--            {{$user->pseudo}}--}}
        {{--            {{$user->email}}--}}
        {{--        </div>--}}
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
            <div class="card p-4">
                <div class=" image d-flex flex-column justify-content-center align-items-center"><img
                        src="{{ asset('images/large') }}/{{ isset($user->image->url) ? $user->image->url  : 'players.jpg' }}"
                        alt=""></button> <span class="name mt-3">{{$user->pseudo}}</span> <span
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
