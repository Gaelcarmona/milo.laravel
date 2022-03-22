<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ route('accueil') }}"><img class="fancy-border-radius" src="{{ asset('images/frame57.svg') }}"></a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="pseudo" :value="__('Pseudo')" />

                <x-input id="pseudo" class="block mt-1 w-full" type="text" name="pseudo" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mot de passe')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4 fs-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Déja enregistré ?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Créer le compte') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

