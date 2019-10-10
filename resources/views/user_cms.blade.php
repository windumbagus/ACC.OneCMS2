@extends('admin.admin') 

@section('user-cms', 'active')
@section('user-management', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">User CMS</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="add-user-cms btn btn-block btn-primary">Create a New User</a>
                </div>
                <div class="col-sm-6">
                    <a href="{{asset('/user-cms/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name, Username or Mobile Phone" class="InputSearch form-control">
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="ResetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Mobile Phone</th>
            <th>Is Active</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($UserCMSs as $UserCMS)
            <tr>  
                <td><span>{{$UserCMS->User->Id}}</span></td>
                <td><span>{{$UserCMS->User->Name}}</span></td>
                <td><span>{{$UserCMS->User->Username}}</span></td>
                <td><span>{{$UserCMS->User->Email}}</span></td>          
                <td><span>{{$UserCMS->User->MobilePhone}}</span></td>

                @if (property_exists($UserCMS->User, 'Is_Active'))
                    @if($UserCMS->User->Is_Active == true)
                        <td><span><i class="fa fa-check" style="color:green;"></i></span></td>
                    @else
                        <td><span><i class="fa fa-close" style="color:red;"></i></span></td>
                    @endif
                @else 
                <td>-</td>
                @endif
                            
                <td>
                <span>
                    <a href="#" data-id="{{ $UserCMS->User->Id}}" class="update-user-cms btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp;
                    <a href="{{asset('user-cms/delete/'.$UserCMS->User->Id)}}" 
                        class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this User ?')" >
                        <i class="fa fa-trash"></i>
                    </a> 
                </span>
                </td>
            </tr>                              
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    $(document).ready(function () {
      $('#example1').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                {"searchable":false},
                null,
                null,
                {"searchable":false},
                null,
                {"searchable":false},
                {"searchable":false},
            ]
      })

        //Button Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })


        // ADD
        $(document).on('click','.add-user-cms',function(){
            $('#add-user-cms').modal();
        });

        //VIEW
        $(document).on('click','.update-user-cms',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/user-cms/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    // $('[name="Id"]').val(val.User.Id);
                    // $('[name="Creation_Date"]').val(val.User.Creation_Date);
                    // $('[name="Password"]').val(val.User.Password);
                    // $('[name="External_Id"]').val(val.User.External_Id);
                    
                    // $('[name="Name"]').val(val.User.Name);
                    // $('[name="Username"]').val(val.User.Username);
                    // $('[name="Email"]').val(val.User.Email);
                    // $('[name="MobilePhone"]').val(val.User.MobilePhone);
                    // $('[name="Last_Login"]').val(new Date(val.User.Last_Login).toLocaleDateString());
                    // $('[name="LastLogin"]').val(val.User.Last_Login);
                    // $('[name="NIK"]').val(val.MstCustomerDetail.NIK);

                    // if (val.MstCustomerDetail.hasOwnProperty('TanggalLahir')) {
                    //     $('[name="TanggalLahir"]').val(new Date(val.MstCustomerDetail.TanggalLahir).toLocaleDateString());   
                    // }else{
                    //     $('[name="TanggalLahir"]').val("-");        
                    // }

                    // $('[name="Alamat"]').val(val.MstCustomerDetail.Alamat);

                    // if (val.hasOwnProperty('MstStatus')) {
                    //     if (val.MstStatus.hasOwnProperty('Label')) {
                    //         $('[name="Status"]').val(val.MstStatus.Label);   
                    //     }else{
                    //         $('[name="Status"]').val("");        
                    //     }
                    // }

                    // if (val.MstCustomerDetail.hasOwnProperty('StatusNoHP')) {
                    //     $('[name="StatusNoHP"]').val(val.MstCustomerDetail.StatusNoHP);   
                    // }else{
                    //     $('[name="StatusNoHP"]').val("False");        
                    // }

                    // if (val.MstCustomerDetail.hasOwnProperty('Subscribe')) {
                    //     $('[name="Subscribe"]').val(val.MstCustomerDetail.Subscribe);   
                    // }else{
                    //     $('[name="Subscribe"]').val("N");        
                    // }

                    // $('[name="Pekerjaan"]').val(val.MstCustomerDetail.Job);
                    
                    // $('[name="FlagCustomer"]').val(val.MstCustomerDetail.FlagCustomer);

                    // if (val.User.hasOwnProperty('Is_Active')) {
                    //     if(val.User.Is_Active == true){
                    //         $('[name="Is_Active"]').attr('checked', true);
                    //     }else{
                    //         $('[name="Is_Active"]').attr('checked', false);                            
                    //     }
                    // }

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-user-cms').modal();
        });


        
    })
  </script>

@include('modal.add_user_cms')
@include('modal.update_user_cms')
@endsection
