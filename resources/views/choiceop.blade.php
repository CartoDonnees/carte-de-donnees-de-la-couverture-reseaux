<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div class="text-center">
        <a href="{{ route('networkDash') }}" class="badge badge-primary">Acceder à l'interface d'administration</a> <br>
        <a href="{{ route('new') }}" class="badge badge-secondary">Acceder à la page d'accueil</a>
        </div>
        



    </x-jet-authentication-card>
</x-guest-layout>