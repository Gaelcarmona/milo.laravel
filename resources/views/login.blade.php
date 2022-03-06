<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <form class='mx-5 mt-5' method='post'>
            @csrf
            <div class='mb-3'>
                <label for='pseudo' class='form-label fw-bold px-3'>Pseudo</label>
                <input
                    type='text'
                    name='pseudo'
                    required
                >
            </div>
            </div>
            <div class='mb-3'>
                <label for='password' class='form-label fw-bold px-3'>Mot de passe</label>
                <input
                    type='password'
                    id="password"
                    required
                    name='password'
                    value=''>
            </div>
            <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
        </form>
</x-app-layout>
