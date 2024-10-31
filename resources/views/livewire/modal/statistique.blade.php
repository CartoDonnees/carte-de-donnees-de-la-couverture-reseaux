<div>
    <div class="modal fade" id="statModal" tabindex="-1" aria-labelledby="statModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statModal">Extraction de toute les données</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary float-right" onclick="generateAl()">Extraire uniquement les lignes affichées</button>
                    <table style="width: 100%;" id="myalldata" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>DISTRICT</th>

                                <th>POPULATION</th>
                                <th>POPULATION COUVERTE</th>
                                <th>POPULATION NON COUVERTE</th>

                                <th>LOCALITE</th>
                                <th>LOCALITE COUVERTE</th>
                                <th>LOCALITE NON COUVERTE</th>

                            </tr>
                        </thead>
                        <tbody id="tbyall">
                            {{-- @foreach($locCouvs as $value)
                      <tr>
                        <td>{{ $value->LOCALITE }}</td>
                            <td>{{ $value->SOUS-PREFECTURE }}</td>
                            <td>{{ $value->DEPARTEMENT }}</td>
                            <td>{{ $value->REGION}}</td>
                            <td>{{ $value->DISTRICT }}</td>
                            <td>{{ intval($value->POPULATION) }}</td>
                            <td><i class=" {{ $value->SYNTHESE_COUVERTURE_2G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_2G == 1 ? ' Oui' :' Non' }}</i></td>
                            <td><i class=" {{ $value->SYNTHESE_COUVERTURE_3G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_3G == 1 ? ' Oui' :' Non' }}</i></td>
                            <td><i class=" {{ $value->SYNTHESE_COUVERTURE_4G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_4G == 1 ? ' Oui' :' Non' }}</i></td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                    <script>
                        var btyall = document.getElementById('tbyall');
                        var taa = null;
                        var donnee = 'dataFiles/geojson/district_limites_30_06_2024.geojson';

                        function afficherDonneesDuJSON() {
                            // Chargement du fichier JSON à partir de son nom
                            if (taa != null) {
                                // Quickly and simply clear a table
                                $('#myalldata').dataTable().fnClearTable();
                                // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                                $('#myalldata').dataTable().fnDestroy();
                            }

                        }
                        // fetch('dataFiles/geojson/ci_limite_distrricts.geojson')
                        //     .then(results => results.json())
                        //     .then(console.log)
                        //     .then(function(response) {
                        //         return response.json();
                        //     })
                        //     .then(function(data) {
                        //         for (var i = 0; i < data['features'].length; i++) {
                        //             nomEntite.innerHTML += '<option value="' + i + '">' + data['features'][i]['properties'].localite + '</option>';

                        //         }
                        //     });

                        function initAllDataTable() {
                            
                            // fetch(donnee)
                            //     .then(response => response.json())
                            //     .then(function(data) {
                            //         for (var i = 0; i < data['features'].length; i++) {
                            //             var tra = document.createElement('tr');
                            //             tra.id = i + "a";
                            //             btyall.appendChild(tra);
                            //             optionAr = data['features'][i]['properties'];
                            //             for (op in optionAr) {
                            //                 var sub = document.getElementById(tra.id)
                            //                 if (op == 'admin1Name' || op == 'population' || op == 'popcouv' || op == 'nopopcouv' || op == 'nbloc' || op == 'nbcouvloc' || op == 'nbnocouvloc') {
                            //                     var sub = document.getElementById(tra.id)
                            //                     var tex = optionAr.op;
                            //                     var tda = document.createElement('td');
                            //                     tda.innerHTML = tex;
                            //                     sub.appendChild(tda);
                            //                 }
                            //                 sub.appendChild(tda);
                            //             }
                            //         }
                            //     })
                            //     .catch(error => {
                            //         console.error('Une erreur est survenue : ', error);
                            //     })
                            //     setTimeout(() => {
                            //     taa = tableAdd('myalldata');
                            // }, 3000);
                            
                        //     var iab = 1;
                        //     for (da in dwdData) {
                        //         var tra = document.createElement('tr');
                        //         tra.id = da + "a";
                        //         btyall.appendChild(tra);
                        //         optionAr = dwdData[da];
                        //         for (op in optionAr) {
                        //             if (optionAr.hasOwnProperty(op)) {
                        //                 var sub = document.getElementById(tra.id)
                        //                 var tex = optionAr[op];
                        //                 var tda = document.createElement('td');
                        //                 if (op == 'S2GORANGE' || op == 'S2GMTN' || op == 'S2GMOOV' || op == 'S2G' || op == 'S3GORANGE' || op == 'S3GMTN' || op == 'S3GMOOV' || op == 'S3G' || op == 'S4GORANGE' || op == 'S4GMTN' || op == 'S4GMOOV' || op == 'S4G') {
                        //                     if (optionAr[op] == 1) {
                        //                         tda.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                        //                     } else {
                        //                         tda.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                        //                     }
                        //                 } else {
                        //                     tda.innerHTML = tex;
                        //                 }
                        //                 sub.appendChild(tda);
                        //             }
                        //         }
                        //         iab = iab + 1;
                        //     }
                        //     setTimeout(() => {
                        //         taa = tableAdd('myalldata');
                        //     }, 3000);
                        }

                        function generateAl() {
                            var doc = new jspdf.jsPDF('l')

                            // Simple html example
                            doc.autoTable({
                                html: '#myalldata',
                                tableWidth: 'auto',
                                headStyles: {
                                    halign: 'center',
                                    fillColor: 'orange',
                                },
                                styles: {
                                    cellPadding: 0.5,
                                    fontSize: 8,
                                    overflow: 'linebreak',
                                },
                            });
                            doc.save('table.pdf')
                        }
                    </script>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>