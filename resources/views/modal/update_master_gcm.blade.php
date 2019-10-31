<!-- Modal ADD -->
<div class="modal fade" id="update-master-gcm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master GCM</h4> 
            </div>
            <form id="form-update-master-gcm" action="{{ asset('master-gcm/update') }}" method="post" enctype="multipart/form-data" novalidate> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Id" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture_Id" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture_DataId" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture_FileName" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture_FileType" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Picture_Type" >
                    </div>
                    
                    <div class="form-group">
                        <label>Condition</label>
                        <input type="text" class="form-control" name="Condition_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 1</label>
                        <input type="text" class="form-control" name="CharValue1_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 1</label>
                        <input type="text" class="form-control" name="CharDesc1_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 2</label>
                        <input type="text" class="form-control" name="CharValue2_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 2</label>
                        <input type="text" class="form-control" name="CharDesc2_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 3</label>
                        <input type="text" class="form-control" name="CharValue3_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 3</label>
                        <input type="text" class="form-control" name="CharDesc3_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 4</label>
                        <input type="text" class="form-control" name="CharValue4_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 4</label>
                        <input type="text" class="form-control" name="CharDesc4_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 5</label>
                        <input type="text" class="form-control" name="CharValue5_Update" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 5</label>
                        <input type="text" class="form-control" name="CharDesc5_Update" >
                    </div>
                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="Picture_Update" alt=""
                            id="Picture_Update"/><br><br>
                        <input type="file" class="form-control" name="Input_Picture_Update" id="Input_Picture_Update">
                    </div>
                    <div class="form-group">
                        <label>IsActive</label> &nbsp;
                        <input type="checkbox" class="" name="IsActive_Update">
                    </div>
                    <div class="form-group">
                        <label>TimeStamp1</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="TimeStamp1_Update" 
                                name="TimeStamp1_Update" value="{{ date('d/m/Y') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>TimeStamp2</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="TimeStamp2_Update" 
                                name="TimeStamp2_Update" value="{{ date('d/m/Y') }}" >
                        </div>    
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
            $('#update-master-gcm').modal('hide');
            $('#form-update-master-gcm')[0].reset();  
        });      
    });

    $('#TimeStamp1_Update').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    })

    $('#TimeStamp2_Update').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    })
</Script>
