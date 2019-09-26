<!-- Modal ADD -->
<div class="modal fade" id="update-master-searching" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master Searching</h4> 
            </div>
            <form id="form-update-master-searching" action="{{ asset('master-searching/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_update" >
                    </div>
                    <div class="form-group">
                        <label>Input Keyword</label>
                        <input type="text" class="form-control" name="input_keyword_update" >
                    </div>
                    <div class="form-group">
                        <label>Search Suggestions</label>
                        <input type="text" class="form-control" name="search_suggestion_update" >
                    </div>
                    <div class="form-group">
                        <label>Destination</label>
                        <select name="destination_update" id="destination_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($MenuItems as $MenuItem)
                                <option value="{{$MenuItem->Caption}}">{{$MenuItem->Caption}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group" id="RedirectToScreenUpdate">
                        <label>Redirect to Screen</label>
                        <select name="redirect_to_screen_update" id="redirect_to_screen_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Screens as $Screen)
                                <option value="{{$Screen->Label}}">{{$Screen->Label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-update btn btn-default" >Close</button>	
                    <button type="submit" class="btn btn-warning">Update</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-update').click(function() {
            $('#update-master-searching').modal('hide');
            $('#form-update-master-searching')[0].reset();  
            $('#RedirectToScreenUpdate').hide()

        });      
    });

    //hide ridirect to screen
    $(document).on('change','#destination_update',function(){
        console.log($('#destination_update').val());
           if ($('#destination_update').val()=="acc.one"){
               $('#RedirectToScreenUpdate').show()
           }else{
               $('#RedirectToScreenUpdate').hide()
           }
        });
</Script>
