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
          <div class="modal-body" >
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


              function initAllDataTable(){
              let dats = dwdData;
              let btyall = document.getElementById('tbyall');
              let taa = null;
              console.log("AFFICHAGE DU CONTENEUR", btyall)
                if(taa != null){
                    // Quickly and simply clear a table
                    $('#myalldata').dataTable().fnClearTable();
                    // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                    $('#myalldata').dataTable().fnDestroy();
                  }
                let iab = 1;
                for(da in dwdData){
                  var tra = document.createElement('tr');
                  tra.id = da+"a";
                  btyall.appendChild(tra);
                  optionAr = dwdData[da];
                  for(op in optionAr){
                    if (optionAr.hasOwnProperty(op)) {
                        var sub = document.getElementById(tra.id)
                        var tex = optionAr[op];
                        var tda = document.createElement('td');
                      if(op == 'S2GORANGE' || op == 'S2GMTN' || op== 'S2GMOOV' || op == 'S2G' || op == 'S3GORANGE' || op == 'S3GMTN' || op== 'S3GMOOV'|| op == 'S3G' || op == 'S4GORANGE' || op == 'S4GMTN' || op== 'S4GMOOV'|| op == 'S4G' ){
                        if(optionAr[op] == 1){
                          tda.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                        }else{
                          tda.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                        }
                      }
                      else{
                        tda.innerHTML = tex;
                      }
                        sub.appendChild(tda);
                    }
                  }
                  iab = iab+1;
                }
                setTimeout(() => {
                  taa = tableAdd('myalldata');
                }, 3000);
              }


              function generateAl() {
                var doc = new jspdf.jsPDF('l')

                // Simple html example
                doc.autoTable({ 
                  html: '#myalldata' ,
                  tableWidth : 'auto',
                  headStyles: {
                    halign : 'center',
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