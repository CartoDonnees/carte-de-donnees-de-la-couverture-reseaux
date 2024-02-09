<div>
    <div class="card">
        <div class="card-body">
            <div class="flex items-center justify-end m-2">
                <a href="{{route('new')}}" type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" data-original-title="Example Tooltip">
                    <i class="fas fa-times"></i> <b>Quitter</b>
                </a>
            </div>
            @if($success)
            <div class="alert alert-success fade show" role="alert">Votre commentaire à été ajouter avec succès</div>
            @endif

            @if(!$success)
            <h4 class="text-center" style="font-size: 25px !important; font-weight: bold;">Signalez un problème</h4>
            <div class="divider"></div>
            <form wire:submit.prevent="submitComment">
                <div class="alert alert-info p-2">
                    <h4 class="text-center">Participez à l'amélioration de l'application en nous donnant vos avis, remarques et suggestions</h4>
                </div>

                <div class="container bg-light rounded py-3">

                    <h2 class="mt-2" style="font-size: 18px; font-weight:bold">Veuillez identifier votre problème?</h2>
                    <div class="row mt-4">
                        <div class="form-check mb-3 col">
                            <input class="form-check-input" type="radio" id="exampleRadios1" value="Appli" wire:model="CheckPb">
                            <label class=" form-check-label" for="exampleRadios1">
                                Problème avec l'application
                            </label>
                        </div>
                        <div class="form-check mb-3 col">
                            <input class="form-check-input" type="radio" id="exampleRadios2" value="Reseau" wire:model="CheckPb">
                            <label class=" form-check-label" for="exampleRadios2">
                                Problème avec un réseau mobile
                            </label>
                        </div>
                    </div>

                    @if($CheckPb == 'Reseau')
                    <h2 class="mt-2" style="font-size: 18px; font-weight:bold">Avez-vous un problème avec le réseau?</h2>
                    <div class="row mt-4">
                        <div class="input-group mb-3 col">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="selectOperateur">Opérateur : </label>
                            </div>
                            <select class="custom-select" id="selectOperateur" wire:model="operateur" @if ($CheckPb=="Reseau" ) required @endif>
                                <option value=""></option>
                                <option value="MTN">MTN</option>
                                <option value="ORANGE">ORANGE</option>
                                <option value="MOOV">MOOV</option>
                            </select>
                        </div>
                        <!-- <div class="input-group mb-3 col">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="selectOperateur">Localité : </label>
                            </div>
                            <input type="text" id="searchBar" class="form-control" placeholder="Rechercher par nom">

                        </div> -->

                        <div class="input-group mb-3 col" wire:ignore>
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="selectLocalite">Localité : </label>
                            </div>
                            <select class="custom-select select2" id="selectLocalite" @if ($CheckPb=="Reseau" ) required @endif>
                                <option value=""></option>
                                @foreach($cities as $key )
                                <option value="{{ $key['loc']}}">{{ $key['loc'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <h3 class="col" style="font-size: 16px; font-weight:bold">Problème Internet : </h3>
                        <div class="form-group form-check  pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="internetLent">
                            <label class="form-check-label" for="exampleCheck1">Connexion lente</label>
                        </div>
                        <div class="form-group form-check  pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="internetImpossible">
                            <label class="form-check-label" for="exampleCheck1">Connexion inexistante</label>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <h3 class="col" style="font-size: 16px; font-weight:bold">Problème d'appel : </h3>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="appelFluide">
                            <label class="form-check-label" for="exampleCheck1">Appel non fluide</label>
                        </div>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="appelImpossible">
                            <label class="form-check-label" for="exampleCheck1">Appel impossible</label>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <h3 class="col" style="font-size: 16px; font-weight:bold">Problème avec les SMS : </h3>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="eSmsLent">
                            <label class="form-check-label" for="exampleCheck1">Envoi de SMS lent</label>
                        </div>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="rSmsLent">
                            <label class="form-check-label" for="exampleCheck1">Reception de SMS lente</label>
                        </div>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="eSmsImpossible">
                            <label class="form-check-label" for="exampleCheck1">Envoi des SMS impossible</label>
                        </div>
                        <div class="form-group form-check pl-0 p-1 rounded col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="rSmsImpossible">
                            <label class="form-check-label" for="exampleCheck1">Reception des SMS impossible</label>
                        </div>
                    </div>

                    <h2 class="mt-4" style="font-size: 18px; font-weight:bold">Laissez votre contact</h2>
                    <div class="row ml-3 mt-4">
                        <div class="col">
                            <input type="tel" class="form-control" placeholder="Téléphone" wire:model="telephone">
                            @error('telephone') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Mail" wire:model="mail">
                            @error('mail') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <h2 class="mt-4" style="font-size: 18px; font-weight:bold">Avez-vous quelque chose à ajouter?</h2>
                    <div class="form-group mt-2 mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" wire:model="comment"></textarea>
                    </div>
                    <div class="flex items-center justify-end m-2">
                        <x-jet-button class="ml-4">
                            {{ __('Envoyer') }}
                        </x-jet-button>
                    </div>
                    @push('scripts')
                    <script>
                        $(document).ready(function() {
                            $('#selectLocalite').select2();
                            $('#selectLocalite').on('change', function (e) {
                                var data = $('#selectLocalite').select2("val");
                                @this.set('localite', data);
                            });
                        });
                    </script>
                    @endpush
                    @endif

                    @if($CheckPb == 'Appli')

                    <h2 class="mt-4" style="font-size: 18px; font-weight:bold">Avez-vous un problème avec l'application ?</h2>
                    <div class="row ml-3 mt-4">
                        <div class="form-group form-check pl-0  rounded p-1 col">
                            <input type="checkbox" class="form-check-input" wire:model="appliLente">
                            <label class="form-check-label" for="exampleCheck1">Lenteur de l'application</label>
                        </div>
                        <div class="form-group form-check pl-0 rounded p-1 col">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="pblAffichage">
                            <label class="form-check-label" for="exampleCheck1">Problème d'affichage</label>
                        </div>
                    </div>

                    <h2 class="mt-4" style="font-size: 18px; font-weight:bold">Laissez votre contact</h2>
                    <div class="row ml-3 mt-4">
                        <div class="col">
                            <input type="tel" class="form-control" placeholder="Téléphone" wire:model="telephone">
                            @error('telephone') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Mail" wire:model="mail">
                            @error('mail') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <h2 class="mt-4" style="font-size: 18px; font-weight:bold">Avez-vous quelque chose à ajouter?</h2>
                    <div class="form-group mt-2 mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" wire:model="comment"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end m-2">
                    <x-jet-button class="ml-4">
                        {{ __('Envoyer') }}
                    </x-jet-button>
                </div>
                @endif
            </form>
            @endif
        </div>
    </div>
</div>


