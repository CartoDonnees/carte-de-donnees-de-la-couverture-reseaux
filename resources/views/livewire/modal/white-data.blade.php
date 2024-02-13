<div>
    <div class="modal fade" id="whiteModal" tabindex="-1" aria-labelledby="whiteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="whiteModal">Extraction des localités blanches</h5>
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
                <button type="button" class="btn btn-primary float-right" onclick="generateW()">Extraire uniquement les lignes affichées</button>
                <table style="width: 100%;" id="whitedata" class="table table-hover table-striped table-bordered">
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
                  <tbody id="tbywhite">
                    
                  </tbody>
                </table>
              
              <script>
                //setTimeout(initAllDataTable(),2000);

                function initWhiteDataTable(){
                let twhitedata = whiteData;
                let tbywhite = document.getElementById('tbywhite');
                let taw = null;
                    if(taw != null){
                      // Quickly and simply clear a table
                      $('#whitedata').dataTable().fnClearTable();
                      // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                      $('#whitedata').dataTable().fnDestroy();
                    }
                    let iabw = 1;
                  for(da in whiteData){
                    let trw = document.createElement('tr');
                    trw.id = da+"w";
                    tbywhite.appendChild(trw);
                    optionArw = whiteData[da];
                    for(opw in optionArw){
                          let subw = document.getElementById(trw.id)
                          let texw = optionArw[opw];
                          let tdw = document.createElement('td');
                          tdw.innerHTML = texw;
                          subw.appendChild(tdw);
                    }
                    iabw = iabw+1;
                  }
                  setTimeout(() => {
                    taw = tableAdd('whitedata');
                  }, 3000);
                }



                function generateW() {
                  let doc = new jspdf.jsPDF('l')

                  // Simple html example
                  doc.autoTable({ 
                    html: '#whitedata' ,
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