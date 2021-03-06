<!-- Modal UPDATE -->
<div class="modal fade" id="update-user-cms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                    <h4 class="box-title">Update New User CMS</h4> 
                @else 
                    <h4 class="box-title">View New User CMS</h4>                 
                @endif
            </div>
            <form id="form-update-user-cms" action="{{ asset('user-cms/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Id_update" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="IdUserDetail_update" >
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Creation_Date_update" >
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="Name_update" >
                    </div>
                    <div class="form-group">
                        <label>Username </label>
                        <input type="text" class="form-control" name="Username_update" readonly>
                    </div>
                    <div class="form-group">
                        <label>Password </label>
                        <input type="password" class="form-control" name="Password_update" readonly>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password </label>
                        <input type="password" class="form-control" name="Confirm_Password_update" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input type="text" class="form-control" name="Email_update" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone </label>
                        <input type="text" class="form-control" name="MobilePhone_update" >
                    </div>
                    <div class="form-group">
                        <label>Is Active </label><br>
                        <input type="checkbox" class="" name="Is_Active_update" >
                    </div>
                    <div class="form-group">
                        <label>User Category</label>
                        <select name="User_Category_update" id="User_Category_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($UserCategories as $UserCategory)
                                <option value="{{$UserCategory}}">{{$UserCategory}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Organization</label>
                        <input type="text" class="form-control" name="Organization_update" >
                    </div>
                    <div class="form-group">
                        <label>NPK</label>
                        <input type="text" class="form-control" name="NPK_update" >
                    </div>
                    <div class="form-group">
                        <label>Expired Date</label>
                        <input type="date" class="form-control" name="Expired_Date_update" >
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="Address_update" >
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="Role_update" id="Role_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Roles as $Role)
                                <option value="{{$Role->Id}}">{{$Role->RoleName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-update btn btn-default" >Close</button>	
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        <button type="submit" class="btn btn-warning">Update</button>		
                    @endif
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-update').click(function() {
            $('#update-user-cms').modal('hide');
            $('#form-update-user-cms')[0].reset();  
        });      
    });

</Script>
