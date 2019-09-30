
<div class="modal fade" id="modal_promo_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-modal-promo-add" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Promo</h4> 
            </div>
            <form id="form_promoModalAdd_add" action="{{ asset('promo/add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf	

                    <div class="form-group" hidden>
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="promo_User_Id" 
                            value="{{ session()->get('Id')}}">
                    </div>

                    <div class="form-group">
                        <label>Jenis Promo</label>
                        <select class="form-control select2" style="width:100%;" 
                            name="promo_MstPromo_JenisPromo" id="dropdown_promoModalAdd_JenisPromo" required>
                            
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
                        <textarea rows="10" cols="60"
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
                        <img style="width: 300px; height: 200px;" name="promo_MstPicture_Picture" alt=""
                            id="placeholder_promoModalAdd_picture"/><br>
                        File type : JPEG/PNG<br>
                        <input type="file" class="form-control" name="promo_MstPicture" id="input_promoModalAdd_picture">
                    </div>

                    <div class="form-group">
                        <label>Promo Code:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_PromoCode">
                    </div>

                    <div class="form-group">
                        <label>Promo Type:</label>
                        <select class="form-control select2" style="width:100%;" name="promo_MstPromo_PromoType"
                            id="dropdown_promoModalAdd_promoType" required>
                            
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
                            <span class="input-group-addon" id="inputaddon_promoModalAdd_PromoAmountRp">Rp</span>
                            <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_promoModalAdd_PromoAmountRp"
                                min="0.00" step="1" max="1000000000" value="0" required>
                            <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_promoModalAdd_PromoAmountPr"
                                min="0.00" step="0.01" max="100" value="0" required>
                            <span class="input-group-addon" id="inputaddon_promoModalAdd_PromoAmountPr">%</span>
                        </div>
                        <input type="number" class="form-control" name="promo_MstPromo_PromoAmount" id="currencymask_promoModalAddPromoAmount"
                            min="0" value="0" required>
                    </div>

                    <div class="form-group" id="checkbox_promoModalAdd_TampilPeriodePromo">
                        <label>Tampilkan Periode Promo:</label><br>
                        <input type="checkbox" class="" name="promo_MstPromo_TampilPeriodePromo">
                    </div>

                    <div class="form-group">
                        <label>Start Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalAdd_StartDate" 
                                name="promo_MstPromo_StartDate"value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>End Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalAdd_EndDate" 
                                name="promo_MstPromo_EndDate" value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Syarat dan Ketentuan:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="promo_MstPromo_SyaratDanKetentuan" 
                            id="textarea_promoModalAdd_SyaratDanKetentuan" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_URL">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-primary close-modal-promo-add"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-promo-add').click(function() {
            $('#modal_promo_add').modal('hide');
            $('#form_promoModalAdd_add')[0].reset();  
        });      
    });

    // Jenis Promo Dropdown
    $(document).on('change','#dropdown_promoModalAdd_JenisPromo',function(){
        // console.log($('#dropdown_promoModalAdd_JenisPromo').val());
        if ($('#dropdown_promoModalAdd_JenisPromo').val()=="Non-Promo"){
            $('#checkbox_promoModalAdd_TampilPeriodePromo').show()

            document.getElementById("dropdown_promoModalAdd_promoType").removeAttribute("required");
            document.getElementById("currencymask_promoModalAddPromoAmount").removeAttribute("required");
            document.getElementById("currencymask_promoModalAdd_PromoAmountRp").removeAttribute("required");
            document.getElementById("currencymask_promoModalAdd_PromoAmountPr").removeAttribute("required");
            document.getElementById("textarea_promoModalAdd_SyaratDanKetentuan").removeAttribute("required");
        }else{
            $('#checkbox_promoModalAdd_TampilPeriodePromo').hide()

            document.getElementById("dropdown_promoModalAdd_promoType").setAttribute("required", "");
            document.getElementById("currencymask_promoModalAddPromoAmount").setAttribute("required", "");
            document.getElementById("currencymask_promoModalAdd_PromoAmountRp").setAttribute("required", "");
            document.getElementById("currencymask_promoModalAdd_PromoAmountPr").setAttribute("required", "");
            document.getElementById("textarea_promoModalAdd_SyaratDanKetentuan").setAttribute("required", "");
        }
    });

    // Promo Type Dropdown
    $(document).on('change','#dropdown_promoModalAdd_promoType',function(){
        console.log($('#dropdown_promoModalAdd_promoType').val());
        switch($('#dropdown_promoModalAdd_promoType').val()) {
            case "FIXED VALUE":
                $('#currencymask_promoModalAddPromoAmount').hide()
                $('#currencymask_promoModalAdd_PromoAmountPr').hide()
                $('#inputaddon_promoModalAdd_PromoAmountPr').hide()

                $('#currencymask_promoModalAdd_PromoAmountRp').show()
                $('#inputaddon_promoModalAdd_PromoAmountRp').show()
                break;
            case "PERCENTAGE":
                $('#currencymask_promoModalAddPromoAmount').hide()
                $('#currencymask_promoModalAdd_PromoAmountRp').hide()
                $('#inputaddon_promoModalAdd_PromoAmountRp').hide()

                $('#currencymask_promoModalAdd_PromoAmountPr').show()
                $('#inputaddon_promoModalAdd_PromoAmountPr').show()
                break;
            default:
                $('#currencymask_promoModalAdd_PromoAmountRp').hide()
                $('#currencymask_promoModalAdd_PromoAmountPr').hide()
                $('#inputaddon_promoModalAdd_PromoAmountRp').hide()
                $('#inputaddon_promoModalAdd_PromoAmountPr').hide()

                $('#currencymask_promoModalAddPromoAmount').show()
        }
    });

    // Start-End Datepicker
    // var startDate = new Date('01/01/2012');
    // var FromEndDate = new Date();
    // var ToEndDate = new Date();
    // ToEndDate.setDate(ToEndDate.getDate()+365);
    $('#datepicker_promoModalAdd_StartDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker_promoModalAdd_EndDate').datepicker('setStartDate', startDate);
    });
    $('#datepicker_promoModalAdd_EndDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    // }).on('changeDate', function(selected){
    //     FromEndDate = new Date(selected.date.valueOf());
    //     FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
    //     $('.from_date').datepicker('setEndDate', FromEndDate);
    });

    $("#input_promoModalAdd_picture").change(function() {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#placeholder_promoModalAdd_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</Script>