<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="h5 modal-title text-center">
                <h4 class="mt-2">
                    <div>Cartodonnées <b>Connexion<b></div>
                    <span>Veuillez vous connecter à votre compte ci-dessous.</span>
                </h4>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group">
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="E-mail ici..." required autofocus  />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="position-relative input-group">
                        <x-jet-input id="password" class="block w-full" type="password" name="password" placeholder="Mot de passe ..." required autocomplete="new-password" />
                        <div class="input-group-append">
                            <span class="input-group-tex btn btn-primary text-center" id="pwd-eye" onclick="Afficher()"><i class="far fa-eye"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-relative form-check mt-3">
                <div class="row">
                    <div class="col-md-1">
                        <x-jet-checkbox id="remember_me" class="form-control p-0 m-0" name="remember" style="height: 20px; width: 20px" />
                    </div>
                    <div class="col-md-11">
                        <label for="exampleCheck" class="form-check-label p-0 m-0">Se souvenir de moi</label>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <h6 class="mb-0">Pas de compte? <a href="{{ route('register') }}" class="text-primary">S'inscrire maintenant</a></h6>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="btn-lg btn btn-link">Récupérer le mot de passe</a>
            @endif
            
            <div class="float-right">
                <button class="btn btn-primary btn-lg">Se connecter</button>
            </div>
        </form>
        <script>
            function Afficher()
            { 
                var input = document.getElementById("password");
                var eye = document.getElementById("pwd-eye");
                if (input.type === "password")
                { 
                    input.type = "text";
                    eye.style.background = "#f19742";
                    eye.style.color = "white";
                }
                else
                { 
                    input.type = "password";
                    eye.style.background = "white";
                    eye.style.color = "black";
                } 
            } 
        </script>
    </x-jet-authentication-card>
</x-guest-layout>
