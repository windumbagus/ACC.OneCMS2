
<div class="modal fade" id="modal_promo_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-modal-promo-update" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Promo</h4> 
            </div>
            <form id="form_promoModalUpdate_update" action="{{ asset('promo/update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf	

                    <div class="form-group" hidden>
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_User_Id" 
                            value="{{ session()->get('Id')}}">
                    </div>
                    <div class="form-group" hidden>
                        <label>Promo Id:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_MstPromo_Id" >
                    </div>
                    <div class="form-group" hidden>
                        <label>Order Name:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_MstPromo_OrderName" >
                    </div>
                    <div class="form-group" hidden>
                        <label>Added Date:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_MstPromo_AddedDate" >
                    </div>
                    <div class="form-group" hidden>
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_MstPromo_UserAdded" >
                    </div>

                    <div class="form-group">
                        <label>Jenis Promo</label>
                        <select class="form-control select2" style="width:100%;" 
                            name="updatePromo_MstPromo_JenisPromo" id="dropdown_promoModalUpdate_JenisPromo" required>

                            <!-- <option selected="selected" value="">Silahkan Pilih Jenis Promo</option> -->
                            <option value="1">
                                <a href="#" class="">Promo</a>
                            </option>
                            <option value="2">
                                <a href="#" class="">Non-Promo</a>
                            </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" name="updatePromo_MstPromo_Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea rows="10" cols="60"
                            type="text" class="form-control" name="updatePromo_MstPromo_Description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Active:</label><br>
                        <input type="checkbox" class="" value="true" name="updatePromo_MstPromo_IsActivePromo"
                            id="checkbox_promoModalUpdate_IsActivePromo">
                        <input type="text" name="updatePromo_MstPromo_IsActivePromo">
                    </div>

                    <div class="form-group">
                        <label>Is Active Banner:</label><br>
                        <input type="checkbox" class="" value="true" name="updatePromo_MstPromo_IsActiveBanner"
                            id="checkbox_promoModalUpdate_IsActiveBanner">
                        <input type="text" name="updatePromo_MstPromo_IsActiveBanner">
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="updatePromo_MstPicture_Picture" alt=""
                            id="placeholder_promoModalUpdate_picture"/><br>
                        File type : JPEG/PNG<br>
                        <input type="file" class="form-control" name="updatePromo_MstPicture" id="input_promoModalUpdate_picture">
                    </div>

                    <div class="form-group">
                        <label>Promo Code:</label><br>
                        <input type="text" class="form-control" name="updatePromo_MstPromo_PromoCode">
                    </div>

                    <div class="form-group">
                        <label>Promo Type:</label>
                        <select class="form-control select2" style="width:100%;" name="updatePromo_MstPromo_PromoType"
                            id="dropdown_promoModalUpdate_promoType" required>
                            
                            <!-- <option selected="selected" value="">Silahkan Pilih Tipe Promo</option> -->
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
                            <span class="input-group-addon" id="inputaddon_promoModalUpdate_PromoAmount">
                                <i class="fa fa-dollar"></i>
                            </span>
                            <span class="input-group-addon" id="inputaddon_promoModalUpdate_PromoAmountRp">Rp</span>
                            <input type="number" class="form-control" name="updatePromo_MstPromo_PromoAmount" 
                                id="currencymask_promoModalUpdate_PromoAmount" value="0" required>
                            <span class="input-group-addon" id="inputaddon_promoModalUpdate_PromoAmountPr">%</span>
                        </div>
                    </div>

                    <div class="form-group" id="checkbox_promoModalUpdate_TampilPeriodePromo">
                        <label>Tampilkan Periode Promo:</label><br>
                        <input type="checkbox" class="" value="true"
                            name="updatePromo_MstPromo_TampilPeriodePromo" id="checkbox_promoModalUpdate_TampilPeriodePromo">
                    </div>

                    <div class="form-group">
                        <label>Start Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalUpdate_StartDate" 
                                name="updatePromo_MstPromo_StartDate" value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>End Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalUpdate_EndDate" 
                                name="updatePromo_MstPromo_EndDate" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Syarat dan Ketentuan:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="updatePromo_MstPromo_SyaratDanKetentuan" 
                            id="textarea_promoModalUpdate_SyaratDanKetentuan" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL:</label><br>
                        <input type="text" class="form-control" name="updatePromo_MstPromo_URL">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"
                        onclick="return confirm('Are you sure want to update this data?')">Save</button>	
                    <button type="button" class="btn btn-primary close-modal-promo-update"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-promo-update').click(function() {
            $('#modal_promo_update').modal('hide');
            $('#form_promoModalUpdate_update')[0].reset();  
        });      
    });

    // Jenis Promo Dropdown
    $(document).on('change','#dropdown_promoModalUpdate_JenisPromo',function(){
        // console.log($('#dropdown_promoModalUpdate_JenisPromo').val());
        if ($('#dropdown_promoModalUpdate_JenisPromo').val()=="2"){
            $('#checkbox_promoModalUpdate_TampilPeriodePromo').show()

            document.getElementById("dropdown_promoModalUpdate_promoType").removeAttribute("required");
            document.getElementById("textarea_promoModalUpdate_SyaratDanKetentuan").removeAttribute("required");
        }else{
            $('#checkbox_promoModalUpdate_TampilPeriodePromo').hide()

            document.getElementById("dropdown_promoModalUpdate_promoType").setAttribute("required", "");
            document.getElementById("textarea_promoModalUpdate_SyaratDanKetentuan").setAttribute("required", "");
        }
    });

    // Promo Type Dropdown
    $(document).on('change','#dropdown_promoModalUpdate_promoType',function(){
        // console.log($('#dropdown_promoModalUpdate_promoType').val());
        switch($('#dropdown_promoModalUpdate_promoType').val()) {
            case "FIXED VALUE":
                $('#inputaddon_promoModalUpdate_PromoAmountPr').hide()
                $('#inputaddon_promoModalUpdate_PromoAmount').hide()
                $('#inputaddon_promoModalUpdate_PromoAmountRp').show()

                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("min", "0")
                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("max", "1000000000")
                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("step", "1")
                break;
            case "PERCENTAGE":
                $('#inputaddon_promoModalUpdate_PromoAmountRp').hide()
                $('#inputaddon_promoModalUpdate_PromoAmount').hide()
                $('#inputaddon_promoModalUpdate_PromoAmountPr').show()

                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("min", "0")
                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("max", "100")
                document.getElementById("currencymask_promoModalUpdate_PromoAmount").setAttribute("step", "0.01")
                break;
            default:
                $('#inputaddon_promoModalUpdate_PromoAmountRp').hide()
                $('#inputaddon_promoModalUpdate_PromoAmountPr').hide()
                $('#inputaddon_promoModalUpdate_PromoAmount').show()
                
                document.getElementById("textarea_promoModalUpdate_SyaratDanKetentuan").removeAttribute("min");
                document.getElementById("textarea_promoModalUpdate_SyaratDanKetentuan").removeAttribute("max");
                document.getElementById("textarea_promoModalUpdate_SyaratDanKetentuan").removeAttribute("step");
        }
    });

    // Start-End Datepicker
    // var startDate = new Date('01/01/2012');
    // var FromEndDate = new Date();
    // var ToEndDate = new Date();
    // ToEndDate.setDate(ToEndDate.getDate()+365);
    $('#datepicker_promoModalUpdate_StartDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepicker_promoModalUpdate_EndDate').datepicker('setStartDate', startDate);
    });
    $('#datepicker_promoModalUpdate_EndDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    // }).on('changeDate', function(selected){
    //     FromEndDate = new Date(selected.date.valueOf());
    //     FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
    //     $('.from_date').datepicker('setEndDate', FromEndDate);
    });

    $("#input_promoModalUpdate_picture").change(function() {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#placeholder_promoModalUpdate_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</Script>