<div>
    {{-- The whole world belongs to you. --}}
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($modification == 'table')
                    <h4 class="text-center" style="font-size: 15px">Tableau des mises à jours</h4>
                    <div class="d-flex justify-content-center">
                        {{-- {!! $users->links() !!} --}}
                    </div>
                    <table style="width: 100%;" id="controleTable" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Localité</th>
                                <th>Operateur</th>
                                <th>Demandeur</th>
                                <th>Technologie</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($update as $jour)
                            <tr>
                                <td>{{ $i=$i++ }}</td>
                                <td>{{ $jour->localite }}</td>
                                <td>{{$jour->operateur}}</td>
                                <td>{{$jour->demandeur}}</td>
                                <td>{{ $jour->technologie }}</td>
                                <td>{{date("d/m/Y à H:i:s", strtotime($jour->created_at))}}</td>
                                <td>{{ ($jour->statut == 0) ? 'En attente' : (($jour->statut == 1) ? 'Accepter' : 'Rejeter')}}</td>
                                <td>
                                    <a href="javascript:void()" class="btn btn-primary" onclick="@this.editUpdate({{$jour->id}})"><i class="fas fa-edit"></i></a>

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
                            tableAdd('controleTable');
                        }, 1000);
                    </script>
                    @elseif($modification == 'edit')
                    <form wire:submit.prevent="acceptUpdate({{$deleteId}})">
                        @csrf
                        @if ($alertUpdatedMessage != null)
                        <div class="alert {{$alertUpdatedColor}}" role="alert">
                            {{$alertUpdatedMessage}}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Localité</label>
                                <input type="text" class="form-control" wire:model="localM" id="exampleFormControlInput1" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Operateur</label>
                                <input type="text" class="form-control" wire:model="operateurM" id="exampleFormControlInput1" disabled>
                            </div>
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Demandeur de la modification:</label>
                                <input type="text" class="form-control" wire:model="demandeurM" id="exampleFormControlInput1" disabled>
                            </div>
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Technologie</label>
                                <input type="text" class="form-control" wire:model="techM" id="exampleFormControlInput1" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Envoyé le:</label>
                                <input type="text" class="form-control" wire:model="dateM" id="exampleFormControlInput1" disabled>
                            </div>
                            @if ($updateM != null)
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Traité le:</label>
                                <input type="text" class="form-control" wire:model="updateM" id="exampleFormControlInput1" disabled>
                            </div>
                            @endif
                            <div class="col form-group">
                                <label for="exampleFormControlSelect1">Statut</label>
                                <select class="form-control" wire:model="statutM" id="exampleFormControlSelect1" disabled>
                                    <option value="2">Rejeter</option>
                                    <option value="1">Accepter</option>
                                    <option value="0">En attente</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="exampleFormControlSelect1">Presence {{$techM}}</label>
                                <select class="form-control" wire:model="presenceM" id="exampleFormControlSelect1" disabled>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label for="exampleFormControlSelect1">Couverture {{$techM}}</label>
                                <select class="form-control" wire:model="couvertureM" id="exampleFormControlSelect1" disabled>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Population couverte</label>
                                <input type="number" min="0" max="{{$popTotM}}" wire:model="pop2GM" class="form-control" id="exampleFormControlInput1" disabled>

                            </div>
                            <div class="col form-group">
                                <label for="exampleFormControlInput1">Population totale</label>
                                <input type="number" wire:model="popTotM" class="form-control" id="exampleFormControlInput1" disabled>
                            </div>
                        </div>
                        <div class="flex items-center justify-end m-2">


                            @if($statutM == 0 || $statutM == 2)
                            <x-jet-button class="ml-4">
                                {{ __('Accepter') }}
                            </x-jet-button>
                            @endif
                            @if($statutM == 0)
                            <div class="btn btn-success btn-lg ml-2" onclick="@this.rejectUpdate({{$deleteId}})">Rejeter</div>
                            @endif
                            <div class="btn btn-dark btn-lg ml-2" onclick="@this.set('modification','table')">Retour</div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>