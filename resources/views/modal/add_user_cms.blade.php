<!-- Modal ADD -->
<div class="modal fade" id="add-user-cms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-add close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New User CMS</h4> 
            </div>
            <form id="form-add-user-cms" action="{{ asset('user-cms/add') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="Name_add" required>
                    </div>
                    <div class="form-group">
                        <label>Username </label>
                        <input type="text" class="form-control" name="Username_add" required>
                    </div>
                    <div class="form-group">
                        <label>Password </label><br>
                        <span id='message_pass'></span>
                        <input type="password" class="form-control" name="Password_add" id="Password_add"  onkeyup='check();'required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password </label><br>
                        <span id='message_confirm_pass'></span>
                        <input type="password" class="form-control" name="Confirm_Password_add" id="Confirm_Password_add"  onkeyup='check();' required>
                    </div>
                    <div class="form-group">
                        <label>Email </label>
                        <input type="text" class="form-control" name="Email_add" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone </label>
                        <input type="text" class="form-control" name="MobilePhone_add" required>
                    </div>
                    <div class="form-group">
                        <label>Is Active </label><br>
                        <input type="checkbox" class="" name="Is_Active_add" >
                    </div>
                    <div class="form-group">
                        <label>User Category</label>
                        <select name="User_Category_add" id="User_Category_add" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($UserCategories as $UserCategory)
                                <option value="{{$UserCategory}}">{{$UserCategory}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Organization</label>
                        <input type="text" class="form-control" name="Organization_add" required>
                    </div>
                    <div class="form-group">
                        <label>NPK</label>
                        <input type="text" class="form-control" name="NPK_add" required>
                    </div>
                    <div class="form-group">
                        <label>Expired Date</label>
                    <input type="date" class="form-control" name="Expired_Date_add" value="{{date("Y-m-d")}}" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="Address_add" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="Role_add" id="Role_add" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Roles as $Role)
                                <option value="{{$Role->Id}}">{{$Role->RoleName}}</option>
                            @endforeach
                        </select>
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
            $('#add-user-cms').modal('hide');
            $('#form-add-user-cms')[0].reset();  
        });      
    });

    //confirm pass check
    var check = function() {
        if (document.getElementById('Password_add').value == document.getElementById('Confirm_Password_add').value && document.getElementById('Password_add').value != "") {
            document.getElementById('message_confirm_pass').style.color = 'green';
            document.getElementById('message_confirm_pass').innerHTML = 'Password Matching';
        }else if (document.getElementById('Password_add').value == "") {
            document.getElementById('message_pass').style.color = 'red';
            document.getElementById('message_pass').innerHTML = 'Password Required';
            document.getElementById('message_confirm_pass').innerHTML = '';
        }else{
            document.getElementById('message_pass').innerHTML = '';
            document.getElementById('message_confirm_pass').style.color = 'red';
            document.getElementById('message_confirm_pass').innerHTML = 'Password Not Matching';
        }
    }

</Script>
