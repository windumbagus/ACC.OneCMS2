<!-- Modal ADD -->
<div class="modal fade" id="add-master-otr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-add close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Master OTR</h4> 
            </div>
            <form id="form-add-master-otr" action="{{ asset('master-otr/add') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>CD BRAND :</label>
                        <input type="text" class="form-control" name="CD_BRAND_master_otr_add" id="CD_BRAND_master_otr_add" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>DESC BRAND :</label>
                        <select name="DESC_BRAND_master_otr_add" id="DESC_BRAND_master_otr_add" class="form-control">
                            <option selected disabled value="">-</option>
                            @foreach ($GetMstGCMSBrands as $GetMstGCMSBrand)
                                <option cd-brand="{{$GetMstGCMSBrand->CD_BRAND}}" value="{{$GetMstGCMSBrand->DESC_BRAND}}">{{$GetMstGCMSBrand->DESC_BRAND}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>CD TYPE :</label>
                        <input type="text" class="form-control" name="CD_TYPE_master_otr_add" id="CD_TYPE_master_otr_add" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>DESC TYPE :</label>
                        <select name="DESC_TYPE_master_otr_add" id="DESC_TYPE_master_otr_add" class="form-control">
                            <option selected disabled value="">-</option>
                            {{-- @foreach ($GetMstGCMSBrands as $GetMstGCMSBrand)
                                <option cd-brand="{{$GetMstGCMSBrand->CD_BRAND}}" value="{{$GetMstGCMSBrand->DESC_BRAND}}">{{$GetMstGCMSBrand->DESC_BRAND}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>CD MODEL :</label>
                        <input type="text" class="form-control" name="CD_MODEL_master_otr_add" id="CD_MODEL_master_otr_add" readonly>
                    </div>

                    <div class="form-group">
                        <label>DESC MODEL :</label>
                        <select name="DESC_MODEL_master_otr_add" id="DESC_MODEL_master_otr_add" class="form-control">
                            <option selected disabled value="">-</option>
                            {{-- @foreach ($GetMstGCMSBrands as $GetMstGCMSBrand)
                                <option cd-brand="{{$GetMstGCMSBrand->CD_BRAND}}" value="{{$GetMstGCMSBrand->DESC_BRAND}}">{{$GetMstGCMSBrand->DESC_BRAND}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tahun :</label>
                        <input type="text" class="form-control" name="TAHUN_master_otr_add" >
                    </div>
                    <div class="form-group">
                        <label>CD SP :</label>
                        <input type="text" class="form-control" name="CD_SP_master_otr_add" >
                    </div>
                    <div class="form-group">
                        <label>CD AREA :</label>
                        <input type="text" class="form-control" name="CD_AREA_master_otr_add" >
                    </div>
                    <div class="form-group">
                        <label>OTR :</label>
                        <input type="text" class="form-control" name="OTR_master_otr_add" >
                    </div>
                    <div class="form-group">
                        <label>DEVIASI :</label>
                        <input type="number" class="form-control" name="DEVIASI_master_otr_add" >
                    </div>
                    <div class="form-group">
                        <label>IS New :</label><br>
                        <input type="checkbox" class="" name="IS_NEW_master_otr_add">
                    </div>
                    <div class="form-group">
                        <label>IS Active :</label><br>
                        <input type="checkbox" class="" name="IS_ACTIVE_master_otr_add">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="close-modal-add btn btn-default">Close</button>	
                    <button type="submit" class="btn btn-success">Create</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-add').click(function() {
            $('#add-master-otr').modal('hide');
            $('#form-add-master-otr')[0].reset();  
        });      
    });

    //get desc_type
    $('#DESC_BRAND_master_otr_add').on('change', function(){
        // set cd brand on form
        var cd_brand = $(this).find(':selected').attr('cd-brand')
        document.getElementById('CD_BRAND_master_otr_add').value = cd_brand;

        var Brand = $(this).val()        
        // console.log(Brand);
        if (Brand) {
            $.ajax({
            url: 'master-otr/GetMstGcmType/'+Brand,
            dataType: 'json',
            success: function(data){
                console.log(data);
                    $('#DESC_TYPE_master_otr_add').empty()
                    $('#DESC_TYPE_master_otr_add').append('<option value="" selected disabled>-</option>')
                    data.map(d=>{
                        $('#DESC_TYPE_master_otr_add').append('<option cd-type="'+d.CD_TYPE+'" value="'+d.DESC_TYPE+'">'+d.DESC_TYPE+'</option>')
                    })
                },
            })
        }
        else {
            $('#DESC_TYPE_master_otr_add').empty()
        }
    });

    //get desc_model
    $(document).on('change','#DESC_TYPE_master_otr_add', function(){
        // set cd brand on form
        var cd_type = $(this).find(':selected').attr('cd-type')
        // console.log(cd_type);
        
        document.getElementById('CD_TYPE_master_otr_add').value = cd_type;

        var Type = $(this).val()        
        console.log(Type);
        if (Type) {
            $.ajax({
            url: 'master-otr/GetMstGcmModel/'+Type,
            dataType: 'json',
            success: function(data){
                    $('#DESC_MODEL_master_otr_add').empty()
                    $('#DESC_MODEL_master_otr_add').append('<option value="" selected disabled>-</option>')
                    data.map(d=>{
                        $('#DESC_MODEL_master_otr_add').append('<option cd-model="'+d.CD_MODEL+'" value="'+d.DESC_MODEL+'">'+d.DESC_MODEL+'</option>')
                    })
                },
            })
        }
        else {
            $('#DESC_MODEL_master_otr_add').empty()
        }
    });

    $('#DESC_MODEL_master_otr_add').on('change', function(){
        // set cd brand on form
        var cd_model = $(this).find(':selected').attr('cd-model')
        document.getElementById('CD_MODEL_master_otr_add').value = cd_model;
    });


</Script>
