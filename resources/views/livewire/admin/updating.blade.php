<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if ($updated == "dashboard")
    <div class="p-3">
        <div class="notifications-box">
            <div class="d-flex justify-center">
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
                            <h5>Chargement en cours !</h5>
                        </div>
                    </div>
                </div>
            </div>
            @if($success)
            <h3>Nombre total de localités couvertes :</h3>
            @endif
            <table class="mb-0 table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Orange</th>
                        <th>Mtn</th>
                        <th>Moov</th>
                        <!-- <th>Total</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Localité Couverte 2G</th>

                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(8)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(11)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(14)">Mise à jour</a></td>
                        <!-- <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(2)">Mise à jour</a></td> -->
                    </tr>
                    <tr>
                        <th scope="row">Localité Couverte 3G</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(9)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(12)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(15)">Mise à jour</a></td>
                        <!-- <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(3)">Mise à jour</a></td> -->
                    </tr>
                    <tr>
                        <th scope="row">Localité Couverte 4G</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(10)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(13)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(16)">Mise à jour</a></td>
                        <!-- <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(4)">Mise à jour</a></td> -->
                    </tr>
                    <!-- <tr>
                        <th scope="row">Couverture totale</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(5)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(6)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(7)">Mise à jour</a></td>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.updateData(1)">Mise à jour</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Total Localité Couverte</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="d-flex justify-center">
        <div class="row">
            <div class="col-md-3 row">
                <div class="col-md-6">
                    <a href="#" class="btn btn-info float-right" onclick="@this.updateStatDistrict()">Mise à jour Statistiques
                        District</a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn btn-info float-right" onclick="@this.updateStatRegion()">Mise à jour Statistiques
                        Region</a>
                </div>
            </div>
            <div class="col-md-9 row">
                <div class="col-md-3">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.updateData(0)">Mise à jour localités non
                        couvertes</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.updateStationData(1)">Mise à jour stations 2G</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.updateStationData(2)">Mise à jour stations 3G</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.updateStationData(3)">Mise à jour stations 4G</a>
                </div>
                <div class="col-md-3 mt-2">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.loadProperty()">Misse à jour variables données</a>
                </div>
                <div class="col-md-3 mt-2">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.updateData(18)">Toute les données</a>
                </div>
                <div class="col-md-3 mt-2">
                    <a href="#" class="btn btn-dark float-right" onclick="@this.loadCouverture()">Données téléchargeables</a>
                </div>
            </div>
        </div>
    </div> -->
    @elseif ($updated == "orange2g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{number_format($popPercent, 2)}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{number_format($loPercent, 2)}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 2G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Orange 2G</th>
                                        <th>Couverture Orange 2G</th>
                                        <th>Population Orange 2G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_2G_orange == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_orange == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_orange }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(8, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(8)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Orange 2G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Orange 2G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Orange 2G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(8)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "orange3g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 3G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Orange 3G</th>
                                        <th>Couverture Orange 3G</th>
                                        <th>Population Orange 3G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_3G_orange == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_3G_orange == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_3G_orange }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(9, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(9)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Orange 3G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Orange 3G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Orange 3G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(9)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "orange4g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 4G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Orange 4G</th>
                                        <th>Couverture Orange 4G</th>
                                        <th>Population Orange 4G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_4G_orange == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_4G_orange == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_4G_orange }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(10, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(10)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Orange 4G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Orange 4G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Orange 4G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(10)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "mtn2g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 2G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence MTN 2G</th>
                                        <th>Couverture MTN 2G</th>
                                        <th>Population MTN 2G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_2G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_mtn }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(11, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(11)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence MTN 2G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture MTN 2G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population MTN 2G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(11)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "mtn3g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 3G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence MTN 3G</th>
                                        <th>Couverture MTN 3G</th>
                                        <th>Population MTN 3G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_3G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_3G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_3G_mtn }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(12, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(12)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence MTN 3G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture MTN 3G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population MTN 3G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(12)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "mtn4g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 4G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence MTN 4G</th>
                                        <th>Couverture MTN 4G</th>
                                        <th>Population MTN 4G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_4G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_4G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_4G_mtn }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(13, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(13)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence MTN 4G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture MTN 4G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population MTN 4G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(13)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "moov2g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 2G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Moov 2G</th>
                                        <th>Couverture Moov 2G</th>
                                        <th>Population Moov 2G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_2G_moov == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_moov == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_moov }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(14, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(14)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Moov 2G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Moov 2G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Moov 2G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(14)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "moov3g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 3G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Moov 3G</th>
                                        <th>Couverture Moov 3G</th>
                                        <th>Population Moov 3G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_3G_moov == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_3G_moov == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_3G_moov }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(15, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(15)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Moov 3G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Moov 3G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Moov 3G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(15)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @elseif ($updated == "moov4g")
    <div class="container mt-3">
        @if ($updatedCrud == "view")
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notifications-box">
                            <div class="d-flex justify-center">
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
                                            <h5>Chargement en cours !</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                                <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} | {{$popPercent}}%</p>
                                </div>
                                <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} | {{$loPercent}}%</p>
                                </div>
                                <h4 class="text-center" style="font-size: 15px">Orange 4G</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{-- {!! $users->links() !!} --}}
                            </div>
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence Moov 4G</th>
                                        <th>Couverture Moov 4G</th>
                                        <th>Population Moov 4G</th>
                                        <th>Population totale</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($couvertureReseau as $reseau)
                                    <tr>
                                        <td>{{ $i=$i++ }}</td>
                                        <td>{{ $reseau->localite }}</td>
                                        <td>{{ $reseau->presence_4G_moov == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_4G_moov == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_couverte_4G_moov }}</td>
                                        <td>{{$reseau->population_totale}}</td>
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(16, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                setTimeout(() => {
                                    tableAdd('updateTable');
                                }, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($updatedCrud == "update")
        <div class="card">
            <div class="card-body">
                <form class="w-100" wire:submit.prevent="validateUpdate(16)">
                    @csrf
                    @if ($alertUpdatedMessage != null)
                    <div class="alert {{$alertUpdatedColor}}" role="alert">
                        {{$alertUpdatedMessage}}
                    </div>
                    @endif
                    <div class="form-group ">
                        <label for="exampleFormControlInput1">Localité</label>
                        <input type="text" class="form-control" wire:model="local" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Presence Moov 4G</label>
                            <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlSelect1">Couverture Moov 4G</label>
                            <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population Moov 4G</label>
                            <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                        </div>
                        <div class="col form-group">
                            <label for="exampleFormControlInput1">Population totale</label>
                            <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        <div class="btn btn-dark" onclick="@this.retourUpdate(16)">Retour</div>

                        <x-jet-button class="ml-4">
                            {{ __('Modifier') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
</div>