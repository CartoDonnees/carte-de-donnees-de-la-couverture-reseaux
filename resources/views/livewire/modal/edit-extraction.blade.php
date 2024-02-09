<div>
    <div class="card pt-3">
        <div class="d-flex justify-content-end ">
            <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom"
                class="btn-shadow mr-3 btn btn-danger" data-original-title="Example Tooltip">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="alert alert-info fade show" role="alert">
                <h3 style="font-size: 18px" class="text-warning text-center">!!! À lire attentivement !!!</h3>
                <p>Cette section vous permet d'extraire des données selon vos préférences. Cependant chaque étape dépend
                    du précédent.</p>
                <p>Il existe en tout <b>5 étapes:</b> <b>Districts</b>, <b>Régions</b>, <b>Départements</b>,
                    <b>Sous-prefectures</b> et <b>Localités</b>. L'utilisateur n'a pas besoin de terminer toutes les
                    étapes avant d'extraire les données
                </p>
                <p><b>Par exemple :</b> uniquement les régions appartenant aux districts sélectionnés(s) seront présentes
                    à la deuxième étape (2) et ainsi de suite</p>
                <br>
                Sélectionner plusieurs districts en maintenant la touche <b>Ctrl</b> et <b>Clic</b> ( !
                <b>Glisser</b> vers le <b>bas</b> ou vers le <b>haut</b> !)
            </div>

                                
            <div class="scroll-area-lg">
                <div class="scrollbar-container ps--active-y">
                    <div wire:loading>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="loader-wrapper d-flex justify-content-center align-items-center">
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
                            </div>
                            <div class="col-md-12">
                                <h5>Chargement des données !</h5>
                            </div>
                        </div>
                    </div>
                    <div wire:loading.remove>
                        @if($action == 'district')
                        <div class="mb-2">
                            <h2 class="text-center" style="font-size: 20px">Etape <b class="text-info">1</b> sélection
                                de districts</h2>
                        </div>
                        <form wire:submit.prevent="submitMySelect()">
                            <h2 style="font-size: 18px"><b>Districts :</b></h2>
                            <div class="form-group">
                                <select name="" multiple class="form-control form-control-sm" style="height: 300px" wire:model.defer="district">
                                    <option>BAS-SASSANDRA</option>
                                    <option>COMOE</option>
                                    <option>DENGUELE</option>
                                    <option>ABIDJAN</option>
                                    <option>YAMOUSSOUKRO</option>
                                    <option>GOH-DJIBOUA</option>
                                    <option>LACS</option>
                                    <option>LAGUNES</option>
                                    <option>MONTAGNES</option>
                                    <option>SASSANDRA-MARAHOUE</option>
                                    <option>SAVANES</option>
                                    <option>VALLEE DU BANDAMA</option>
                                    <option>WOROBA</option>
                                    <option>ZANZAN</option>
                                </select>
                            </div>
                            <a class="btn btn-secondary text-light float-left" onclick="@this.extratDistrict()">Extraire</a>
                            <button type="submit" class="btn btn-primary float-right">Suivant</button>
                        </form>
                        @elseif($action == "region")
                        <div class="mb-2">
                            <h2 class="text-center" style="font-size: 20px">Etape <b class="text-info">2</b> sélection
                                de régions</h2>
                        </div>
                        <form wire:submit.prevent="submitRegionSelect()">
                            <div class="row">
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Districts sélectionné(s) :</h4>
                                        @foreach($district as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h2 style="font-size: 18px"><b>Régions :</b></h2>
                                    <div class="form-group">
                                        <select name="" multiple class="form-control form-control-sm" style="height: 300px" wire:model.defer="region">
                                            @foreach($regions as $value)
                                            <option>{{ $value->new_region}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-secondary text-light float-left" onclick="@this.extratRegion()">Extraire</a>
                            <a class="btn btn-info text-light float-left ml-3" onclick="@this.precedentDistrict()">Précédent</a>
                            <button type="submit" class="btn btn-primary float-right">Suivant</button>
                        </form>
                        @elseif($action == "departement")
                        <div class="mb-2">
                            <h2 class="text-center" style="font-size: 20px">Etape <b class="text-info">3</b> sélection
                                de departements</h2>
                        </div>
                        <form wire:submit.prevent="submitDepartSelect()">
                            <div class="row">
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Districts sélectionné(s)</h4>
                                        @foreach($district as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Régions sélectionnée(s)</h4>
                                        @foreach($region as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h2 style="font-size: 18px"><b>departements :</b></h2>
                                    <div class="form-group">
                                        <select name="" multiple class="form-control form-control-sm" style="height: 300px" wire:model.defer="departement">
                                            @foreach($departements as $value)
                                            <option>{{ $value->new_departement }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-secondary text-light float-left" onclick="@this.extratDepartement()">Extraire</a>
                            <a class="btn btn-info text-light float-left ml-3" onclick="@this.precedentRegion()">Précédent</a>
                            <button type="submit" class="btn btn-primary float-right">Suivant</button>
                        </form>
                        @elseif($action == "sous_pref")
                        <div class="mb-2">
                            <h2 class="text-center" style="font-size: 20px">Etape <b class="text-info">4</b> sélection
                                de sous-prefectures</h2>
                        </div>
                        <form wire:submit.prevent="submitSous_prefSelect()">
                            <div class="row">
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Districts sélectionné(s)</h4>
                                        @foreach($district as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Régions sélectionnée(s)</h4>
                                        @foreach($region as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">departements sélectionné(s)
                                        </h4>
                                        @foreach($departement as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 style="font-size: 18px"><b>Sous-prefecture :</b></h2>
                                    <div class="form-group">
                                        <select name="" multiple class="form-control form-control-sm" style="height: 300px" wire:model.defer="sous_pref">
                                            @foreach($sous_prefs as $val)
                                            <option>{{ $val->sous_prefecture }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-secondary text-light float-left" onclick="@this.extratSousPref()">Extraire</a>
                            <a class="btn btn-info text-light float-left ml-3" onclick="@this.precedentDepartement()">Précédent</a>
                            <button type="submit" class="btn btn-primary float-right">Suivant</button>
                        </form>
                        @elseif($action == "localite")
                        <div class="mb-2">
                            <h2 class="text-center" style="font-size: 20px">Etape <b class="text-info">5</b> sélection
                                de Localités</h2>
                        </div>
                        <form wire:submit.prevent="extratLocalite()">
                            <div class="row">
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">District sélectionné(s)</h4>
                                        @foreach($district as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Régions sélectionnée(s)</h4>
                                        @foreach($region as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">departements sélectionné(s)
                                        </h4>
                                        @foreach($departement as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 bg-light">
                                    <div class="p-2">
                                        <h4 style="font-size: 12px" class="text-primary">Sous-prefectures sélectionnée(s)
                                        </h4>
                                        @foreach($sous_pref as $value)
                                        <h5><b>{{ $value }}</b></h5>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h2 style="font-size: 18px"><b>Localités :</b></h2>
                                    <div class="form-group">
                                        <select name="" multiple class="form-control form-control-sm" style="height: 300px" wire:model.defer="localite">
                                            @foreach($localites as $value)
                                            <option>{{ $value->localite }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-info text-light float-left ml-3" onclick="@this.precedentSousPrefecture()">Précédent</a>
                                <button type="submit" class="btn btn-secondary">Extraire les données</button>
                            </div>
                        </form>
                        @elseif($action == "data")
                        <h4 style="font-size: 20px" class="text-primary mb-2">Extraction de données</h4>
                        <table style="width: 100%;" id="myda" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>LOCALITE</th>
                                    <th>SOUS-PREFECTURE</th>
                                    <th>DEPARTEMENT</th>
                                    <th>REGION</th>
                                    <th>DISTRICT</th>
                                    <th>POPULATION</th>
                                    <th>COUVERTURE 2G ORANGE</th>
                                    <th>COUVERTURE 2G MTN</th>
                                    <th>COUVERTURE 2G MOOV</th>
                                    <th>SYNTHESE COUVERTURE 2G</th>
                                    <th>COUVERTURE 3G ORANGE</th>
                                    <th>COUVERTURE 3G MTN</th>
                                    <th>COUVERTURE 3G MOOV</th>
                                    <th>SYNTHESE COUVERTURE 3G</th>
                                    <th>COUVERTURE 4G ORANGE</th>
                                    <th>COUVERTURE 4G MTN</th>
                                    <th>COUVERTURE 4G MOOV</th>
                                    <th>SYNTHESE COUVERTURE 4G</th>
                                </tr>
                            </thead>
                            <tbody id="tbrn">
                                @foreach($datas as $value)
                                <tr>
                                    <td>{{ $value->localite }}</td>
                                    <td>{{ $value->sous_prefecture }}</td>
                                    <td>{{ $value->departement }}</td>
                                    <td>{{ $value->region}}</td>
                                    <td>{{ $value->district }}</td>
                                    <td>{{ intval($value->population_totale) }}</td>

                                    <td><i class=" {{ $value->couverture_2G_orange == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_2G_orange == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_2G_mtn == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_2G_mtn == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_2G_moov == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_2G_moov == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->synthese_couverture_2G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->synthese_couverture_2G == 1 ? ' Oui' :' Non' }}</i></td>

                                    <td><i class=" {{ $value->couverture_3G_orange == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_3G_orange == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_3G_mtn == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_3G_mtn == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_3G_moov == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_3G_moov == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->synthese_couverture_3G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->synthese_couverture_3G == 1 ? ' Oui' :' Non' }}</i></td>

                                    <td><i class=" {{ $value->couverture_4G_orange == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_4G_orange == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_4G_mtn == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_4G_mtn == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->couverture_4G_moov == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->couverture_4G_moov == 1 ? ' Oui' :' Non' }}</i></td>
                                    <td><i class=" {{ $value->synthese_couverture_4G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}">
                                            {{ $value->synthese_couverture_4G == 1 ? ' Oui' :' Non' }}</i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            tableAdd('myda')
                        </script>
                        <a onclick="@this.precedent()" class="btn btn-warning">Précédent</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
</div>

</div>