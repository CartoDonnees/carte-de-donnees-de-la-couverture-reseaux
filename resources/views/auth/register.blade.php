<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <x-jet-authentication-card-logo />
        </x-slot>


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="h5 modal-title text-center">
                <h4 class="mt-2">
                    <div>Cartodonnées <b>Inscription<b></div>
                    <span>Veuillez vous inscrire ci-dessous.</span>
                </h4>
            </div>
            <x-jet-validation-errors class="mb-4" />
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group">
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Entrer un nom" required autofocus autocomplete="name" />
                    </div>
                    <div class="position-relative form-group">
                        <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" placeholder="Entrer un prénom" required autofocus autocomplete="name" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="position-relative form-group">
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required />
                    </div>
                </div>

                <!-- <div class="col-md-12">
                    <div class="position-relative form-group">
                        <x-jet-input id="pseudo" class="block mt-1 w-full" type="text" name="pseudo" :value="old('pseudo')" placeholder="Pseudo" required />
                    </div>
                </div> -->
<!-- 
                <div class="col-md-12">
                    <div>
                        <label class="form-label"><b class="text-danger" style="font-size: 15px">*</b> Indiquer sa position</label>
                        <div class="position-relative form-group">
                            <select name="tempory_role" id="tempory_role" class="block mt-1 w-full form-control">
                                <option value="5">consommateur</option>
                                <option value="2">opérateur moov</option>
                                <option value="3">opérateur mtn</option>
                                <option value="4">opérateur orange</option>
                            </select>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-12">
                    <div class="">
                        <label class="form-label"><b class="text-danger" style="font-size: 15px">*</b> Le mot de passe doit comporter au moins 8 caractères</label>
                        <div class="position-relative input-group">
                            <x-jet-input id="password" class="block w-full" type="password" name="password" placeholder="Mot de passe ..." required autocomplete="new-password" />
                            <span class="input-group-text btn btn-primary text-white" onclick="Afficher()"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="position-relative input-group">
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Confirmer le mot de passe ..." required autocomplete="new-password" />
                            <span class="input-group-text btn btn-primary text-white" onclick="Afficher()"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-2 ml-5">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" class="form-check-input" id="terms" />

                        <div class="ml-2 ">
                            {!! __('J\'accepte les termes et conditions.', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-end m-2">

            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('new') }}">
                    {{ __('Retour') }}
                </a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('login') }}">
                    {{ __('Déjà inscrit?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('S\'inscrire') }}
                </x-jet-button>
            </div>
        </form>
        <script>
            function Afficher() {
                var input = document.getElementById("password");
                var input1 = document.getElementById("password_confirmation");
                var eye = document.getElementById("pwd-eye");
                if (input.type === "password") {
                    input.type = "text";
                    input1.type = "text";
                    eye.style.background = "#f19742";
                    eye.style.color = "white";
                } else {
                    input.type = "password";
                    input1.type = "password";
                    eye.style.background = "white";
                    eye.style.color = "black";
                }
            }
        </script>
    </x-jet-authentication-card>
</x-guest-layout>