@extends('admin.admin') 

@section('survey', 'active')
@section('feedback', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Role Management</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="sync-role-management btn btn-block btn-primary">Sync</a>
                </div>
                <div class="col-sm-6">
                    <a href="#" class="add-role-management btn btn-block btn-primary">Create New Role</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Star or User" class="InputSearch form-control">
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
                <th>Role Name</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($Roles as $Role)
                    <tr>  
                        <td><span>{{$Role->RoleName}}</span></td>
                        <td>
                            <span>
                                <a href="#" data-id="{{ $Role->Id}}" class="update-role-management btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('setting-role-management')}}" data-id="{{ $Role->Id}}" class="btn btn-info btn-sm"><i class="fa fa-gear"></i></a> &nbsp; 
                                <a href="{{asset('role-management/delete/'.$Role->Id)}}" class=" btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure want to delete this data?')" ><i class="fa fa-trash"></i>
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
                null,
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
        $(document).on('click','.add-role-management',function(){
            $('#add-role-management').modal();
        });

        //VIEW
        $(document).on('click','.update-role-management',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/role-management/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="role_name_update"]').val(val.MstRole.RoleName);           
                    $('[name="Id"]').val(val.MstRole.Id);           
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown);
                console.log(textStatus);
                },
            });
            $('#update-role-management').modal();
        });
        
    })
</script>
@include('modal.add_role_management')
@include('modal.update_role_management')
@endsection