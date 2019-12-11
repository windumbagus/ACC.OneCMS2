<!-- Modal VIEW -->
<div class="modal fade" id="view-seamless-unit-detail-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-view close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              
                    <h4 class="box-title">View Unit Detail</h4> 
               
                    <!-- <h4 class="box-title">View ACCCash Apply</h4>                  -->
               
            </div>
            <form id="form-view-seamless-unit-detail" action="#" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Id Unit</label>
                        <input type="text" class="form-control" name="ID_UNIT" readonly>
                    </div>
                    <table id="example2" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Chardesc</th>
                               
                          
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                           
                        </tbody>
                        </table>
                    
                    <div class="modal-footer">
                    <button type="button" class="close-modal-view btn btn-default" >Close</button>			
                   
                </div>	
                    

                </div>
               	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-view').click(function() {
            $('#view-seamless-unit-detail-popup').modal('hide');
            $('#form-view-seamless-unit-detail')[0].reset();  
        });      
    });

</Script>
