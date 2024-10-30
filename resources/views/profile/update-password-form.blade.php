<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Mettre à jour le mot de passe') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Assurez-vous que votre compte utilise un long mot de passe pour rester sécurisé.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Nouveau mot de passe') }}" />
            <div class="col-sm-10">
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            </div>
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirmer le mot de passe') }}" />
            <div class="col-sm-10">
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            </div>
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Sauvegardé.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Sauvegarder') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
