<!-- Modal ADD -->
<div class="modal fade" id="update-user-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update User Mobile</h4> 
            </div>
            <form id="form-update-user-mobile" action="{{ asset('user-mobile/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Id" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Creation_Date" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Password" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="External_Id" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="LastLogin" readonly>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="Name" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="Username" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="Email" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone</label>
                        <input type="text" class="form-control" name="MobilePhone" readonly>
                    </div>
                    <div class="form-group">
                        <label>Last Login</label>
                        <input type="text" class="form-control" name="Last_Login" readonly>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="NIK" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="TanggalLahir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="Alamat" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="Status" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status No HP</label>
                        <input type="text" class="form-control" name="StatusNoHP" readonly>
                    </div>
                    <div class="form-group">
                        <label>Subscribe</label>
                        <input type="text" class="form-control" name="Subscribe" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" name="Pekerjaan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Flag Customer</label>
                        <input type="text" class="form-control" name="FlagCustomer" readonly>
                    </div>
                    <div class="form-group">
                        <label>Is Active</label><br>
                        <input type="checkbox" class="" name="Is_Active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal btn btn-default">Close</button>	
                    <button type="submit" class="btn btn-warning">Update</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal').click(function() {
            $('#update-user-mobile').modal('hide');
            $('#form-update-user-mobile')[0].reset();  
        });      
    });

  
</Script>
