<div>
  <div class="modal fade" id="extractModal" tabindex="-1" aria-labelledby="extractModal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="extractModal1">Extraction des données selectionnées</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
          <div class="d-flex justify-content-end ">
            <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom"
                class="btn-shadow mr-3 btn btn-danger">
                <i class="fas fa-times"></i>
            </a>
        </div>
        </div>
        <div class="modal-body">
          <div id="tcontent" class="d-flex justify-center">
            <h4 class="text-warring"><i class="fas fa-exclamation-triangle mr-2"></i>Aucune zone selectionnée !</h4>
          </div>
          <div id="tablec">
            <button type="button" class="btn btn-primary float-right" onclick="generate()">Extraire uniquement les lignes affichées</button>
            <table style="width: 100%;" id="mydata" class="table table-hover table-striped table-bordered">
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
              <tbody id="tby">
                {{-- @foreach($locCouvs as $value)
                      <tr>
                        <td>{{ $value->localite }}</td>
                <td>{{ $value->sous_prefecture }}</td>
                <td>{{ $value->departement }}</td>
                <td>{{ $value->region}}</td>
                <td>{{ $value->DISTRICT }}</td>
                <td>{{ intval($value->population_totale) }}</td>
                <td><i class=" {{ $value->SYNTHESE_COUVERTURE_2G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_2G == 1 ? ' Oui' :' Non' }}</i></td>
                <td><i class=" {{ $value->SYNTHESE_COUVERTURE_3G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_3G == 1 ? ' Oui' :' Non' }}</i></td>
                <td><i class=" {{ $value->SYNTHESE_COUVERTURE_4G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_4G == 1 ? ' Oui' :' Non' }}</i></td>
                </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>

          <script>
            setTimeout(initTable(), 2000);

            function initTable() {
            let tdata = dwdData;
            let tby = document.getElementById('tby');
            let last_export = null;
            let tableC = document.getElementById('tablec');
            let contentTable = document.getElementById('tcontent');

              if (d_export != null && last_export != d_export) {
                let mydata = [];
                contentTable.innerHTML = '';
                tableC.style.display = 'block';
                if (d_export[0] == 1) {
                  for (data in dwdData) {
                    if (dwdData[data].dt.toLowerCase() == d_export[1].toLowerCase()) {
                      mydata.push(dwdData[data]);
                    }
                  }
                } else if (d_export[0] == 2) {
                  for (data in dwdData) {
                    if (dwdData[data].rg.toLowerCase() == d_export[1].toLowerCase()) {
                      mydata.push(dwdData[data]);
                    }
                  }
                } else if (d_export[0] == 3) {
                  for (data in dwdData) {
                    if (sansAccent(dwdData[data].sp.toLowerCase()) == sansAccent(d_export[1].toLowerCase())) {
                      mydata.push(dwdData[data]);
                    }
                  }
                }
                else if(d_export[0] == 4){
                  for (data in dwdData) {
                    if (sansAccent(dwdData[data].loc.toLowerCase()) == sansAccent(d_export[1].toLowerCase())) {
                      mydata.push(dwdData[data]);
                    }
                  }
                }

                makeTable(mydata);
              } else {
                tableC.style.display = 'none';
                contentTable.innerHTML = '<h4 class="text-warring"><i class="fas fa-exclamation-triangle mr-2"></i>Aucune zone selectionnée !</h4>';
                contentTable.style.display = 'block';
              }
            }

            function sansAccent(str) {
              let accent = [
                /[\300-\306]/g, /[\340-\346]/g, // A, a
                /[\310-\313]/g, /[\350-\353]/g, // E, e
                /[\314-\317]/g, /[\354-\357]/g, // I, i
                /[\322-\330]/g, /[\362-\370]/g, // O, o
                /[\331-\334]/g, /[\371-\374]/g, // U, u
                /[\321]/g, /[\361]/g, // N, n
                /[\307]/g, /[\347]/g, // C, c
              ];
              let noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];


              for (let i = 0; i < accent.length; i++) {
                str = str.replace(accent[i], noaccent[i]);
              }

              return str;
            }

            function makeTable(tdata) {
            let ta = null;
              if (ta != null) {
                // Quickly and simply clear a table
                $('#mydata').dataTable().fnClearTable();
                // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                $('#mydata').dataTable().fnDestroy();
              }
              for (data in tdata) {
                let tr = document.createElement('tr');
                tr.id = data;
                tby.appendChild(tr);
                optionArray = tdata[data]
                for (opt in optionArray) {
                  if (optionArray.hasOwnProperty(opt)) {
                    let subtr = document.getElementById(data)
                    let text = optionArray[opt];
                    let td = document.createElement('td');
                    if (opt == 'S2GORANGE' || opt == 'S2GMTN' || opt == 'S2GMOOV' || opt == 'S2G' || opt == 'S3GORANGE' || opt == 'S3GMTN' || opt == 'S3GMOOV' || opt == 'S3G' || opt == 'S4GORANGE' || opt == 'S4GMTN' || opt == 'S4GMOOV' || opt == 'S4G') {
                      if (optionArray[opt] == 1) {
                        td.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                      } else {
                        td.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                      }
                    } else {
                      td.innerHTML = text;
                    }
                    subtr.appendChild(td);
                  }
                }
              }
              ta = tableAdd('mydata');
            }



            function generate() {
              var doc = new jspdf.jsPDF('l')

              doc.addImage("data:image/jpeg;base64,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", 'JPEG', 12, 5, 50, 8);
              doc.text(230, 12, 'DEMP 2021-2022');
              // Simple html example
              doc.autoTable({
                html: '#mydata',
                tableWidth: 'auto',
                headStyles: {
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