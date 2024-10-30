<div>
    <style>
        .select2-selection .select2-selection--single {
            height: 38px !important;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="flex items-center justify-between m-2">
                <h4 class="text-center" style="font-size: 25px !important; font-weight: bold;">Signalez un problème</h4>
                <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-danger" data-original-title="Example Tooltip">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            @if ($success)
                <div class="p-5">
                    {{-- <a class="btn btn-dark text-white" onclick="@this.set('success', false)">
                        <i class="fa fa-arrow-left me-2"></i> Retour au choix du type de problème
                    </a> --}}
                    <div class="">
                        <div class=" d-flex justify-center">
                            <img src="{{ asset('images/success.png') }}" class="img-success">
                        </div>
                    </div>
                    <div class="alert alert-success fade show" role="alert">
                        <h3 class="text-center" style="font-size: 20px; font-weight:bold">Votre commentaire à été
                            ajouter avec succès</h3>
                    </div>
                </div>
                <div class="d-flex justify-center">
                    <a href="" class="btn btn-block btn-primary">Retour à l'accueil</a>
                </div>

        </div>
        @endif

        @if (!$success)
            <div class="divider"></div>
            <div class="alert alert-warning p-2">
                <h4 class="text-center">Participez à l'amélioration de l'application en nous donnant vos avis,
                    remarques et suggestions</h4>
            </div>

            <div class="container ">

                <div wire:loading wire:target="submitComment" class=" w-100 p-3 ">
                    <div class="col-md-12 loader-wrapper d-flex justify-content-center align-items-center w-100 ">
                        <div class="loader">
                            <div class="line-scale">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center align-items-center w-100 ">
                        <h5>Chargement des données !</h5>
                    </div>
                </div>
                @if (!$isSelect)
                    <div class="bg-light rounded p-2">
                        <h2 class="mt-2 text-center" style="font-size: 18px; font-weight:bold">Veuillez choisir le
                            type de problème que vous rencontrez ?</h2>
                        <div class="row mt-4 p-3 bg-white rounded m-2">
                            {{-- <div class="form-check mb-3 col">
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
                                </div> --}}
                            <div class="col-md-6 d-flex justify-content-center">
                                <a class="btn btn-secondary text-white" wire:click="selectApplicationProbleme">Problème
                                    sur la plateforme</a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a class="btn btn-secondary text-white" wire:click="selectNetworkProbleme"> Problème
                                    avec un réseau mobile</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div wire:loading.remove>
                        @if ($CheckPb == 1)
                            <form wire:submit.prevent="submitComment">
                                <div class="d-flex justify-between">
                                    <a class="btn btn-dark text-white" onclick="@this.handleBack()">
                                        <i class="fa fa-arrow-left me-2"></i> Retour
                                    </a>
                                    <h2 class="mt-2" style="font-size: 18px; font-weight:bold">Type de problème
                                        selectionné: <b class="text-success">Problème avec la
                                            plateforme</b> </h2>
                                </div>
                                <p class="mt-4 text-center text-info" style="font-size: 18px; font-weight:bold">
                                    Veuillez remplir le formulaire ci-dessous et le soumettre </p>
                                @if ($error == true)
                                    <div class="alert alert-danger p-2">
                                        <h4 class="text-center">Indiquez un problème ou laissez un commentaire</h4>
                                    </div>
                                @endif

                                <div class="row mt-2">
                                    <div class="col-md-6 bg-light rounded p-2">
                                        <h3 class="mb-3" style="font-size: 20px; font-weight:bold">
                                            <u>
                                                Identifiez un problème sur la plateforme
                                            </u>
                                        </h3>
                                        <div class="form-group mt-2 pl-4">
                                            <input type="checkbox" id="appliLente" class="form-check-input"
                                                wire:model="appliLente">
                                            <label class="form-check-label" for="appliLente">Lenteur de
                                                l'application</label>
                                        </div>
                                        <div class="form-group mt-2 pl-4">
                                            <input type="checkbox" class="form-check-input" id="pblAffichage"
                                                wire:model="pblAffichage">
                                            <label class="form-check-label" for="pblAffichage">Problème
                                                d'affichage</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-2">
                                        <h3 class="text-center" style="font-size: 20px; font-weight:bold">
                                            <u>
                                                Laissez votre contact
                                            </u>
                                        </h3>
                                        <div class="form-group w-100 mt-2">
                                            <label class="form-label mt-2" for="phone">Numéro de téléphone
                                                :</label>
                                            <input id="phone" type="tel" class="form-control"
                                                placeholder="Ex: (+225) 00 00 00 00" wire:model="telephone"
                                                pattern="^(?:0|\(?\+225\)?\s?|00225\s?)[1-79](?:[\.\-\s]?\d\d){4}$                                                        ">
                                            @error('telephone')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2 w-100">
                                            <label class="form-label" for="email">Email</label>
                                            <input id="email" type="email" class="form-control "
                                                placeholder="Saisir un email" wire:model="mail">
                                            @error('mail')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2 w-100">
                                            <label class="form-label" for="comment">Commentaire</label>
                                            <div class="form-group mb-3">
                                                <textarea id="comment" placeholder="Saisir votre commentaire" class="form-control "
                                                    id="exampleFormControlTextarea1" rows="5" wire:model="comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-end mt-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send me-2"></i>
                                        Soumettre le formulaire</button>
                                </div>

                            </form>
                        @elseif ($CheckPb == 2)
                            <div class="d-flex justify-between">
                                <a class="btn btn-dark text-white" onclick="@this.handleBack()">
                                    <i class="fa fa-arrow-left me-2"></i> Retour
                                </a>
                                <h2 class="mt-2" style="font-size: 18px; font-weight:bold">Type de problème
                                    selectionné <b class="text-success">Problème avec un
                                        réseau mobile</b> </h2>
                            </div>
                            <div wire:ignore class="">
                                <form wire:submit.prevent="submitComment">
                                    <p class="mt-4 text-center text-info" style="font-size: 18px; font-weight:bold">
                                        Veuillez remplir le formulaire ci-dessous et le soumettre </p>
                                    @if ($error == true)
                                        <div class="alert alert-danger p-2">
                                            <h4 class="text-center">Indiquez un problème ou laissez un commentaire</h4>
                                        </div>
                                    @endif
                                    <div class="row bg-light rounded p-2 mt-2">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="selectOperateur">
                                                        <span class="text-danger">*</span>Opérateur
                                                    </label>
                                                </div>
                                                <select class="custom-select" id="selectOperateur"
                                                    wire:model="operateur" required>
                                                    <option value="">Selectionner un opérateur</option>
                                                    <option value="MTN">MTN</option>
                                                    <option value="ORANGE">ORANGE</option>
                                                    <option value="MOOV">MOOV</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="selectLocalite"><span
                                                            class="text-danger">*</span> Localité
                                                    </label>
                                                </div>
                                                <div>
                                                    <select class="custom-select select2" id="selectLocalite"
                                                        wire:model="localite" required>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-8 bg-light rounded pt-0">
                                            <h3 class="mb-3" style="font-size: 20px; font-weight:bold">
                                                <u>
                                                    Identifiez un problème réseau
                                                </u>
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <h3 class="p-0" style="font-size: 16px; font-weight:bold">
                                                        Internet :
                                                    </h3>
                                                    <div class="pl-3">
                                                        <div class="form-group form-check  pl-0 p-1 rounded col">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="internetLent" wire:model="internetLent">
                                                            <label class="form-check-label"
                                                                for="internetLent">Connexion
                                                                lente</label>
                                                        </div>
                                                        <div class="form-group form-check  pl-0 p-1 rounded col">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="internetImpossible"
                                                                wire:model="internetImpossible">
                                                            <label class="form-check-label"
                                                                for="internetImpossible">Connexion
                                                                inexistante</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-4 border-lw bg-light">
                                                    <h3 class="p-0" style="font-size: 16px; font-weight:bold">
                                                        Appel :
                                                    </h3>
                                                    <div class="pl-3">
                                                        <div class="form-group form-check pl-0 p-1 rounded ">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="appelFluide" wire:model="appelFluide">
                                                            <label class="form-check-label" for="appelFluide">Appel
                                                                non
                                                                fluide</label>
                                                        </div>
                                                        <div class="form-group form-check pl-0 p-1 rounded ">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="appelImpossible" wire:model="appelImpossible">
                                                            <label class="form-check-label"
                                                                for="appelImpossible">Appel
                                                                impossible</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 border-lw bg-light">
                                                    <h3 class="p-0" style="font-size: 16px; font-weight:bold">
                                                        SMS : </h3>
                                                    <div class="pl-3">
                                                        <div class="form-group form-check pl-0 p-1 rounded">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="eSmsLent" wire:model="eSmsLent">
                                                            <label class="form-check-label" for="eSmsLent">Envoi
                                                                de
                                                                SMS lent</label>
                                                        </div>
                                                        <div class="form-group form-check pl-0 p-1 rounded">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="rSmsLent" wire:model="rSmsLent">
                                                            <label class="form-check-label" for="rSmsLent">Reception
                                                                de SMS lente</label>
                                                        </div>
                                                        <div class="form-group form-check pl-0 p-1 rounded">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="eSmsImpossible" wire:model="eSmsImpossible">
                                                            <label class="form-check-label" for="eSmsImpossible">Envoi
                                                                des
                                                                SMS impossible</label>
                                                        </div>
                                                        <div class="form-group form-check pl-0 p-1 rounded">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="rSmsImpossible" wire:model="rSmsImpossible">
                                                            <label class="form-check-label"
                                                                for="rSmsImpossible">Reception
                                                                des SMS impossible</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-center" style="font-size: 20px; font-weight:bold">
                                                <u>
                                                    Laissez votre contact
                                                </u>
                                            </h3>
                                            <div class="form-group w-100">
                                                <label class="form-label mt-2" for="phone">Numéro de téléphone
                                                    :</label>
                                                <input id="phone" type="tel" class="form-control"
                                                    placeholder="Ex: (+225) 00 00 00 00 00" wire:model="telephone"
                                                    pattern="/(7|8|9)\d{9}$/ ">
                                                @error('telephone')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2 w-100">
                                                <label class="form-label" for="email">Email</label>
                                                <input id="email" type="email" class="form-control "
                                                    placeholder="Saisir un email" wire:model="mail">
                                                @error('mail')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2 w-100">
                                                <label class="form-label" for="comment">Commentaire</label>
                                                <div class="form-group mb-3">
                                                    <textarea id="comment" placeholder="Saisir votre commentaire" class="form-control "
                                                        id="exampleFormControlTextarea1" rows="5" wire:model="comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-end mt-3">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-send me-2"></i> Soumettre le formulaire</button>
                                    </div>
                                </form>
                            </div>

                            <script>
                                //Remove all options of Select2

                                let locs = Object.keys(localite).map(function(cle) {
                                    return [Number(cle), localite[cle]];
                                });

                                let select = document.getElementById("selectLocalite");

                                for (let i = 0; i < 50; i++) {
                                    let newOption

                                    if (i != 49) {
                                        newOption = new Option(locs[i][1].loc + '/ ' + locs[i][1].sp, locs[i][1].loc);
                                    }
                                    if (i == 49) {
                                        newOption = new Option("Saisir une recherche pour plus ...", "");
                                    }
                                    select.options.add(newOption);
                                }



                                //Init Select 2
                                $('#selectLocalite').select2({
                                    placeholder: "Recherche...",
                                });

                                //Manage select2 data for fast chargement
                                $(document).on('keyup', '.select2-search__field', function(e) {
                                    let val = e.target.value.toUpperCase()
                                    if (val?.length > 1) {
                                        let mLocs = locs.filter(item => item[1].loc.includes(val));

                                        if (mLocs?.length > 0) {
                                            //Remove all options of Select2
                                            console.log('ok')
                                            let s, L = select.options.length - 1;
                                            for (s = L; s >= 0; s--) {
                                                select.remove(s);
                                            }

                                            //Add search options
                                            mLocs.forEach((dloc) => {
                                                let newOption = new Option(dloc[1].loc + '/ ' + dloc[1].sp, dloc[1].loc);
                                                select.options.add(newOption);
                                            })
                                        }
                                    } else {
                                        for (let i = 0; i < 50; i++) {
                                            let newOption

                                            if (i != 49) {
                                                newOption = new Option(locs[i][1].loc + ' / ' + locs[i][1].sp, locs[i][1].loc);
                                            }
                                            if (i == 49) {
                                                newOption = new Option("Saisir une recherche pour plus ...", "");
                                            }
                                            select.options.add(newOption);
                                        }
                                    }
                                });

                                $('#selectLocalite').on('change', function(e) {
                                    @this.set('localite', e.target.value);
                                });

                                setTimeout(() => {
                                    $('.select2-search__field').attr('placeholder', 'Entrez votre recherche...');
                                }, 1000);
                            </script>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>


</div>
