<!-- Modal ADD -->
<div class="modal fade" id="add-master-searching" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Master Searching</h4> 
            </div>
            <form id="form-add-master-searching" action="{{ asset('master-searching/add') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Input Keyword</label>
                        <input type="text" class="form-control" name="input_keyword_add" >
                    </div>
                    <div class="form-group">
                        <label>Search Suggestions</label>
                        <input type="text" class="form-control" name="search_suggestion_add" >
                    </div>
                    <div class="form-group">
                        <label>Destination</label>
                        <select name="destination_add" id="destination_add" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($MenuItems as $MenuItem)
                                <option value="{{$MenuItem->Caption}}">{{$MenuItem->Caption}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group" id="RedirectToScreenAdd">
                        <label>Redirect to Screen</label>
                        <select name="redirect_to_screen_add" id="redirect_to_screen_add" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Screens as $Screen)
                                <option value="{{$Screen->Label}}">{{$Screen->Label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close-modal-add">Close</button>	
                    <button type="submit" class="btn btn-success">Create</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-add').click(function() {
            $('#add-master-searching').modal('hide');
            $('#form-add-master-searching')[0].reset();  
        });      
    });

    //hide ridirect to screen
    $(document).on('change','#destination_add',function(){
        console.log($('#destination_add').val());
           if ($('#destination_add').val()=="acc.one"){
               $('#RedirectToScreenAdd').show()
           }else{
            $('#RedirectToScreenAdd').hide()
           }
        });
</Script>
