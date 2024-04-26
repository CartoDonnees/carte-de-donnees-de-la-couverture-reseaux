<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
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
    <div class="scrollbar-sidebar pb-5">
        <div class="bg-secondary" style="height: 7px !important;">
        </div>
        <div class="app-sidebar__inner" id="side_init">
            <ul class="vertical-nav-menu pl-0">
                <li class="app-sidebar__heading pl-0">
                <li class="mm-active pl-0">
                    <a href="javascript:void()" class="text-primary p-0"><i class="fas fa-project-diagram mr-2"></i>COUVERTURE RESEAU
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class="mm-active mt-2 pl-2" onclick="showTpCouv('st_couv')">
                                <i class="fas fa-satellite-dish mr-1"></i>Couverture des localités
                                <i class="fas fa-chevron-right"></i>
                            </a>

                            <div class="" id="st_couv">
                                <!-- <div class="form-check" data-toggle="tooltip" data-placement="top"
                                    title="Afficher les localités couvertes"> -->
                                <div class="form-check">
                                    <input type="checkbox" id="zc" class="chec" checked onclick="showLayer()">
                                    <label for="zc" class="form-check-label ml-2">Localités <b>couvertes</b> </label>
                                </div>
                                <!-- <div class="form-check" data-toggle="tooltip" data-placement="top"
                                    title="Afficher les localités non couvertes"> -->
                                <div class="form-check">
                                    <input type="checkbox" id="zn" class="" onclick="showLayer()">
                                    <label for="zn" class="form-check-label ml-2">Localités <b>non couvertes</b></label>
                                </div>
                                <!-- <div class="form-check" data-toggle="tooltip" data-placement="top"
                                    title="Afficher les localités non couvertes et sans prévision de couverture"> -->
                                <div class="form-check">
                                    <input type="checkbox" id="zb" class="" onclick="showLayer()">
                                    <label for="zb" class="form-check-label ml-2">Localités <b>blanches</b> </label>
                                </div>
                            </div>




                            {{-- <ul>
                                <li>
                                </li>
                            </ul> --}}
                            <a class="mm-active mt-2 pl-2" onclick="showTpCouv('operat')">
                                <i class="fas fa-satellite-dish mr-2"></i>Opérateurs
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                            <div id="operat">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group text-center m-0 p-0" data-toggle="tooltip" data-placement="top" title="Afficher la couverture Orange">
                                            <label for="orangeop">
                                                <img src="../images/operateurs/orange.png" alt="" style="height: 20px; margin:auto">
                                            </label>
                                            <input type="checkbox" class="check" id="orangeop" onclick="showLayer()">
                                            <label id="lbor" for="orangeop"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group text-center m-0 p-0" data-toggle="tooltip" data-placement="top" title="Afficher la couverture Mtn">
                                            <label for="mtnop">
                                                <img src="../images/operateurs/mtn.png" alt="" style="height: 20px; margin:auto">
                                            </label>
                                            <input type="checkbox" class="check" id="mtnop" onclick="showLayer()">
                                            <label id="lbmt" for="mtnop"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group text-center m-0 p-0" data-toggle="tooltip" data-placement="top" title="Afficher la couverture Moov">
                                            <label for="moovop">
                                                <img src="../images/operateurs/moov.png" alt="" style="height: 20px; margin:auto">
                                            </label>
                                            <input type="checkbox" class="check" id="moovop" onclick="showLayer()">
                                            <label id="lbmo" for="moovop"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void()" class="mm-active pl-2" onclick="showTpCouv('techno')">
                                <i class="fas fa-microchip mr-2"></i>Technologies
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                            <div id="techno">
                                <style>
                                    .checTech {
                                        box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.7);
                                        border: 1px solid rgba(128, 128, 128, 0.26);
                                        border-radius: 50%;
                                        height: 20px;
                                        width: 20px;
                                    }
                                </style>
                                <div class="row mb-2 ml-1 mr-1">
                                    <div class="col-md-4 text-center">
                                        <label for="thecno2G" class="form-label text-center pl-1"><b>2G</b></label>
                                        <input id="thecno2G" type="checkbox" onclick="showLayer()" class="checTech">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label for="thecno3G" class="form-label text-center pl-1"><b>3G</b></label>
                                        <input id="thecno3G" type="checkbox" onclick="showLayer()" class="checTech">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label for="thecno4G" class="form-label text-center pl-1"><b>4G</b></label>
                                        <input id="thecno4G" type="checkbox" onclick="showLayer()" class="checTech">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void()" class="mm-active mt-2 mb-1 pl-2" onclick="showTpCouv('stats')">
                                <i class="fas fa-chart-pie mr-2"></i>Statistiques
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                            <div id="stats">
                                <div class="text-center text-secondary">
                                    <b class="text-primary">Statistiques générales</b>
                                </div>
                                <div class="p-2">
                                    <div id="ttLoc">
                                        <small>Total des localités :</small>
                                    </div>
                                    <div id="ttPop">
                                        <small>Total de la population : </small>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col" class="text-center p-0"></th>
                                        <th scope="col" class="text-center p-0"><small>Localités couvertes</small></th>
                                        <th scope="col" class="text-center p-0"><small>Population couverte</small></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row" rowspan="2" class="text-center p-0"><small>2G</small></th>
                                        <td id="l_2G" class="text-center p-0"><small></small></td>
                                        <td id="p_2G" class="text-center p-0"><small></small> </td>
                                      </tr>
                                      <tr>
                                        <td id='pl_2G' class="text-center p-0"><small></small></td>
                                        <td id="pp_2G" class="text-center p-0"><small></small></td>
                                      </tr>

                                      <tr class="" style="border-top: 1.5px solid rgb(214, 213, 213)">
                                        <th scope="row" rowspan="2" class="text-center p-0"><small>3G</small></th>
                                        <td id="l_3G" class="text-center p-0"><small></small></td>
                                        <td id="p_3G" class="text-center p-0"><small></small> </td>
                                      </tr>
                                      <tr>
                                        <td id='pl_3G' class="text-center p-0"><small></small></td>
                                        <td id="pp_3G" class="text-center p-0"><small></small></td>
                                      </tr>

                                      <tr class="" style="border-top: 1.5px solid rgb(214, 213, 213)">
                                        <th scope="row" rowspan="2" class="text-center p-0"><small>4G</small></th>
                                        <td id="l_4G" class="text-center p-0"><small></small></td>
                                        <td id="p_4G" class="text-center p-0"><small></small> </td>
                                      </tr>
                                      <tr>
                                        <td id='pl_4G' class="text-center p-0"><small></small></td>
                                        <td id="pp_4G" class="text-center p-0"><small></small></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                <h5 class="text-center" style="font-size:12px"><b>Localités couvertes par
                                        technologie</b></h5>
                                <div id="nb_locss" class="text-center"></div>
                                <canvas id="genChart" width="400" height="400"></canvas>
                                <div class="divider"></div>
                                <div class="mt-3">
                                    <h5 class="text-center" style="font-size:12px"><b>Populations couvertes par
                                            technologie</b></h5>
                                    <div id="nb_popss" class="text-center"></div>
                                    <canvas id="genChartPop" width="400" height="400"></canvas>
                                    <div class="divider"></div>
                                </div>
                                <div class="divider"></div>
                                <div class="mt-3">
                                    <h5 class="text-center" style="font-size:12px"><b>Populations couvertes par
                                            opérateur</b></h5>
                                    <canvas id="popChart" width="100" height="50"></canvas>
                                </div>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById('nb_locss').innerHTML = '<small>Nombre : <b class="text-primary">' + couvTotLoc + ' => '+((couvTotLoc*100) / nbLoc).toFixed(2) +'% </b></small>'
                                        document.getElementById('nb_popss').innerHTML = '<small>Effectif: <b class="text-primary">' + couvTotpop + ' => '+((couvTotpop*100) / pops).toFixed(2)+'%</b></small>'
                                        document.getElementById('ttLoc').innerHTML = '<small>Total des localités : <b class="text-success">' + nbLoc + '</b></small>'
                                        document.getElementById('ttPop').innerHTML = '<small>Total de la population : <b class="text-success">' + pops + '</b></small>'

                                        document.getElementById('l_2G').innerHTML = '<small><b class="text-center">' + nbLoc2G + '</b></small>'
                                        document.getElementById('l_3G').innerHTML = '<small><b class="text-center">' + nbLoc3G + '</b></small>'
                                        document.getElementById('l_4G').innerHTML = '<small><b class="text-center">' + nbLoc4G + '</b></small>'

                                        document.getElementById('p_2G').innerHTML = '<small><b class="text-center">' + po2G + '</b></small>'
                                        document.getElementById('p_3G').innerHTML = '<small><b class="text-center">' + po3G + '</b></small>'
                                        document.getElementById('p_4G').innerHTML = '<small><b class="text-center">' + po4G + '</b></small>'

                                        document.getElementById('pl_2G').innerHTML = '<small><b class="text-center">' + ((nbLoc2G*100) / nbLoc).toFixed(2) + '%</b></small>'
                                        document.getElementById('pl_3G').innerHTML = '<small><b class="text-center">' + ((nbLoc3G*100) / nbLoc).toFixed(2) + '%</b></small>'
                                        document.getElementById('pl_4G').innerHTML = '<small><b class="text-center">' + ((nbLoc4G*100) / nbLoc).toFixed(2) + '%</b></small>'

                                        document.getElementById('pp_2G').innerHTML = '<small><b class="text-center">' + ((po2G*100) / pops).toFixed(2) + '%</b></small>'
                                        document.getElementById('pp_3G').innerHTML = '<small><b class="text-center">' + ((po3G*100) / pops).toFixed(2) + '%</b></small>'
                                        document.getElementById('pp_4G').innerHTML = '<small><b class="text-center">' + ((po4G*100) / pops).toFixed(2) + '%</b></small>'
                                    }, 2000);
                                </script>
                            </div>
                            <div id="statd" class="d-none">
                                <div class="text-center text-secondary" id="stat_dist">
                                </div>
                                <h5 class="text-center" style="font-size:12px"><b>Localités couvertes par
                                        technologie</b></h5>
                                <div id="nb_locs" class="text-center"></div>
                                <canvas id="myChart" width="400" height="400" class="p-0"></canvas>
                                <hr class="mb-2">
                                <h5 class="text-center" style="font-size:12px"><b>Population couvertes par
                                        technologie</b></h5>
                                <div id="nb_pops" class="text-center"></div>
                                <canvas id="netData" width="400" height="400"></canvas>
                            </div>
                        </li>
                    </ul>
                </li>
                </li>
                <li>
                    <a href="#side_init" class="text-primary p-0 ">
                        <i class="fa-solid fa-tower-broadcast mr-2"></i>INFRASTRUCTURES
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                    <ul style="margin-left: -15px !important">
                        
                        {{-- <li>
                            <a href="javascript:void()" class="adrop" style="margin-left: -20px !important">
                                <i class="fas fa-circle-notch mr-2"></i>Antennes réseaux
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                            <ul>
                                <li>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les antennes orange">
                                        <input type="checkbox" id="antenna_or"  class="form-check-input" onclick="showAntenna('or')">
                                        <label for="antenna_or" class="form-check-label ml-2">Orange</label>
                                    </div>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les antennes MTN">
                                        <input type="checkbox" id="antenna_mt" class="form-check-input" onclick="showAntenna('mt')">
                                        <label for="antenna_mt" class="form-check-label ml-2">MTN</label>
                                    </div>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les antennes Moov">
                                        <input type="checkbox" id="antenna_mo" class="form-check-input" onclick="showAntenna('mo')">
                                        <label for="antenna_mo" class="form-check-label ml-2">Moov</label>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript:void()" class="adrop" style="margin-left: -20px !important">
                                <i class="fas fa-circle-notch mr-2"></i>Connectivité internationale
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void()" class="adrop" style="margin-left: -20px !important">
                                <i class="fas fa-circle-notch mr-2"></i>Réseau de transmission
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void()" class="adrop" style="margin-left: -20px !important">
                                <i class="fas fa-circle-notch mr-2"></i>Réseau d'accès
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        </li> --}}
                        <li>
                            <a href="javascript:void()" class="adrop" style="margin-left: -20px !important">
                                <i class="fas fa-circle-notch mr-2"></i>Voiries
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                            <ul>
                                <li>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les localités non couverte et sans prévision de couverture">
                                        <input type="checkbox" id="road_n" checked class="form-check-input" onclick="showLayer()">
                                        <label for="zb" class="form-check-label ml-2">Autoroute</label>
                                    </div>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les localités non couverte et sans prévision de couverture">
                                        <input type="checkbox" id="road_s" checked class="form-check-input" onclick="showLayer()">
                                        <label for="zb" class="form-check-label ml-2">Routes nationale</label>
                                    </div>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher les localités non couverte et sans prévision de couverture">
                                        <input type="checkbox" id="road_m" checked class="form-check-input" onclick="showLayer()">
                                        <label for="zb" class="form-check-label ml-2">Piste</label>
                                    </div>
                                    <div class="form-check" data-toggle="tooltip" data-placement="right" title="Afficher chemin de fer">
                                        <input type="checkbox" checked id="rail" class="form-check-input" onclick="showLayer()">
                                        <label for="rail" class="form-check-label ml-2">Chemin de fer</label>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#side_init" class="adrop p-0 text-muted" onclick="Livewire.emit('openModal', 'modal.error')">
                        <i class="fa-solid fa-handshake mr-2"></i> QUALITE DE SERVICE
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                </li>
                <li>
                    <a href="#side_init" class="adrop p-0 text-muted" onclick="Livewire.emit('openModal', 'modal.error')">
                        <i class="fa-solid fa-user-tie mr-2"></i>QUALITE D'EXPERIENCE
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                </li>
                <!-- <li>
                    <a href="#side_init" class="text-primary p-0">
                        <i class="fas fa-info-circle mr-2"></i>INFORMATIONS
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ Route('guide') }}" target="blanck">
                                <i class="metismenu-icon"></i>Guide d'utilisation
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('guide') }}" target="blanck">
                                <i class="metismenu-icon"></i>Termes et conditions
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>