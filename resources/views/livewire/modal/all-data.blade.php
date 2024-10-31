<div>
  <div class="modal fade" id="extractAllModal" tabindex="-1" aria-labelledby="extractAllModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <div class="modal-header pt-3">
          <h5 class="modal-title" id="extractAllModal">Extraction de toutes les données</h5>

          {{-- <button type="button" class="close btn-shadow mr-3 btn btn-danger" data-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button> --}}
          <div class="d-flex justify-content-end ">
            <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom"
              class="btn-shadow mr-3 btn btn-danger">
              <i class="fas fa-times"></i>
            </a>
          </div>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-primary float-right" onclick="generateAl()">Extraire uniquement les lignes affichées</button>
          <table style="width: 100%;" id="myalldata" class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th>LOCALITE</th>
                <th>SOUS-PREFECTURE</th>
                <th>DEPARTEMENT</th>
                <th>REGION</th>
                <th>DISTRICT</th>
                <th>POPULATION</th>
                <th>COUVERTURE 2G ORANGE</th>
                <th>COUVERTURE 2G MTN</th>
                <th>COUVERTURE 2G MOOV</th>
                <th>SYNTHESE COUVERTURE 2G</th>
                <th>COUVERTURE 3G ORANGE</th>
                <th>COUVERTURE 3G MTN</th>
                <th>COUVERTURE 3G MOOV</th>
                <th>SYNTHESE COUVERTURE 3G</th>
                <th>COUVERTURE 4G ORANGE</th>
                <th>COUVERTURE 4G MTN</th>
                <th>COUVERTURE 4G MOOV</th>
                <th>SYNTHESE COUVERTURE 4G</th>
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
            //setTimeout(initAllDataTable(),2000);


            function initAllDataTable() {

              let dats = dwdData;
              let btyall = document.getElementById('tbyall');
              let taa = null;
              console.log("AFFICHAGE DU CONTENEUR", btyall)
              if (taa != null) {
                // Quickly and simply clear a table
                $('#myalldata').dataTable().fnClearTable();
                // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                $('#myalldata').dataTable().fnDestroy();
              }

                var donnee = 'dataFiles/geojson/all_data30_06_2024.geojson';
                fetch(donnee)
                  .then(response => response.json())
                  .then(function(data) {
                    // alert('ok')
                    console.log('====>', data['features']);
                    for (var i = 0; i < data['features'].length; i++) {
                      var tra = document.createElement('tr');
                      tra.id = i + "a";
                      btyall.appendChild(tra);
                      optionAr = data['features'][i]['properties'];

                      var sub = document.getElementById(tra.id);

                      const locTd = document.createElement('td');
                      locTd.innerHTML = optionAr['name']
                      sub.appendChild(locTd)

                      const locSub = document.createElement('td');
                      locSub.innerHTML = optionAr['sub_pref']
                      sub.appendChild(locSub)

                      const locDep = document.createElement('td');
                      locDep.innerHTML = optionAr['depart']
                      sub.appendChild(locDep)

                      const locReg = document.createElement('td');
                      locReg.innerHTML = optionAr['region']
                      sub.appendChild(locReg)

                      const locDist = document.createElement('td');
                      locDist.innerHTML = optionAr['district']
                      sub.appendChild(locDist)

                      const pop = document.createElement('td');
                      pop.innerHTML = optionAr['pop']
                      sub.appendChild(pop)

                      const cov2GOrange = document.createElement('td');
                      if (optionAr['covORANGE2G'] > 0) {
                        cov2GOrange.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov2GOrange.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov2GOrange)

                      const cov2GMtn = document.createElement('td');
                      if (optionAr['covMTN2G'] > 0) {
                        cov2GMtn.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov2GMtn.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov2GMtn)

                      const cov2GMoov = document.createElement('td');
                      if (optionAr['covMOOV2G'] > 0) {
                        cov2GMoov.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov2GMoov.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov2GMoov)

                      const cov2G = document.createElement('td');
                      if (optionAr['cov2G'] > 0) {
                        cov2G.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov2G.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov2G)


                      const cov3GOrange = document.createElement('td');
                      if (optionAr['covORANGE3G'] > 0) {
                        cov3GOrange.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov3GOrange.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov3GOrange)

                      const cov3GMtn = document.createElement('td');
                      if (optionAr['covMTN3G'] > 0) {
                        cov3GMtn.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov3GMtn.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov3GMtn)

                      const cov3GMoov = document.createElement('td');
                      if (optionAr['covMOOV3G'] > 0) {
                        cov3GMoov.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov3GMoov.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov3GMoov)

                      const cov3G = document.createElement('td');
                      if (optionAr['cov3G'] > 0) {
                        cov3G.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov3G.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov3G)

                      const cov4GOrange = document.createElement('td');
                      if (optionAr['covORANGE4G'] > 0) {
                        cov4GOrange.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov4GOrange.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov4GOrange)

                      const cov4GMtn = document.createElement('td');
                      if (optionAr['covMTN4G'] > 0) {
                        cov4GMtn.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov4GMtn.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov4GMtn)

                      const cov4GMoov = document.createElement('td');
                      if (optionAr['covMOOV4G'] > 0) {
                        cov4GMoov.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov4GMoov.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov4GMoov)

                      const cov4G = document.createElement('td');
                      if (optionAr['cov4G'] > 0) {
                        cov4G.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        cov4G.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                      sub.appendChild(cov4G)
                    }
                  })
                  .catch(error => {
                    console.error('Une erreur est survenue : ', error);
                  })
                  
                  setTimeout(() => {
                taa = tableAdd('myalldata');
              }, 3000);
              // setTimeout(() => {
              // var donnee = 'dataFiles/geojson/district_limites_30_06_2024.geojson';
              // fetch(donnee)
              //   .then(response => response.json())
              //   .then(function(data) {
              //     alert('ok')
              //     // for (var i = 0; i < data['features'].length; i++) {
              //     //   var tra = document.createElement('tr');
              //     //   tra.id = i + "a";
              //     //   btyall.appendChild(tra);
              //     //   optionAr = data['features'][i]['properties'];

              //     //   var tda = document.createElement('td');
              //     //   if (optionAr['popCov'] > 0) {
              //     //     tda.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
              //     //   } else {
              //     //     tda.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
              //     //   }
              //     // }
              //   })
              //   .catch(error => {
              //     console.error('Une erreur est survenue : ', error);
              //   })
              // }, 3000);


              // let iab = 1;
              // for(da in dwdData){
              //   var tra = document.createElement('tr');
              //   tra.id = da+"a";
              //   btyall.appendChild(tra);
              //   optionAr = dwdData[da];
              //   for(op in optionAr){
              //     if (optionAr.hasOwnProperty(op)) {
              //         var sub = document.getElementById(tra.id)
              //         var tex = optionAr[op];
              //         var tda = document.createElement('td');
              //       if(op == 'S2GORANGE' || op == 'S2GMTN' || op== 'S2GMOOV' || op == 'S2G' || op == 'S3GORANGE' || op == 'S3GMTN' || op== 'S3GMOOV'|| op == 'S3G' || op == 'S4GORANGE' || op == 'S4GMTN' || op== 'S4GMOOV'|| op == 'S4G' ){
              //         if(optionAr[op] == 1){
              //           tda.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
              //         }else{
              //           tda.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
              //         }
              //       }
              //       else{
              //         tda.innerHTML = tex;
              //       }
              //         sub.appendChild(tda);
              //     }
              //   }
              //   iab = iab+1;
              // }
              // setTimeout(() => {
              //   taa = tableAdd('myalldata');
              // }, 3000);
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