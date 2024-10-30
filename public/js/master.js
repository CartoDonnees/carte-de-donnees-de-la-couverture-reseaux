//Variable

//select with search
var entity;
const wrappered = document.querySelector(".wrappered"),
    //selectBtn = wrappered.querySelector(".select-button"),
    searchInp = wrappered.querySelector("input"),
    options = wrappered.querySelector(".options");

var countries = new Object();

let districts = {
    1: "BAS-SASSANDRA", 2: "DENGUELE", 3: "DISTRICT AUTONOME D'ABIDJAN",
    4: "DISTRICT AUTONOME DE YAMOUSSOUKRO", 5: "GOH-DJIBOI", 6: "LACS",
    7: "MONTAGNES", 8: "SASSANDRA-MARAHOUE", 9: "SAVANES",
    10: "VALLÉE DU BANDAMA", 11: "WOROBA", 12: "ZANZAN", 13: "LAGUNES", 14: "COMOE"
};

let regions = {
    1: "AGNEBI TIASSA", 2: "BAFING", 3: "BAGOUE", 4: "BELIER", 5: "BERE", 6: "BOUNKANI", 7: "CAVALLY", 10: "FOLON", 11: "GBEKE", 12: "GBOKLE", 13: "GOH",
    14: "GONTOUGO", 15: "GRANDS PONTS", 16: "GUEMON", 17: "HAMBOL", 18: "HAUT-SASSANDRA", 19: "IFFOU", 20: "INDENIE-DJOUABLIN", 21: "KABADOUGOU",
    22: "LOH-DJIBOUA", 23: "MARAHOUE", 24: "ME", 25: "NAWA", 26: "PORO", 28: "SUD-COMOE", 29: "TCHOLOGO", 30: "TONKPI", 31: "WORODOUGOU", 32: "N'ZI", 33: "MORONOU"
};

function clearSearch() {

    if (marker != null) {
        marker.remove();
    }
    var entite = document.getElementById('entites');
    wrappered.classList.toggle("active");
    wrappered.setAttribute('hidden');
    entite.innerHTML = '<option value=""> Sélectionner une entité administrative</option><option value="1">Districts</option><option value="2">Régions</option><option value="3">Sous-préfectures</option><option value="4">Localités</option>';
    optserach == false;
    flyMap(-5.89192, 7.41331, 5.5);
    d_export = null;

    document.getElementById('statd').className = "d-none";
    document.getElementById('stats').className = "d-block";
}

function addCountry(country) {
    options.innerHTML = "";
    if (entity == "rg" || entity == "dt") {
        for (var i in country) {
            let li = `<li onclick="updateName(this)" class="${i}">${country[i]}</li>`;
            options.insertAdjacentHTML("beforeend", li);
        }
    }
    if (entity == 'sp') {
        for (i in country) {
            let li = `<li onclick="updateName(this)" class="${i}">${country[i]['sp'].toUpperCase()}</li>`;
            options.insertAdjacentHTML("beforeend", li);
        }
    }
    if (entity == 'lc') {
        for (i in country) {
            let li = `<li onclick="updateName(this)" class="${i}">${country[i]['loc']}</li>`;
            options.insertAdjacentHTML("beforeend", li);
        }
    }

}

function updateName(selectedLi) {
    searchInp.value = "";
    if (entity == "rg" || entity == "dt") {
        addCountry(countries);
    }
    if (entity == 'sp') {
        addCountry(dep);
    }
    if (entity == 'lc') {
        addCountry(dwdData);
    }

    if (selectedLi.className == '0') {
        options.innerHTML = "";
        options.classList.remove("active");
    } else {
        searchInp.value = selectedLi.innerText;
        entite_administrative_name(selectedLi.className);
        options.innerHTML = "";
        options.classList.remove("active");
    }

}

searchInp.addEventListener("click", () => {
    if (entity == "rg" || entity == "dt") {
        options.classList.add("active");
        addCountry(countries);
    }

    if (entity == "sp") {
        options.classList.add("active");
        addCountry(dep);
    }

    if (entity == "lc") {
        options.classList.add("active");
        addCountry(dwdData);
    }
});

searchInp.addEventListener("keydown", () => {
    let arr = [];
    if (entity == "rg" || entity == "dt") {
        let searchedVal = searchInp.value.toLowerCase();
        arr = Object.entries(countries).filter(function ([key, value]) {
            return value.toLowerCase().startsWith(searchedVal);
            // }
            //  data => {
            //     return countries[data].toLowerCase().startsWith(searchedVal);
        }).map(data => `<li onclick="updateName(this)" class="${data[0]}">${data[1]}</li>`).join("");
        options.innerHTML = arr ? arr : `<p>Oops! Country not found</p>`;
    }
    if (entity == "sp") {
        let searchedVal = searchInp.value.toLowerCase();
        arr = Object.entries(dep).filter(function ([key, value]) {
            return value.sp.toLowerCase().startsWith(searchedVal);
            // }
            //  data => {
            //     return countries[data].toLowerCase().startsWith(searchedVal);
        }).map(data => `<li onclick="updateName(this)" class="${data[0]}">${data[1].sp}</li>`).join("");
        options.innerHTML = arr ? arr : `<p>Oops! Country not found</p>`;
    }
    if (entity == "lc") {
        let searchedVal = searchInp.value.toLowerCase();
        arr = Object.entries(dwdData).filter(function ([key, value]) {
            return value.loc.toLowerCase().startsWith(searchedVal);
            // }
            //  data => {
            //     return countries[data].toLowerCase().startsWith(searchedVal);
        }).map(data => `<li onclick="updateName(this)" class="${data[0]}">${data[1].loc}</li>`).join("");
        options.innerHTML = arr ? arr : `<p>Oops! Country not found</p>`;
    }
});

//selectBtn.addEventListener("click", () => {
//    wrappered.classList.toggle("active");
//});
//select with search

var mapBoxToken = 'pk.eyJ1IjoiYmFzc2lyYSIsImEiOiJja3Q3ZnQ2ODgwcno2Mm9yd2o2MjJrMGxnIn0.Ro21I2cW_NZWJVMr1w6QQw';

var map;
var sourceLoaded = [];
var layerLoaded = [];
var layerVisible = [];
var optserach = false;
var lock_id = null;
var hoveredDistrictId = null;
var d_click = false;
var r_click = false;
var d_lock = null;
var r_lock = null;
var p_click = null;

var de_lock = null;


var stcl = true; //Booléen pou cacher la rubrique couverture localités
var operat = true;
var techno = true;
var stat = true;
var hoveredRegionId = null;

var hoveredlocality = null;

var chartDog = new Chart("myChart", {
    type: 'bar',
    data: {
        labels: ["2G", "3G", "4G",],
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
            text: "Localités couvertes par technologie",
        },
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    boxWidth: 10,
                    fontSize: 6
                },
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function (context, index) {
                        console.log('element======>  ', context)
                        return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / nbLoc).toFixed(2) + '%';
                    }
                }
            },
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

var chartDin = new Chart("netData", {
    type: 'bar',
    data: {
        labels: ["2G", "3G", "4G",],
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
            text: "Population couverte par technologie",
        },
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    boxWidth: 10,
                    fontSize: 4
                },
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function (context, index) {
                        return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / pops).toFixed(2) + '%';
                    }
                }
            },
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

class MyControl {
    constructor() {
        this.onClick = this._onClick.bind(this);
    }
    onAdd(map) {
        this.map = map;
        var el = this.container = document.createElement('div');
        el.className = 'mapboxgl-mycontrol mapboxgl-ctrl mapboxgl-ctrl-group';

        var button = document.createElement('button');
        button.setAttribute('type', 'button');
        button.addEventListener('click', this.onClick, false);
        el.appendChild(button);

        var icon = document.createElement('i');
        icon.className = 'fas fa-home';
        icon.style.fontSize = '18px';
        button.appendChild(icon);
        return el;
    }
    onRemove(map) {
        this.container.parentNode.removeChild(this.container);
        this.map = undefined;
    }
    _onClick() {
        // mon action
        resetMap();
    }
}




if (!mapboxgl.supported()) {
    alert("Votre navigateur Internet ne permet pas d’afficher cette page.\nTrouvez à cette adresse les navigateurs compatibles :\nhttps://www.mapbox.com/help/mapbox-browser-support/");
} else {
    mapboxgl.accessToken = "pk.eyJ1IjoieWFvcGFyZmFpdCIsImEiOiJja2p4enkzM20wbW95MnFwZzdod2h4YWtpIn0.-A0-mEp4INf4laMwOdRVNA";
    map = new mapboxgl.Map({
        container: 'maps',
        style: 'mapbox://styles/yaoparfait/cky4qrjmh7s3p14l5wu98kgvm', //style URL
        center: [-5.891926847184704, 7.41331470697536],
        zoom: 6.1, //starting zoom,
        maxZoom: 22,
        minZoom: 4,
        maxBounds: [-16, 2, 3, 13],
        attributionControl: false,
    });

    // disable map rotation
    // map.dragRotate.disable();
    // map.touchZoomRotate.disableRotation();
    // map.ready = true;
}


// Add geocoder
// var geocoder = new MapboxGeocoder({
//     accessToken: mapboxgl.accessToken,
//     country: 'ci',
//     types: 'country, region, postcode, district, place, locality, neighborhood, address',
//     language: 'fr',
//     marker: false,
// });

// geocoder.options.placeholder = "Rechercher...";
//geocoder.remove();
// map.addControl(geocoder);
map.addControl(new mapboxgl.FullscreenControl({
    container: document.querySelector('maps')
}));

map.addControl(new mapboxgl.NavigationControl(), 'top-right');

map.addControl(new watergis.MapboxExportControl({
    PageSize: watergis.Size.A4,
    PageOrientation: watergis.PageOrientation.landscape,
    Format: watergis.Format.PDF,
    DPI: watergis.DPI[300],
    Crosshair: true,
    PrintableArea: true,
}), 'top-right');

map.addControl(new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true,
    },
    // When active the map will receive updates to the device's location as it changes.
    trackUserLocation: true,
    // Draw an arrow next to the location dot to indicate which direction the device is heading.
    showUserHeading: true,
}));

map.addControl(new MyControl(), 'top-right');

map.addControl(new mapboxgl.ScaleControl({ maxWidth: 80, unit: 'metric' })); // Add scale

