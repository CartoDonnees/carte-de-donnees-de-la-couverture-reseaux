{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<div class="app-main__outer p-2">
    <div class="app-main__inner">
        <div class="app-inner-layout">
            <div class="app-inner-layout__header-boxed p-0">
                <div class="app-inner-layout__header page-title-icon-rounded text-white bg-premium-dark mb-4">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <a href="javascript:void()">
                                        <i class="fas fa-home icon-gradient bg-sunny-morning"></i>
                                    </a>
                                </div>
                                <div>
                                    Tableau de bord d'administration du site
                                    <div class="page-title-subheading">Faciliter la mise à jour du portail web par l'ajout, l’édition et la suppression de contenus.
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'main' ? 'nav-link text-white active' : '' }}" onclick="@this.set('action','main')" href="#tab-animated-0">
                                        <span>Modification apportées</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'updated' ? 'nav-link active text-white' : '' }}" id="tab-c-0" onclick="@this.set('action','updated')" href="#tab-animated-3">
                                        <span>Mise à jour</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="container">
                                    @if($action == 'main')
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if($modification == 'table')
                                                    <h4 class="text-center" style="font-size: 15px">Tableau des mises à jours</h4>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- {!! $users->links() !!} --}}
                                                    </div>
                                                    <table style="width: 100%;" id="userTable" class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Localité</th>
                                                                <th>Technologie</th>
                                                                <th>Demandeur</th>
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
                                                                <td>{{ $jour->technologie }}</td>
                                                                <td>{{ $jour->demandeur}}</td>
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
                                                            tableAdd('userTable');
                                                        }, 1000);
                                                    </script>
                                                    @elseif($modification == 'edit')
                                                    <form wire:submit.prevent="deleteUpdate({{$deleteId}})">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="col form-group">
                                                                <label for="exampleFormControlInput1">Localité</label>
                                                                <input type="text" class="form-control" wire:model="localM" id="exampleFormControlInput1" disabled>
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

                                                            @if($statutM != 0)
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
                                                            <div class="btn btn-dark ml-2" onclick="@this.set('modification','table')">Retour</div>

                                                            @if($statutM == 0)
                                                            <x-jet-button class="ml-4">
                                                                {{ __('Supprimer') }}
                                                            </x-jet-button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($action == 'updated')
                        <div class="p-3">@livewire('operateur.updating')</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="app-wrapper-footer">
    <div class="app-footer">
        <div class="app-footer__inner">
            <div class="app-footer-left">
            </div>
            <div class="app-footer-right">
                <ul class="header-megamenu nav">
                    <li class="nav-item">
                        <a data-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">
                            ARTCI-DEMP 2021
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>