    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <div class="logo-src">
                <a href="https://www.artci.ci">
                    <img src="../images/logo-artci.png" style="height: 35px; width: 100%;">
                </a>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                <ul class="header-megamenu nav">
                    <li class="dropdown nav-item">
                        <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                            <i class="fas fa-database mr-2"></i>
                            <div class="tdply">Extraire des données</div>
                            <i class="fa fa-angle-down ml-2 opacity-5"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg_mdsuccess">
                                    <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/abstract3.jpg');"></div>
                                    <div class="menu-header-content text-left">
                                        <h5 class="menu-header-title">Extraction de données</h5>
                                        <h6 class="menu-header-subtitle">Sélectionnez les données à extraire</h6>
                                    </div>
                                </div>
                            </div>

                            <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal" data-target="#extractAllModal" onclick="initAllDataTable()">
                                <h6><i class="fas fa-circle mr-2" style="color: #00b09b"></i> Couverture totale</H6>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal" data-target="#extractNoModal" onclick="initNoDataTable()">
                                <h6><i class="fas fa-circle mr-2" style="color: red"></i>Localités non couvertes</H6>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal" data-target="#whiteModal" onclick="initWhiteDataTable()">
                                <h6><i class="fa-regular fa-circle mr-2" style="color: grey"></i>Localités blanches</H6>
                            </button>

                            <button type="button" tabindex="0" class="dropdown-item" data-toggle="modal" data-target="#extractModal" onclick="initTable()">
                                <h5><i class="far fa-hand-pointer mr-2 "></i>Zone sélectionnée</h5>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item" onclick="Livewire.emit('openModal', 'modal.edit-extraction')">
                                <h6 class="text-gray"><i class="fas fa-edit mr-2"></i>Personnaliser</h6>
                            </button>
                        </div>
                    </li>
                    <li class=" nav-item">
                        <a href="#" class="nav-link" onclick="Livewire.emit('openModal', 'modal.add-comment')">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <div class="tdply">Signalements</div>
                        </a>

                        {{-- <button class="nav-link" onclick="Livewire.emit('openModal', 'modal.add-comment')"><i class="fas fa-exclamation-triangle mr-2"></i>
                            <div class="tdply">Signalements</div></button> --}}

                    </li>
                    <li class="dropdown nav-item">
                        <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                            <i class="far fa-newspaper mr-2"></i>
                            <div class="tdply">Newsletters</div>
                            <i class="fa fa-angle-down ml-2 opacity-5"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg_mdprimary">
                                    <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/abstract3.jpg');"></div>
                                    <div class="menu-header-content text-left">
                                        <h5 class="menu-header-title">Newsletter</h5>
                                        <h6 class="menu-header-subtitle">Découvrir les nouvelles publications de l'ARTCI sur la couverture réseau mobile</h6>
                                    </div>
                                </div>
                            </div>
                            <button type="button" tabindex="0" class="dropdown-item" onclick="Livewire.emit('openModal', 'modal.show-newsletter')">
                                Voir les newsletters
                            </button>
                        </div>
                    </li>
                    <li class="dropdown nav-item">
                        <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                            <i class="fa-solid fa-square-rss mr-2"></i>
                            <div class="tdply">Flux RSS</div>
                            <i class="fa fa-angle-down ml-2 opacity-5"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg_mdsuccess">
                                    <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/abstract3.jpg');"></div>
                                    <div class="menu-header-content text-left">
                                        <h5 class="menu-header-title">Ficher RSS</h5>
                                        <h6 class="menu-header-subtitle">Toutes les mises à jours de l'applications</h6>
                                    </div>
                                </div>
                            </div>
                            <button type="button" tabindex="0" class="dropdown-item" onclick="Livewire.emit('openModal', 'modal.flux-rss')">
                                <h6 class="text-gray"><i class="fa-solid fa-bolt mr-2"></i>Liste des mises à jours</h6>
                            </button>
                            <!-- <a type="button" tabindex="0" class="dropdown-item" href="{{route('rss')}}">
                                <h6 class="text-gray"><i class="fa-regular fa-file-excel mr-2"></i>Fichier XML</h6>
                            </a> -->
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" data-placement="bottom" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <div class="tdply">A propos</div>
                            <i class="fa fa-angle-down ml-2 opacity-5"></i>
                        </a>
                        <div class="rm-max-width">
                            <div class="d-none popover-custom-content">
                                <div class="dropdown-mega-menu">
                                    <div class="grid-menu grid-menu-3col">
                                        <div class="no-gutters row">
                                            <div class="col-sm-6 col-xl-4">
                                                <ul class="nav flex-column text-primary">
                                                    <li class="nav-item-header nav-item"> L'Autorité</li>
                                                    <li class="nav-item">
                                                        <a href="https://www.artci.ci/index.php/accueil/creation-et-missions2.html" target="blank" class="nav-link">
                                                            <span> A propos de l'ARTCI</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <ul class="nav flex-column text-primary">
                                                    <li class="nav-item-header nav-item"> Régulation </li>
                                                    <li class="nav-item">
                                                        <a href="https://www.artci.ci/index.php/marches-regules/observatoire-telecoms.html" target="blank" class="nav-link"> Observatoire Télécoms </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="https://www.artci.ci/index.php/marches-regules/observatoire-telecoms/statistiques-du-marche-telecoms.html" target="blank" class="nav-link"> Statistiques des marchés Télécoms
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <ul class="nav flex-column text-primary">
                                                    <li class="nav-item-header nav-item">Contrôle</li>
                                                    <li class="nav-item">
                                                        <a href="https://www.artci.ci/index.php/controles/qualite-de-services.html" target="blank" class="nav-link">Qualité de service</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> -->

                    <li class="dropdown nav-item">
                        <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                            <!-- <i class="fas fa-question-circle mr-2"></i> -->
                            <i class="fa-solid fa-address-book mr-2"></i>
                            <div class="tdply">Contacts</div>
                            <i class="fa fa-angle-down ml-2 opacity-5"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-rounded dropdown-menu-lg rm-pointers dropdown-menu">
                            <div class="grid-menu grid-menu-2col">
                                <div class="no-gutters row">
                                    <div class="col-sm-12 col-xl-12">
                                        <ul class="nav flex-column">
                                            <!-- <li class="nav-item-header nav-item">Contacts</li> -->
                                            <li class="nav-item">
                                                <a class="nav-link" href="tel:+2252720344373">
                                                    <i class="fas fa-phone mr-2"></i>
                                                    <span>+225 27 20 34 43 73</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="mailto:ygningninri@gmail.com">
                                                    <i class="fa-solid fa-envelope mr-2"></i>
                                                    <span>cartodonnee@artci.ci</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link">
                                                    <i class="fas fa-home mr-2"></i>
                                                    <span>Abidjan - Marcory Anoumanbo 18 BP 2203 Abidjan 18</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-xl-12">
                                        <ul class="nav flex-column">
                                            <!-- <li class="nav-item-header nav-item">Plus</li>
                                            <li class="nav-item"><a href="{{ Route('guide') }}" target="blanck" disabled class="nav-link text-primary">Guide d'utilisation</a></li> -->


                    </li>

                </ul>
            </div>

        </div>
    </div>
    </div>
    </li>
    </ul>


    </div>
    <div class="app-header-right">
        <div class="header-dots">
            {{-- <div class="dropdown">
                <button type="button" data-toggle="dropdown" class="p-0 mr-2 btn btn-link badge-light">
                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                        <span class="">FR</span>
                    </span>
                </button>
                <!-- Hamburger -->
                <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu dropdown-menu-right">
                    <div class="dropdown-menu-header">
                        <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                            <div class="menu-header-image opacity-05" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                            <div class="menu-header-content text-center text-white">
                                <h6 class="menu-header-subtitle mt-0"> Choisissez la langue</h6>
                            </div>
                        </div>
                    </div>
                    <h6 tabindex="-1" class="dropdown-header">Langues</h6>
                    <button type="button" tabindex="0" class="dropdown-item">
                        <img src="../images/lang/france.png" class="img mr-2" height="20px" width="20px" alt=""> Français
                    </button>
                    <button type="button" disabled tabindex="0" class="dropdown-item bg-light" disabled>
                        <img src="../images/lang/royaume-uni.png" class="img mr-2" height="20px" width="20px" alt=""> English
                    </button>
                </div>
            </div> --}}
            <div class="dropdown">
                @if (Route::has('login'))
                @Auth
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button type="button" data-toggle="dropdown" class="p-0 mr-2 btn btn-link badge-light">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </button>
                @else
                <span class="inline-flex rounded-md">
                    <button data-toggle="dropdown" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
                @endif
                @else
                <div class="p-0 mr-2 badge-light">
                    <a href="{{ Route('login') }}" class="btn btn-secondary text-light">Connexion</a>
                    @if (Route::has('register'))
                    <a href="{{ Route('register') }}" class="btn btn-success text-light">Inscription</a>
                    @endif
                </div>
                @endauth
                @endauth
                <!-- Hamburger -->
                @auth
                <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu dropdown-menu-right">
                    <div class="dropdown-menu-header">
                        <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                            <div class="menu-header-image opacity-05" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                            <div class="menu-header-content text-center text-white">
                                <h6 class="menu-header-subtitle mt-0"> Gestion de profil</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                            @endif

                            <div>
                                <div class="" style="width: 100px;word-wrap:break-word">{{ Auth::user()->name }}</div>
                                <div class="" style="width: 100px; word-wrap:break-word; !important">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profil') }}
                            </x-jet-responsive-nav-link>

                            @if (Auth::user()->role == 'admin')
                            <x-jet-responsive-nav-link href="{{ route('adminDash') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Administration') }}
                            </x-jet-responsive-nav-link>
                            @elseif (Auth::user()->role == 'moov' || Auth::user()->role == 'orange' || Auth::user()->role == 'mtn')
                            <x-jet-responsive-nav-link href="{{ route('networkDash') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Administration') }}
                            </x-jet-responsive-nav-link>
                            @endif


                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                    {{ __('Deconnexion') }}
                                </x-jet-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
        {{-- <div class="header-btn-lg">
                    <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                        <h5><i class="fas fa-chart-pie"></i></h5>
                    </button>
                </div> --}}
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>
    </div>

    <div class="d-none">
        <button type="button" id="ext" data-toggle="modal" onclick="alert('ok')" data-target="#createCommentModal">
        </button>
        <script>

        </script>
    </div>
    </div>