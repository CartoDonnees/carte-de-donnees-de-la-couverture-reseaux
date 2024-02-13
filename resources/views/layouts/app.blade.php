<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ARTCI Cartodonnées</title>

    <!-- select test -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />

    <!-- select2 searchbar -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/9ca3b27b3d.js" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.7/css/autoFill.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.3.0/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link href="{{ asset('../css/main.css') }}" rel="stylesheet">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Alpine v3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Focus plugin -->
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>

    <script>
        var d_export = null;
    </script>
<!-- Google Tag Manager -->
{{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MMCJ9NNQ');</script>
    <!-- End Google Tag Manager --> --}}

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5NBY02E09G"></script>
    <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5NBY02E09G');
</script>
   

</head>


<body><!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MMCJ9NNQ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js">
    </script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        @livewire('navigation-menu')
        <main class="app-main">
            {{ $slot }}
        </main>
        </main>

        <div class="app-drawer-wrapper">
            <div class="drawer-nav-btn">
                <button type="button" class="hamburger hamburger--elastic is-active">
                    <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                </button>
            </div>
            <div class="drawer-content-wrapper">
                <div class="scrollbar-container">
                    <h3 class="drawer-heading text-primary"><i class="fas fa-info-circle mr-2" style="font-size: 20px"></i> INFORMATION</h3>
                    <div class="drawer-section">
                        <div>
                            <h5 class="card-title">Cartodonnées</h5>
                            <p class="text-justify">Cet outil est une plateforme qui présente la couverture de données mobile sur toute l’étendue du territoire national.
                                Il vise à communiquer des informations précises sur la couverture réseau des localités de la Côte d'Ivoire au grand public.</p>
                            <!-- <p>Créer grâce à la colaboration du departement <b><a href="https://www.artci.ci/index.php/accueil/la-direction-generale/3-les-directions/36-direction-de-l-economie-des-marches-et-de-la-prospective.html">DEMP</a></b> et <b><a href="https://www.artci.ci/index.php/accueil/la-direction-generale/3-les-directions/393-direction-de-la-protection-des-donnees-personnelles.html">DPDP</a> </b> de l'ARTCI, cet
                                outil vise à donner des informations précises sur la couverture réseau des localités de
                                la Côte d'Ivoire au grand public</p> -->
                        </div>
                        <div class="divider"></div>
                        <div class="pt-1">
                            <h5 class="card-title">Accès au portail</h5>
                            <p class="text-justify">L’accès au portail, les commentaires et l’extraction des données se fait sans inscription.
                                <br />
                                Toutefois avec l’inscription, vous êtes tenu au courant des derniers articles et mises à jour de notre plateforme.
                            </p>

                        </div>
                        <p></p>
                        <div class="divider"></div>
                        <div class="pt-1">
                            <h5 class="card-title">Extraction des données</h5>
                            <p class="text-justify">L'image de la carte peut être exporter sous format .pdf, .jpeg, .png.</p>
                            <p class="text-justify">Les données de couvertures peuvent être extraites sous format .xlsx, pdf ou être copier.
                                Cette action est possible grâce à la barre de navigation sous l'option "<b>Extraction de
                                    données</b>".</p>
                        </div>
                        <div class="divider"></div>
                        <div class="pt-1">
                            <h5 class="card-title">Propriété du portail</h5>
                            <p>Le portail est exclusivement la propriété de l’ARTCI.</p>
                        </div>
                        <!-- <div class="text-center pt-5">
                            <a href="{{ Route('guide') }}" target="blanck" class="pt-3 text-info">Termes - Conditions</a>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>

        <div class="ui-theme-settings">

            <button type="button" class="hamburger hamburger--elastic open-right-drawer my_custom_option" style="background-color: white">
                <h5><i class="fas fa-info"></i></h5>
            </button>
            <div class="theme-settings__inner">
            </div>
        </div>
    </div>


    @livewireScripts
    @livewire('livewire-ui-modal')
    @livewire('modal.select-data')
    @livewire('modal.all-data')
    @livewire('modal.white-data')
    @livewire('modal.no-data')
    @include('cookie-consent::index')
    @stack('modals')


    



    <script>
        function tableAdd(params) {

            var tb = $('#' + params).DataTable({
                autoFill: {
                    columns: ':not(:first-child)'
                },
                "language": {
                    "sProcessing": "Traitement...",
                    "sLengthMenu": "Afficher _MENU_ lignes",
                    "pageLength": "Afficher _MENU_ lignes",
                    "zeroRecords": "Aucune données trouvée - Désolé !",
                    "info": "Affichage de _START_ à _END_ données sur _TOTAL_",
                    "infoEmpty": "Aucune donnée disponible",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "infoThousands": ".",
                    "loadingRecords": "Chargement...",
                    "search": "Recherche",
                    "paginate": {
                        "first": "Premier",
                        "last": "Dernier",
                        "next": "Suivant",
                        "previous": "Précédent"
                    },
                    "buttons": {
                        "colvis": "Visibilité des colonnes",
                        "copy": "Copier",
                        "print": "Imprimer"
                    }
                },
                "buttons": [, "copy", "excel", "pdf", "print", "colvis"],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "select": true,
                "lengthMenu": [
                    [10, 25, 50, 100, 1000, -1],
                    [10, 25, 50, 100, 1000, "Tous"]
                ],
            }).buttons().container().appendTo('#' + params + '_wrapper .col-md-6:eq(0)');
            return tb;
        }
    </script>

    <script src="{{ asset('js/mapbox-gl-export.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/data.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d-operateurs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d-sites.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/master.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/canvas-toBlob.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/FileSaver.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jspdf.umd.js') }}"></script>
    

    <script type="text/javascript" src="{{ asset('dataFiles/js/dwdData.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/departement.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/localite.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/data.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/whiteData.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/white.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataFiles/js/noData.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.7/js/dataTables.autoFill.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.7/js/autoFill.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.3.0/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Page specific script -->


</body>

</html>