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
                                <button type="button" data-toggle="tooltip" title="Example Tooltip"
                                    data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
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
                                    <a role="tab" class="nav-link active" id="tab-c-1" data-toggle="tab"
                                        href="#tab-animated-0">
                                        <span>Principale</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab"
                                        href="#tab-animated-1">
                                        <span>Newsletters</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a role="tab" class="nav-link" id="tab-c-0" data-toggle="tab"
                                        href="#tab-animated-3">
                                        <span>Mise à jour</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active p-2" id="tab-animated-0" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="text-center" style="font-size: 15px">Gestion des utilisateurs</h4>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- {!! $users->links() !!} --}}
                                                    </div>
                                                    <table style="width: 100%;" id="userTable"
                                                        class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nom et premoms</th>
                                                                <th>Email</th>
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
                                                                <td>{{ $user->created_at }}</td>
                                                                <td>
                                                                    <div class="btn btn-primary"><i
                                                                            class="fas fa-edit"></i></div>
                                                                    <div class="btn btn-primary"><i
                                                                            class="fas fa-trash"></i></div>
                                                                </td>
                                                            </tr>
                                                            @php
                                                            $i=$i+1;
                                                            @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nom et premoms</th>
                                                                <th>Email</th>
                                                                <th>Date d'inscription</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <script>
                                                        setTimeout(() => {
                                                        tableAdd('userTable');
                                                    }, 1000);    
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="text-center">Historique</h4>
                                                    <table style="width: 100%;" id="userTable"
                                                        class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>IP</th>
                                                                <th>Agent utilisateur</th>
                                                                <th>Charge util</th>
                                                                <th>Dernière activité</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $i=1;
                                                            @endphp
                                                            @foreach($history as $his)
                                                            <tr>
                                                                <td>{{ $i=$i++ }}</td>
                                                                <td>{{ $his->ip_address }}</td>
                                                                <td>{{ $his->user_agent }}</td>
                                                                <td>{{ $his->last_activity }}</td>
                                                            </tr>
                                                            @php
                                                            $i=$i+1;
                                                            @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nom et premoms</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                                    <div class="p-3">
                                        @livewire('admin.newsletter')
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-animated-2" role="tabpanel">
                                    <div class="no-results pt-3 pb-0">
                                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                            <div class="swal2-success-circular-line-left"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                            <span class="swal2-success-line-tip"></span>
                                            <span class="swal2-success-line-long"></span>
                                            <div class="swal2-success-ring"></div>
                                            <div class="swal2-success-fix"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                            <div class="swal2-success-circular-line-right"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                        </div>
                                        <div class="results-subtitle">All caught up!</div>
                                        <div class="results-title">There are no system errors!</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-animated-3" role="tabpanel">
                                    <div class="p-3">
                                        <div class="notifications-box">
                                            <div class="d-flex justify-center">
                                                <div wire:loading>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="loader-wrapper d-flex justify-content-center align-items-center">
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
                                                            <h5>Mise à Jour en cours !</h5>
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
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Localité Couverte 2G</th>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(8)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(11)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(14)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(2)">Mise à jour</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Localité Couverte 3G</th>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(9)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(12)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(15)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(3)">Mise à jou</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Localité Couverte 4G</th>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(10)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(13)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(16)">Mise à jour</a></td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateData(4)">Mise à jour</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">population_totale 2G</th>
                                                        <td>4G</td>
                                                        <td>the Bird</td>
                                                        <td>AZER</td>
                                                        <td><a href="#" class="btn btn-info float-center"
                                                                onclick="@this.updateStatData(2)">Mise à jour</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">population_totale 3G</th>
                                                        <td>4G</td>
                                                        <td>the Bird</td>
                                                        <td>AZER</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">population_totale 4G</th>
                                                        <td>4G</td>
                                                        <td>the Bird</td>
                                                        <td>AZER</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Total population_totale</th>
                                                        <td>Toute le localité</td>
                                                        <td>AZER</td>
                                                        <td>AZER</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Total Localité Couverte</th>
                                                        <td>Toute le localité</td>
                                                        <td>AZER</td>
                                                        <td>AZER</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-info float-right"
                                                    onclick="@this.updateStatDistrict()">Mise à jour Statistiques
                                                    District</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-info float-right"
                                                    onclick="@this.updateStatRegion()">Mise à jour Statistiques
                                                    Region</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-info float-right"
                                                    onclick="@this.loadCouverture()">Mise à jour du fichier de
                                                    couverture</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-dark float-right"
                                                    onclick="@this.updateData(0)">Mise à jour de fichier localité non
                                                    couvert</a>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-dark float-right"
                                                    onclick="@this.updateStationData(1)">Mise à jour des données sur les
                                                    Stations 2G</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-dark float-right"
                                                    onclick="@this.updateStationData(2)">Mise à jour des données sur les
                                                    Stations 3G</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-dark float-right"
                                                    onclick="@this.updateStationData(3)">Mise à jour des données sur les
                                                    Stations 4G</a>
                                            </div>
                                        </div>
                                    </div>
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
                    <div class="footer-dots">
                        <div class="dropdown">
                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                class="dot-btn-wrapper">
                                <i class="dot-btn-icon lnr-bullhorn icon-gradient bg-mean-fruit"></i>
                                <div class="badge badge-dot badge-abs badge-dot-sm badge-danger">Notifications</div>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                <div class="dropdown-menu-header mb-0">
                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                        <div class="menu-header-image opacity-1"
                                            style="background-image: url('assets/images/dropdown-header/city3.jpg');">
                                        </div>
                                        <div class="menu-header-content text-dark">
                                            <h5 class="menu-header-title">Notifications</h5>
                                            <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul
                                    class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" data-toggle="tab"
                                            href="#tab-messages-header1">
                                            <span>Messages</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header1">
                                            <span>Events</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header1">
                                            <span>System Errors</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-messages-header1" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div class="notifications-box">
                                                        <div
                                                            class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production
                                                                            release
                                                                            <span
                                                                                class="badge badge-danger ml-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Something not
                                                                            important
                                                                            <div
                                                                                class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/1.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/2.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/3.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/4.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/5.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/9.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/7.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="assets/images/avatars/8.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                    <div class="avatar-icon"><i>+</i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has an info
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production
                                                                            release
                                                                            <span
                                                                                class="badge badge-danger ml-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has a dark
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-events-header1" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div
                                                        class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                    <p>Lorem ipsum dolor sic amet, today at
                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <p>Another meeting today, at
                                                                        <b class="text-danger">12:00 PM</b>
                                                                    </p>
                                                                    <p>Yet another one, at <span
                                                                            class="text-success">15:00 PM</span></p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">Build the production
                                                                        release</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur eiusmdd
                                                                        tempor
                                                                        incididunt ut labore et dolore magna elit enim
                                                                        at
                                                                        minim veniam quis nostrud
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title text-success">Something
                                                                        not important</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur elit enim
                                                                        at
                                                                        minim veniam quis nostrud</p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                    <p>Lorem ipsum dolor sic amet, today at
                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <p>Another meeting today, at
                                                                        <b class="text-danger">12:00 PM</b>
                                                                    </p>
                                                                    <p>Yet another one, at <span
                                                                            class="text-success">15:00 PM</span></p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">Build the production
                                                                        release</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur eiusmdd
                                                                        tempor
                                                                        incididunt ut labore et dolore magna elit enim
                                                                        at
                                                                        minim veniam quis nostrud
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title text-success">Something
                                                                        not important</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur elit enim
                                                                        at
                                                                        minim veniam quis nostrud
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-errors-header1" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="no-results pt-3 pb-0">
                                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                        <div class="swal2-success-circular-line-left"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                        <span class="swal2-success-line-tip"></span>
                                                        <span class="swal2-success-line-long"></span>
                                                        <div class="swal2-success-ring"></div>
                                                        <div class="swal2-success-fix"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                        <div class="swal2-success-circular-line-right"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                    </div>
                                                    <div class="results-subtitle">All caught up!</div>
                                                    <div class="results-title">There are no system errors!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest
                                            Changes</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dots-separator"></div>
                        <div class="dropdown">
                            <a class="dot-btn-wrapper" aria-haspopup="true" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="dot-btn-icon lnr-earth icon-gradient bg-happy-itmeo"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                                        <div class="menu-header-image opacity-05"
                                            style="background-image: url('assets/images/dropdown-header/city2.jpg');">
                                        </div>
                                        <div class="menu-header-content text-center text-white">
                                            <h6 class="menu-header-subtitle mt-0"> Choose Language</h6>
                                        </div>
                                    </div>
                                </div>
                                <h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <span class="mr-3 opacity-8 flag large US"></span> USA
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <span class="mr-3 opacity-8 flag large CH"></span> Switzerland
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <span class="mr-3 opacity-8 flag large FR"></span>France
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <span class="mr-3 opacity-8 flag large ES"></span>Spain
                                </button>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <h6 tabindex="-1" class="dropdown-header">Others</h6>
                                <button type="button" tabindex="0" class="dropdown-item active">
                                    <span class="mr-3 opacity-8 flag large DE"></span>Germany
                                </button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                    <span class="mr-3 opacity-8 flag large IT"></span> Italy
                                </button>
                            </div>
                        </div>
                        <div class="dots-separator"></div>
                        <div class="dropdown">
                            <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="dot-btn-icon lnr-pie-chart icon-gradient bg-love-kiss"></i>
                                <div class="badge badge-dot badge-abs badge-dot-sm badge-warning">Notifications</div>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-premium-dark">
                                        <div class="menu-header-image"
                                            style="background-image: url('assets/images/dropdown-header/abstract4.jpg');">
                                        </div>
                                        <div class="menu-header-content text-white">
                                            <h5 class="menu-header-title">Users Online</h5>
                                            <h6 class="menu-header-subtitle">Recent Account Activity Overview</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-chart">
                                    <div class="widget-chart-content">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg opacity-9 bg-focus"></div>
                                            <i class="lnr-users text-white"></i>
                                        </div>
                                        <div class="widget-numbers">
                                            <span>344k</span>
                                        </div>
                                        <div class="widget-subheading pt-2"> Profile views since last login</div>
                                        <div class="widget-description text-danger">
                                            <span class="pr-1"> <span>176%</span></span>
                                            <i class="fa fa-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="widget-chart-wrapper">
                                        <div id="dashboard-sparkline-carousel-4-pop"></div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider mt-0 nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                            <i class="fa fa-cog fa-spin mr-2"></i> View Details
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-footer-right">
                    <ul class="header-megamenu nav">
                        <li class="nav-item">
                            <a data-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom"
                                class="nav-link">
                                Footer Menu
                                <i class="fa fa-angle-up ml-2 opacity-8"></i>
                            </a>
                            <div class="rm-max-width rm-pointers">
                                <div class="d-none popover-custom-content">
                                    <div class="dropdown-mega-menu dropdown-mega-menu-sm">
                                        <div class="grid-menu grid-menu-2col">
                                            <div class="no-gutters row">
                                                <div class="col-sm-6 col-xl-6">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Overview</li>
                                                        <li class="nav-item">
                                                            <a class="nav-link">
                                                                <i class="nav-link-icon lnr-inbox"></i>
                                                                <span>Contacts</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link">
                                                                <i class="nav-link-icon lnr-book"></i>
                                                                <span>Incidents</span>
                                                                <div class="ml-auto badge badge-pill badge-danger">5
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link">
                                                                <i class="nav-link-icon lnr-picture"></i>
                                                                <span>Companies</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a disabled="" class="nav-link disabled">
                                                                <i class="nav-link-icon lnr-file-empty"></i>
                                                                <span>Dashboards</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6 col-xl-6">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Sales &amp; Marketing</li>
                                                        <li class="nav-item"><a class="nav-link">Queues</a></li>
                                                        <li class="nav-item"><a class="nav-link">Resource Groups</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link">Goal Metrics
                                                                <div class="ml-auto badge badge-warning">3</div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item"><a class="nav-link">Campaigns</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom"
                                class="nav-link">
                                Grid Menu
                                <div class="badge badge-dark ml-0 ml-1">
                                    <small>NEW</small>
                                </div>
                                <i class="fa fa-angle-up ml-2 opacity-8"></i>
                            </a>
                            <div class="rm-max-width rm-pointers">
                                <div class="d-none popover-custom-content">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-tempting-azure">
                                            <div class="menu-header-image opacity-1"
                                                style="background-image: url('assets/images/dropdown-header/city5.jpg');">
                                            </div>
                                            <div class="menu-header-content text-dark">
                                                <h5 class="menu-header-title">Two Column Grid</h5>
                                                <h6 class="menu-header-subtitle">Easy grid navigation inside popovers
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid-menu grid-menu-2col">
                                        <div class="no-gutters row">
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                    <i
                                                        class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"></i>Automation
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                    <i
                                                        class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>Reports
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">
                                                    <i
                                                        class="lnr-bus text-success opacity-7 btn-icon-wrapper mb-2"></i>Activity
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus">
                                                    <i
                                                        class="lnr-gift text-focus opacity-7 btn-icon-wrapper mb-2"></i>Settings
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn clearfix nav-item">
                                            <div class="float-left">
                                                <button class="btn btn-link btn-sm">Link Button</button>
                                            </div>
                                            <div class="float-right">
                                                <button class="btn-shadow btn btn-info btn-sm">Info Button</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>