<div>
    {{-- Be like water. --}}
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
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>{{Auth::user()->role}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Couverture 2G</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(2)">Mise à jour</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Couverture 3G</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(3)">Mise à jour</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Couverte 4G</th>
                        <td><a href="#" class="btn btn-info float-center" onclick="@this.selectUpdate(4)">Mise à jour</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @elseif ($updated == "2g")
    <div class="container mt-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($updatedCrud == "view")
                        <div>
                            <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                            <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} |{{number_format($popPercent, 2)}}%</p>
                            </div>
                            <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} |{{number_format($loPercent, 2)}}%</p>
                            </div>
                            <h4 class="text-center" style="font-size: 15px">{{Auth::user()->role}} 2G</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{-- {!! $users->links() !!} --}}
                        </div>
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
                            <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Localité</th>
                                        <th>Presence 2G</th>
                                        <th>Couverture 2G</th>
                                        <th>Population couverte</th>
                                        <th>Population totale</th>
                                        <th>Action</th>
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

                                        @if (Auth::user()->role == 'orange')
                                        <td>{{$reseau->presence_2G_orange == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_orange == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_orange}}</td>
                                        <td>{{ $reseau->population_totale }}</td>
                                        @endif

                                        @if (Auth::user()->role == 'moov')
                                        <td>{{$reseau->presence_2G_moov == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_moov == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_moov}}</td>
                                        <td>{{ $reseau->population_totale }}</td>
                                        @endif

                                        @if (Auth::user()->role == 'mtn')
                                        <td>{{$reseau->presence_2G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                        <td>{{ $reseau->couverture_2G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                        <td>{{ $reseau->population_2G_mtn}}</td>
                                        <td>{{ $reseau->population_totale }}</td>
                                        @endif
                                        <td>
                                            <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(2, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <script>
                            setTimeout(() => {
                                tableAdd('updateTable');
                            }, 1000);
                        </script>
                        @elseif ($updatedCrud == "update")
                        <form class="w-100" wire:submit.prevent="validateUpdate(2)">
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
                                    <label for="exampleFormControlSelect1">Presence 2G</label>
                                    <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlSelect1">Couverture 2G</label>
                                    <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population couverte</label>
                                    <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population totale</label>
                                    <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                                </div>
                            </div>
                            <div class="flex items-center justify-end m-2">

                                <x-jet-button class="ml-4">
                                    {{ __('Soumettre la modification') }}
                                </x-jet-button>

                                <div class="btn btn-dark ml-2" onclick="@this.retourUpdate(2)">Retour</div>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif ($updated == "3g")
    <div class="container mt-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($updatedCrud == "view")
                        <div>
                            <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                            <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} |{{number_format($popPercent, 2)}}%</p>
                            </div>
                            <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} |{{number_format($loPercent, 2)}}%</p>
                            </div>
                            <h4 class="text-center" style="font-size: 15px">{{Auth::user()->role}} 3G</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{-- {!! $users->links() !!} --}}
                        </div>
                        <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Localité</th>
                                    <th>Presence 3G</th>
                                    <th>Couverture 3G</th>
                                    <th>Population couverte</th>
                                    <th>Population totale</th>
                                    <th>Action</th>
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

                                    @if (Auth::user()->role == 'orange')
                                    <td>{{$reseau->presence_3G_orange == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_3G_orange == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_couverte_3G_orange}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif

                                    @if (Auth::user()->role == 'moov')
                                    <td>{{$reseau->presence_3G_moov == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_3G_moov == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_couverte_3G_moov}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif

                                    @if (Auth::user()->role == 'mtn')
                                    <td>{{$reseau->presence_3G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_3G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_3G_mtn}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif
                                    <td>
                                        <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(3, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
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
                        @elseif ($updatedCrud == "update")
                        <form wire:submit.prevent="validateUpdate(3)">
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
                                    <label for="exampleFormControlSelect1">Presence 3G</label>
                                    <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlSelect1">Couverture 3G</label>
                                    <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population couverte</label>
                                    <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population totale</label>
                                    <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                                </div>
                            </div>
                            <div class="flex items-center justify-end m-2">
                                <div class="btn btn-dark" onclick="@this.retourUpdate(3)">Retour</div>

                                <x-jet-button class="ml-4">
                                    {{ __('Soumettre la modification') }}
                                </x-jet-button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif ($updated == "4g")
    <div class="container mt-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($updatedCrud == "view")
                        <div>
                            <div class="btn btn-dark" onclick="@this.retourAccueil()">Retour</div>
                            <div class="btn btn-light">Population couverte: <p class="font-weight-bold">{{$popCo}} |{{number_format($popPercent, 2)}}%</p>
                            </div>
                            <div class="btn btn-light">Localité couverte: <p class="font-weight-bold">{{$loCo}} |{{number_format($loPercent, 2)}}%</p>
                            </div>
                            <h4 class="text-center" style="font-size: 15px">{{Auth::user()->role}} 4G</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{-- {!! $users->links() !!} --}}
                        </div>
                        <table style="width: 100%;" id="updateTable" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Localité</th>
                                    <th>Presence 4G</th>
                                    <th>Couverture 4G</th>
                                    <th>Population couverte</th>
                                    <th>Population totale</th>
                                    <th>Action</th>
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

                                    @if (Auth::user()->role == 'orange')
                                    <td>{{$reseau->presence_4G_orange == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_4G_orange == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_couverte_4G_orange}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif

                                    @if (Auth::user()->role == 'moov')
                                    <td>{{$reseau->presence_4G_moov == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_4G_moov == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_couverte_4G_moov}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif

                                    @if (Auth::user()->role == 'mtn')
                                    <td>{{$reseau->presence_4G_mtn == 1 ? 'OUI': 'NON'}}</td>
                                    <td>{{ $reseau->couverture_4G_mtn == 1 ? 'OUI': 'NON' }}</td>
                                    <td>{{ $reseau->population_couverte_4G_mtn}}</td>
                                    <td>{{ $reseau->population_totale }}</td>
                                    @endif
                                    <td>
                                        <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUpdate(4, '{{ $reseau->localite }}')"><i class="fas fa-edit"></i></a>
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
                        @elseif ($updatedCrud == "update")
                        <form wire:submit.prevent="validateUpdate(4)">
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
                                    <label for="exampleFormControlSelect1">Presence 4G</label>
                                    <select class="form-control" wire:model="presence" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlSelect1">Couverture 4G</label>
                                    <select class="form-control" wire:model="couverture" id="exampleFormControlSelect1" required>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population couverte</label>
                                    <input type="number" min="0" max="{{$popTot}}" wire:model="pop2G" class="form-control" id="exampleFormControlInput1" disabled>

                                </div>
                                <div class="col form-group">
                                    <label for="exampleFormControlInput1">Population totale</label>
                                    <input type="number" wire:model="popTot" class="form-control" id="exampleFormControlInput1" disabled>
                                </div>
                            </div>
                            <div class="flex items-center justify-end m-2">
                                <div class="btn btn-dark" onclick="@this.retourUpdate(4)">Retour</div>

                                <x-jet-button class="ml-4">
                                    {{ __('Soumettre la modification') }}
                                </x-jet-button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>