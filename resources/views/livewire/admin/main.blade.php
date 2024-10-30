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
                                        <span>Utilisateurs</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'comment' ? 'nav-link text-white active' : '' }}" onclick="@this.set('action','comment')" href="#tab-animated-0">
                                        <span>Commentaires</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'news' ? 'nav-link active text-white' : '' }}" onclick="@this.set('action','news')" href="#tab-animated-1">
                                        <span>Newsletters</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'updated' ? 'nav-link active text-white' : '' }}" id="tab-c-0" onclick="@this.set('action','updated')" href="#tab-animated-3">
                                        <span>Mise à jour</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class=" btn btn-light {{ $action == 'controle' ? 'nav-link active text-white' : '' }}" id="tab-c-0" onclick="@this.set('action','controle')" href="#tab-animated-3">
                                        <span>Controle</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="container">
                                    @if($action == 'main')
                                    <div class="row mt-2">
                                        @if($userCrud == 'view')
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="text-center" style="font-size: 15px">Gestion des utilisateurs</h4>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- {!! $users->links() !!} --}}
                                                    </div>
                                                    <table style="width: 100%;" id="userTable" class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nom et premoms</th>
                                                                <th>Email</th>
                                                                <th>Statut</th>
                                                                <th>Date d'inscription</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $i=1;
                                                            @endphp
                                                            @foreach($users as $user)
                                                            <tr>
                                                                <td>{{ $i=$i++ }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>

                                                                @if($user->role == 'admin')
                                                                <td>Régulateur</td>
                                                                @elseif ($user->role == 'moov')
                                                                <td>Moov</td>
                                                                @elseif ($user->role == 'mtn')
                                                                <td>Mtn</td>
                                                                @elseif($user->role == 'orange')
                                                                <td>Orange</td>
                                                                @elseif($user->role == 'user')
                                                                <td>Consommateur</td>
                                                                @endif

                                                                <!-- <td>{{strtoupper($user->role)}}</td> -->
                                                                <!-- <td class="{{ $user->role !='user' ? $user->role=='admin'? 'bg-success' : 'bg-info' : ''}}">{{$user->role}}</td> -->
                                                                
                                                                <td>{{ date("d/m/Y à H:i:s", strtotime($user->created_at)) }}</td>


                                                                <td>
                                                                    @if(Auth::user()->id != $user->id )
                                                                    <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectEditUser({{ $user->id }})"><i class="fas fa-edit"></i></a>
                                                                    <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectDeleteUser({{ $user->id }})"><i class="fas fa-trash"></i></a>
                                                                    @endif
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
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($userCrud != 'view')
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if ($userCrud == 'add')
                                                    <!-- <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>ARTCI</td>
                                                                <td>admin</td>
                                                                <td>Compte de l'ARTCI</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>MOOV</td>
                                                                <td>moov</td>
                                                                <td>Opérateur Moov</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>MTN</td>
                                                                <td>mtn</td>
                                                                <td>Opérateur MTN</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4</th>
                                                                <td>ORANGE</td>
                                                                <td>orange</td>
                                                                <td>Opérateur ORANGE</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5</th>
                                                                <td>Utilisateur</td>
                                                                <td>user</td>
                                                                <td>Compte ordinaire</td>
                                                            </tr>
                                                        </tbody>
                                                    </table> -->
                                                    <!-- <form wire:submit.prevent="submitUsers()">
                                                        @csrf
                                                        <div class="form-row">
                                                            @if ($alertMessage != null)
                                                            <div class="alert {{$alertColor}}" role="alert">
                                                                {{$alertMessage}}
                                                            </div>
                                                            @endif

                                                            <div class="col-md-12">
                                                                <div class="position-relative form-group">
                                                                    <x-jet-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" placeholder="Entrer un nom" required autofocus autocomplete="name" />
                                                                </div>
                                                                <div class="position-relative form-group">
                                                                    <x-jet-input id="first_name" wire:model="firstName" class="block mt-1 w-full" type="text" name="first_name" placeholder="Entrer un prénom" required autofocus autocomplete="name" />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="position-relative form-group">
                                                                    <x-jet-input id="email" wire:model="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required />
                                                                </div>
                                                                <div class="position-relative form-group " wire:model="role">
                                                                    <select class="custom-select" required>
                                                                        <option value="">Agence</option>
                                                                        <option value="admin">ARTCI</option>
                                                                        <option value="moov">MOOV</option>
                                                                        <option value="orange">ORANGE</option>
                                                                        <option value="mtn">MTN</option>
                                                                        <option value="user">Utilisateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="position-relative input-group">
                                                                        <x-jet-input id="password" wire:model="password" class="block w-full" type="password" name="password" placeholder="Mot de passe ..." required autocomplete="new-password" />
                                                                        <span class="input-group-text btn btn-primary text-white" onclick="Afficher()"><i class="fas fa-eye"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center justify-end m-2">
                                                            <x-jet-button class="ml-4">
                                                                {{ __('Ajouter') }}
                                                            </x-jet-button>
                                                        </div>
                                                    </form> -->
                                                    @elseif ($userCrud == 'edit')
                                                    <form wire:submit.prevent="submitEditUser()">
                                                        @csrf
                                                        <div class="">
                                                            @if ($alertMessage != null)
                                                            <div class="alert {{$alertColor}}" role="alert">
                                                                {{$alertMessage}}
                                                            </div>

                                                            @else

                                                            <div class="row">
                                                                <div class="form-group col">
                                                                    <label for="inputCity">Noms</label>
                                                                    <input type="text" class="form-control" id="inputCity" wire:model="name" disabled>
                                                                </div>

                                                                <div class="form-group col">
                                                                    <label for="inputEmail4">Mail</label>
                                                                    <input type="email" class="form-control" id="inputEmail4" wire:model="email" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col">
                                                                    <label for="inputCity">Date d'inscription</label>
                                                                    <input type="text" class="form-control" id="inputCity" wire:model="dateCreation" disabled>
                                                                </div>
                                                                <div class="form-group col" wire:model="d_role">
                                                                    <label for="inputState">Statut</label>
                                                                    <select id="inputState" class="form-control" disabled>
                                                                        <option {{ $userEdit->role == 'admin' ? 'selected': '' }}>Régulateur</option>
                                                                        <option {{ $userEdit->role == 'moov' ? 'selected': '' }}>Opérateur MOOV</option>
                                                                        <option {{ $userEdit->role == 'orange' ? 'selected': '' }}>Opérateur ORANGE</option>
                                                                        <option {{ $userEdit->role == 'mtn' ? 'selected': '' }}>Opérateur MTN</option>
                                                                        <option {{ $userEdit->role == 'user' ? 'selected': '' }}>Consommateur</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col" wire:model="role">
                                                                    <label for="inputState" class="text-primary">Changer le statut</label>
                                                                    <select id="inputState" class="form-control">
                                                                        <option value="admin" {{ $userEdit->role == 'admin' ? 'selected': '' }}>Régulateur</option>
                                                                        <option value="moov" {{ $userEdit->role == 'moov' ? 'selected': '' }}>Opérateur MOOV</option>
                                                                        <option value="orange" {{ $userEdit->role == 'orange' ? 'selected': '' }}>Opérateur ORANGE</option>
                                                                        <option value="mtn" {{ $userEdit->role == 'mtn' ? 'selected': '' }}>Opérateur MTN</option>
                                                                        <option value="user" {{ $userEdit->role == 'user' ? 'selected': '' }}>Consommateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex items-center justify-end m-2">
                                                            <div class="btn btn-dark" onclick="@this.userRetour()">Retour</div>
                                                            @if ($alertMessage == null)
                                                            <x-jet-button class="ml-4">
                                                                {{ __('Modifier') }}
                                                            </x-jet-button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                    @elseif ($userCrud == 'delete')
                                                    <form wire:submit.prevent="submitDeletetUser()">
                                                        @csrf
                                                        <div class="">
                                                            @if ($alertMessage != null)
                                                            <div class="alert {{$alertColor}}" role="alert">
                                                                {{$alertMessage}}
                                                            </div>

                                                            @endif

                                                            <div class="row">
                                                                <div class="form-group col">
                                                                    <label for="inputCity">Noms</label>
                                                                    <input type="text" class="form-control" id="inputCity" wire:model="name" disabled>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="inputCity">Pseudo</label>
                                                                    <input type="text" class="form-control" id="inputCity" wire:model="firstName" disabled>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="inputEmail4">Mail</label>
                                                                    <input type="email" class="form-control" id="inputEmail4" wire:model="email" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col">
                                                                    <label for="inputCity">Date d'inscription</label>
                                                                    <input type="text" class="form-control" id="inputCity" wire:model="dateCreation" disabled>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="inputState">Statut actuel</label>
                                                                    <select id="inputState" class="form-control" disabled>
                                                                        <option {{ $userEdit->role == 'admin' ? 'selected': '' }}>Régulateur</option>
                                                                        <option {{ $userEdit->role == 'moov' ? 'selected': '' }}>Opérateur MOOV</option>
                                                                        <option {{ $userEdit->role == 'orange' ? 'selected': '' }}>Opérateur ORANGE</option>
                                                                        <option {{ $userEdit->role == 'mtn' ? 'selected': '' }}>Opérateur MTN</option>
                                                                        <option {{ $userEdit->role == 'user' ? 'selected': '' }}>Consommateur</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="inputState">Statut demandé</label>
                                                                    <select id="inputState" class="form-control" disabled>
                                                                        <option {{ $userEdit->tempory_role == 1 ? 'selected': '' }}>Régulateur</option>
                                                                        <option {{ $userEdit->tempory_role == 2 ? 'selected': '' }}>Opérateur MOOV</option>
                                                                        <option {{ $userEdit->tempory_role == 3 ? 'selected': '' }}>Opérateur MTN</option>
                                                                        <option {{ $userEdit->tempory_role == 4 ? 'selected': '' }}>Opérateur ORANGE</option>
                                                                        <option {{ $userEdit->tempory_role == 5 ? 'selected': '' }}>Consommateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex items-center justify-end m-2">
                                                            <div class="btn btn-dark" onclick="@this.userRetour()">Retour</div>

                                                            @if($alertMessage == null)
                                                            <x-jet-button class="ml-4">
                                                                {{ __('supprimer') }}
                                                            </x-jet-button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="container mt-3">
                            <div class="card">
                                <div class="card-title">
                                    <h5>Statistiques générale</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="text-center" style="font-size:12px"><b>Localités couvertes par
                                                    technologie</b></h5>
                                            <div id="nb_locs" class="text-center"></div>
                                            <canvas id="myChart" width="400" height="400" class="p-0"></canvas>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-center" style="font-size:12px"><b>populaton_totales couvertes par
                                                    technologie</b></h5>
                                            <div id="nb_pops" class="text-center"></div>
                                            <canvas id="netData" width="400" height="400"></canvas>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-center" style="font-size:12px"><b>Localités couvertes par
                                                    opérateur</b></h5>
                                            <canvas id="popChart" width="100" height="50"></canvas>
                                        </div>
                                        <script>
                                            setTimeout(() => {
                                                new Chart("popChart", {
                                                    type: "doughnut",
                                                    data: {
                                                        labels: ["Orange", "Mtn", "Moov", ],
                                                        datasets: [{
                                                            backgroundColor: ["orange", "yellow", "blue"],
                                                            data: [nbcouvOr, nbcouvMt, nbcouvMo]
                                                        }]
                                                    },
                                                    options: {
                                                        tooltips: {
                                                            mode: 'index',
                                                            intersect: false
                                                        },
                                                        responsive: true,
                                                        plugins: {
                                                            legend: {
                                                                labels: {
                                                                    boxWidth: 10,
                                                                    fontSize: 6
                                                                },
                                                                position: 'bottom'
                                                            }
                                                        },
                                                    }
                                                });



                                                new Chart('genChart', {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ["2G", "3G", "4G", ],
                                                        datasets: [{
                                                                label: 'Orange',
                                                                backgroundColor: 'orange',
                                                                data: [
                                                                    nbLocOr2G,
                                                                    nbLocOr3G,
                                                                    nbLocOr4G,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            },
                                                            {
                                                                label: 'Mtn',
                                                                backgroundColor: 'yellow',
                                                                data: [
                                                                    nbLocMt2G,
                                                                    nbLocMt3G,
                                                                    nbLocMt4G,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            },
                                                            {
                                                                label: 'Moov',
                                                                backgroundColor: 'blue',
                                                                data: [
                                                                    nbLocMo2G,
                                                                    nbLocMo3G,
                                                                    nbLocMo4G,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            },
                                                        ],
                                                    },
                                                    options: {
                                                        title: {
                                                            display: true,
                                                            text: "population_totale couverte par technologie",
                                                        },
                                                        tooltips: {
                                                            mode: 'index',
                                                            intersect: false
                                                        },
                                                        responsive: true,
                                                        plugins: {
                                                            legend: {
                                                                labels: {
                                                                    boxWidth: 10,
                                                                    fontSize: 6
                                                                },
                                                                position: 'bottom'
                                                            }
                                                        },
                                                        scales: {
                                                            x: {
                                                                ticks: {
                                                                    display: true,
                                                                    font: {
                                                                        size: 10
                                                                    }
                                                                }
                                                            },
                                                            y: {
                                                                ticks: {
                                                                    display: true,
                                                                    font: {
                                                                        size: 6
                                                                    }
                                                                }
                                                            }
                                                        },
                                                    },
                                                });


                                                new Chart('genChartPop', {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ["2G", "3G", "4G", ],
                                                        datasets: [{
                                                                label: 'Orange',
                                                                backgroundColor: 'orange',
                                                                data: [
                                                                    po2GOr,
                                                                    po3GOr,
                                                                    po4GOr,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            },
                                                            {
                                                                label: 'Mtn',
                                                                backgroundColor: 'yellow',
                                                                data: [
                                                                    po2GMt,
                                                                    po3GMt,
                                                                    po4GMt,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            },
                                                            {
                                                                label: 'Moov',
                                                                backgroundColor: 'blue',
                                                                data: [
                                                                    po2GMo,
                                                                    po3GMo,
                                                                    po4GMo,
                                                                ],
                                                                borderWidth: 1,
                                                                barPercentage: 0.5,
                                                                barThickness: 10,
                                                                maxBarThickness: 20,
                                                            }
                                                        ],
                                                    },
                                                    options: {
                                                        title: {
                                                            display: true,
                                                            text: "populaton_totales couverte par technologie",
                                                        },
                                                        tooltips: {
                                                            mode: 'index',
                                                            intersect: false
                                                        },
                                                        responsive: true,
                                                        plugins: {
                                                            legend: {
                                                                labels: {
                                                                    boxWidth: 10,
                                                                    fontSize: 14
                                                                },
                                                                position: 'bottom'
                                                            }
                                                        },
                                                        scales: {
                                                            x: {
                                                                ticks: {
                                                                    display: true,
                                                                    font: {
                                                                        size: 10
                                                                    }
                                                                }
                                                            },
                                                            y: {
                                                                ticks: {
                                                                    display: true,
                                                                    font: {
                                                                        size: 6
                                                                    }
                                                                }
                                                            }
                                                        },
                                                    },
                                                });




                                            }, 2000);
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        @elseif($action == 'comment')
                        <div class="p-3">
                            @livewire('admin.comments')
                        </div>
                        @elseif($action == 'news')
                        <div class="p-3">
                            @livewire('admin.newsletter')
                        </div>
                        @elseif($action == 'updated')
                        <div class="p-3">@livewire('admin.updating')</div>
                        @elseif ($action =='controle')
                        <div class="p-3">@livewire('admin.controle')</div>
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
</div>