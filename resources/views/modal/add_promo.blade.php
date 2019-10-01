
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
                        <input type="hidden" class="form-control" name="addPromo_MstPromo_UserAdded" 
                            value="{{ session()->get('Id') }}">
                    </div>
                    <div class="form-group" hidden>
                        <label>Promo Id:</label><br>
                        <input type="hidden" class="form-control" name="updatePromo_MstPromo_Id" value="">
                    </div>
                    <div class="form-group" hidden>
                        <label>Product Owner:</label><br>
                        <input type="hidden" class="form-control" name="addPromo_MstPromo_ProductOwner" value="ACC World">
                    </div>

                    <div class="form-group">
                        <label>Jenis Promo</label>
                        <select class="form-control select2" style="width:100%;" 
                            name="addPromo_MstPromo_JenisPromo" id="dropdown_promoModalAdd_JenisPromo" required>

                            <option selected="selected" value="">Silahkan Pilih Jenis Promo</option>
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
                        <input type="text" class="form-control" name="addPromo_MstPromo_Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea rows="10" cols="60"
                            type="text" class="form-control" name="addPromo_MstPromo_Description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Active:</label><br>
                        <input type="checkbox" class="" value="True" name="addPromo_MstPromo_IsActivePromo">
                    </div>

                    <div class="form-group">
                        <label>Is Active Banner:</label><br>
                        <input type="checkbox" class="" value="True" name="addPromo_MstPromo_IsActiveBanner">
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="addPromo_MstPicture_Picture" alt=""
                            id="placeholder_promoModalAdd_picture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="addPromo_MstPicture" id="input_promoModalAdd_picture" required>
                    </div>

                    <div class="form-group">
                        <label>Promo Code:</label><br>
                        <input type="text" class="form-control" name="addPromo_MstPromo_PromoCode">
                    </div>

                    <div class="form-group">
                        <label>Promo Type:</label>
                        <select class="form-control select2" style="width:100%;" name="addPromo_MstPromo_PromoType"
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
                            <span class="input-group-addon" id="inputaddon_promoModalAdd_PromoAmount">
                                <i class="fa fa-dollar"></i>
                            </span>
                            <span class="input-group-addon" id="inputaddon_promoModalAdd_PromoAmountRp">Rp</span>
                            <input type="number" class="form-control" name="addPromo_MstPromo_PromoAmount" 
                                id="currencymask_promoModalAdd_PromoAmount" value="0" required>
                            <span class="input-group-addon" id="inputaddon_promoModalAdd_PromoAmountPr">%</span>
                        </div>
                    </div>

                    <div class="form-group" id="div_promoModalAdd_TampilPeriodePromo">
                        <label>Tampilkan Periode Promo:</label><br>
                        <input type="checkbox" class="" value="True" checked
                            name="addPromo_MstPromo_TampilPeriodePromo">
                    </div>

                    <div class="form-group">
                        <label>Start Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalAdd_StartDate" 
                                name="addPromo_MstPromo_StartDate" value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>End Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="datepicker_promoModalAdd_EndDate" 
                                name="addPromo_MstPromo_EndDate" value="{{ date('d/m/Y') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Syarat dan Ketentuan:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="addPromo_MstPromo_SyaratDanKetentuan" 
                            id="textarea_promoModalAdd_SyaratDanKetentuan" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL:</label><br>
                        <input type="text" class="form-control" name="addPromo_MstPromo_URL">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-warning close-modal-promo-add"
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
        if ($('#dropdown_promoModalAdd_JenisPromo').val()=="2"){
            document.getElementById("div_promoModalAdd_TampilPeriodePromo").removeAttribute("hidden");
            document.getElementById("dropdown_promoModalAdd_promoType").removeAttribute("required");
            document.getElementById("textarea_promoModalAdd_SyaratDanKetentuan").removeAttribute("required");
        }else{
            document.getElementById("div_promoModalAdd_TampilPeriodePromo").setAttribute("hidden", "");
            document.getElementById("dropdown_promoModalAdd_promoType").setAttribute("required", "");
            document.getElementById("textarea_promoModalAdd_SyaratDanKetentuan").setAttribute("required", "");
        }
    });

    // Promo Type Dropdown
    $(document).on('change','#dropdown_promoModalAdd_promoType',function(){
        // console.log($('#dropdown_promoModalAdd_promoType').val());
        switch($('#dropdown_promoModalAdd_promoType').val()) {
            case "FIXED VALUE":
                $('#inputaddon_promoModalAdd_PromoAmountPr').hide()
                $('#inputaddon_promoModalAdd_PromoAmount').hide()
                $('#inputaddon_promoModalAdd_PromoAmountRp').show()

                document.getElementById("currencymask_promoModalAdd_PromoAmount").setAttribute("min", "0")
                document.getElementById("currencymask_promoModalAdd_PromoAmount").setAttribute("max", "1000000000")
                break;
            case "PERCENTAGE":
                $('#inputaddon_promoModalAdd_PromoAmountRp').hide()
                $('#inputaddon_promoModalAdd_PromoAmount').hide()
                $('#inputaddon_promoModalAdd_PromoAmountPr').show()

                document.getElementById("currencymask_promoModalAdd_PromoAmount").setAttribute("min", "0")
                document.getElementById("currencymask_promoModalAdd_PromoAmount").setAttribute("max", "100")
                break;
            default:
                $('#inputaddon_promoModalAdd_PromoAmountRp').hide()
                $('#inputaddon_promoModalAdd_PromoAmountPr').hide()
                $('#inputaddon_promoModalAdd_PromoAmount').show()
                
                document.getElementById("currencymask_promoModalAdd_PromoAmount").removeAttribute("min");
                document.getElementById("currencymask_promoModalAdd_PromoAmount").removeAttribute("max");
                document.getElementById("currencymask_promoModalAdd_PromoAmount").removeAttribute("step");
        }
    });

    // Start-End Datepicker
    $('#datepicker_promoModalAdd_StartDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: '01/01/' + new Date().getFullYear(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        $('#datepicker_promoModalAdd_EndDate').datepicker('setStartDate', startDate);
        if (startDate > $('#datepicker_promoModalAdd_EndDate').datepicker('getDate')) {
            $('#datepicker_promoModalAdd_EndDate').datepicker('setDate', startDate);
        }
    });
    $('#datepicker_promoModalAdd_EndDate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        startDate: new Date(),
        endDate: '31/12/' + (new Date().getFullYear() + 1)
    }).on('changeDate', function(selected){
        EndDate = new Date(selected.date.valueOf());
        $('#datepicker_promoModalAdd_StartDate').datepicker('setEndDate', EndDate);
    });

    // Promo Picture
    $("#input_promoModalAdd_picture").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_promoModalAdd_picture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }

</Script>