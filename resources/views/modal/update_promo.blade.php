
<div class="modal fade" id="update-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Promo</h4> 
            </div>
            <form id="form-update-promo" action="#" method="post">
                <div class="modal-body"> 
                    @csrf	

                    <div class="form-group">
                        <label>Jenis Promo</label>
                        <select class="form-control select2" style="width:100%;" name="promo_MstPromo_PromoType">
                            
                            <option selected="selected" value="">Silahkan Pilih Jenis Promo</option>
                            <option value="Promo">
                                <a href="#" data-promotype="Promo" class="update-jenispromo">Promo</a>
                            </option>
                            <option value="Non-Promo">
                                <a href="#" data-promotype="Non-Promo" class="update-jenispromo">Non-Promo</a>
                            </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_Name">
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea id="editor1" name="editor1" rows="10" cols="60"
                        type="text" class="form-control" name="promo_MstPromo_Description"></textarea>
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
                        <button type="button" class="update-picture btn btn-success">Upload Picture</button>
                    </div>

                    <div class="form-group">
                        <label>Promo Code:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_PromoCode">
                    </div>

                    <div class="form-group">
                        <label>Promo Type:</label>
                        <select class="form-control select2" style="width:100%;" name="promo_MstPromo_PromoType">
                            
                            <option selected="selected" value="">Silahkan Pilih Tipe Promo</option>
                            @foreach ($PromoTypes as $PromoTypeDropdown)
                                <option value="{{ $PromoTypeDropdown }}">
                                    <a href="#" data-promotype="{{ $PromoTypeDropdown }}" class="update-promotype">
                                        {{$PromoTypeDropdown}}
                                    </a>
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Promo Amount:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_PromoAmount">
                    </div>

                    <div class="form-group">
                        <label>Start Date:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_StartDate">
                    </div>

                    <div class="form-group">
                        <label>End Date:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_EndDate">
                    </div>
                    
                    <div class="form-group">
                        <label>Syarat dan Ketentuan:</label><br>
                        <textarea id="editor1" name="editor1" rows="10" cols="60"
                        type="text" class="form-control" name="promo_MstPromo_SyaratDanKetentuan"></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL:</label><br>
                        <input type="text" class="form-control" name="promo_MstPromo_URL">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"
                        onclick="return confirm('Are you sure want to update this data?')">Save</button>	
                    <button type="button" class="btn btn-primary" id="close-modal-update-promo">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-update-promo').click(function() {
            $('#update-promo').modal('hide');
            $('#form-update-promo')[0].reset();  
        });      
    });

    $(document).on('click','.update-picture',function(){
        $('#update-promo-picture-modal').modal();
    });
</Script>