map.on('load', () => {
    //Sources
    addOnSource('sous_prefs', 'geojson', 'dataFiles/geojson/sub_prefecture_limites_30_06_2024.geojson');
    addOnSource('departements', 'geojson', 'dataFiles/geojson/department_limites_30_06_2024.geojson');
    addOnSource('regions', 'geojson', 'dataFiles/geojson/region_limites_30_06_2024.geojson');
    addOnSource('districts', 'geojson', 'dataFiles/geojson/district_limites_30_06_2024.geojson');
    addOnSource('states', 'geojson', 'dataFiles/geojson/ci_limites_states.geojson');


    //Layer Fill
    addFillLayer('district-fills', 'districts', 1, 8, 'rgba(6, 250, 46,0.5)', 0.1);
    addFillLayer('region-fills', 'regions', 6, 9, 'rgba(247, 21, 198, 0.173)', 0.2);
    addFillLayer('departement-fills', 'departements', 8.5, 20, 'rgba(214, 136, 18, 0.1)', 0.2);

    //Données

    //Unique fonction d'afficher le nom des localité sur la carte
    addOnSource('screendata', 'geojson', 'dataFiles/geojson/all_data30_06_2024.geojson');
    addOnCircleLayerLocalisation('sdata', 'screendata', 'black');

    addOnSource('alldata', 'geojson', 'dataFiles/geojson/all_data30_06_2024.geojson');
    addOnCircleLayerWithFilter('adata', 'alldata', '#00b09b',[">=", ['get', 'popCov'], 1]);
    layerVisible.push('adata');


    // addOnSource('data2G', 'geojson', 'dataFiles/geojson/data2G.geojson');
    addOnCircleLayerWithFilter('d2G', 'alldata', '#00b09b', ["==", ['get', 'cov2G'], 1]);
    layerVisible.push('d2G');

    // addOnSource('data3G', 'geojson', 'dataFiles/geojson/data3G.geojson');
    addOnCircleLayerWithFilter('d3G', 'alldata', '#00b09b', ["==", ['get', 'cov3G'], 1]);
    layerVisible.push('d3G');

    // addOnSource('data4G', 'geojson', 'dataFiles/geojson/data4G.geojson');
    addOnCircleLayerWithFilter('d4G', 'alldata', '#00b09b', ["==", ['get', 'cov4G'], 1]);
    layerVisible.push('d4G');

    // addOnSource('dataOrange', 'geojson', 'dataFiles/geojson/dataOrange.geojson');
    addOnCircleLayerWithFilter('odata', 'alldata', 'orange', ["==", ['get', 'covORANGE2G'], 1]);
    layerVisible.push('odata');

    // addOnSource('dataMtn', 'geojson', 'dataFiles/geojson/dataMtn.geojson');
    addOnCircleLayerWithFilter('mtdata', 'alldata', '#fffc37', ["==", ['get', 'covMTN2G'], 1]);
    layerVisible.push('mtdata');

    // addOnSource('dataMoov', 'geojson', 'dataFiles/geojson/dataMoov.geojson');
    addOnCircleLayerWithFilter('modata', 'alldata', '#075bf7', ["==", ['get', 'covMOOV2G'], 1]);
    layerVisible.push('modata');

    // addOnSource('dataOrange2G', 'geojson', 'dataFiles/geojson/dataOrange2G.geojson');
    addOnCircleLayerWithFilter('o2Gdata', 'alldata', 'orange', ["==", ['get', 'covORANGE2G'], 1]);
    layerVisible.push('o2Gdata');

    // addOnSource('dataMtn2G', 'geojson', 'dataFiles/geojson/dataMtn2G.geojson');
    addOnCircleLayerWithFilter('mt2Gdata', 'alldata', '#fffc37', ["==", ['get', 'covMTN2G'], 1]);
    layerVisible.push('mt2Gdata');

    // addOnSource('dataMoov2G', 'geojson', 'dataFiles/geojson/dataMoov2G.geojson');
    addOnCircleLayerWithFilter('mo2Gdata', 'alldata', '#075bf7', ["==", ['get', 'covMOOV2G'], 1]);
    layerVisible.push('mo2Gdata');

    // addOnSource('dataOrange3G', 'geojson', 'dataFiles/geojson/dataOrange3G.geojson');
    addOnCircleLayerWithFilter('o3Gdata', 'alldata', 'orange', ["==", ['get', 'covORANGE3G'], 1]);
    layerVisible.push('o3Gdata');

    // addOnSource('dataMtn3G', 'geojson', 'dataFiles/geojson/dataMtn3G.geojson');
    addOnCircleLayerWithFilter('mt3Gdata', 'alldata', '#fffc37', ["==", ['get', 'covMTN3G'], 1]);
    layerVisible.push('mt3Gdata');

    // addOnSource('dataMoov3G', 'geojson', 'dataFiles/geojson/dataMoov3G.geojson');
    addOnCircleLayerWithFilter('mo3Gdata', 'alldata', '#075bf7', ["==", ['get', 'covMOOV3G'], 1]);
    layerVisible.push('mo3Gdata');

    // addOnSource('dataOrange4G', 'geojson', 'dataFiles/geojson/dataOrange4G.geojson');
    addOnCircleLayerWithFilter('o4Gdata', 'alldata', 'orange', ["==", ['get', 'covORANGE4G'], 1]);
    layerVisible.push('o4Gdata');

    // addOnSource('dataMtn4G', 'geojson', 'dataFiles/geojson/dataMtn4G.geojson');
    addOnCircleLayerWithFilter('mt4Gdata', 'alldata', '#fffc37', ["==", ['get', 'covMTN4G'], 1]);
    layerVisible.push('mt4Gdata');

    //Ajout des données de couverture 4G
    // addOnSource('dataMoov4G', 'geojson', 'dataFiles/geojson/dataMoov4G.geojson');
    addOnCircleLayerWithFilter('mo4Gdata', 'alldata', '#075bf7', ["==", ['get', 'covMOOV4G'], 1]);
    layerVisible.push('mo4Gdata');


    //Ajout des localité non couvertes
    // addOnSource('nodata', 'geojson', 'dataFiles/geojson/nodata.geojson');
    addOnCircleLayerWithFilter('nodata', 'alldata', 'red',["==", ['get', 'popCov'], 0]);
    layerVisible.push('nodata');


    // addOnSource('areawhitedata', 'geojson', 'dataFiles/geojson/dataWhiteArea.geojson');
    addOnCircleLayerWithFilter('awdata', 'alldata','white',["==", ['get', 'popCov'], 0]);
    layerVisible.push('awdata');

    //Ajout des antennes

    //2G
    addOnSource('mtnantenna2g', 'geojson', 'dataFiles/geojson/antennaMtn.geojson');
    //addOnAntennaLayer('mtAnt2g', 'mtnantenna2g', 'images/antenna/antenna.png', 'yellow');
    //layerVisible.push('mtAnt');

    addOnSource('orangeantenna2g', 'geojson', 'dataFiles/geojson/antennaOrange.geojson');
    // addOnAntennaLayer('orAnt2g', 'orangeantenna2g', 'images/antenna/antenna.png', 'orange');
    // layerVisible.push('orAnt2g');

    addOnSource('moovantenna2g', 'geojson', 'dataFiles/geojson/antennaMoov.geojson');
    // addOnAntennaLayer('moAnt2g', 'moovantenna2g', 'images/antenna/antenna.png', 'blue');
    // layerVisible.push('moAnt2g');

    // //3G
    // addOnSource('mtnantenna3g', 'geojson', 'dataFiles/geojson/antennaMtn3G.geojson');
    // addOnAntennaLayer('mtAnt3g', 'mtnantenna3g', 'images/antenna/antenna.png', 'yellow');
    // layerVisible.push('mtAnt3g');

    // addOnSource('orangeantenna3g', 'geojson', 'dataFiles/geojson/antennaOrange3G.geojson');
    // addOnAntennaLayer('orAnt3g', 'orangeantenna3g', 'images/antenna/antenna.png', 'orange');
    // layerVisible.push('orAnt3g');

    // addOnSource('moovantenna3g', 'geojson', 'dataFiles/geojson/antennaMoov3G.geojson');
    // addOnAntennaLayer('moAnt3g', 'moovantenna3g', 'images/antenna/antenna.png', 'blue');
    // layerVisible.push('moAnt3g');

    // //4G
    // addOnSource('mtnantenna4g', 'geojson', 'dataFiles/geojson/antennaMtn4G.geojson');
    // addOnAntennaLayer('mtAnt4g', 'mtnantenna4g', 'images/antenna/antenna.png', 'yellow');
    // layerVisible.push('mtAnt4g');

    // addOnSource('orangeantenna4g', 'geojson', 'dataFiles/geojson/antennaOrange4G.geojson');
    // addOnAntennaLayer('orAnt4g', 'orangeantenna4g', 'images/antenna/antenna.png', 'orange');
    // layerVisible.push('orAnt4g');

    // addOnSource('moovantennal4g', 'geojson', 'dataFiles/geojson/antennaMoov4G.geojson');
    // addOnAntennaLayer('moAnt4g', 'moovantenna4g', 'images/antenna/antenna.png', 'blue');
    // layerVisible.push('moAnt4g');


    //Layer Border
    addLineLayer('departement-borders', 'departements', 8, 20, 'rgba(66, 65, 66, 0.264)', 1);
    addLineLayer('region-borders', 'regions', 6, 20, 'rgba(10, 93, 248, 0.493)', 1.5);
    addLineLayer('district-borders', 'districts', 1, 8, 'rgb(0, 0, 0)', 1);
    addLineLayer('state-borders', 'states', 1, 7, 'rgba(22, 23, 24, 0.911)', 1.5);

    //Layer Label

    addLayerLabel('region-label', 'regions', 'admin2Name', 6, 9);
    addLayerLabel('district-label', 'districts', 'admin1Name', 1, 8);
    addLayerLabelLocalisation('localite-label', 'screendata', 'localite', 8, 20);



    // Create a popup, but don't add it to the map yet.
    const popup = new mapboxgl.Popup({
        closeButton: true,
        closeOnClick: true
    });

    map.on('mouseleave', 'places', () => {
        map.getCanvas().style.cursor = '';
        popup.remove();
    });



    map.on('click', 'departement-fills', (a) => {
        map.flyTo({
            center: [
                a.lngLat.lng, a.lngLat.lat
            ],
            zoom: 9.5,
            speed: 0.5,
            curve: 1,
            essential: true,
            //this animation is considered essential with respect to prefers-reduced-motion
        });
    });


    popFill = new mapboxgl.Popup({ className: "apple-popup" });

    //Couche Districts

    map.on('mousemove', 'district-fills', (e) => {


        //xdocument.getElementById('chart_cont').innerHTML('<canvas id="dinamiqueChart" width="400" height="300"></canvas>');



        const locCOuv = e.features[0].properties.nbcouvloc;
        const dist_name = e.features[0].properties.admin1Name;
        const pops = e.features[0].properties.population;
        const tloc = e.features[0].properties.nbloc;
        const txcloc = e.features[0].properties.txcouvloc;
        const txcpop = e.features[0].properties.txpopcouv;

        var popcouv = e.features[0].properties.popcouv;

        popFill.setLngLat(e.lngLat)
            .setHTML('<small style="color: #FFFFFF;" >District: <b>' + dist_name + ' </b><br></small><small style="color: #FFFFFF;">Localité couverte: <b>' + locCOuv + ' / ' + tloc + ' => ' + txcloc.toFixed(2) + '%</b><br></small><small style="color: #FFFFFF;">Population Couverte: <b>' + popcouv + ' / ' + pops + ' => ' + txcpop.toFixed(2) + '%</b><br></small>')
            .addTo(map);


        if (e.features.length > 0) {
            if (hoveredDistrictId != null) {
                if (d_lock != hoveredDistrictId) {
                    map.setFeatureState({ source: 'districts', id: hoveredDistrictId }, { hover: false });

                }
            }
            hoveredDistrictId = e.features[0].id;
            if (d_lock != hoveredDistrictId) {
                map.setFeatureState({ source: 'districts', id: hoveredDistrictId }, { hover: true });
            }
        }


        //document.getElementById('descript').innerHTML = '<small>DISTRICT: <b class="text-primary">' + e.features[0].properties.admin1Name + ' </b><br></small><small>LOCALITE COUVERTE: <b class="text-primary">' + e.features[0].properties.nbcouvloc + ' </b><br></small><small>POPULATION: <b class="text-primary">' + e.features[0].properties.population + ' </b><br></small>';
    });


    map.on('mousemove', 'region-fills', (e) => {

        popFill.remove();
        const locCOuv = e.features[0].properties.nbcouvloc;
        const reg_name = e.features[0].properties.admin2Name;
        const pops = e.features[0].properties.population;
        const tloc = e.features[0].properties.nbloc;
        const txcloc = e.features[0].properties.txcouvloc;
        const txcpop = e.features[0].properties.txpopcouv;

        var popcouv = e.features[0].properties.popcouv;

        popFill.setLngLat(e.lngLat)
            .setHTML('<small style="color: #FFFFFF;" >REGION: <b>' + reg_name + ' </b><br></small><small style="color: #FFFFFF;">Localité couverte: <b>' + locCOuv + ' / ' + tloc + ' => ' + txcloc.toFixed(2) + '%</b><br></small><small style="color: #FFFFFF;">Population Couverte: <b>' + popcouv + ' / ' + pops + ' => ' + txcpop.toFixed(2) + '%</b><br></small>')
            .addTo(map);

        if (e.features.length > 0) {
            if (hoveredRegionId != null) {
                if (r_lock != hoveredRegionId) {
                    map.setFeatureState({ source: 'regions', id: hoveredRegionId }, { hover: false });
                }
            }
            hoveredRegionId = e.features[0].id;
            if (r_lock != hoveredRegionId) {
                map.setFeatureState({ source: 'regions', id: hoveredRegionId }, { hover: true });
            }
        }
    });


    // CLICK DE DISTRICT
    map.on('click', 'district-fills', (e) => {
        d_export = [1, e.features[0].properties.admin1Name, e.features[0].properties.popcouv, e.features[0].properties.population, e.features[0].properties.nbcouvloc, e.features[0].properties.nbcouvloc, e.features[0].properties.nbloc];

        if (map.getZoom() > 7) {

        } else {
            map.flyTo({
                center: [
                    e.lngLat.lng, e.lngLat.lat
                ],
                zoom: 7.5,
                speed: 0.5,
                curve: 1,
                essential: true,
                //this animation is considered essential with respect to prefers-reduced-motion
            });
        }


        if (d_lock != null) {
            map.setFeatureState({ source: 'districts', id: d_lock }, { hover: false });
        }
        if (r_lock != null) {
            map.setFeatureState({ source: 'regions', id: r_lock }, { hover: false });
        }
        map.setFeatureState({ source: 'districts', id: e.features[0].id }, { hover: true });
        d_lock = e.features[0].id;

        document.getElementById('stat_dist').innerHTML = '<small>DISTRICT: <b class="text-primary">' + e.features[0].properties.admin1Name + ' </b></small>'


        p_click = true;

        document.getElementById('statd').className = "d-block";
        document.getElementById('stats').className = "d-none";

        chartDog.destroy();
        chartDin.destroy();
        const nbo2G = e.features[0].properties.nbcouv2gOr;
        const nbo3G = e.features[0].properties.nbcouv3gOr;
        const nbo4G = e.features[0].properties.nbcouv4gOr;
        const nbmt2G = e.features[0].properties.nbcouv2gMtn;
        const nbmt3G = e.features[0].properties.nbcouv3gMtn;
        const nbmt4G = e.features[0].properties.nbcouv4gMtn;
        const nbmo2G = e.features[0].properties.nbcouv2gMoov;
        const nbmo3G = e.features[0].properties.nbcouv3gMoov;
        const nbmo4G = e.features[0].properties.nbcouv4gMoov;
        const o2G = e.features[0].properties.popOrange2G;
        const o3G = e.features[0].properties.popOrange3G;
        const o4G = e.features[0].properties.popOrange4G;
        const mt2G = e.features[0].properties.popMtn2G;
        const mt3G = e.features[0].properties.popMtn3G;
        const mt4G = e.features[0].properties.popMtn4G;
        const mo2G = e.features[0].properties.popMoov2G;
        const mo3G = e.features[0].properties.popMoov3G;
        const mo4G = e.features[0].properties.popMoov4G;
        const populat_c = e.features[0].properties.popcouv;
        const popu = e.features[0].properties.population;
        const loc_c = e.features[0].properties.nbcouvloc;
        const nb_loc = e.features[0].properties.nbloc;
        const txcloc = e.features[0].properties.txcouvloc;
        const txcpop = e.features[0].properties.txpopcouv;


        document.getElementById('nb_locs').innerHTML = '<small>Nombre : <b class="text-primary">' + loc_c + '/' + nb_loc + ' => ' + txcloc.toFixed(2) + '%</b></small>'
        document.getElementById('nb_pops').innerHTML = '<small>Effectif: <b class="text-primary">' + populat_c + '/' + popu + ' => ' + txcpop.toFixed(2) + '%</b></small>'

        chartDog = new Chart("myChart", {
            type: 'bar',
            data: {
                labels: ["2G", "3G", "4G",],
                datasets: [{
                    label: 'Orange',
                    backgroundColor: 'orange',
                    data: [
                        nbo2G,
                        nbo3G,
                        nbo4G,
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
                        nbmt2G,
                        nbmt3G,
                        nbmt4G,
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
                        nbmo2G,
                        nbmo3G,
                        nbmo4G,
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
                    text: "Localités couvertes par technologie",
                },
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            boxWidth: 10,
                            fontSize: 6
                        },
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context, index) {
                                return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / nb_loc).toFixed(2) + '%';
                            }
                        }
                    },
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

        chartDin = new Chart("netData", {
            type: 'bar',
            data: {
                labels: ["2G", "3G", "4G",],
                datasets: [{
                    label: 'Orange',
                    backgroundColor: 'orange',
                    data: [
                        o2G,
                        o3G,
                        o4G,
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
                        mt2G,
                        mt3G,
                        mt4G,
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
                        mo2G,
                        mo3G,
                        mo4G,
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
                    text: "Population couverte par technologie",
                },
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            boxWidth: 10,
                            fontSize: 6
                        },
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context, index) {
                                return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / popu).toFixed(2) + '%';
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            display: true,
                            font: {
                                size: 8
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
    });



    map.on('click', 'region-fills', (e) => {
        d_export = [2, e.features[0].properties.admin2Name, e.features[0].properties.popcouv, e.features[0].properties.population, e.features[0].properties.nbcouvloc, e.features[0].properties.nbcouvloc, e.features[0].properties.nbloc];
        if (map.getZoom() > 7.5) {

        } else {
            map.flyTo({
                center: [
                    e.lngLat.lng, e.lngLat.lat
                ],
                zoom: 8.5,
                speed: 0.5,
                curve: 1,
                essential: true,
                //this animation is considered essential with respect to prefers-reduced-motion
            });
        }

        d_lock = null;
        r_lock = null;
        d_click = false;
        if (e.features.length > 0) {
            if (hoveredRegionId != null) {
                map.setFeatureState({ source: 'regions', id: hoveredRegionId }, { hover: false });
            }
            hoveredRegionId = e.features[0].id;
            map.setFeatureState({ source: 'regions', id: hoveredRegionId }, { hover: true });
        }

        r_lock = e.features[0].id;
        p_click = true;

        document.getElementById('statd').className = "d-block";
        document.getElementById('stats').className = "d-none";
        chartDog.destroy();
        chartDin.destroy();
        const nbo2G = e.features[0].properties.nbcouv2gOr;
        const nbo3G = e.features[0].properties.nbcouv3gOr;
        const nbo4G = e.features[0].properties.nbcouv4gOr;
        const nbmt2G = e.features[0].properties.nbcouv2gMtn;
        const nbmt3G = e.features[0].properties.nbcouv3gMtn;
        const nbmt4G = e.features[0].properties.nbcouv4gMtn;
        const nbmo2G = e.features[0].properties.nbcouv2gMoov;
        const nbmo3G = e.features[0].properties.nbcouv3gMoov;
        const nbmo4G = e.features[0].properties.nbcouv4gMoov;
        const o2G = e.features[0].properties.popOrange2G;
        const o3G = e.features[0].properties.popOrange3G;
        const o4G = e.features[0].properties.popOrange4G;
        const mt2G = e.features[0].properties.popMtn2G;
        const mt3G = e.features[0].properties.popMtn3G;
        const mt4G = e.features[0].properties.popMtn4G;
        const mo2G = e.features[0].properties.popMoov2G;
        const mo3G = e.features[0].properties.popMoov3G;
        const mo4G = e.features[0].properties.popMoov4G;
        const populat_c = e.features[0].properties.popcouv;
        const popu = e.features[0].properties.population;
        const loc_c = e.features[0].properties.nbcouvloc;
        const nb_loc = e.features[0].properties.nbloc;
        const txcloc = e.features[0].properties.txcouvloc;
        const txcpop = e.features[0].properties.txpopcouv;


        document.getElementById('stat_dist').innerHTML = '<small>REGION: <b class="text-primary">' + e.features[0].properties.admin2Name + ' </b></small>'

        document.getElementById('nb_locs').innerHTML = '<small>Nombre : <b class="text-primary">' + loc_c + '/' + nb_loc + ' => ' + txcloc.toFixed(2) + '%</b></small>'
        document.getElementById('nb_pops').innerHTML = '<small>Effectif: <b class="text-primary">' + populat_c + '/' + popu + ' => ' + txcpop.toFixed(2) + '%</b></small>'

        chartDog = new Chart("myChart", {
            type: 'bar',
            data: {
                labels: ["2G", "3G", "4G",],
                datasets: [{
                    label: 'Orange',
                    backgroundColor: 'orange',
                    data: [
                        nbo2G,
                        nbo3G,
                        nbo4G,
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
                        nbmt2G,
                        nbmt3G,
                        nbmt4G,
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
                        nbmo2G,
                        nbmo3G,
                        nbmo4G,
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
                    text: "Localités couvertes par technologie",
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
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context, index) {
                                return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / nb_loc).toFixed(2) + '%';
                            }
                        }
                    },
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

        chartDin = new Chart("netData", {
            type: 'bar',
            data: {
                labels: ["2G", "3G", "4G",],
                datasets: [{
                    label: 'Orange',
                    backgroundColor: 'orange',
                    data: [
                        o2G,
                        o3G,
                        o4G,
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
                        mt2G,
                        mt3G,
                        mt4G,
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
                        mo2G,
                        mo3G,
                        mo4G,
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
                    text: "Population couverte par technologie",
                },
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            boxWidth: 10,
                            fontSize: 6
                        },
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context, index) {
                                return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / popu).toFixed(2) + '%';
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            display: true,
                            font: {
                                size: 8
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
    });

    map.on('mouseout', 'district-fills', () => {
        if (d_lock == null) {
            var i;
            for (i = 1; i < 15; i++) {
                map.setFeatureState({ source: 'districts', id: i }, { hover: false });
            }
        }
    });


    map.on('mouseout', 'region-fills', () => {
        if (r_lock == null) {
            var i;
            for (i = 1; i < 33; i++) {
                map.setFeatureState({ source: 'regions', id: i }, { hover: false });
            }
        }
    });

    map.on('mouseleave', 'district-fills', () => {
        map.getCanvas().style.cursor = '';
        popup.remove();
        popFill.remove();
    });

    map.on('mousemove', 'district-fills', (e) => { });



    // map.on('mouseenter', 'region-fills', () => {
    //     map.getCanvas().style.cursor = 'pointer';
    // });

    // map.on('mouseleave', 'district-fills', () => {
    //     if (optserach == false) {
    //         for (i = 1; i < 12; i++) {
    //             map.setFeatureState({ source: 'districts', id: i }, { hover: false });
    //         }
    //         //document.getElementById('descript').innerHTML = "                        <small> <em>Les districts, regions et departements survoler ou clicker sur la carte du territoire ivoirien s'afficherons ici</em> </small>"
    //     }
    // });

    // map.on('mouseleave', 'region-fills', () => {
    //     if (optserach == false) {
    //         for (i = 1; i < 33; i++) {
    //             map.setFeatureState({ source: 'regions', id: i }, { hover: false });
    //         }
    //     }
    // });


    //When the user moves their mouse over the state-fill layer, we'll update the
    //feature state for the feature under the mouse.

    map.on('click', 'departement-fills', (e) => {
        if (e.features.length > 0) {
            if (hoveredlocality != null) {
                map.setFeatureState({ source: 'departements', id: hoveredlocality }, { hover: false });
            }
            hoveredlocality = e.features[0].id;
            map.setFeatureState({ source: 'departements', id: hoveredlocality }, { hover: true });
        }
    });



    //When the mouse leaves the state-fill layer, update the feature state of the
    //previously hovered feature.
    map.on('mouseleave', 'departement-fills', () => {
        // if (hoveredStateId !== null) {
        //     map.setFeatureState({ source: 'departements', id: hoveredStateId }, { hover: false });
        // }
        // hoveredStateId = null;
    });



    setAllLayersInvisible();
    setLayerVisible('adata');


    map.setLayoutProperty('country-label', 'text-field', [
        'get',
        `name_fr`,
    ]);


});

function addOnSource(name, type, data) {
    map.addSource(name, {
        'type': type,
        'data': data,
    });
}

/////////////////////////////////////////
function addOnAntennaLayer(id, source, image, color) {
    map.loadImage(
        image,
        (error, image) => {
            if (error) throw error;

            // Add the image to the map style.
            map.addImage('cat', image);


            map.addLayer({
                'id': id + '-icon',
                'type': 'symbol',
                'source': source, // reference the data source
                'layout': {
                    'icon-image': 'cat', // reference the image
                    'icon-size': 0.25,
                    'icon-anchor': 'bottom', // Set the anchor point of the icon to the bottom
                    'icon-offset': [0, -30]
                }
            });

            map.addLayer({
                'id': id + '-text',
                'type': 'symbol',
                'source': source,
                'layout': {
                    'text-field': '{tech}', // Display technology info
                    'text-font': ['Open Sans Semibold', 'Arial Unicode MS Bold'],
                    // Adjust the vertical offset of the technology label
                    'text-size': 12,
                    'text-offset': [0, -4],
                    'text-anchor': 'bottom'
                },
                'paint': {
                    'text-color': color
                },
                'minzoom': 8
            });

        })
}

function removeNetworkAntennaLayer(id) {
    if (map.getLayer(id + '-icon')) {
        map.removeLayer(id + '-icon');
    }

    if (map.getLayer(id + '-text')) {
        map.removeLayer(id + '-text');
    }
}

////////////////////////////////////////////////////

function addOnCircleLayer(id, source, color) {
    map.addLayer({
        'id': id,
        'type': 'circle',
        'source': source,
        'paint': {
            'circle-radius': 4,
            //'circle-stroke-width': 2,
            'circle-color': color,
            //'circle-stroke-color': 'white'
        }
    });
}
function addOnCircleLayerWithFilter(id, source, color, filter) {
    map.addLayer({
        'id': id,
        'type': 'circle',
        'source': source,
        'paint': {
            'circle-radius': 4,
            //'circle-stroke-width': 2,
            'circle-color': color,
            //'circle-stroke-color': 'white'
        },
        filter: filter
    });
}

function addOnCircleLayerLocalisation(id, source, color) {
    map.addLayer({
        'id': id,
        'type': 'circle',
        'source': source,
        'paint': {
            'circle-radius': 4,
            'circle-color': color,
            'circle-opacity': 0
        }
    });

    map.on('zoom', function () {
        var zoom = map.getZoom();
        if (zoom >= 8.5) {
            map.setPaintProperty(id, 'circle-opacity', 1);
        } else {
            map.setPaintProperty(id, 'circle-opacity', 0);
        }
    });
}


function addOnCircleLayerWhite(id, source) {
    map.addLayer({
        'id': id,
        'type': 'circle',
        'source': source,
        'paint': {
            'circle-radius': 4,
            'circle-color': 'white',
            'circle-stroke-width': 0.5,
            'circle-stroke-color': 'black'
        }
    });
}



function addLineLayer(id, source, minzoom, maxzoom, color, width) {
    map.addLayer({
        'id': id,
        'type': 'line',
        'source': source,
        'minzoom': minzoom,
        'maxzoom': maxzoom,
        'layout': {},
        'paint': {
            'line-color': color,
            'line-width': width
        }
    });
}



function addFillLayer(id, source, minzoom, maxzoom, color, opacity) {
    map.addLayer({
        'id': id,
        'type': 'fill',
        'source': source,
        'minzoom': minzoom,
        'maxzoom': maxzoom,
        'layout': {},
        'paint': {
            'fill-color': color,
            'fill-opacity': [
                'case', ['boolean', ['feature-state', 'hover'], false],
                1,
                opacity
            ]
        }
    });
}



function addLayerLabel(id, source, text_f, minzoom, maxzoom) {
    map.addLayer({
        'id': id,
        'type': 'symbol',
        'source': source,
        'layout': {
            'text-field': ['get', text_f],
            'text-justify': 'auto',
            'text-variable-anchor': ['top', 'bottom', 'left', 'right'],
            'text-font': [
                'literal', ['DIN Offc Pro Italic', 'Arial Unicode MS Regular'],
            ],
        },
        'minzoom': minzoom,
        'maxzoom': maxzoom,
    })
}
function addLayerLabelLocalisation(id, source, text_f, minzoom, maxzoom) {
    map.addLayer({
        'id': id,
        'type': 'symbol',
        'source': source,
        'layout': {
            'text-size': 10,
            'text-field': ['get', text_f],
            'text-justify': 'auto',
            'text-variable-anchor': ['top', 'bottom', 'left', 'right'],
            'text-font': [
                'literal', ['DIN Offc Pro Italic', 'Arial Unicode MS Regular'],
            ],
        },
        'minzoom': minzoom,
        'maxzoom': maxzoom,
    })
}


function showTpCouv(id) {
    var elt_c = document.getElementById(id);
    if (id == 'st_couv') {
        if (stcl == true) {
            elt_c.style.display = "none";
            stcl = false;
        } else {
            elt_c.style.display = "block";
            stcl = true;
        }
    } else if (id == 'operat') {
        if (operat == true) {
            elt_c.style.display = "none";
            operat = false;
        } else {
            elt_c.style.display = "block";
            operat = true;
        }
    } else if (id == 'techno') {
        if (techno == true) {
            elt_c.style.display = "none";
            techno = false;
        } else {
            elt_c.style.display = "block";
            techno = true;
        }
    } else if (id == 'stats') {
        if (stat == true) {
            elt_c.style.display = "none";
            stat = false;
        } else {
            elt_c.style.display = "block";
            stat = true;
        }
    }
}


function setAllLayersInvisible() {
    while (layerVisible.length > 0) {
        setLayerInvisible(layerVisible[0]);
    }
}

function setLayerInvisible(layer) {
    map.setLayoutProperty(layer, "visibility", "none");
    removeFromArray(layerVisible, layer);
}

function removeFromArray(array, value) {
    if (array.indexOf(value) >= 0) {
        array.splice(array.indexOf(value), 1);
    }
}

function setLayerVisible(layer) {
    if (!layerVisible.includes(layer)) {
        map.setLayoutProperty(layer, "visibility", "visible");
        console.log("setLayerVisible : " + layer);
        layerVisible.push(layer);
    }
}

function minSetLayer() {

}

function showAntenna(id) {
    var ator = document.getElementById('antenna_or');
    var atmt = document.getElementById('antenna_mt');
    var atmo = document.getElementById('antenna_mo');

    removeNetworkAntennaLayer('orAnt2g');
    removeNetworkAntennaLayer('mtAnt2g');
    removeNetworkAntennaLayer('moAnt2g');

    if (id == "or" && ator.checked == true) {

        if (atmt.checked == true) { addOnAntennaLayer('mtAnt2g', 'mtnantenna2g', 'images/antenna/antenna.png', 'yellow'); }
        if (atmo.checked == true) { addOnAntennaLayer('moAnt2g', 'moovantenna2g', 'images/antenna/antenna.png', 'blue'); }
        addOnAntennaLayer('orAnt2g', 'orangeantenna2g', 'images/antenna/antenna.png', 'orange');
    }
    else if (id == "mt" && atmt.checked == true) {

        if (atmo.checked == true) { addOnAntennaLayer('moAnt2g', 'moovantenna2g', 'images/antenna/antenna.png', 'blue'); }
        if (ator.checked == true) { addOnAntennaLayer('orAnt2g', 'orangeantenna2g', 'images/antenna/antenna.png', 'orange'); }
        addOnAntennaLayer('mtAnt2g', 'mtnantenna2g', 'images/antenna/antenna.png', 'yellow');
    }
    else if (id == "mo" && atmo.checked == true) {

        if (ator.checked == true) { addOnAntennaLayer('orAnt2g', 'orangeantenna2g', 'images/antenna/antenna.png', 'orange'); }
        if (atmt.checked == true) { addOnAntennaLayer('mtAnt2g', 'mtnantenna2g', 'images/antenna/antenna.png', 'yellow'); }
        addOnAntennaLayer('moAnt2g', 'moovantenna2g', 'images/antenna/antenna.png', 'blue');
    }
    else {
        if (atmt.checked == true) { addOnAntennaLayer('mtAnt2g', 'mtnantenna2g', 'images/antenna/antenna.png', 'yellow'); }
        if (atmo.checked == true) { addOnAntennaLayer('moAnt2g', 'moovantenna2g', 'images/antenna/antenna.png', 'blue'); }
        if (ator.checked == true) { addOnAntennaLayer('orAnt2g', 'orangeantenna2g', 'images/antenna/antenna.png', 'orange'); }
    }
}


function showLayer() {
    var opor = document.getElementById('orangeop');
    var opmt = document.getElementById('mtnop');
    var opmo = document.getElementById('moovop');
    var t2G = document.getElementById('thecno2G');
    var t3G = document.getElementById('thecno3G');
    var t4G = document.getElementById('thecno4G');

    var zc = document.getElementById('zc');
    var zb = document.getElementById('zb');
    var zn = document.getElementById('zn');

    var vf = document.getElementById('rail');
    var rn = document.getElementById('road_n');
    var rs = document.getElementById('road_s');
    var rm = document.getElementById('road_m');

    setAllLayersInvisible();

    if (zc.checked == true && zb.checked == true && zn.checked == true) {
        setLayerVisible('adata');
        setLayerVisible('nodata');
        setLayerVisible('awdata');
    } else if (zc.checked == true && zb.checked == true && zn.checked == false) {
        setLayerVisible('adata');
        setLayerVisible('awdata');
    } else if (zc.checked == true && zb.checked == false && zn.checked == true) {
        setLayerVisible('adata');
        setLayerVisible('nodata');
    } else if (zc.checked == false && zb.checked == true && zn.checked == true) {
        setLayerVisible('awdata');
        setLayerVisible('nodata');
    } else if (zc.checked == true && zb.checked == false && zn.checked == false) {
        setLayerVisible('adata');
    } else if (zc.checked == false && zb.checked == true && zn.checked == false) {
        setLayerVisible('awdata');
    } else if (zc.checked == false && zb.checked == false && zn.checked == true) {
        setLayerVisible('nodata');
    }

    if (vf.checked === true) {
        setLayerVisible('rails')
    }

    if (rn.checked === true) {
        setLayerVisible('road-motorway-trunk')
    }
    if (rs.checked === true) {
        setLayerVisible('road-secondary-tertiary')
    }
    if (rm.checked === true) {
        setLayerVisible('road-minor')
    }


    if (opor.checked === true && opmt.checked == true && opmo.checked == true) { //Orange Mtn Moov
        if (t2G.checked === true) { //Orange 2G
            setLayerVisible('o2Gdata');
            setLayerVisible('mt2Gdata');
            setLayerVisible('mo2Gdata');
        } else if (t3G.checked === true) { //Orange 3G
            setLayerVisible('o3Gdata');
            setLayerVisible('mt3Gdata');
            setLayerVisible('mo3Gdata');
        } else if (t4G.checked === true) { //Orange 4G
            setLayerVisible('o4Gdata');
            setLayerVisible('mt4Gdata');
            setLayerVisible('mo4Gdata');
        } else {
            setLayerVisible('odata');
            setLayerVisible('mtdata');
            setLayerVisible('modata');
        }
    } else if (opor.checked === true && opmt.checked == false && opmo.checked == false) { //Orange !Mtn !Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked) {
            if (t2G.checked === true) { //Selection 2G
                setLayerVisible('o2Gdata');
            }
            if (t3G.checked === true) { //Selection 3G
                setLayerVisible('o3Gdata');
            }
            if (t4G.checked === true) { //Selection 4G
                setLayerVisible('o4Gdata');
            }
        } else { //Orange
            setLayerVisible('odata');
        }
    } else if (opor.checked === false && opmt.checked == true && opmo.checked == false) { //!Orange Mtn !Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked) {
            if (t2G.checked === true) { // MTN 2G
                setLayerVisible('mt2Gdata');
            }
            if (t3G.checked === true) { // MTN 3G
                setLayerVisible('mt3Gdata');
            }
            if (t4G.checked === true) { // MTN 4G
                setLayerVisible('mt4Gdata');
            }
        } else { // MTN 
            setLayerVisible('mtdata');
        }
    } else if (opor.checked === false && opmt.checked == false && opmo.checked == true) { //!Orange !Mtn Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked) {
            if (t2G.checked === true) { //Moov 2G
                setLayerVisible('mo2Gdata');
            }
            if (t3G.checked === true) { // Moov 3G
                setLayerVisible('mo3Gdata');
            }
            if (t4G.checked === true) { // Moov 4G
                setLayerVisible('mo4Gdata');
            }
        } else { //Moov
            setLayerVisible('modata');
        }
    } else if (opor.checked === false && opmt.checked == true && opmo.checked == true) { //!Orange Mtn Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked == true) {
            if (t2G.checked === true) {
                setLayerVisible('mt2Gdata');
                setLayerVisible('mo2Gdata');
            }
            if (t2G.checked === false && t3G.checked === true) {
                setLayerVisible('mt3Gdata');
                setLayerVisible('mo3Gdata');
            }
            if (t2G.checked === false && t3G.checked === false && t4G.checked === true) {
                setLayerVisible('mt4Gdata');
                setLayerVisible('mo4Gdata');
            }
        } else {
            setLayerVisible('mtdata');
            setLayerVisible('modata');
        }
    } else if (opor.checked === true && opmt.checked == true && opmo.checked == false) { //Orange Mtn !Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked == true) {
            if (t2G.checked === true) {
                setLayerVisible('o2Gdata');
                setLayerVisible('mt2Gdata');
            }
            if (t2G.checked === false && t3G.checked === true) {
                setLayerVisible('o3Gdata');
                setLayerVisible('mt3Gdata');
            }
            if (t2G.checked === false && t3G.checked === false && t4G.checked === true) {
                setLayerVisible('o4Gdata');
                setLayerVisible('mt4Gdata');
            }
        } else {
            setLayerVisible('odata');
            setLayerVisible('mtdata');
        }
    } else if (opor.checked === true && opmt.checked == false && opmo.checked == true) { //Orange !Mtn Moov
        if (t2G.checked === true || t3G.checked === true || t4G.checked == true) {
            if (t2G.checked === true) {
                setLayerVisible('o2Gdata');
                setLayerVisible('mo2Gdata');
            }
            if (t2G.checked === false && t3G.checked === true) {
                setLayerVisible('o3Gdata');
                setLayerVisible('mo3Gdata');
            }
            if (t2G.checked === false && t3G.checked === false && t4G.checked === true) {
                setLayerVisible('o4Gdata');
                setLayerVisible('mo4Gdata');
            }
        } else {
            setLayerVisible('odata');
            setLayerVisible('modata');
        }
    } else {
        if (t2G.checked === true || t3G.checked === true || t4G.checked == true) {
            setAllLayersInvisible();
            if (t2G.checked === true) { // 2G
                setLayerVisible('d2G');
            }
            if (t3G.checked === true) { // 3G
                setLayerVisible('d3G');
            }
            if (t4G.checked === true) { // 4G
                setLayerVisible('d4G');
            }
        }

        if (zb.checked == true && zn.checked == true) {
            setLayerVisible('nodata');
            setLayerVisible('awdata');
        } else if (zb.checked == true && zn.checked == false) {
            setLayerVisible('awdata');
        } else if (zb.checked == false && zn.checked == true) {
            setLayerVisible('nodata');
        } else if (zb.checked == true && zn.checked == true) {
            setLayerVisible('awdata');
            setLayerVisible('nodata');
        }
    }



}

function showWhiteArea() {
    setAllLayersInvisible();
    setLayerVisible('awdata');
}

function showDatas() { }

function showNoData() {
    setAllLayersInvisible();
    setLayerVisible('nodata');
}


// function ditrictSelected() {
//     var district = document.getElementById('ditrict_s');
//     var region = document.getElementById('region_s')

//     if (district.value == 1) {
//         flyMap(-6.85451, 4.95212, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="25">NAWA</option><option value="12">GBOKLE</option><option value="27">SAN-PEDRO</option>';
//         d_export = [1, 'BAS-SASSANDRA'];
//     } else if (district.value == 2) {
//         flyMap(-7.33710, 9.41089, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="10">FOLON</option><option value="21">KABADOUGOU</option>';
//         d_export = [1, 'DENGUELE'];
//     } else if (district.value == 3) {
//         flyMap(-3.93656, 5.35020, 7);
//         region.innerHTML = '<option value="">---</option>';
//         d_export = [1, "DISTICT AUTONOME D'ABIDJAN"];
//     } else if (district.value == 4) {
//         flyMap(-5.23295, 6.84131, 7);
//         region.innerHTML = '<option value="">---</option>';
//         d_export = [1, 'DISTICT AUTONOME DE YAMOUSSOUKRO'];
//     } else if (district.value == 5) {
//         flyMap(-5.71085, 5.97882, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="13">GOH</option><option value="22">LOH-DJIBOUA</option>';
//         d_export = [1, 'GOH-DJIBOI'];
//     } else if (district.value == 6) {
//         flyMap(-4.55179, 7.11393, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="4">BELIER</option><option value="19">IFFOU</option><option value="33">MORONOU</option><option value="32">N\'ZI</option>';
//         d_export = [1, 'LACS'];
//     } else if (district.value == 7) {
//         flyMap(-7.76055, 6.81789, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="7">CAVALY</option><option value="16">GUEMON</option><option value="30">TONKPI</option>';
//         d_export = [1, 'MONTAGNES'];
//     } else if (district.value == 8) {
//         flyMap(-6.26151, 7.11491, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="18">HAUT-SASSANDRA</option><option value="23">MARAHOUE</option>';
//         d_export = [1, 'SASSANDRA-MARAHOUE'];
//     } else if (district.value == 9) {
//         flyMap(-5.72318, 9.74464, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="3">BAGOUE</option><option value="26">PORO</option><option value="29">TCHOLOGO</option>';
//         d_export = [1, 'SAVANE'];
//     } else if (district.value == 10) {
//         flyMap(-4.85518, 8.29674, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="11">GBEKE</option><option value="17">HAMBOL</option>';
//         d_export = [1, 'VALLÉE DU BANDAMA'];
//     } else if (district.value == 11) {
//         flyMap(-6.81993, 8.44411, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="2">BAFING</option><option value="5">BERE</option><option value="31">WORODOUGOU</option>'
//         d_export = [1, 'WOROBA'];
//     } else if (district.value == 12) {
//         flyMap(-3.33729, 8.71763, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="6">BOUNKANI</option><option value="14">GONTOUGO</option>';
//         d_export = [1, 'ZANZAN'];
//     } else if (district.value == 13) {
//         flyMap(-4.50054, 5.94614, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="1">AGNEBI TIASSA</option><option value="15">GRANDS PONTS</option><option value="24">ME</option>';
//         d_export = [1, 'LAGUNES'];
//     } else if (district.value == 14) {
//         flyMap(-3.23515, 5.35694, 7);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="20">INDENIE-DJOUABLIN</option><option value="28">SUD-COMOE</option>';
//         d_export = [1, 'COMOE'];
//     } else {
//         optserach == false;
//         flyMap(-5.89192, 7.41331, 5.5);
//         region.innerHTML = '<option value="">Selectionner une region</option><option value="1">AGNEBI TIASSA</option><option value="2">BAFING</option><option value="3">BAGOUE</option><option value="4">BELIER</option><option value="5">BERE</option><option value="6">BOUNKANI</option><option value="7">CAVALY</option><option value="8">DISTICT AUTONOME D\'ABIDJAN</option><option value="9">DISTICT AUTONOME DE YAMOUSSOUKRO</option><option value="10">FOLON</option><option value="11">GBEKE</option><option value="13">GOH</option><option value="14">GONTOUGO</option><option value="15">GRANDS PONTS</option><option value="16">GUEMON</option><option value="17">HAMBOL</option><option value="18">HAUT-SASSANDRA</option><option value="19">IFFOU</option><option value="20">INDENIE-DJOUABLIN</option><option value="21">KABADOUGOU</option><option value="22">LOH-DJIBOUA</option><option value="23">MARAHOUE</option><option value="24">ME</option><option value="26">PORO</option><option value="28">SUD-COMOE</option><option value="29">TCHOLOGO</option><option value="30">TONKPI</option><option value="31">WORODOUGOU</option><option value="32">N\'ZI</option><option value="33">MORONOU</option>';
//         d_export = null;
//     }

//     if (lock_id != null) {
//         map.setFeatureState({ source: 'districts', id: lock_id }, { hover: false });
//     }
//     lock_id = district.value;
//     map.setFeatureState({ source: 'districts', id: lock_id }, { hover: true });




//     optserach = true;
// }


// function regionSelected() {
//     var district = document.getElementById('ditrict_s');
//     var region = document.getElementById('region_s');
//     if (region.value == 1) {
//         flyMap(-4.55783, 5.95810, 8.5);
//         d_export = [2, 'AGNEBI-TIASSA'];
//     } else if (region.value == 2) {
//         flyMap(-7.60506, 8.36806, 8.5);
//         d_export = [2, 'BAFING'];
//     } else if (region.value == 3) {
//         flyMap(-6.39656, 10.05434, 8.5);
//         d_export = [2, 'BAGOUE'];
//     } else if (region.value == 4) {
//         flyMap(-4.96834, 6.81628, 8);
//         d_export = [2, 'BELIER'];
//     } else if (region.value == 5) {
//         flyMap(-5.99007, 8.29740, 8);
//         d_export = [2, 'BERE'];
//     } else if (region.value == 6) {
//         flyMap(-3.24348, 9.17696, 8);
//         d_export = [2, 'BOUNKANI'];
//     } else if (region.value == 7) {
//         flyMap(-7.83028, 6.41795, 8);
//         d_export = [2, 'CAVALY'];
//     } else if (region.value == 8) {
//         flyMap(-4.05098, 5.39620, 8);
//         d_export = [2, "DISTICT AUTONOME D'ABIDJAN"];
//     } else if (region.value == 9) {
//         flyMap(-5.23201, 6.84355, 8);
//         d_export = [2, 'DISTICT AUTONOME DE YAMOUSSOUKRO'];
//     } else if (region.value == 10) {
//         flyMap(-7.65999, 10.26521, 8);
//         d_export = [2, 'FOLON'];
//     } else if (region.value == 11) {
//         flyMap(-5.13186, 7.70873, 8);
//         d_export = [2, 'GBEKE'];
//     } else if (region.value == 12) {
//         flyMap(-6.04500, 5.30322, 8);
//         d_export = [2, 'GBOKLE'];
//     } else if (region.value == 13) {
//         flyMap(-5.79781, 6.20501, 8);
//         d_export = [2, 'GOH'];
//     } else if (region.value == 14) {
//         flyMap(-3.11165, 8.37893, 8);
//         d_export = [2, 'GONTOUGO'];
//     } else if (region.value == 15) {
//         flyMap(-4.8035, 5.28134, 8);
//         d_export = [2, 'GRANDS PONTS'];
//     } else if (region.value == 16) {
//         flyMap(-7.29744, 7.03985, 8);
//         d_export = [2, 'GUEMON'];
//     } else if (region.value == 17) {
//         flyMap(-4.75410, 8.49847, 8);
//         d_export = [2, 'HAMBOL'];
//     } else if (region.value == 18) {
//         flyMap(-6.64375, 7.07256, 8);
//         d_export = [2, 'HAUT-SASSANDRA'];
//     } else if (region.value == 19) {
//         flyMap(-4.04549, 7.58470, 8);
//         d_export = [2, 'IFFOU'];
//     } else if (region.value == 20) {
//         flyMap(-3.45772, 6.78355, 8);
//         d_export = [2, 'INDENIE-DJOUABLIN'];
//     } else if (region.value == 21) {
//         flyMap(-7.50879, 9.48093, 8);
//         d_export = [2, 'KABADOUGOU'];
//     } else if (region.value == 22) {
//         flyMap(-5.46694, 5.66291, 8);
//         d_export = [2, 'LOH-DJIBOUA'];
//     } else if (region.value == 23) {
//         flyMap(-5.77456, 7.00595, 8);
//         d_export = [2, 'MARAHOUE'];
//     } else if (region.value == 24) {
//         flyMap(-3.86294, 6.08913, 8);
//         d_export = [2, 'ME'];
//     } else if (region.value == 25) {
//         flyMap(-6.68643, 5.95802, 8);
//         d_export = [2, 'NAWA'];
//     } else if (region.value == 26) {
//         flyMap(-6.04922, 9.54975, 8);
//         d_export = [2, 'PORO'];
//     } else if (region.value == 28) {
//         flyMap(-3.21475, 5.41141, 8);
//         d_export = [2, 'SUD-COMOE'];
//     } else if (region.value == 29) {
//         flyMap(-4.78579, 9.50641, 8);
//         d_export = [2, 'TCHOLOGO'];
//     } else if (region.value == 30) {
//         flyMap(-7.76309, 7.35475, 8);
//         d_export = [2, 'TONKPI'];
//     } else if (region.value == 31) {
//         flyMap(-6.55459, 8.42121, 8);
//         d_export = [2, "WORODOUGOU"];
//     } else if (region.value == 32) {
//         flyMap(-4.63198, 6.97324, 8);
//         d_export = [2, "N'ZI"];
//     } else if (region.value == 33) {
//         flyMap(-4.31338, 6.70053, 8);
//         d_export = [2, 'MORONOU'];
//     } else {
//         optserach == false;
//         flyMap(-5.89192, 7.41331, 5.5);
//         d_export = null;
//     }

//     if (r_lock != null) {
//         map.setFeatureState({ source: 'regions', id: r_lock }, { hover: false });
//     }

//     r_lock = region.value;
//     map.setFeatureState({ source: 'regions', id: r_lock }, { hover: true });
//     optserach = true;
// }
var marker = null;

function entite_administrative() {

    if (marker != null) {
        marker.remove();
    }
    var entite = document.getElementById('entites');
    // var nomEntite = document.getElementById('nomEntites');
    // var btnLoc = document.getElementById('basic-addon1 btnLoc');
    // var searchLoc = document.getElementById('searchLoc');

    if (entite.value == 1) {
        // btnLoc.setAttribute('hidden');
        // searchLoc.removeAttribute('hidden');
        // searchLoc.setAttribute('disabled');
        // searchLoc.setAttribute('placeholder', 'Selectionner un district');


        // nomEntite.removeAttribute('hidden');
        entite.innerHTML = '<option value="1">Districts</option><option value="2">Régions</option><option value="3">Sous-préfectures</option><option value="4">Localités</option><option value="5">Annuler votre selection</option>';
        // nomEntite.innerHTML = '<option value= "">-----------------------------------</option><option value="1">BAS-SASSANDRA</option> <option value="14">COMOE</option> <option value="2">DENGUELE</option> <option value="3">DISTRICT AUTONOME ABIDJAN</option> <option value="4">DISTRICT AUTONOME DE YAMOUSSOUKRO</option><option value="5">GOH-DJIBOI</option> <option value="6">LACS</option><option value="13">LAGUNES</option><option value="7">MONTAGNES</option><option value="8">SASSANDRA-MARAHOUE</option><option value="9">SAVANE</option><option value="10">VALLÉE DU BANDAMA</option><option value="11">WOROBA</option><option value="12">ZANZAN</option>';
        //nomEntite.classList.add('chosen');
        searchInp.value = "";
        options.classList.remove("active");
        wrappered.classList.add("active");
        wrappered.removeAttribute('hidden');
        //selectBtn.firstElementChild.innerText = "----------------------------";
        entity = 'dt'
        countries = districts;
        //options.innerHTML = "";
        //addCountry(districts);


    }
    else if (entite.value == 2) {
        // btnLoc.setAttribute('hidden');
        // searchLoc.removeAttribute('hidden');
        // searchLoc.setAttribute('disabled');
        // searchLoc.setAttribute('placeholder', 'Selectionner une région');

        // nomEntite.removeAttribute('hidden');
        entite.innerHTML = '<option value="1">Districts</option><option selected value="2">Régions</option><option value="3">Sous-préfectures</option><option value="4">Localités</option><option value="5">Annuler votre selection</option>';

        // nomEntite.innerHTML = '<option value="">-----------------------------------</option>' +
        //     '<option value="1">AGNEBI TIASSA</option>' +
        //     '<option value="2">BAFING</option>' +
        //     '<option value="3">BAGOUE</option>' +
        //     '<option value="4">BELIER</option>' +
        //     '<option value="5">BERE</option>' +
        //     '<option value="6">BOUNKANI</option>' +
        //     '<option value="7">CAVALLY</option>' +
        //     '<option value="10">FOLON</option>' +
        //     '<option value="11">GBEKE</option>' +
        //     '<option value="12">GBOKLE</option>' +
        //     '<option value="13">GOH</option>' +
        //     '<option value="14">GONTOUGO</option>' +
        //     '<option value="15">GRANDS PONTS</option>' +
        //     '<option value="16">GUEMON</option>' +
        //     '<option value="17">HAMBOL</option>' +
        //     '<option value="18">HAUT-SASSANDRA</option>' +
        //     '<option value="19">IFFOU</option>' +
        //     '<option value="20">INDENIE-DJOUABLIN</option>' +
        //     '<option value="21">KABADOUGOU</option>' +
        //     '<option value="22">LOH-DJIBOUA</option>' +
        //     '<option value="23">MARAHOUE</option>' +
        //     '<option value="24">ME</option>' +
        //     '<option value="25">NAWA</option>' +
        //     '<option value="26">PORO</option>' +
        //     '<option value="28">SUD-COMOE</option>' +
        //     '<option value="29">TCHOLOGO</option>' +
        //     '<option value="30">TONKPI</option>' +
        //     '<option value="31">WORODOUGOU</option>' +
        //     '<option value="32">N\'ZI</option>' +
        //     '<option value="33">MORONOU</option>';
        searchInp.value = "";
        options.classList.remove("active");
        wrappered.classList.add("active");
        wrappered.removeAttribute('hidden');
        //selectBtn.firstElementChild.innerText = "----------------------------";
        entity = 'rg';
        countries = regions;
        //addCountry(countries);


    }
    else if (entite.value == 3) {
        // btnLoc.setAttribute('hidden');
        // searchLoc.removeAttribute('hidden');
        // searchLoc.setAttribute('disabled');
        // searchLoc.setAttribute('placeholder', 'Selectionner une sous-prefecture');


        // nomEntite.removeAttribute('hidden');
        entite.innerHTML = '<option value="1">Districts</option><option value="2">Régions</option><option selected value="3">Sous-préfectures</option><option value="4">Localités</option><option value="5">Annuler votre selection</option>';
        // nomEntite.innerHTML = '<option value= "">-----------------------------------</option>';

        // for(data in dep){
        //     nomEntite.innerHTML += '<option value="' +data+ '">' +dep[data].sp +'</option>';

        // }
        // fetch('dataFiles/geojson/ci_limites_departements.geojson')
        //     // .then(results=>results.json())
        //     // .then(console.log);
        //     .then(function (response) {
        //         return response.json();
        //     })
        //     .then(function (data) {
        //         for (var i = 0; i < data['features'].length; i++) {
        //             nomEntite.innerHTML += '<option value="' + data['features'][i].id + '">' + data['features'][i]['properties'].ADM3_FR + '</option>';
        //         }
        //     });

        //nomEntite.innerHTML = '<option value= "">Selectionner un département</option><option value="1">Abengourou</option> ';
        searchInp.value = "";
        options.classList.remove("active");
        wrappered.classList.add("active");
        wrappered.removeAttribute('hidden');
        //selectBtn.firstElementChild.innerText = "----------------------------";
        entity = 'sp';
        //addCountry(dep);


    }
    else if (entite.value == 4) {
        // btnLoc.removeAttribute('hidden');
        // searchLoc.removeAttribute('hidden')
        // searchLoc.removeAttribute('disabled')
        // searchLoc.setAttribute('placeholder', 'Taper le nom de votre localité');


        // nomEntite.setAttribute('hidden');
        entite.innerHTML = '<option value="1">Districts</option><option value="2">Régions</option><option value="3">Sous-préfectures</option><option selected value="4">Localités</option><option value="5">Annuler votre selection</option>';

        // nomEntite.innerHTML = '<option value= "">Selectionner localité</option>';
        searchInp.value = "";
        options.classList.remove("active");
        wrappered.classList.add("active");
        wrappered.removeAttribute('hidden');
        //selectBtn.firstElementChild.innerText = "----------------------------";
        entity = 'lc';
        //addCountry(dwdData);
    }
    else if (entite.value == 5) {
        wrappered.classList.toggle("active");
        wrappered.setAttribute('hidden');
        // btnLoc.setAttribute('hidden');
        // searchLoc.setAttribute('hidden')
        // searchLoc.setAttribute('placeholder', 'Taper le nom de votre localité');

        // nomEntite.setAttribute('hidden');
        entite.innerHTML = '<option value=""> Sélectionner une entité administrative</option><option value="1">Districts</option><option value="2">Régions</option><option value="3">Sous-préfectures</option><option value="4">Localités</option>';
        optserach == false;
        flyMap(-5.89192, 7.41331, 5.5);
        d_export = null;
        // nomEntite.innerHTML = '<option value= "">Selectionner une localité</option>';
        //nomEntite.innerHTML = '<option value= "">Selectionner un localite</option><option value="1">TOYEBLI</option>';



        // fetch('dataFiles/geojson/data2G.geojson')
        // .then(results=>results.json())
        // .then(console.log);
        // .then(function(response){
        //     return response.json();
        // })
        // .then(function(data) {
        //     for(var i=0 ; i<data['features'].length; i++ ){
        //         nomEntite.innerHTML += '<option value="' +i+ '">' +data['features'][i]['properties'].localite +'</option>';

        //     }
        // });
    }
    else {
        wrappered.setAttribute('hidden');
        optserach == false;
        flyMap(-5.89192, 7.41331, 5.5);
        d_export = null;

        document.getElementById('statd').className = "d-none";
        document.getElementById('stats').className = "d-block";
    }
}

async function entite_administrative_name(nomEntite) {
    var entite = document.getElementById('entites');

    if (marker != null) {
        marker.remove();
    }


    if (entite.value == 1) {

        if (nomEntite == 1) {
            flyMap(-6.85451, 4.95212, 7);
            d_export = [1, 'BAS-SASSANDRA'];
        } else if (nomEntite == 2) {
            flyMap(-7.33710, 9.41089, 7);
            d_export = [1, 'DENGUELE'];
        } else if (nomEntite == 3) {
            flyMap(-3.93656, 5.35020, 7);
            d_export = [1, "DISTRICT AUTONOME D'ABIDJAN"];
        } else if (nomEntite == 4) {
            flyMap(-5.23295, 6.84131, 7);
            d_export = [1, 'DISTRICT AUTONOME DE YAMOUSSOUKRO'];
        } else if (nomEntite == 5) {
            flyMap(-5.71085, 5.97882, 7);
            d_export = [1, 'GOH-DJIBOUA'];
        } else if (nomEntite == 6) {
            flyMap(-4.55179, 7.11393, 7);
            d_export = [1, 'LACS'];
        } else if (nomEntite == 7) {
            flyMap(-7.76055, 6.81789, 7);
            d_export = [1, 'MONTAGNES'];
        } else if (nomEntite == 8) {
            flyMap(-6.26151, 7.11491, 7);
            d_export = [1, 'SASSANDRA-MARAHOUE'];
        } else if (nomEntite == 9) {
            flyMap(-5.72318, 9.74464, 7);
            d_export = [1, 'SAVANES'];
        } else if (nomEntite == 10) {
            flyMap(-4.85518, 8.29674, 7);
            d_export = [1, 'VALLEE DU BANDAMA'];
        } else if (nomEntite == 11) {
            flyMap(-6.81993, 8.44411, 7);
            d_export = [1, 'WOROBA'];
        } else if (nomEntite == 12) {
            flyMap(-3.33729, 8.71763, 7);
            d_export = [1, 'ZANZAN'];
        } else if (nomEntite == 13) {
            flyMap(-4.50054, 5.94614, 7);
            d_export = [1, 'LAGUNES'];
        } else if (nomEntite == 14) {
            flyMap(-3.23515, 5.35694, 7);
            d_export = [1, 'COMOE'];
        } else {
            optserach == false;
            flyMap(-5.89192, 7.41331, 5.5);
            d_export = null;
        }

        if (lock_id != null) {
            map.setFeatureState({ source: 'districts', id: lock_id }, { hover: false });
        }
        lock_id = nomEntite;
        map.setFeatureState({ source: 'districts', id: lock_id }, { hover: true });

        optserach = true;

        reponse = await fetch('../dataFiles/geojson/ci_limite_distrricts.geojson');
        myGeoData = await reponse.json();
        for (var i = 0; i < myGeoData['features'].length; i++) {
            console.log(myGeoData['features'][i]['id']);
            if (myGeoData['features'][i]['id'] == lock_id) {
                document.getElementById('stat_dist').innerHTML = '<small>DISTRICT: <b class="text-primary">' + myGeoData['features'][i]['properties'].admin1Name + ' </b></small>'

                p_click = true;

                document.getElementById('statd').className = "d-block";
                document.getElementById('stats').className = "d-none";

                chartDog.destroy();
                chartDin.destroy();
                const nbo2G = myGeoData['features'][i]['properties'].nbcouv2gOr;
                const nbo3G = myGeoData['features'][i]['properties'].nbcouv3gOr;
                const nbo4G = myGeoData['features'][i]['properties'].nbcouv4gOr;
                const nbmt2G = myGeoData['features'][i]['properties'].nbcouv2gMtn;
                const nbmt3G = myGeoData['features'][i]['properties'].nbcouv3gMtn;
                const nbmt4G = myGeoData['features'][i]['properties'].nbcouv4gMtn;
                const nbmo2G = myGeoData['features'][i]['properties'].nbcouv2gMoov;
                const nbmo3G = myGeoData['features'][i]['properties'].nbcouv3gMoov;
                const nbmo4G = myGeoData['features'][i]['properties'].nbcouv4gMoov;
                const o2G = myGeoData['features'][i]['properties'].popOrange2G;
                const o3G = myGeoData['features'][i]['properties'].popOrange3G;
                const o4G = myGeoData['features'][i]['properties'].popOrange4G;
                const mt2G = myGeoData['features'][i]['properties'].popMtn2G;
                const mt3G = myGeoData['features'][i]['properties'].popMtn3G;
                const mt4G = myGeoData['features'][i]['properties'].popMtn4G;
                const mo2G = myGeoData['features'][i]['properties'].popMoov2G;
                const mo3G = myGeoData['features'][i]['properties'].popMoov3G;
                const mo4G = myGeoData['features'][i]['properties'].popMoov4G;
                const populat_c = myGeoData['features'][i]['properties'].popcouv;
                const popu = myGeoData['features'][i]['properties'].population;
                const loc_c = myGeoData['features'][i]['properties'].nbcouvloc;
                const nb_loc = myGeoData['features'][i]['properties'].nbloc;
                const txcloc = myGeoData['features'][i]['properties'].txcouvloc;
                const txcpop = myGeoData['features'][i]['properties'].txpopcouv;

                document.getElementById('nb_locs').innerHTML = '<small>Nombre : <b class="text-primary">' + loc_c + '/' + nb_loc + ' => ' + txcloc.toFixed(2) + '%</b></small>'
                document.getElementById('nb_pops').innerHTML = '<small>Effectif: <b class="text-primary">' + populat_c + '/' + popu + ' => ' + txcpop.toFixed(2) + '%</b></small>'

                chartDog = new Chart("myChart", {
                    type: 'bar',
                    data: {
                        labels: ["2G", "3G", "4G",],
                        datasets: [{
                            label: 'Orange',
                            backgroundColor: 'orange',
                            data: [
                                nbo2G,
                                nbo3G,
                                nbo4G,
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
                                nbmt2G,
                                nbmt3G,
                                nbmt4G,
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
                                nbmo2G,
                                nbmo3G,
                                nbmo4G,
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
                            text: "Localités couvertes par technologie",
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    boxWidth: 10,
                                    fontSize: 6
                                },
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context, index) {
                                        return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / nb_loc).toFixed(2) + '%';
                                    }
                                }
                            },
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

                chartDin = new Chart("netData", {
                    type: 'bar',
                    data: {
                        labels: ["2G", "3G", "4G",],
                        datasets: [{
                            label: 'Orange',
                            backgroundColor: 'orange',
                            data: [
                                o2G,
                                o3G,
                                o4G,
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
                                mt2G,
                                mt3G,
                                mt4G,
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
                                mo2G,
                                mo3G,
                                mo4G,
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
                            text: "Population couverte par technologie",
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    boxWidth: 10,
                                    fontSize: 6
                                },
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context, index) {
                                        return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / popu).toFixed(2) + '%';
                                    }
                                }
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    display: true,
                                    font: {
                                        size: 8
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
            }
        }
    }
    else if (entite.value == 2) {
        if (nomEntite == 1) {
            flyMap(-4.55783, 5.95810, 8.5);
            d_export = [2, 'AGNEBY-TIASSA'];
        } else if (nomEntite == 2) {
            flyMap(-7.60506, 8.36806, 8.5);
            d_export = [2, 'BAFING'];
        } else if (nomEntite == 3) {
            flyMap(-6.39656, 10.05434, 8.5);
            d_export = [2, 'BAGOUE'];
        } else if (nomEntite == 4) {
            flyMap(-4.96834, 6.81628, 8);
            d_export = [2, 'BELIER'];
        } else if (nomEntite == 5) {
            flyMap(-5.99007, 8.29740, 8);
            d_export = [2, 'BERE'];
        } else if (nomEntite == 6) {
            flyMap(-3.24348, 9.17696, 8);
            d_export = [2, 'BOUNKANI'];
        } else if (nomEntite == 7) {
            flyMap(-7.83028, 6.41795, 8);
            d_export = [2, 'CAVALLY'];
        } else if (nomEntite == 8) {
            flyMap(-4.05098, 5.39620, 8);
            d_export = [2, "DISTICT AUTONOME D'ABIDJAN"];
        } else if (nomEntite == 9) {
            flyMap(-5.23201, 6.84355, 8);
            d_export = [2, 'DISTICT AUTONOME DE YAMOUSSOUKRO'];
        } else if (nomEntite == 10) {
            flyMap(-7.65999, 10.26521, 8);
            d_export = [2, 'FOLON'];
        } else if (nomEntite == 11) {
            flyMap(-5.13186, 7.70873, 8);
            d_export = [2, 'GBEKE'];
        } else if (nomEntite == 12) {
            flyMap(-6.04500, 5.30322, 8);
            d_export = [2, 'GBOKLE'];
        } else if (nomEntite == 13) {
            flyMap(-5.79781, 6.20501, 8);
            d_export = [2, 'GOH'];
        } else if (nomEntite == 14) {
            flyMap(-3.11165, 8.37893, 8);
            d_export = [2, 'GONTOUGO'];
        } else if (nomEntite == 15) {
            flyMap(-4.8035, 5.28134, 8);
            d_export = [2, 'GRANDS-PONTS'];
        } else if (nomEntite == 16) {
            flyMap(-7.29744, 7.03985, 8);
            d_export = [2, 'GUEMON'];
        } else if (nomEntite == 17) {
            flyMap(-4.75410, 8.49847, 8);
            d_export = [2, 'HAMBOL'];
        } else if (nomEntite == 18) {
            flyMap(-6.64375, 7.07256, 8);
            d_export = [2, 'HAUT-SASSANDRA'];
        } else if (nomEntite == 19) {
            flyMap(-4.04549, 7.58470, 8);
            d_export = [2, 'IFFOU'];
        } else if (nomEntite == 20) {
            flyMap(-3.45772, 6.78355, 8);
            d_export = [2, 'INDENIE-DJUABLIN'];
        } else if (nomEntite == 21) {
            flyMap(-7.50879, 9.48093, 8);
            d_export = [2, 'KABADOUGOU'];
        } else if (nomEntite == 22) {
            flyMap(-5.46694, 5.66291, 8);
            d_export = [2, 'LOH-DJIBOUA'];
        } else if (nomEntite == 23) {
            flyMap(-5.77456, 7.00595, 8);
            d_export = [2, 'MARAHOUE'];
        } else if (nomEntite == 24) {
            flyMap(-3.86294, 6.08913, 8);
            d_export = [2, 'LA ME'];
        } else if (nomEntite == 25) {
            flyMap(-6.68643, 5.95802, 8);
            d_export = [2, 'NAWA'];
        } else if (nomEntite == 26) {
            flyMap(-6.04922, 9.54975, 8);
            d_export = [2, 'PORO'];
        } else if (nomEntite == 28) {
            flyMap(-3.21475, 5.41141, 8);
            d_export = [2, 'SUD-COMOE'];
        } else if (nomEntite == 29) {
            flyMap(-4.78579, 9.50641, 8);
            d_export = [2, 'TCHOLOGO'];
        } else if (nomEntite == 30) {
            flyMap(-7.76309, 7.35475, 8);
            d_export = [2, 'TONKPI'];
        } else if (nomEntite == 31) {
            flyMap(-6.55459, 8.42121, 8);
            d_export = [2, "WORODOUGOU"];
        } else if (nomEntite == 32) {
            flyMap(-4.63198, 6.97324, 8);
            d_export = [2, "N'ZI"];
        } else if (nomEntite == 33) {
            flyMap(-4.31338, 6.70053, 8);
            d_export = [2, 'MORONOU'];
        } else {
            optserach == false;
            flyMap(-5.89192, 7.41331, 5.5);
            d_export = null;
        }

        if (r_lock != null) {
            map.setFeatureState({ source: 'regions', id: r_lock }, { hover: false });
        }

        r_lock = nomEntite;
        map.setFeatureState({ source: 'regions', id: r_lock }, { hover: true });
        optserach = true;


        reponse = await fetch('../dataFiles/geojson/ci_limites_regions.geojson');
        myGeoData = await reponse.json();
        for (var i = 0; i < myGeoData['features'].length; i++) {
            console.log(myGeoData['features'][i]['id']);
            if (myGeoData['features'][i]['id'] == r_lock) {
                document.getElementById('stat_dist').innerHTML = '<small>REGION: <b class="text-primary">' + myGeoData['features'][i]['properties'].admin2Name + ' </b></small>'

                p_click = true;

                document.getElementById('statd').className = "d-block";
                document.getElementById('stats').className = "d-none";

                chartDog.destroy();
                chartDin.destroy();
                const nbo2G = myGeoData['features'][i]['properties'].nbcouv2gOr;
                const nbo3G = myGeoData['features'][i]['properties'].nbcouv3gOr;
                const nbo4G = myGeoData['features'][i]['properties'].nbcouv4gOr;
                const nbmt2G = myGeoData['features'][i]['properties'].nbcouv2gMtn;
                const nbmt3G = myGeoData['features'][i]['properties'].nbcouv3gMtn;
                const nbmt4G = myGeoData['features'][i]['properties'].nbcouv4gMtn;
                const nbmo2G = myGeoData['features'][i]['properties'].nbcouv2gMoov;
                const nbmo3G = myGeoData['features'][i]['properties'].nbcouv3gMoov;
                const nbmo4G = myGeoData['features'][i]['properties'].nbcouv4gMoov;
                const o2G = myGeoData['features'][i]['properties'].popOrange2G;
                const o3G = myGeoData['features'][i]['properties'].popOrange3G;
                const o4G = myGeoData['features'][i]['properties'].popOrange4G;
                const mt2G = myGeoData['features'][i]['properties'].popMtn2G;
                const mt3G = myGeoData['features'][i]['properties'].popMtn3G;
                const mt4G = myGeoData['features'][i]['properties'].popMtn4G;
                const mo2G = myGeoData['features'][i]['properties'].popMoov2G;
                const mo3G = myGeoData['features'][i]['properties'].popMoov3G;
                const mo4G = myGeoData['features'][i]['properties'].popMoov4G;
                const populat_c = myGeoData['features'][i]['properties'].popcouv;
                const popu = myGeoData['features'][i]['properties'].population;
                const loc_c = myGeoData['features'][i]['properties'].nbcouvloc;
                const nb_loc = myGeoData['features'][i]['properties'].nbloc;
                const txcloc = myGeoData['features'][i]['properties'].txcouvloc;
                const txcpop = myGeoData['features'][i]['properties'].txpopcouv;

                document.getElementById('nb_locs').innerHTML = '<small>Nombre : <b class="text-primary">' + loc_c + '/' + nb_loc + ' => ' + txcloc.toFixed(2) + '%</b></small>'
                document.getElementById('nb_pops').innerHTML = '<small>Effectif: <b class="text-primary">' + populat_c + '/' + popu + ' => ' + txcpop.toFixed(2) + '%</b></small>'

                chartDog = new Chart("myChart", {
                    type: 'bar',
                    data: {
                        labels: ["2G", "3G", "4G",],
                        datasets: [{
                            label: 'Orange',
                            backgroundColor: 'orange',
                            data: [
                                nbo2G,
                                nbo3G,
                                nbo4G,
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
                                nbmt2G,
                                nbmt3G,
                                nbmt4G,
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
                                nbmo2G,
                                nbmo3G,
                                nbmo4G,
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
                            text: "Population couverte par technologie",
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

                chartDin = new Chart("netData", {
                    type: 'bar',
                    data: {
                        labels: ["2G", "3G", "4G",],
                        datasets: [{
                            label: 'Orange',
                            backgroundColor: 'orange',
                            data: [
                                o2G,
                                o3G,
                                o4G,
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
                                mt2G,
                                mt3G,
                                mt4G,
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
                                mo2G,
                                mo3G,
                                mo4G,
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
                            text: "Population couverte par technologie",
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
                                        size: 8
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
            }
        }


    }
    else if (entite.value == 3) {

        if (dep[nomEntite] != null) {

            flyMap(dep[nomEntite].lg, dep[nomEntite].lt, 10);
            d_export = [3, dep[nomEntite].sp];

            //     fetch('dataFiles/geojson/ci_limites_departements.geojson')
            //         .then(function (response) {
            //             return response.json();
            //         })
            //         .then(function (data) {
            //             for (var i = 0; i < data['features'].length; i++) {

            //                 if (data['features'][i]['properties'].ADM3_FR == nomEntite.options[nomEntite.selectedIndex].text) {
            //                     flyMap(data['features'][i]['geometry']['coordinates'][0][0][0], // -3.4404
            //                         data['features'][i]['geometry']['coordinates'][0][0][1],  //6.73439
            //                         10);
            //                 }

            //             }
            //         });
            //     // flyMap(-3.7008, // -3.4404
            //     //        6.7797,  //6.73439
            //     //      10);
            //     d_export = [3, nomEntite.options[nomEntite.selectedIndex].text];

            document.getElementById('statd').className = "d-none";
            document.getElementById('stats').className = "d-block";

        }
        else {

            optserach == false;
            flyMap(-5.89192, 7.41331, 5.5);
            d_export = null;
        }


        if (de_lock != null) {
            map.setFeatureState({ source: 'departements', id: de_lock }, { hover: false });
        }

        de_lock = nomEntite;
        map.setFeatureState({ source: 'departements', id: de_lock }, { hover: true });
        optserach = true;
    }
    else if (entite.value == 4) {

        console.log("LOCALITE SELECTIONNEES ===>", localite)
        console.log("LOCALITE SELECTIONNEES ===>", nomEntite)
        console.log("LOCALITE SELECTIONNEES ===>", localite[nomEntite])
        // Localité
        flyMap(localite[nomEntite].lg, localite[nomEntite].lt, 12);
        d_export = [4, dwdData[nomEntite].loc];

        // flyMap(-8.48714, 6.61499, 12);
        // d_export = [3, "TOYEBLI"];


        if (marker == null && localite[nomEntite].lg != 0 && localite[nomEntite].lt != 0) {
            marker = new mapboxgl.Marker().setLngLat([localite[nomEntite].lg, localite[nomEntite].lt]).addTo(map);
        } else if (marker == null && (localite[nomEntite].lg == 0 || localite[nomEntite].lt == 0)) {
            marker = null;
        } else {
            marker.remove();
            marker = new mapboxgl.Marker().setLngLat([localite[nomEntite].lg, localite[nomEntite].lt]).addTo(map);
        }
        document.getElementById('statd').className = "d-none";
        document.getElementById('stats').className = "d-block";
    } else if (entite.value == 5) {
        optserach == false;
        flyMap(-5.89192, 7.41331, 5.5);
        d_export = null;
        document.getElementById('statd').className = "d-none";
        document.getElementById('stats').className = "d-block";
    }
    else { }
}

function flyMap(lng, lat, zoom) {
    map.flyTo({
        center: [
            lng, lat,
        ],
        zoom: zoom,
        speed: 0.8,
        curve: 1,
        essential: true,
    });
}

function addDataChart(chart, data) {
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
}

function removeDataChart(chart) {
    chart.data.datasets.forEach((dataset) => {
        dataset.data.pop();
    });
    chart.update();
}

function resetMap() {
    map.setPitch(0);
    map.setBearing(0);
    if (d_lock != null) {
        map.setFeatureState({ source: 'districts', id: d_lock }, { hover: false });
    }
    if (r_lock != null) {
        map.setFeatureState({ source: 'regions', id: r_lock }, { hover: false });
    }
    d_lock = null;
    r_lock = null;
    d_click = false;
    r_click = false;
    d_export = null;
    flyMap(-5.891926847184704, 7.41331470697536, 6.1);

    document.getElementById('statd').className = "d-none";
    document.getElementById('stats').className = "d-block";
    p_click = false;

}


setTimeout(() => {
    new Chart("popChart", {
        type: "doughnut",
        data: {
            labels: ["Orange", "Mtn", "Moov",],
            datasets: [{
                backgroundColor: ["orange", "yellow", "blue"],
                data: [nbcouvOr, nbcouvMt, nbcouvMo]
            }]
        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 10,
                        fontSize: 6
                    },
                    position: 'bottom'
                },
            },
        }
    });

    new Chart('genChart', {
        type: 'bar',
        data: {
            labels: ["2G", "3G", "4G",],
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
                text: "Localités couvertes par technologie",
            },
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 10,
                        fontSize: 6
                    },
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function (context, index) {
                            console.log('element======>  ', context)
                            return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / nbLoc).toFixed(2) + '%';
                        }
                    }
                },
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
            labels: ["2G", "3G", "4G",],
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
                text: "Populations couverte par technologie",
            },
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 10,
                        fontSize: 14
                    },
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function (context, index) {
                            console.log('element======>  ', context)
                            return context.dataset.label + ': ' + context.dataset.data[context.dataIndex] + ' => ' + (context.dataset.data[context.dataIndex] * 100 / pops).toFixed(2) + '%';
                        }
                    }
                },
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


    function getDistrictDataForGraph(type) {
        if (type == 1) {

        }
        else {

        }
    }



}, 2000);