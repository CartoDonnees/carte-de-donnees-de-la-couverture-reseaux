var mapBoxToken = "pk.eyJ1Ijoic3RlcGhhbmVkZWJveXNzb24iLCJhIjoiY2lvN3A1eGQ4MDA3M3Z5a3AzNzQzMmJsZCJ9.u_6ia9oYkGwdRpjQ1R8_qg";

var vectorStr = "vector";
var fillOutlineColorDefault = "rgba(255, 255, 255, 0)";
var fillStr = "fill";
var qualitesColDefault = "niveau";
var qualitesDefault = ['CL', 'BC', 'TBC'];
var itineranceColDefault = "operateur";
var itineranceDefault = ['20801', '20815'];
var monoColorDefault = "#e36565";
var multipleColorsDefault = ['#efa7a7', '#e36565', '#d82424'];
var opacityMonoColorDefault = 0.5;
var opactiyMultipleColorsDefault = 0.7;

function creerSource(id, type, url){
    var source = {};
    source.id = id;
    source.type = type;
    source.url = url;
    return source;
}

function creerCompositeSources(id, sources) {
  var source = {};
  source.id = id;
  source.type = "composite";
  source.sources = sources;
  return source;
}

function creerLayerCouverture(id, type, source, sourceLayer, fillColor, qualitesCol, qualites, fillOpacity, fillOutlineColor){
    if(qualitesCol === undefined) qualitesCol = qualitesColDefault;
    if(qualites === undefined) qualites = qualitesDefault;
    if(fillOpacity === undefined) fillOpacity = (fillColor.constructor === Array)?opactiyMultipleColorsDefault:opacityMonoColorDefault;
    if(fillOutlineColor === undefined) fillOutlineColor = fillOutlineColorDefault;
    var layer = {};
    layer.id = id;
    layer.type = type;
    layer.source = source;
    layer.sourceLayer = sourceLayer;
    layer.paint = {};
    if (fillColor.constructor === Array){
        layer.paint.fillColor = ['match',['get', qualitesCol]];
        for(var i=0;i<3;i++){
             layer.paint.fillColor.push(qualites[i]);
             layer.paint.fillColor.push(fillColor[i]);
        }
        layer.paint.fillColor.push('white');
    } else {
        layer.paint.fillColor = fillColor;
    }
    layer.paint.fillOpacity = fillOpacity;
    layer.paint.fillOutlineColor = fillOutlineColor;
    return layer;
}

function creerLayerCouvertureItinerance(id, type, source, sourceLayer, fillColor, itineranceCol, itinerance, fillOpacity, fillOutlineColor){
    if(fillOutlineColor === undefined) fillOutlineColor = fillOutlineColorDefault;
    var layer = {};
    layer.id = id;
    layer.type = type;
    layer.source = source;
    layer.sourceLayer = sourceLayer;
    layer.paint = {};
    if(fillColor.constructor === Array){
        layer.paint.fillColor = ['match',['get', itineranceCol]];
        for(var i=0;i<2;i++){
             layer.paint.fillColor.push(itinerance[i]);
             layer.paint.fillColor.push(fillColor[i]);
        }
        layer.paint.fillColor.push('white');
    } else {
        layer.paint.fillColor = fillColor;
    }
    layer.paint.fillOpacity = fillOpacity;
    layer.paint.fillOutlineColor = fillOutlineColor;
    return layer;
}

function creerLayer(id, source, sourceLayer, typeBilan){
    var layer = {};
    layer.id = id;
    layer.source = source;
    layer.sourceLayer = sourceLayer;
    layer.typeBilan = typeBilan;
	  layer.layout = {"icon-allow-overlap": false}
    return layer;
}

function buildHashTable(map, obj, index) {
    map[obj.id] = index;
    return map;
}

