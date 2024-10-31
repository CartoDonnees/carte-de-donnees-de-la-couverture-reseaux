@livewire('sidebar')



{{-- @if($isDataLoad)
@livewire('modal.extract-data')
@endif --}}
<style>
    /* .wrappered {
        width: 370px;
    } */

    /* .select-button, */
    .options li {
        display: flex;
        cursor: pointer;
        align-items: center;
    }

    /* .select-button { */
    /* height: 65px;
        font-size: 22px;
        padding: 0 20px; */
    /* border-radius: 7px; */
    /* background: #fff;
        justify-content: space-between;

    } */

    /* .select-button i { */
    /* font-size: 31px; */
    /* transition: transform 0.3s linear;
    } */

    /* .wrappered.wrappered.active .select-button i {
        transform: rotate(-180deg);
    } */

    .contenu {
        display: none;
        /* padding-bottom: 20px; */
        /* margin-top: 15px;
        border-radius: 7px; */
        background: #fff;
    }

    .wrappered.active .contenu {
        display: block;
    }

    .wrappered .options {
        display: none;
    }

    .wrappered .options.active {
        display: block;
    }

    .contenu .search {
        position: relative;
    }

    /* .search i {
        left: 15px;
        color: #999;
        font-size: 20px;
        line-height: 53px;
        position: absolute;
    } */

    .search input {
        /* height: 53px; */
        width: 100%;
        outline: none;
        /* font-size: 17px;
        border-radius: 5px; */
        /* padding: 0 15px 0 43px; */
        border-color: #b3b3b3;
    }

    .contenu .options {
        /* margin-top: 10px; */
        max-height: 250px;
        overflow-y: auto;
    }

    /* .options::-webkit-scrollbar {
        width: 7px;
    }

    .options::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 25px;
    }

    .options::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 25px;
    } */

    .options li {
        /* height: 50px; */
        padding: 0 13px;
        /* font-size: 21px; */
        border-radius: 5px;
    }

    .options li:hover {
        background: #f2f2f2;
    }
</style>
<style>
    .dwld {
        height: 31px;
        width: 31px;
        position: absolute;
        bottom: 55px;
        right: 10px;
        margin: auto;
        padding: 5px;
        text-align: center;
        background-color: white;
        border: 2px solid rgba(48, 47, 47, 0.24);
        border-radius: 5px;
    }

    .breset {
        height: 31px;
        width: 31px;
        position: absolute;
        top: 308px;
        right: 10px;
        margin: auto;
        padding: 0;
        text-align: center;
        background-color: white;
        border: 2px solid rgba(48, 47, 47, 0.24);
        border-radius: 5px;
        font-size: 18px;
        /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 10px 0 rgba(0, 0, 0, 0.19); */
    }

    .breset:hover {
        background-color: rgba(231, 228, 228, 0.822);
    }

    .tobarSect {
        width: 50%;
        position: absolute;
        top: 8%;
        left: 20%;
        margin: auto;
        padding: 5px;
        text-align: center;
    }

    .labeld {
        height: 100px;
        width: 200px;
        position: absolute;
        bottom: 40px;
        right: 0px;
        margin: auto;
        background-color: rgba(39, 38, 38, 0.5);
        padding: 5px;
        text-align: center;
    }

    .legend {
        height: 4%;
        width: 75%;
        position: absolute;
        bottom: 0px;
        right: 0px;
        margin: auto;
        background-color: rgba(39, 38, 38, 0.5);
        text-align: center;
        color: white;
        padding: 2px;
    }

    .text-sm-custom{
        font-size: 9px
    }

    #maps {
        height: 100%;
        width: 100%;
    }

    @media only screen and (max-width: 998px) {
        .tobarSect {
            left: 20%;
            width: 60%;
            top: 15%;
        }

        .legend {
            width: 100%
        }
    }

    @media only screen and (max-width: 550px) {
        .tobarSect {
            top: 15%;
            left: 10%;
        }

        .tdleg {
            display: none;
        }

        .legend {
            height: 60px;
        }
    }
</style>

<style>
.souce_data{
    height: 8%;
    width: 25%;
    position: absolute;
    top: 40px;
    right: 0px;
    margin: auto;
    background-color: rgba(39, 38, 38, 0.5);
    /* text-align: center; */
    color: white;
    padding: 2px;
}

@media only screen and (max-width: 998px) {

    .souce_data {
        width: 50%;
    height: 15%;
    }
}

