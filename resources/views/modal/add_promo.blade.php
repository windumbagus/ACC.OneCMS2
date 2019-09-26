
<div class="modal fade" id="add-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-modal-add-promo" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Promo</h4> 
            </div>
            <form class="form-update-promo" action="#" method="post">
                <div class="modal-body"> 
                    @csrf	

                    <!-- <div class="form-group">
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="promo_MstPromo_UserAdded" 
                            value="{{ session()->get('Id')}}">
                    </div> -->

                    <div class="form-group">
                        <label>Jenis Promo</label>
                        <select class="form-control select2" style="width:100%;" 
                            name="promo_MstPromo_PromoType" id="dropdown_JenisPromo_Add" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Jenis Promo</option>
                            <option value="Promo">
                                <a href="#" class="">Promo</a>
                            </option>
                            <option value="Non-Promo">
                                <a href="#" class="">Non-Promo</a>
                            </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea id="editor1" name="editor1" rows="10" cols="60"
                        type="text" class="form-control" name="promo_MstPromo_Description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Active:</label><br>
                        <input type="checkbox" class="" name="promo_MstPromo_IsActivePromo">
                    </div>

                    <div class="form-group">
                        <label>Is Active Banner:</label><br>
                        <input type="checkbox" class="" name="promo_MstPromo_IsActiveBanner">
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 150px; height: 200px;" id="pendinglist_KTP_update_data" 
                        name="promo_MstPicture_Picture" alt=""/><br>
                        <button type="button" class="btn btn-success">Upload Picture</button>
                    </div>

                    <div class="form-group">
                        <label>Promo Code:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_PromoCode">
                    </div>

                    <div class="form-group">
                        <label>Promo Type:</label>
                        <select class="form-control select2" style="width:100%;" name="promo_MstPromo_PromoType"
                            id="dropdown_PromoType_Add" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Tipe Promo</option>
                            @foreach ($PromoTypes as $PromoTypeDropdown)
                                <option value="{{ $PromoTypeDropdown }}">
                                    <a href="#" class="">
                                        {{$PromoTypeDropdown}}
                                    </a>
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Promo Amount:</label><br>
                        <div class="input-group">
                            <span class="input-group-addon" id="inputaddon_PromoAmountRp_Add">Rp</span>
                            <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_PromoAmountRp_Add"
                                min="0.00" step="1" max="1000000000" value="0" required>
                            <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_PromoAmountPr_Add"
                                min="0.00" step="0.01" max="100" value="0" required>
                            <span class="input-group-addon" id="inputaddon_PromoAmountPr_Add">%</span>
                        </div>
                        <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_PromoAmount_Add"
                            min="0" value="0" required>
                    </div>

                    <div class="form-group" id="checkbox_TampilPeriodePromo_Add">
                        <label>Tampilkan Periode Promo:</label><br>
                        <input type="checkbox" class="" name="promo_MstPromo_TampilPeriodePromo">
                    </div>

                    <div class="form-group">
                        <label>Start Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_StartDate_Add" name="promo_MstPromo_StartDate"
                                value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>End Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_EndDate_Add" name="promo_MstPromo_EndDate"
                                value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Syarat dan Ketentuan:</label><br>
                        <textarea id="editor1" name="editor1" rows="10" cols="60" type="text" class="form-control" 
                            name="promo_MstPromo_SyaratDanKetentuan" id="textarea_SyaratDanKetentuan_Add" required>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>URL:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_URL">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-primary close-modal-add-promo"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-add-promo').click(function() {
            $('#add-promo').modal('hide');
            $('.form-update-promo')[0].reset();  
        });      
    });

    // Start-End Datepicker
    // var startDate = new Date('01/01/2012');
    // var FromEndDate = new Date();
    // var ToEndDate = new Date();
    // ToEndDate.setDate(ToEndDate.getDate()+365);
    $('#datepicker_StartDate_Add').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker_EndDate_Add').datepicker('setStartDate', startDate);
    });
    $('#datepicker_EndDate_Add').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    // }).on('changeDate', function(selected){
    //     FromEndDate = new Date(selected.date.valueOf());
    //     FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
    //     $('.from_date').datepicker('setEndDate', FromEndDate);
    });

    // Jenis Promo Dropdown
    $(document).on('change','#dropdown_JenisPromo_Add',function(){
        // console.log($('#dropdown_JenisPromo_Add').val());
        if ($('#dropdown_JenisPromo_Add').val()=="Non-Promo"){
            $('#checkbox_TampilPeriodePromo_Add').show()
            document.getElementById("dropdown_PromoType_Add").removeAttribute("required");
            document.getElementById("currencymask_PromoAmount_Add").removeAttribute("required");
            document.getElementById("currencymask_PromoAmountRp_Add").removeAttribute("required");
            document.getElementById("currencymask_PromoAmountPr_Add").removeAttribute("required");
        }else{
            $('#checkbox_TampilPeriodePromo_Add').hide()
            document.getElementById("dropdown_PromoType_Add").setAttribute("required", "");
            document.getElementById("currencymask_PromoAmount_Add").setAttribute("required", "");
            document.getElementById("currencymask_PromoAmountRp_Add").setAttribute("required", "");
            document.getElementById("currencymask_PromoAmountPr_Add").setAttribute("required", "");
        }
    });

    // Promo Type Dropdown
    $(document).on('change','#dropdown_PromoType_Add',function(){
        console.log($('#dropdown_PromoType_Add').val());
        switch($('#dropdown_PromoType_Add').val()) {
            case "FIXED VALUE":
                $('#currencymask_PromoAmount_Add').hide()
                $('#currencymask_PromoAmountPr_Add').hide()
                $('#inputaddon_PromoAmountPr_Add').hide()

                $('#currencymask_PromoAmountRp_Add').show()
                $('#inputaddon_PromoAmountRp_Add').show()
                break;
            case "PERCENTAGE":
                $('#currencymask_PromoAmount_Add').hide()
                $('#currencymask_PromoAmountRp_Add').hide()
                $('#inputaddon_PromoAmountRp_Add').hide()

                $('#currencymask_PromoAmountPr_Add').show()
                $('#inputaddon_PromoAmountPr_Add').show()
                break;
            default:
                $('#currencymask_PromoAmountRp_Add').hide()
                $('#currencymask_PromoAmountPr_Add').hide()
                $('#inputaddon_PromoAmountRp_Add').hide()
                $('#inputaddon_PromoAmountPr_Add').hide()

                $('#currencymask_PromoAmount_Add').show()
        }
    });

    // Update Picture
    $(document).on('click','.update-picture',function(){
        $('#update-promo-picture-modal').modal();
    });
</Script>