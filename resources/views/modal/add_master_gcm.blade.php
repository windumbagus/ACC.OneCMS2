<!-- Modal ADD -->
<div class="modal fade" id="add-master-gcm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-add close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Master GCM</h4> 
            </div>
            <form id="form-add-master-gcm" action="{{ asset('master-gcm/add') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Condition</label>
                        {{-- <input type="text" class="form-control" name="Condition_Add" > --}}
                        <select class="form-control select2" id="Condition_Add" name="Condition_Add" style="width:100%;">
                            <option value="0" selected>-- Choose Condition --</option>
                            @foreach ($Conditions as $C)
                                <option value="{{$C}}">
                                    {{$C}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Char Value 1</label>
                        <input type="text" class="form-control" name="CharValue1_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 1</label>
                        <input type="text" class="form-control" name="CharDesc1_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 2</label>
                        <input type="text" class="form-control" name="CharValue2_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 2</label>
                        <input type="text" class="form-control" name="CharDesc2_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 3</label>
                        <input type="text" class="form-control" name="CharValue3_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 3</label>
                        <input type="text" class="form-control" name="CharDesc3_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 4</label>
                        <input type="text" class="form-control" name="CharValue4_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 4</label>
                        <input type="text" class="form-control" name="CharDesc4_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Value 5</label>
                        <input type="text" class="form-control" name="CharValue5_Add" >
                    </div>
                    <div class="form-group">
                        <label>Char Desc 5</label>
                        <input type="text" class="form-control" name="CharDesc5_Add" >
                    </div>
                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="Picture_Add" alt=""
                            id="Picture_Add"/><br><br>
                        <input type="file" class="form-control" name="input_picture_Add" id="input_picture_Add">
                    </div>
                    <div class="form-group">
                        <label>IsActive</label> &nbsp;
                        <input type="checkbox" class="" name="IsActive_Add">
                    </div>
                    <div class="form-group">
                        <label>TimeStamp1</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="TimeStamp1_Add" 
                                name="TimeStamp1_Add" value="{{ date('d/m/Y') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>TimeStamp2</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="TimeStamp2_Add" 
                                name="TimeStamp2_Add" value="{{ date('d/m/Y') }}" >
                        </div>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-add btn btn-default" >Close</button>	
                    <button type="submit" class="btn btn-success">Create</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-add').click(function() {
            $('#add-master-gcm').modal('hide');
            $('#form-add-master-gcm')[0].reset();  
        });      
    });

    $('#TimeStamp1_Add').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    })

    $('#TimeStamp2_Add').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    })
</Script>