var mbData = {
    "sources": [
        //STB
        /*creerSource("2G_Orange_stb", vectorStr, "mapbox://stephanedeboysson.44l3bowe"),
        creerCompositeSources("2G_stb", ["2G_Orange_stb"]),*/

        creerSource("stb_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.azlddahc"),
        creerSource("stb_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.6icfnnhp"),
        creerSource("stb_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.b6iktt9e"),
        creerSource("stb_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.4krvgyr2"),
        creerSource("stb_sites", vectorStr, "mapbox://stephanedeboysson.8zl8dp25"),
        creerSource("2G_Digicel_stb", vectorStr, "mapbox://stephanedeboysson.6z6c5sk4"),
        creerSource("2G3G_Digicel_stb",vectorStr,"mapbox://stephanedeboysson.7547s7kk"),
        creerSource("3G_Digicel_stb", vectorStr, "mapbox://stephanedeboysson.4t3illpw"),
		creerSource("4G_Digicel_stb", vectorStr, "mapbox://stephanedeboysson.4kh1srn6"),
        creerSource("2G_Orange_stb", vectorStr, "mapbox://stephanedeboysson.144pec3y"),
        creerSource("2G3G_Orange_stb",vectorStr,"mapbox://stephanedeboysson.dkgy7hht"),
        creerSource("3G_Orange_stb", vectorStr, "mapbox://stephanedeboysson.a3clhyo0"),
        creerSource("4G_Orange_stb", vectorStr, "mapbox://stephanedeboysson.abb8zpdl"),
        //creerSource("2G_DT_stb", vectorStr, "mapbox://stephanedeboysson.0c0sz6z9"), **pas de carte 2G au T4 2020
        creerSource("2G3G_DT_stb", vectorStr, "mapbox://stephanedeboysson.4efqs3ha"),
        creerSource("3G_DT_stb", vectorStr, "mapbox://stephanedeboysson.dff33f32"),
        creerSource("4G_DT_stb", vectorStr, "mapbox://stephanedeboysson.8hv7l92v"),
        creerCompositeSources("2G_stb", ["2G_Digicel_stb", "2G_Orange_stb"/*, "2G_DT_stb"*/]),
        creerCompositeSources("2G3G_stb", ["2G3G_Digicel_stb", "2G3G_Orange_stb", "2G3G_DT_stb"]),
        creerCompositeSources("3G_stb", ["3G_Digicel_stb", "3G_Orange_stb", "3G_DT_stb"]),
        creerCompositeSources("4G_stb", ["4G_Digicel_stb", "4G_Orange_stb", "4G_DT_stb"]),
        //STM
        /*creerSource("4G_Digicel_stm", vectorStr, "mapbox://stephanedeboysson.02gaqqzx"),
        creerCompositeSources("4G_stm", ["4G_Digicel_stm"]),*/
        creerSource("stm_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.a29ofs6g"),
        creerSource("stm_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.3ltwbg1l"),
        creerSource("stm_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.9ve24esx"),
        creerSource("stm_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.2qynovgc"),
       //creerSource("stm_sites", vectorStr, "mapbox://stephanedeboysson.dtad9ota"), 
        creerSource("stm_sites", vectorStr, "mapbox://stephanedeboysson.0oi8olbo"),
        creerSource("2G_Digicel_stm", vectorStr, "mapbox://stephanedeboysson.0s6jsih9"),
        creerSource("2G3G_Digicel_stm", vectorStr, "mapbox://stephanedeboysson.5c3ej2ms"),
        creerSource("3G_Digicel_stm", vectorStr, "mapbox://stephanedeboysson.89021t2i"),
		creerSource("4G_Digicel_stm", vectorStr, "mapbox://stephanedeboysson.bb1f8r92"),
        creerSource("2G_Orange_stm", vectorStr, "mapbox://stephanedeboysson.bk1bd68f"),
        creerSource("2G3G_Orange_stm", vectorStr, "mapbox://stephanedeboysson.48k7pcby"),
        creerSource("3G_Orange_stm", vectorStr, "mapbox://stephanedeboysson.68nyae66"),
        creerSource("4G_Orange_stm", vectorStr, "mapbox://stephanedeboysson.2vqnivbb"),
        //creerSource("2G_DT_stm", vectorStr, "mapbox://stephanedeboysson.3i8ok0aq"), **Dauphin a éteint la 2G au T3 2020
        //en théorie, il faudrait ici la carte 2G3G voix de Dauphin (qui correspondrait à une carte 3G voix en pratique)
        creerSource("2G3G_DT_stm", vectorStr, "mapbox://stephanedeboysson.7o7biqj1"),
        creerSource("3G_DT_stm", vectorStr, "mapbox://stephanedeboysson.albrmmmg"),
        creerSource("4G_DT_stm", vectorStr, "mapbox://stephanedeboysson.bk0erf4d"),
        creerSource("2G3G_UTS_stm", vectorStr, "mapbox://stephanedeboysson.cka2z3vg"),
        creerSource("3G_UTS_stm", vectorStr, "mapbox://stephanedeboysson.33t9f5pw"), 
        creerCompositeSources("2G_stm", ["2G_Digicel_stm", "2G_Orange_stm"]),
        creerCompositeSources("2G3G_stm", ["2G3G_Digicel_stm", "2G3G_Orange_stm", "2G3G_DT_stm"]),
        creerCompositeSources("3G_stm", ["3G_Digicel_stm", "3G_Orange_stm", "3G_DT_stm", "3G_UTS_stm"]),
        //creerCompositeSources("3G_stm", ["3G_Digicel_stm", "3G_Orange_stm", "3G_DT_stm"]),
        creerCompositeSources("4G_stm", ["4G_Digicel_stm", "4G_Orange_stm", "4G_DT_stm"]),
        
        
        // guadeloupe
        creerSource("guadeloupe_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.7j3afx4y"),
        creerSource("guadeloupe_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.2qztnwro"),
        
        //version en ligne
        //creerSource("guadeloupe_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.1icvyotu"),
        //creerSource("guadeloupe_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.3dusii74"),
        
        // version OK NOK succes 3G succès 4G
        //creerSource("guadeloupe_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.bqhk67ml"),
        
        //version 0 et 1 "numeric"
        creerSource("guadeloupe_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.aahkn6vl"),
        creerSource("guadeloupe_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.ap2islhu"),
        creerSource("guadeloupe_sites", vectorStr, "mapbox://stephanedeboysson.19g32jy4"),
        creerSource("2G_Digicel_guadeloupe", vectorStr, "mapbox://stephanedeboysson.6y5iwowu"),
        creerSource("2G3G_Digicel_guadeloupe", vectorStr,"mapbox://stephanedeboysson.5s3koppx"),
        creerSource("3G_Digicel_guadeloupe", vectorStr, "mapbox://stephanedeboysson.74wfino6"),
		creerSource("4G_Digicel_guadeloupe", vectorStr, "mapbox://stephanedeboysson.1o26x7mi"),
        creerSource("2G_Orange_guadeloupe", vectorStr, "mapbox://stephanedeboysson.8gjgepk3"),
        creerSource("2G3G_Orange_guadeloupe", vectorStr, "mapbox://stephanedeboysson.bcorix0i"),
        creerSource("3G_Orange_guadeloupe", vectorStr, "mapbox://stephanedeboysson.2knaaerl"),
        creerSource("4G_Orange_guadeloupe", vectorStr, "mapbox://stephanedeboysson.57gujiij"),
        creerSource("2G_OMT_guadeloupe", vectorStr, "mapbox://stephanedeboysson.d8r0di21"),
        creerSource("2G3G_OMT_guadeloupe", vectorStr, "mapbox://stephanedeboysson.4prok4n7"),
        creerSource("3G_OMT_guadeloupe", vectorStr, "mapbox://stephanedeboysson.3rrvnrsb"),
        creerSource("4G_OMT_guadeloupe", vectorStr, "mapbox://stephanedeboysson.ci03ccd6"),
        creerCompositeSources("2G_guadeloupe", ["2G_Digicel_guadeloupe", "2G_Orange_guadeloupe", "2G_OMT_guadeloupe"]),
        creerCompositeSources("2G3G_guadeloupe", ["2G3G_Digicel_guadeloupe", "2G3G_Orange_guadeloupe", "2G3G_OMT_guadeloupe"]),
        creerCompositeSources("3G_guadeloupe", ["3G_Digicel_guadeloupe", "3G_Orange_guadeloupe", "3G_OMT_guadeloupe"]),
        creerCompositeSources("4G_guadeloupe", ["4G_Digicel_guadeloupe", "4G_Orange_guadeloupe", "4G_OMT_guadeloupe"]),
        
        
        // Guyane
        creerSource("guyane_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.1k7r80z2"),
        creerSource("guyane_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.aikv59rp"),
        creerSource("guyane_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.cqu63f58"),
        creerSource("guyane_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.7o1kk4nw"),
        //creerSource("guyane_sites", vectorStr, "mapbox://stephanedeboysson.01lnbevc"),
        creerSource("guyane_sites", vectorStr, "mapbox://stephanedeboysson.arh60v26"),
        creerSource("2G_Digicel_guyane", vectorStr, "mapbox://stephanedeboysson.5uw9x9zq"),
        creerSource("2G3G_Digicel_guyane", vectorStr, "mapbox://stephanedeboysson.7vzvcsko"),
        creerSource("3G_Digicel_guyane", vectorStr, "mapbox://stephanedeboysson.dlnp1jes"),
		creerSource("4G_Digicel_guyane", vectorStr, "mapbox://stephanedeboysson.0uj8afs1"),
        creerSource("2G_Orange_guyane", vectorStr, "mapbox://stephanedeboysson.8w2zkm66"),
        creerSource("2G3G_Orange_guyane", vectorStr, "mapbox://stephanedeboysson.8sbj8xp8"),
        creerSource("3G_Orange_guyane", vectorStr, "mapbox://stephanedeboysson.9iidmv8s"),
        creerSource("4G_Orange_guyane", vectorStr, "mapbox://stephanedeboysson.4hve1xw7"),
        creerSource("2G_OMT_guyane", vectorStr, "mapbox://stephanedeboysson.0wg11298"),
        creerSource("2G3G_OMT_guyane", vectorStr, "mapbox://stephanedeboysson.de9wa7o3"),
        creerSource("3G_OMT_guyane", vectorStr, "mapbox://stephanedeboysson.1nyw6z8p"),
        creerSource("4G_OMT_guyane", vectorStr, "mapbox://stephanedeboysson.81bubd6e"),
        creerCompositeSources("2G_guyane", ["2G_Digicel_guyane", "2G_Orange_guyane", "2G_OMT_guyane"]),
        creerCompositeSources("2G3G_guyane", ["2G3G_Digicel_guyane", "2G3G_Orange_guyane", "2G3G_OMT_guyane"]),
        creerCompositeSources("3G_guyane", ["3G_Digicel_guyane", "3G_Orange_guyane", "3G_OMT_guyane"]),
        creerCompositeSources("4G_guyane", ["4G_Digicel_guyane", "4G_Orange_guyane", "4G_OMT_guyane"]),
        
        
        // Martinique
        creerSource("martinique_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.5729f17p"),
        creerSource("martinique_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.72z1rzw4"),
        creerSource("martinique_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.d8dfhbse"),
        creerSource("martinique_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.58ik9zs5"),
        //creerSource("martinique_sites", vectorStr, "mapbox://stephanedeboysson.17xy1l63"),
        creerSource("martinique_sites", vectorStr, "mapbox://stephanedeboysson.b85q1oif"),
        creerSource("2G_Orange_martinique", vectorStr, "mapbox://stephanedeboysson.5lq15oj6"),
        creerSource("2G3G_Orange_martinique", vectorStr, "mapbox://stephanedeboysson.4mpp74vx"),
        creerSource("3G_Orange_martinique", vectorStr, "mapbox://stephanedeboysson.13qx2u3a"),
        creerSource("4G_Orange_martinique", vectorStr, "mapbox://stephanedeboysson.40w9ju6x"),
        creerSource("2G_Digicel_martinique", vectorStr, "mapbox://stephanedeboysson.610vkv24"),
        creerSource("2G3G_Digicel_martinique", vectorStr, "mapbox://stephanedeboysson.7f1x8l27"),
        creerSource("3G_Digicel_martinique", vectorStr, "mapbox://stephanedeboysson.1tjqljqm"),
		creerSource("4G_Digicel_martinique", vectorStr, "mapbox://stephanedeboysson.ac0aq7oi"),
        creerSource("2G_OMT_martinique", vectorStr, "mapbox://stephanedeboysson.6d4msmju"),
        creerSource("2G3G_OMT_martinique", vectorStr, "mapbox://stephanedeboysson.25vsc978"),
        creerSource("3G_OMT_martinique", vectorStr, "mapbox://stephanedeboysson.4xv1tz45"),
        creerSource("4G_OMT_martinique", vectorStr, "mapbox://stephanedeboysson.29tv4tjo"),
        creerCompositeSources("2G_martinique", ["2G_Orange_martinique", "2G_Digicel_martinique", "2G_OMT_martinique"]),
        creerCompositeSources("2G3G_martinique", ["2G3G_Orange_martinique", "2G3G_Digicel_martinique", "2G3G_OMT_martinique"]),
        creerCompositeSources("3G_martinique", ["3G_Orange_martinique", "3G_Digicel_martinique", "3G_OMT_martinique"]),
        creerCompositeSources("4G_martinique", ["4G_Orange_martinique", "4G_Digicel_martinique", "4G_OMT_martinique"]),
        
        
        // Mayotte
        creerSource("mayotte_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.7rhiacx6"),
        creerSource("mayotte_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.5sy26uk0"),
        creerSource("mayotte_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.688zglmw"),
        creerSource("mayotte_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.d2i0p02u"),
        creerSource("mayotte_sites", vectorStr, "mapbox://stephanedeboysson.cmq2flr8"),
        creerSource("2G_SRR_mayotte", vectorStr, "mapbox://stephanedeboysson.4n9py8in"),
        creerSource("2G3G_SRR_mayotte", vectorStr, "mapbox://stephanedeboysson.cdccttkm"),
        creerSource("3G_SRR_mayotte", vectorStr, "mapbox://stephanedeboysson.4hxjw6fs"),
        creerSource("4G_SRR_mayotte", vectorStr, "mapbox://stephanedeboysson.c68i4hvh"),
        creerSource("2G_BJT_mayotte", vectorStr, "mapbox://stephanedeboysson.djnjzl3k"),
        creerSource("2G3G_BJT_mayotte", vectorStr, "mapbox://stephanedeboysson.djnjzl3k"), // en pratique, identique à la carte 2G puisque Maore n'a pas de 3G
    	creerSource("4G_BJT_mayotte", vectorStr, "mapbox://stephanedeboysson.b8klsx05"),
        creerSource("2G_FM_mayotte", vectorStr, "mapbox://stephanedeboysson.9lv1cdsr"),
        creerSource("2G3G_FM_mayotte", vectorStr, "mapbox://stephanedeboysson.9dw1bndp"),
        creerSource("3G_FM_mayotte", vectorStr, "mapbox://stephanedeboysson.0pdu7wuq"),
        creerSource("4G_FM_mayotte", vectorStr, "mapbox://stephanedeboysson.6ho39gov"),
        creerSource("2G_Orange_mayotte", vectorStr, "mapbox://stephanedeboysson.41fn0bey"),
        creerSource("2G3G_Orange_mayotte", vectorStr, "mapbox://stephanedeboysson.4tkzawau"),
        creerSource("3G_Orange_mayotte", vectorStr, "mapbox://stephanedeboysson.2rsgmgnd"),
        creerSource("4G_Orange_mayotte", vectorStr, "mapbox://stephanedeboysson.94gm493z"),
        creerCompositeSources("2G_mayotte", ["2G_SRR_mayotte", "2G_BJT_mayotte", "2G_FM_mayotte", "2G_Orange_mayotte"]),
        creerCompositeSources("2G3G_mayotte", ["2G3G_SRR_mayotte", "2G3G_BJT_mayotte", "2G3G_FM_mayotte", "2G3G_Orange_mayotte"]),
        creerCompositeSources("3G_mayotte", ["3G_SRR_mayotte", "3G_FM_mayotte", "3G_Orange_mayotte"]), // Attention aujourd'hui il n'y a pas de couverture de Maore, qui n'a pas de 3G
        creerCompositeSources("4G_mayotte", ["4G_BJT_mayotte", "4G_SRR_mayotte","4G_FM_mayotte", "4G_Orange_mayotte"]),
        
        
        // La Réunion
        creerSource("la_reunion_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.8i6wxg7n"),
        creerSource("la_reunion_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.bsjex67k"),
        creerSource("la_reunion_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.7jk5yway"),
        creerSource("la_reunion_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.d38ien4i"),
        creerSource("la_reunion_sites", vectorStr, "mapbox://stephanedeboysson.ce3hxlse"),
        creerSource("2G_SRR_la_reunion", vectorStr, "mapbox://stephanedeboysson.93lzg7l4"),
        creerSource("2G3G_SRR_la_reunion", vectorStr, "mapbox://stephanedeboysson.0ls034tu"),
        creerSource("3G_SRR_la_reunion", vectorStr, "mapbox://stephanedeboysson.9oyk2a60"),
        creerSource("4G_SRR_la_reunion", vectorStr, "mapbox://stephanedeboysson.8y5e4ghj"),
        creerSource("2G_Orange_la_reunion", vectorStr, "mapbox://stephanedeboysson.5aymdd45"),
        creerSource("2G3G_Orange_la_reunion", vectorStr, "mapbox://stephanedeboysson.8k1vcrkt"),
        creerSource("3G_Orange_la_reunion", vectorStr, "mapbox://stephanedeboysson.4o0patxl"),
        creerSource("4G_Orange_la_reunion", vectorStr, "mapbox://stephanedeboysson.0fvvomrk"),
        creerSource("2G_FM_la_reunion", vectorStr, "mapbox://stephanedeboysson.0kyvw4vs"),
        creerSource("2G3G_FM_la_reunion", vectorStr, "mapbox://stephanedeboysson.cyhs0eky"),
        creerSource("3G_FM_la_reunion", vectorStr, "mapbox://stephanedeboysson.2q4wdk8y"),
        creerSource("4G_FM_la_reunion", vectorStr, "mapbox://stephanedeboysson.524tfvn2"),
        creerSource("2G_Zeop_la_reunion", vectorStr, "mapbox://stephanedeboysson.66hosbbl"),
        creerSource("2G3G_Zeop_la_reunion", vectorStr, "mapbox://stephanedeboysson.desj841o"),
        creerSource("3G_Zeop_la_reunion", vectorStr, "mapbox://stephanedeboysson.1rwzmq13"),
        creerSource("4G_Zeop_la_reunion", vectorStr, "mapbox://stephanedeboysson.ceuz9fej"),
        creerCompositeSources("2G_la_reunion", ["2G_SRR_la_reunion", "2G_Orange_la_reunion", "2G_FM_la_reunion", "2G_Zeop_la_reunion"]),
        creerCompositeSources("2G3G_la_reunion", ["2G3G_SRR_la_reunion", "2G3G_Orange_la_reunion", "2G3G_FM_la_reunion", "2G3G_Zeop_la_reunion"]),
        creerCompositeSources("3G_la_reunion", ["3G_SRR_la_reunion", "3G_Orange_la_reunion", "3G_FM_la_reunion", "3G_Zeop_la_reunion"]),
        creerCompositeSources("4G_la_reunion", ["4G_SRR_la_reunion", "4G_Orange_la_reunion", "4G_FM_la_reunion", "4G_Zeop_la_reunion"]),
        
        
        // Métropole
        creerSource("metropole_QoS_transports_data_arcep", vectorStr, "mapbox://stephanedeboysson.dzdc3oby"),
        creerSource("metropole_QoS_transports_voix_arcep", vectorStr, "mapbox://stephanedeboysson.80dyards"),
        creerSource("metropole_QoS_transports_data_sncf", vectorStr, "mapbox://stephanedeboysson.52uub4b1"),
        creerSource("metropole_QoS_agglos_data_aura", vectorStr, "mapbox://stephanedeboysson.3xci447m"),
        creerSource("metropole_QoS_agglos_data_aura_2", vectorStr, "mapbox://stephanedeboysson.8tohk1tz"),
        //creerSource("metropole_QoS_agglos_data_cher", vectorStr, "mapbox://stephanedeboysson.d0ze8w92"),
        //creerSource("metropole_QoS_agglos_data_hdfDebits", vectorStr, "mapbox://stephanedeboysson.chjmjma0"),
        //creerSource("metropole_QoS_agglos_data_pdl2019", vectorStr, "mapbox://stephanedeboysson.07un1e4p"),
        creerSource("metropole_QoS_agglos_data_pdl2020", vectorStr, "mapbox://stephanedeboysson.2ctyo9fy"),
        creerSource("metropole_QoS_agglos_data_pdl2020_2", vectorStr, "mapbox://stephanedeboysson.9ubsga50"),
        creerSource("metropole_QoS_agglos_data_arcep", vectorStr, "mapbox://stephanedeboysson.c1vgnu3p"),
        creerSource("metropole_QoS_agglos_voix_arcep", vectorStr, "mapbox://stephanedeboysson.c59doz6x"),
        creerSource("metropole_QoS_agglos_data_lieusaint", vectorStr, "mapbox://stephanedeboysson.29cyraao"),
        creerSource("metropole_QoS_agglos_data_cd43", vectorStr, "mapbox://stephanedeboysson.bspc5lhw"),
        creerSource("metropole_QoS_agglos_data_qosi", vectorStr, "mapbox://stephanedeboysson.879e36sg"),
        creerSource("metropole_QoS_agglos_data_bfc", vectorStr, "mapbox://stephanedeboysson.6af4i9pt"),
        //creerSource("metropole_sites", vectorStr, "mapbox://stephanedeboysson.117k2wdv"),
        creerSource("metropole_sites", vectorStr, "mapbox://stephanedeboysson.dwnin62c"),
        //creerSource("metropole_sites", vectorStr, "mapbox://stephanedeboysson.74uy0p7u"),
        //creerSource("metropole_sites", vectorStr, "mapbox://stephanedeboysson.3juwz2fk"),
        //creerSource("metropole_sites", vectorStr, "mapbox://stephanedeboysson.4q0f89q7"),
        creerSource("metropole_touristique_text", vectorStr, "mapbox://stephanedeboysson.72t84b62"),
        creerSource("2G_Bouygues", vectorStr, "mapbox://stephanedeboysson.dhy3moh5"),
        creerSource("2G_Free", vectorStr, "mapbox://stephanedeboysson.4yjxq68s"),
        creerSource("2G_Orange", vectorStr, "mapbox://stephanedeboysson.1doptq6j"),
        creerSource("2G_SFR", vectorStr, "mapbox://stephanedeboysson.cilqx4yl"),
        // AJOUT 2G3G TEST
        creerSource("2G3G_Bouygues", vectorStr, "mapbox://stephanedeboysson.0txzmqxn"),
        creerSource("2G3G_Free", vectorStr, "mapbox://stephanedeboysson.54tjo213"),
        creerSource("2G3G_Orange", vectorStr, "mapbox://stephanedeboysson.483iu67q"),
        creerSource("2G3G_SFR", vectorStr, "mapbox://stephanedeboysson.6fmynpr2"),
        // FIN TEST
        creerSource("3G_Bouygues", vectorStr, "mapbox://stephanedeboysson.9iyo6kie"),
        creerSource("3G_Free", vectorStr, "mapbox://stephanedeboysson.bnwar4k1"),
        creerSource("3G_Orange", vectorStr, "mapbox://stephanedeboysson.dxlu51ec"),
        creerSource("3G_SFR", vectorStr, "mapbox://stephanedeboysson.dsh8v7jw"),
        creerSource("4G_Bouygues", vectorStr, "mapbox://stephanedeboysson.bl9nzb9c"),
        creerSource("4G_Free", vectorStr, "mapbox://stephanedeboysson.7be8h5fz"),
        creerSource("4G_Orange", vectorStr, "mapbox://stephanedeboysson.4tit8e1r"),
        creerSource("4G_SFR", vectorStr, "mapbox://stephanedeboysson.5fsvx59h"),
        //creerSource("4G_Bouygues", vectorStr, "mapbox://stephanedeboysson.985b2pe5"),
        //creerSource("4G_Free", vectorStr, "mapbox://stephanedeboysson.aznh2stg"),
        //creerSource("4G_Orange", vectorStr, "mapbox://stephanedeboysson.7zcpjt0f"),
		//creerSource("4G_Orange_diff", vectorStr, "mapbox://stephanedeboysson.429nd7t3"),
        //creerSource("4G_SFR", vectorStr, "mapbox://stephanedeboysson.4akvz8qj"),
        creerCompositeSources("2G_metropole", ["2G_Bouygues", "2G_Free", "2G_Orange", "2G_SFR"]),
        // AJOUT 2G3G TEST
        creerCompositeSources("2G3G_metropole", ["2G3G_Bouygues", "2G3G_Free", "2G3G_Orange", "2G3G_SFR"]),
        //FIN TEST
        creerCompositeSources("3G_metropole", ["3G_Bouygues", "3G_Free", "3G_Orange", "3G_SFR"]),
        creerCompositeSources("4G_metropole", ["4G_Bouygues" ,"4G_Free", "4G_Orange", "4G_SFR"]),
    ],
    "layers": [
        // saint-barth
        creerLayer("stb_QoS_transports_voix_arcep", "stb_QoS_transports_voix_arcep", "STB_QoS_Voix_SMS_transports_virgule", "numeric"),
        creerLayer("stb_QoS_transports_data_arcep", "stb_QoS_transports_data_arcep", "STB_QoS_Data_transports_virgule", "numeric"),
        creerLayer("stb_QoS_agglos_voix_arcep", "stb_QoS_agglos_voix_arcep", "STB_QoS_Voix_SMS_agglos_virgule", "numeric"),
        creerLayer("stb_QoS_agglos_data_arcep", "stb_QoS_agglos_data_arcep", "STB_QoS_Data_AGGLOS_virgule", "numeric"),
        creerLayer("stb_sites", "stb_sites", "STB_sites_2021_T1-0xqcg3"),
        creerLayerCouverture("2G_Digicel_stb", fillStr, "2G_stb", "STB_DIGIC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Digicel_stb",fillStr,"2G3G_stb","STB_DIGIC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Digicel_stb", fillStr, "3G_stb", "STB_DIGIC_couv_3G_data_2020_T4", monoColorDefault),
		creerLayerCouverture("4G_Digicel_stb", fillStr, "4G_stb", "977_DIGIC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_stb", fillStr, "2G_stb", "STB_ORCA_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_stb", fillStr,"2G3G_stb", "STB_ORCA_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_stb", fillStr, "3G_stb", "STB_ORCA_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_stb", fillStr, "4G_stb", "977_ORCA_4G_data_2021T1", monoColorDefault),
        //creerLayerCouverture("2G_DT_stb", fillStr, "2G_stb", "STB_DAUPH_couv_2G_voix_2020_T2", multipleColorsDefault), **pas de données au T42 020
        creerLayerCouverture("2G3G_DT_stb",fillStr,"2G3G_stb", "STB_DAUPH_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_DT_stb", fillStr, "3G_stb", "STB_DAUPH_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_DT_stb", fillStr, "4G_stb", "977_DAUPH_4G_data_2021T1", monoColorDefault),
        //creerLayerCouverture("3G_UTS_stb", fillStr, "3G_stb", "STB_UTS_couv_3G_data_2019_T2", monoColorDefault), **UTS a rendu les fréquences donc normalement plus à afficher
       
       
        //STM
        creerLayer("stm_QoS_transports_voix_arcep", "stm_QoS_transports_voix_arcep", "STM_QoS_Voix_SMS_transports3_virgule", "numeric"),
        creerLayer("stm_QoS_transports_data_arcep", "stm_QoS_transports_data_arcep", "STM_QoS_Data_transports2_virgule", "numeric"),
        creerLayer("stm_QoS_agglos_voix_arcep", "stm_QoS_agglos_voix_arcep", "STM_QoS_voix_AGGLOS3_virgule", "numeric"),
        creerLayer("stm_QoS_agglos_data_arcep", "stm_QoS_agglos_data_arcep", "STM_QoS_Data_agglos2_virgule", "numeric"),
        //creerLayer("stm_sites", "STM_sites", "sites_STM-3iilnf"),
        creerLayer("stm_sites", "stm_sites", "STM_sites_2021_T1-33s33k"),
        creerLayerCouverture("2G_Digicel_stm", fillStr, "2G_stm", "STM_DIGIC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Digicel_stm", fillStr, "2G3G_stm", "STM_DIGIC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Digicel_stm", fillStr, "3G_stm", "STM_DIGIC_couv_3G_data_2020_T4", monoColorDefault),
		creerLayerCouverture("4G_Digicel_stm", fillStr, "4G_stm", "978_DIGIC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_stm", fillStr, "2G_stm", "STM_ORCA_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_stm", fillStr, "2G3G_stm","STM_ORCA_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_stm", fillStr, "3G_stm", "STM_ORCA_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_stm", fillStr, "4G_stm", "978_ORCA_4G_data_2021T1", monoColorDefault),
        //creerLayerCouverture("2G_DT_stm", fillStr, "2G_stm", "STM_DAUPH_couv_2G_voix_2020_T2", multipleColorsDefault), **eteint la 2G au T3 2020
        creerLayerCouverture("2G3G_DT_stm", fillStr, "2G3G_stm", "STM_DAUPH_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_DT_stm", fillStr, "3G_stm", "STM_DAUPH_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_DT_stm", fillStr, "4G_stm", "978_DAUPH_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G3G_UTS_stm", fillStr, "2G3G_stm", "STM_UTS_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_UTS_stm", fillStr, "3G_stm", "STM_UTS_couv_3G_data_2020_T4", monoColorDefault),
        
        
        // guadeloupe
        creerLayer("guadeloupe_QoS_transports_voix_arcep", "guadeloupe_QoS_transports_voix_arcep", "GUA_QoS_voix_SMS_transports_virgule", "numeric"),
        creerLayer("guadeloupe_QoS_transports_data_arcep", "guadeloupe_QoS_transports_data_arcep", "GUA_QoS_DATA_transports_virgule", "numeric"),
        
        //version en ligne
        //creerLayer("guadeloupe_QoS_agglos_voix_arcep", "guadeloupe_QoS_agglos_voix_arcep", "QoS_Guadeloupe_Agglos_voix-b5ez5h"),
        //creerLayer("guadeloupe_QoS_agglos_data_arcep", "guadeloupe_QoS_agglos_data_arcep", "QoS_Guadeloupe_Agglos_data-8weccw"),
        
        // version OK NOK succès 3G et 4G
        //creerLayer("guadeloupe_QoS_agglos_voix_arcep", "guadeloupe_QoS_agglos_voix_arcep", "QoS_Guadeloupe_Agglos_voix-b5ez5h"),
        //creerLayer("guadeloupe_QoS_agglos_data_arcep", "guadeloupe_QoS_agglos_data_arcep", "QoS_GUA_Agglos_data_4"),
        
        
        // version 0 et 1 numeric
        creerLayer("guadeloupe_QoS_agglos_voix_arcep", "guadeloupe_QoS_agglos_voix_arcep", "GUA_QoS_Voix_SMS_agglos_virgule", "numeric"),
        creerLayer("guadeloupe_QoS_agglos_data_arcep", "guadeloupe_QoS_agglos_data_arcep", "GUA_QoS_DATA_AGGLOS_virgule", "numeric"),

        //creerLayer("guadeloupe_sites", "guadeloupe_sites", "sites_Guadeloupe-3iilnf"),
        creerLayer("guadeloupe_sites", "guadeloupe_sites", "GUA_sites_2021_T1-cm59ka"),
        creerLayerCouverture("2G_Digicel_guadeloupe", fillStr, "2G_guadeloupe", "GUA_DIGIC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Digicel_guadeloupe",fillStr,"2G3G_guadeloupe", "GUA_DIGIC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Digicel_guadeloupe", fillStr, "3G_guadeloupe", "GUA_DIGIC_couv_3G_data_2020_T4", monoColorDefault),
		creerLayerCouverture("4G_Digicel_guadeloupe", fillStr, "4G_guadeloupe", "971_DIGIC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_guadeloupe", fillStr, "2G_guadeloupe", "GUA_ORCA_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_guadeloupe", fillStr, "2G3G_guadeloupe", "GUA_ORCA_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_guadeloupe", fillStr, "3G_guadeloupe", "GUA_ORCA_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_guadeloupe", fillStr, "4G_guadeloupe", "971_ORCA_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_OMT_guadeloupe", fillStr, "2G_guadeloupe", "GUA_OMT_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_OMT_guadeloupe", fillStr, "2G3G_guadeloupe", "GUA_OMT_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_OMT_guadeloupe", fillStr, "3G_guadeloupe", "GUA_OMT_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_OMT_guadeloupe", fillStr, "4G_guadeloupe", "971_OMT_4G_data_2021T1", monoColorDefault),
        
        
        // Guyane
        creerLayer("guyane_QoS_transports_voix_arcep", "guyane_QoS_transports_voix_arcep", "MRMGuyane_voixsms", "numeric"),
        creerLayer("guyane_QoS_transports_data_arcep", "guyane_QoS_transports_data_arcep", "GUY_QoS_Data_Transport_virgule", "numeric"),
        creerLayer("guyane_QoS_agglos_voix_arcep", "guyane_QoS_agglos_voix_arcep", "GUY_QoS_Voix_agglos_virgule", "numeric"),
        creerLayer("guyane_QoS_agglos_data_arcep", "guyane_QoS_agglos_data_arcep", "GUY_QoS_Data_AGGLOS_virgule", "numeric"),
        //creerLayer("guyane_sites", "guyane_sites", "sites_Guyane-ad8epo"),
        creerLayer("guyane_sites", "guyane_sites", "GUY_sites_2021_T1-6ck95j"),
        creerLayerCouverture("2G_Digicel_guyane", fillStr, "2G_guyane", "GUY_DIGIC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Digicel_guyane", fillStr, "2G3G_guyane", "GUY_DIGIC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Digicel_guyane", fillStr, "3G_guyane", "GUY_DIGIC_couv_3G_data_2020_T4", monoColorDefault),
		creerLayerCouverture("4G_Digicel_guyane", fillStr, "4G_guyane", "973_DIGIC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_guyane", fillStr, "2G_guyane", "GUY_ORCA_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_guyane", fillStr, "2G3G_guyane", "GUY_ORCA_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_guyane", fillStr, "3G_guyane", "GUY_ORCA_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_guyane", fillStr, "4G_guyane", "973_ORCA_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_OMT_guyane", fillStr, "2G_guyane", "GUY_OMT_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_OMT_guyane", fillStr, "2G3G_guyane", "GUY_OMT_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_OMT_guyane", fillStr, "3G_guyane", "GUY_OMT_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_OMT_guyane", fillStr, "4G_guyane", "973_OMT_4G_data_2021T1", monoColorDefault),
       
       
        // Martinique
        creerLayer("martinique_QoS_transports_voix_arcep", "martinique_QoS_transports_voix_arcep", "MAR_QoS_Voix_SMS_transports_virgule", "numeric"),
        creerLayer("martinique_QoS_transports_data_arcep", "martinique_QoS_transports_data_arcep", "MAR_QoS_Data_transports_virgule", "numeric"),
        creerLayer("martinique_QoS_agglos_voix_arcep", "martinique_QoS_agglos_voix_arcep", "MAR_QoS_Voix_SMS_agglos_-_VCL-2rxksw", "numeric"),
        creerLayer("martinique_QoS_agglos_data_arcep", "martinique_QoS_agglos_data_arcep", "MAR_QoS_Data_AGGLOS_virgule", "numeric"),
        //creerLayer("martinique_sites", "martinique_sites", "sites_Martinique-2psska"),
        creerLayer("martinique_sites", "martinique_sites", "MAR_sites_2021_T1-5qjcp4"),
        creerLayerCouverture("2G_Digicel_martinique", fillStr, "2G_martinique", "MAR_DIGIC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Digicel_martinique", fillStr, "2G3G_martinique", "MAR_DIGIC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Digicel_martinique", fillStr, "3G_martinique", "MAR_DIGIC_couv_3G_data_2020_T4", monoColorDefault),
		creerLayerCouverture("4G_Digicel_martinique", fillStr, "4G_martinique", "972_DIGIC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_martinique", fillStr, "2G_martinique", "MAR_ORCA_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_martinique", fillStr, "2G3G_martinique", "MAR_ORCA_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_martinique", fillStr, "3G_martinique", "MAR_ORCA_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_martinique", fillStr, "4G_martinique", "972_ORCA_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_OMT_martinique", fillStr, "2G_martinique", "MAR_OMT_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_OMT_martinique", fillStr, "2G3G_martinique", "MAR_OMT_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_OMT_martinique", fillStr, "3G_martinique", "MAR_OMT_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_OMT_martinique", fillStr, "4G_martinique", "972_OMT_4G_data_2021T1", monoColorDefault),
       
       
        // Mayotte
        creerLayer("mayotte_QoS_transports_voix_arcep", "mayotte_QoS_transports_voix_arcep", "MAY_QoS_Voix_Transports_virgule", "numeric"),
        creerLayer("mayotte_QoS_transports_data_arcep", "mayotte_QoS_transports_data_arcep", "MAY_QoS_Data_transports2_virgule", "numeric"),
        creerLayer("mayotte_QoS_agglos_voix_arcep", "mayotte_QoS_agglos_voix_arcep", "MAY_QoS_Voix_agglos_virgule", "numeric"),
        creerLayer("mayotte_QoS_agglos_data_arcep", "mayotte_QoS_agglos_data_arcep", "MAY_QoS_Data_agglos2_virgule", "numeric"),
        creerLayer("mayotte_sites", "mayotte_sites", "MAY_sites_2021_T1-8mt7bo"),
        //creerLayerCouverture("2G_BJT_mayotte", fillStr, "2G_mayotte", "MAY_BJTP_couv_2G_voix_2019_T4", multipleColorsDefault), **Maore Mobile n'a pas envoyé de carte T2 2020
        creerLayerCouverture("2G_BJT_mayotte", fillStr, "2G_mayotte", "MAY_MAOR_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_BJT_mayotte", fillStr, "2G3G_mayotte", "MAY_MAOR_couv_2G_voix_2020_T4", multipleColorsDefault), //comme Maore n'a pas de 3G, couv 2G3G = couv 2G
        creerLayerCouverture("4G_BJT_mayotte", fillStr, "4G_mayotte", "976_MAOR_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_SRR_mayotte", fillStr, "2G_mayotte", "MAY_SRR_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_SRR_mayotte", fillStr, "2G3G_mayotte", "MAY_SRR_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_SRR_mayotte", fillStr, "3G_mayotte", "MAY_SRR_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_SRR_mayotte", fillStr, "4G_mayotte", "976_SRR_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_FM_mayotte", fillStr, "2G_mayotte", "MAY_TELC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_FM_mayotte", fillStr, "2G3G_mayotte", "MAY_TELC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_FM_mayotte", fillStr, "3G_mayotte", "MAY_TELC_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_FM_mayotte", fillStr, "4G_mayotte", "976_TELC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_mayotte", fillStr, "2G_mayotte", "MAY_OF_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_mayotte", fillStr, "2G3G_mayotte", "MAY_OF_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_mayotte", fillStr, "3G_mayotte", "MAY_OF_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_mayotte", fillStr, "4G_mayotte", "976_OF_4G_data_2021T1", monoColorDefault),
        
        
        // La Réunion
        creerLayer("la_reunion_QoS_transports_voix_arcep", "la_reunion_QoS_transports_voix_arcep", "REU_QoS_Voix_transports_virgule", "numeric"),
        creerLayer("la_reunion_QoS_transports_data_arcep", "la_reunion_QoS_transports_data_arcep", "REU_QoS_data_transports_virgule", "numeric"),
        creerLayer("la_reunion_QoS_agglos_voix_arcep", "la_reunion_QoS_agglos_voix_arcep", "REU_QoS_Voix_AGGLOS_virgule", "numeric"),
        creerLayer("la_reunion_QoS_agglos_data_arcep", "la_reunion_QoS_agglos_data_arcep", "REU_QoS_data_agglos_virgule", "numeric"),
        creerLayer("la_reunion_sites", "la_reunion_sites", "REU_sites_2021_T1-adco7w"),
        //creerLayer("la_reunion_sites", "la_reunion_sites", "REU_sites_T4_2020"),
        creerLayerCouverture("2G_SRR_la_reunion", fillStr, "2G_la_reunion", "REU_SRR_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_SRR_la_reunion", fillStr, "2G3G_la_reunion", "REU_SRR_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_SRR_la_reunion", fillStr, "3G_la_reunion", "REU_SRR_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_SRR_la_reunion", fillStr, "4G_la_reunion", "974_SRR_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Orange_la_reunion", fillStr, "2G_la_reunion", "REU_OF_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_la_reunion", fillStr, "2G3G_la_reunion", "REU_OF_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Orange_la_reunion", fillStr, "3G_la_reunion", "REU_OF_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Orange_la_reunion", fillStr, "4G_la_reunion", "974_OF_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_FM_la_reunion", fillStr, "2G_la_reunion", "REU_TELC_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_FM_la_reunion", fillStr, "2G3G_la_reunion", "REU_TELC_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_FM_la_reunion", fillStr, "3G_la_reunion", "REU_TELC_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_FM_la_reunion", fillStr, "4G_la_reunion", "974_TELC_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("2G_Zeop_la_reunion", fillStr, "2G_la_reunion", "REU_ZEOP_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Zeop_la_reunion", fillStr, "2G3G_la_reunion", "REU_ZEOP_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("3G_Zeop_la_reunion", fillStr, "3G_la_reunion", "REU_ZEOP_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Zeop_la_reunion", fillStr, "4G_la_reunion", "974_ZEOP_4G_data_2021T1", monoColorDefault),
       
       
        // Métropole
        creerLayer("metropole_QoS_transports_voix_arcep", "metropole_QoS_transports_voix_arcep", "QoS_Arcep_transports_voix_sms_2020", "numeric"),
        creerLayer("metropole_QoS_transports_data_arcep", "metropole_QoS_transports_data_arcep", "MRMTransports_data_2020_OK", "numeric"),
        creerLayer("metropole_QoS_agglos_data_arcep", "metropole_QoS_agglos_data_arcep", "QoS_Arcep_habitations_data_2020", "numeric"),
		creerLayer("metropole_QoS_agglos_voix_arcep", "metropole_QoS_agglos_voix_arcep", "QoS_Arcep_habitations_voixsms_2020", "numeric"),
        creerLayer("metropole_QoS_transports_data_sncf", "metropole_QoS_transports_data_sncf", "MRM_web_sncf_QoSi_T2_2020"),
        creerLayer("metropole_QoS_agglos_data_aura", "metropole_QoS_agglos_data_aura", "MRM_Aura_data_final", "continuous"),
        creerLayer("metropole_QoS_agglos_data_aura_2", "metropole_QoS_agglos_data_aura_2", "MRM_Aura_2020_10_debits", "continuous"),
        //creerLayer("metropole_QoS_agglos_data_cher", "metropole_QoS_agglos_data_cher", "MRM_WEB_Cher_data_routes", "numeric"),
        //creerLayer("metropole_QoS_agglos_data_hdfDebits", "metropole_QoS_agglos_data_hdfDebits", "HDF_donnees_MRM", "continuous"),
        //creerLayer("metropole_QoS_agglos_data_pdl2019", "metropole_QoS_agglos_data_pdl2019", "MRM_PDlL_WEB_janvier2019"),
        creerLayer("metropole_QoS_agglos_data_pdl2020", "metropole_QoS_agglos_data_pdl2020", "MRM_PDlL_debit_2020T1", "continuous"),
        creerLayer("metropole_QoS_agglos_data_pdl2020_2", "metropole_QoS_agglos_data_pdl2020_2", "PDlL_mai_septembre2020_all_DL", "continuous"),
        creerLayer("metropole_QoS_agglos_data_lieusaint", "metropole_QoS_agglos_data_lieusaint", "MRM_Lieusaint_T2_2020", "numeric"),
        creerLayer("metropole_QoS_agglos_data_cd43", "metropole_QoS_agglos_data_cd43", "MRM_Haute_Loire_T1_2020", "continuous"),
        creerLayer("metropole_QoS_agglos_data_qosi", "metropole_QoS_agglos_data_qosi", "MRM_5Gmark_juillet_decembre_2020_debits", "continuous"),
        creerLayer("metropole_QoS_agglos_data_bfc", "metropole_QoS_agglos_data_bfc", "MRM_BFC_debits_T3_2020_juin2021", "continuous"),
        //creerLayer("metropole_sites", "metropole_sites", "METRO_Sites_2020_T2-8tsomw"),
        creerLayer("metropole_sites", "metropole_sites", "METRO_sites_T1_2021_sites5G_3-46n55g"),
        //creerLayer("metropole_sites", "metropole_sites", "METRO_Sites_2020_T1-cz8tqr"),
        //creerLayer("metropole_sites", "metropole_sites", "2019_T4_Liste_sites_operateur-10jko0"),
        //creerLayer("metropole_sites", "metropole_sites", "2019_T3_Liste_sites_operateur-ddy13n"),
        creerLayer("metropole_touristique_text", "metropole_touristique_text", "Points_touristiques-acokra", "text"),
        creerLayerCouverture("2G_Bouygues_metropole", fillStr, "2G_metropole", "METRO_BOUY_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G_Free_metropole", fillStr, "2G_metropole", "METRO_FREE_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G_Orange_metropole", fillStr, "2G_metropole", "METRO_OF_couv_2G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G_SFR_metropole", fillStr, "2G_metropole", "METRO_SFR0_couv_2G_voix_2020_T4", multipleColorsDefault),
        // AJOUT 2G3G TEST
        creerLayerCouverture("2G3G_Bouygues_metropole", fillStr, "2G3G_metropole", "METRO_BOUY_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Free_metropole", fillStr, "2G3G_metropole", "METRO_FREE_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_Orange_metropole", fillStr, "2G3G_metropole", "METRO_OF_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        creerLayerCouverture("2G3G_SFR_metropole", fillStr, "2G3G_metropole", "METRO_SFR0_couv_2G3G_voix_2020_T4", multipleColorsDefault),
        // FIN TEST
        creerLayerCouverture("3G_Bouygues_metropole", fillStr, "3G_metropole", "METRO_BOUY_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouvertureItinerance("3G_Free_metropole", fillStr, "3G_metropole", "METRO_FREE_OF_couv_3G_data_2020_T4_txt", ['#efa7a7', '#e36565'], itineranceColDefault, itineranceDefault, 0.5),
        creerLayerCouverture("3G_Orange_metropole", fillStr, "3G_metropole", "METRO_OF_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("3G_SFR_metropole", fillStr, "3G_metropole", "METRO_SFR0_couv_3G_data_2020_T4", monoColorDefault),
        creerLayerCouverture("4G_Bouygues_metropole", fillStr, "4G_metropole", "METRO_BOUY_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("4G_Free_metropole", fillStr, "4G_metropole", "METRO_FREE_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("4G_Orange_metropole", fillStr, "4G_metropole", "METRO_OF_4G_data_2021T1", monoColorDefault),
        creerLayerCouverture("4G_SFR_metropole", fillStr, "4G_metropole", "METRO_SFR0_4G_data_2021T1", monoColorDefault),
    ],
    "sourcesHashTable": {},
    "layersHashTable" : {}
};

mbData.sourcesHashTable = mbData.sources.reduce(buildHashTable, {});
mbData.layersHashTable = mbData.layers.reduce(buildHashTable, {});
