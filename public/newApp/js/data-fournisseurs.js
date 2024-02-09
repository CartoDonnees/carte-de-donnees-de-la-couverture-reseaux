listeFounisseurs = [
  
  //l'ordre dans lequel ils sont renseignés est celui dans lequel ils apparaitront dans le menu déroulant 
  {
    nom: "SNCF-QOSI",
    key: "sncf",
    scope: {
      metropole_transports_tgv: ["data"],
      metropole_transports_intercites_ter: ["data"],
      //metropole_transports_rer_transiliens: ["data"]
    },
    info: "Mesures réalisées par QOSI pour SNCF entre août et septembre\u00a02020"
  },
  
  {
    nom: "QoSi - Mozark Group",
    key: "qosi",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["voix", "data"]
    },
    info: "Mesures réalisées par QoSi - Mozark Group entre juillet\u00a02020 et décembre\u00a02020."
  },

  {
    nom: "de la Bourgogne-Franche-Comté - T3 2020 / juin 2021",
    key: "bfc",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["voix", "data"]
    },
    info: "Mesures réalisées par la région Bourgogne-Franche-Comté entre spetembre\u00a02020 et juin\u00a02021."
  },

  {
    nom: "de l'Auvergne-Rhône-Alpes - fin 2019 / début 2020",
    key: "aura",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["voix", "data"]
    },
    info: "Mesures réalisées par le conseil régional et la préfecture d’Auvergne-Rhône-Alpes entre août\u00a02019 et février\u00a02020."
  },
  
  {
    nom: "de l'Auvergne-Rhône-Alpes - T3 2020",
    key: "aura_2",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["voix", "data"]
    },
    info: "Mesures réalisées par le conseil régional et la préfecture d’Auvergne-Rhône-Alpes en octobre\u00a02020."
  },
  
  /*
  {
    nom: "du Département du Cher",
    key: "cher",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Mesures réalisées par le Département du Cher en septembre et octobre\u00a02019"
  },
  */

  {
    nom: "de la Haute-Loire",
    key: "cd43",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Tests de débit réalisés par le département de la Haute-Loire en mai\u00a02020"
  },
  
  /*
  {
    nom: "des Hauts-de-France",
    key: "hdfDebits",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Tests de débit réalisés par la Région Hauts-de-France et les 5\u00a0Conseils Départementaux depuis avril\u00a02019."
  },
  */
  
  {
    nom: "de Lieusaint",
    key: "lieusaint",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["voix", "data"]
    },
    info: "Mesures réalisées par le conseil régional et la préfecture de Grand Paris Sud en avril\u00a02020."
  },

  /*
  {
    nom: "des Pays de la Loire - janvier\u00a02019",
    key: "pdl2019",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Tests de navigation web réalisés par le syndicat mixte Gigalis en janvier\u00a02019."
  },
  */

  {
    nom: "des Pays de la Loire - T1\u00a02020",
    key: "pdl2020",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Tests de débits réalisés par le syndicat mixte Gigalis au T1\u00a02020."
  },
  
  {
    nom: "des Pays de la Loire - T2 et T3\u00a02020",
    key: "pdl2020_2",
    scope: {
      metropole_agglos_national: ["data"],
      //metropole_transports_routes: ["data"]
    },
    info: "Tests de débits réalisés par le syndicat mixte Gigalis de mai à septembre\u00a02020."
  },
]

listeFounisseurs.findByProperty = function(propertyKey, propertyValue){
    var fournisseurTrouve = null;
     this.forEach(function(fournisseur){
        if (fournisseur[propertyKey] == propertyValue) fournisseurTrouve = fournisseur;
    });
    return fournisseurTrouve;
};
