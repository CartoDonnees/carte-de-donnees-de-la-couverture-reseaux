<div>
    <?php
        use App\Models\User;
    ?>
    <div class="card">
        <div class="card-title">
            <div class="row p-2">
                <div class="col-md-8">
                    <h5 class="modal-title" id="exampleModalLabel">FORUM</h5>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="tcontent" class="d-flex justify-center">
              <h4 class="text-warring"><i class="fas fa-exclamation-triangle mr-2"></i>Aucune zone selectionnée !</h4>
            </div>
            <div id="tablec">
              <button type="button" class="btn btn-primary float-right" onclick="generate()">Extraire uniquement la liste afficher</button>
              <table style="width: 100%;" id="mydata" class="table table-hover table-striped table-bordered">
                <thead>
                  <tr>
                      <th>LOCALITE</th>
                      <th>SOUS-PREFECTURE</th>
                      <th>DePARTEMENT</th>
                      <th>REGION</th>
                      <th>DISTRICT</th>
                      <th>POPULATION</th>
                      <th>SYNTHESE COUVERTURE 2G</th>
                      <th>SYNTHESE COUVERTURE 3G</th>
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
                      <td>{{ $value->district }}</td>
                      <td>{{ intval($value->population_totale) }}</td>
                      <td><i class=" {{ $value->synthese_couverture_2G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_2G == 1 ? ' Oui' :' Non' }}</i></td>
                      <td><i class=" {{ $value->synthese_couverture_3G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_3G == 1 ? ' Oui' :' Non' }}</i></td>
                      <td><i class=" {{ $value->synthese_couverture_4G == 1 ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger' }}"> {{ $value->SYNTHESE_COUVERTURE_4G == 1 ? ' Oui' :' Non' }}</i></td>
                    </tr>
                  @endforeach --}}
                </tbody>
              </table>
            </div>
            
            <script>
              var tdata = dwdData;
              var tby = document.getElementById('tby');
              var ta = null;
              var last_export = null;
              var tableC = document.getElementById('tablec');
              var contentTable = document.getElementById('tcontent');
              setTimeout(initTable(),2000);


              function initTable(){
                if(d_export != null && last_export != d_export){
                  var mydata = [];
                  contentTable.innerHTML = '';
                  tableC.style.display = 'block';
                  if(d_export[0] == 1){
                    for(data in dwdData){
                      if(dwdData[data].dt.toLowerCase() == d_export[1].toLowerCase()){
                        mydata.push(dwdData[data]);
                      }
                    }
                  }else if(d_export[0] == 2){
                    for(data in dwdData){
                      if(dwdData[data].rg.toLowerCase() == d_export[1].toLowerCase()){
                        mydata.push(dwdData[data]);
                      }
                    }
                  }
                  makeTable(mydata);
                }
                else{
                  tableC.style.display = 'none';
                  contentTable.innerHTML = '<h4 class="text-warring"><i class="fas fa-exclamation-triangle mr-2"></i>Aucune zone selectionnée !</h4>';
                  contentTable.style.display = 'block';
                }
              }

              function makeTable(tdata){
                  if(ta != null){
                    // Quickly and simply clear a table
                    $('#mydata').dataTable().fnClearTable();
                    // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                    $('#mydata').dataTable().fnDestroy();
                  }
                for(data in tdata){
                  var tr = document.createElement('tr');
                  tr.id = data;
                  tby.appendChild(tr);
                  optionArray = tdata[data]
                  for(opt in optionArray){
                    if (optionArray.hasOwnProperty(opt)) {
                        var subtr = document.getElementById(data)
                        var text = optionArray[opt];
                        var td = document.createElement('td');
                      if(opt == 'S2G' || opt == 'S3G' || opt == 'S4G' ){
                        if(optionArray[opt] == 1){
                          td.innerHTML = '<i class="far fa-check-circle text-success"> Oui</i>';
                        }else{
                          td.innerHTML = '<i class="far fa-times-circle text-danger"> Non</i>';
                        }
                      }
                      else{
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

                // Simple html example
                doc.autoTable({ 
                  html: '#mydata' ,
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
    </div>
                    

    <button wire:click="test">Cliquez moi !</button>

    @if($test)
        <p>bienvenue chez moi</p>
    @endif
  
</div>
