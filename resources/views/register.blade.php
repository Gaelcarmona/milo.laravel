<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <form action="{{route('insert.user')}}" class='mx-5 mt-5' method='post'>
            @csrf
            <div class='mb-3'>
                <label for='pseudo' class='form-label fw-bold px-3'>Pseudo</label>
                <input
                    type='text'
                    name='pseudo'
                    required
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
                >
                @if($errors->has('mail'))
                    <p>Le champ « mail » a une erreur</p>
                    <p>{{$errors->first('mail')}}</p>
                @endif
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
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