@media only screen and (max-width: 550px) {

    .souce_data {
        width: 100%;
    height: 10%;
    }
}
</style>
<div class="app-main__outer">
    <div class="app-main__inner p-0">
        <div id="maps"></div>
        <div class="souce_data">
            <div class="text-center">
                <small><b><u><em>Source de données</em></u></b></small>
            </div>
            <div>
                <small><b>* Données de couverture:</b> déclarration des opérateurs</small>
            </div>
            <div>
                <small><b>* Effectif de la population:</b> RGPH 2014, INS</small>
            </div>
        </div>
        <div class="legend">
            <table class="w-100" style="">
                <tbody>
                    <tr>
                        <td class="pr-1">
                            <small class="d-inline text-sm-custom"><em>Mise à jour le 30/06/2024</em></small> <br>
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/area.png" class="d-inline mr-1" alt="" style="height: 12px;">
                            <small class="d-inline text-sm-custom"><em>Localité</em></small>
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/alldata.png" class="d-inline mr-1" alt="" style="height: 12px;">
                            <small class="d-inline text-sm-custom"><em>Localité couverte</em></small>
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/nodata.png" class="d-inline mr-1" alt="" style="height: 12px;">
                            <small class="d-inline text-sm-custom"><em>Localité non couverte</em></small>
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/whitearea.png" class="d-inline mr-1 rounded-circle border border-dark" alt="" style="height:12px;">
                            <small class="d-inline text-sm-custom"><em>Localité blanche</em></small>
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/cercle-orange.png" class="d-inline " alt="" style="height: 12px">
                            <small class="d-inline text-sm-custom"><em>Couverture Orange</em></small>
                            <img src="../images/operateurs/orange.png" class="d-inline" alt="" style="height: 12px">
                        </td>
                        <td class="pr-1">
                            <img src="../images/operateurs/cercle-mtn.png" class="d-inline" alt="" style="height: 12px;">
                            <small class="d-inline text-sm-custom"><em>Couverture MTN</em></small>
                            <img src="../images/operateurs/mtn.png" class="d-inline" alt="" style="height: 12px;">
                        </td>
                        <td class=pr-1>
                            <img src="../images/operateurs/cercle-moov.png" class="d-inline" alt="" style="height: 12px">
                            <small class="d-inline text-sm-custom"><em>Couverture Moov</em></small>
                            <img src="../images/operateurs/moov.png" class="d-inline" alt="" style="height: 12px">
                        </td>
                        <!-- <td class="pr-2">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <img src="../images/operateurs/cercle-orange.png" class="d-inline " alt="" style="height: 15px; width:15px">
                                    <div class="d-inline">
                                        <small class=""><em>Couverture Orange</em></small>
                                    </div>
                                    <img src="../images/operateurs/orange.png" class="d-inline" alt="" style="height: 15px; width:15px;">

                                </div>
                                <div class="col-md-4">
                                    <img src="../images/operateurs/cercle-mtn.png" class="d-inline" alt="" style="height: 15px; width:15px">
                                    <div class="d-inline">
                                        <small class=""><em>Couverture MTN</em></small>
                                    </div>
                                    <img src="../images/operateurs/mtn.png" class="d-inline" alt="" style="height: 15px; width:15px;">
                                </div>
                                <div class="col-md-4">
                                    <img src="../images/operateurs/cercle-moov.png" class="d-inline" alt="" style="height: 15px; width:15px">
                                    <div class="d-inline">
                                        <small class=""><em>Couverture Moov</em></small>
                                    </div>
                                    <img src="../images/operateurs/moov.png" class="d-inline" alt="" style="height: 15px; width:15px;">
                                </div>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="d-none">
            <canvas id="canvasAl" width="320" height="320"></canvas>
            <canvas id="canvasOr" width="320" height="320"></canvas>
            <canvas id="canvasMt" width="320" height="320"></canvas>
            <canvas id="canvasMo" width="320" height="320"></canvas>
        </div>
        <script>
            var canvas = document.getElementById("canvasAl");
            var ctx = canvas.getContext("2d");
            ctx.beginPath();
            ctx.arc(50, 60, 10, 0, Math.PI * 2, false);
            ctx.fillStyle = "#00b09b";
            ctx.fill();
            ctx.closePath();

            var canvas = document.getElementById("canvasOr");
            var ctxa = canvas.getContext("2d");
            ctxa.beginPath();
            ctxa.arc(240, 160, 10, 0, Math.PI * 2, false);
            ctxa.fillStyle = "orange";
            ctxa.fill();
            ctxa.closePath();

            var canvas = document.getElementById("canvasMt");
            var ctxb = canvas.getContext("2d");
            ctxb.beginPath();
            ctxb.arc(240, 160, 10, 0, Math.PI * 2, false);
            ctxb.fillStyle = "#fffc37";
            ctxb.fill();
            ctxb.closePath();

            var canvas = document.getElementById("canvasMo");
            var ctxc = canvas.getContext("2d");
            ctxc.beginPath();
            ctxc.arc(240, 160, 10, 0, Math.PI * 2, false);
            ctxc.fillStyle = "#075bf7";
            ctxc.fill();
            ctxc.closePath();
        </script>
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 10px !important;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1 !important;
                ;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888 !important;
                ;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555 !important;
                ;
            }
        </style>
        {{-- <a class="btn dwld" id="generate-btn" onclick="generateMap()"><i class="fas fa-download"></i></a> --}}
        <div class="w-100"></div>
        <div class="" id="spinner"></div>

        <!-- <div class="tobarSect">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="" id="ditrict_s" class="form-control form-control-sm" onchange="ditrictSelected()">
                            <option value=""> Sélectionner un DISTRICT</option>
                            <option value="1">BAS-SASSANDRA</option>
                            <option value="14">COMOE</option>
                            <option value="2">DENGUELE</option>
                            <option value="3">DISTRICT AUTONOME D'ABIDJAN</option>
                            <option value="4">DISTRICT AUTONOME DE YAMOUSSOUKRO</option>
                            <option value="5">GOH-DJIBOI</option>
                            <option value="6">LACS</option>
                            <option value="13">LAGUNES</option>
                            <option value="7">MONTAGNES</option>
                            <option value="8">SASSANDRA-MARAHOUE</option>
                            <option value="9">SAVANE</option>
                            <option value="10">VALLÉE DU BANDAMA</option>
                            <option value="11">WOROBA</option>
                            <option value="12">ZANZAN</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="" id="region_s" class="form-control form-control-sm selectedOption" onchange="regionSelected()">
                            <option value="">Sélectionner une REGION</option>
                            <option value="1">AGNEBI TIASSA</option>
                            <option value="2">BAFING</option>
                            <option value="3">BAGOUE</option>
                            <option value="4">BELIER</option>
                            <option value="5">BERE</option>
                            <option value="6">BOUNKANI</option>
                            <option value="7">CAVALY</option>
                            <option value="8">DISTRICT AUTONOME D'ABIDJAN</option>
                            <option value="9">DISTRICT AUTONOME DE YAMOUSSOUKRO</option>
                            <option value="10">FOLON</option>
                            <option value="11">GBEKE</option>
                            <option value="12">GBOKLE</option>
                            <option value="13">GOH</option>
                            <option value="14">GONTOUGO</option>
                            <option value="15">GRANDS PONTS</option>
                            <option value="16">GUEMON</option>
                            <option value="17">HAMBOL</option>
                            <option value="18">HAUT-SASSANDRA</option>
                            <option value="19">IFFOU</option>
                            <option value="20">INDENIE-DJOUABLIN</option>
                            <option value="21">KABADOUGOU</option>
                            <option value="22">LOH-DJIBOUA</option>
                            <option value="23">MARAHOUE</option>
                            <option value="24">ME</option>
                            <option value="25">NAWA</option>
                            <option value="26">PORO</option>
                            <option value="28">SUD-COMOE</option>
                            <option value="29">TCHOLOGO</option>
                            <option value="30">TONKPI</option>
                            <option value="31">WORODOUGOU</option>
                            <option value="32">N'ZI</option>
                            <option value="33">MORONOU</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="tobarSect">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="" id="entites" class="form-control form-control-sm" onchange="entite_administrative()">
                            <option value="">Sélectionner une entité administrative</option>
                            <option value="1">Districts</option>
                            <option value="2">Régions</option>
                            <option value="3">Sous-préfectures</option>
                            <option value="4">Localités</option>
                            <!-- <option value="5">Localités</option> -->

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrappered form-group">
                        <!-- <div class="select-button form-control form-control-sm">
                            <span>-----------------</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div> -->
                        <div class="contenu">
                            <div class="search input-group">
                                <!-- <i class="fa-solid fa-magnifying-glass-location"></i> -->
                                <!-- <i class="uil uil-search"></i> w-100 -->
                                <input class="form-control form-control-sm" spellcheck="false" type="text" placeholder="Rechercher">
                                <div class="input-group-append">
                                    <!-- Icône "Quitter" -->
                                    <span class="input-group-text quit-icon" onclick="clearSearch()"><i class="fas fa-times"></i></span>
                                </div>
                            </div>
                            <ul class="options mt-2">
                            </ul>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="input-group-text" id="basic-addon1 btnLoc" hidden>
                                <i class="fas fa-search"></i>
                                </i></button>
                        </div>
                        <input type="text" id="searchLoc" class="form-control form-control-sm" placeholder="Localité" aria-label="Username" aria-describedby="basic-addon1" hidden>
                    </div>

                    <div class="form-group">
                        <select name="" id="nomEntites" class="form-control form-control-sm selectedOption" hidden onchange="entite_administrative_name()">
                            <option value="">Choix non disponible</option>
                        </select>
                    </div>
                </div>



            </div>

            <!-- 
            <div class="row">
                <div class="col-md-6">
                    
                    
                </div>
            </div>
            -->


        </div>



        {{-- <div class="labeld">
            <div id="" class="text-white text-left">
                <div class="bg-white" id="chart_cont">
                </div>
                <div id="descript"></div>
            </div>
        </div> --}}

        <div>
            <div id="calculated-area"></div>
        </div>

        <div class="d-none">
            <div id="mapbox-gl-export-page-size"></div>
            <div id="mapbox-gl-export-page-orientaiton"></div>
            <div id="mapbox-gl-export-dpi-type"></div>
        </div>

    </div>

</div>



</div>