<div>
    <div class="modal fade" id="extractNoModal" tabindex="-1" aria-labelledby="extractNoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="extractNoModal">Extraction des localités non couvertes</h5>
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
            <div class="modal-body" >
                <button type="button" class="btn btn-primary float-right" onclick="generateNo()">Extraire uniquement les lignes affichées</button>
                <table style="width: 100%;" id="nodata" class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                        <th>LOCALITE</th>
                        <th>SOUS-PREFECTURE</th>
                        <th>DEPARTEMENT</th>
                        <th>REGION</th>
                        <th>DISTRICT</th>
                        <th>POPULATION</th>
                    </tr>
                  </thead>
                  <tbody id="tbyno">

                  </tbody>
                </table>
              
              <script>
                //setTimeout(initAllDataTable(),2000);

                function initNoDataTable(){
                let tnodata = noData;
                let tbyno = document.getElementById('tbyno');
                let tano = null;
                    if(tano != null){
                      // Quickly and simply clear a table
                      $('#nodata').dataTable().fnClearTable();
                      // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                      $('#nodata').dataTable().fnDestroy();
                    }
                  let iabn = 1;
                  for(da in noData){
                    let trn = document.createElement('tr');
                    trn.id = da+"n";
                    tbyno.appendChild(trn);
                    optionArn = noData[da];
                    for(opn in optionArn){
                          let subn = document.getElementById(trn.id)
                          let texn = optionArn[opn];
                          let tdn = document.createElement('td');
                          tdn.innerHTML = texn;
                          subn.appendChild(tdn);
                      }
                      iabn = iabn+1;
                    }
                  setTimeout(() => {
                    tano = tableAdd('nodata');
                  }, 3000);
                }

                function generateNo() {
                  let doc = new jspdf.jsPDF('l')

                  // Simple html example
                  doc.autoTable({ 
                    html: '#nodata' ,
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