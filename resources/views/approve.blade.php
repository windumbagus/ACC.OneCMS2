@extends('admin.admin') 


@section('approve', 'active')
@section('account-verification', 'active')


@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Approve List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Name, Username, Email or Mobile Phone" class="InputSearch form-control">
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
            <th>Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Mobile Phone</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($Approved as $Approve)

            <tr>  
                @if (property_exists($Approve->User, 'Name'))
                    <td><span>{{$Approve->User->Name}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Approve->User, 'Username'))
                    <td><span>{{$Approve->User->Username}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Approve->User, 'Email'))
                    <td><span>{{$Approve->User->Email}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Approve->User, 'MobilePhone'))
                    <td><span>{{$Approve->User->MobilePhone}}</span></td>
                    @else 
                    <td></td>
                    @endif
                <td>
                <span>
                    <a href="#" data-id="{{ $Approve->User->Id}}" class="view-approved btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
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
                null,
                null,
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

        //VIEW
        $(document).on('click','.view-approved',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/approve/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="approve_Name_view"]').val(val.User.Name);
                    $('[name="approve_Username_view"]').val(val.User.Username);
                    $('[name="approve_Email_view"]').val(val.User.Email);
                    $('[name="approve_MobilePhone_view"]').val(val.User.MobilePhone);
                    $('[name="approve_Last_Login_view"]').val(val.User.Last_Login);
                    $('[name="approve_Is_Active_view"]').val(val.User.Is_Active);
                    $('[name="approve_TanggalLahir_view"]').val(val.MstCustomerDetail.TanggalLahir);
                    $('[name="approve_Status_view"]').val(val.MstStatus.Label);
                    //StatusNoHP
                    if (val.MstCustomerDetail.hasOwnProperty('StatusNoHP')) {
                        $('[name="approve_StatusNoHP_view"]').val(val.MstCustomerDetail.StatusNoHP);   
                    }else{
                        $('[name="approve_StatusNoHP_view"]').val("False");        
                    }
                    // Subscribe
                    if (val.MstCustomerDetail.hasOwnProperty('Subscribe')) {
                        $('[name="approve_Subscribe_view"]').val(val.MstCustomerDetail.Subscribe);   
                    }else{
                        $('[name="approve_Subscribe_view"]').val("N");        
                    }

                    // FotoProfil
                    if (val.hasOwnProperty('FotoProfil_MstPicture')) {
                        if (val.FotoProfil_MstPicture.hasOwnProperty('Picture')) {
                            $('[name="approve_Profile_view"]').attr("src","data:image/jpeg;base64,"+val.FotoProfil_MstPicture.Picture);   
                        }else{
                            $('[name="approve_Profile_view"]').val("");        
                        }
                    }else{

                    }
                    
                    // FotoKTP
                    if (val.hasOwnProperty('FotoKTP_MstPictures')) {
                        if (val.FotoKTP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="approve_KTP_view"]').attr("src","data:image/jpeg;base64,"+val.FotoKTP_MstPictures.Picture);   
                        }else{
                            $('[name="approve_KTP_view"]').val("");        
                        }
                    }else{

                    }

                    // FotoNPWP
                    if (val.hasOwnProperty('FotoNPWP_MstPictures')) {
                        if (val.FotoNPWP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="approve_NPWP_view"]').attr("src","data:image/jpeg;base64,"+val.FotoNPWP_MstPictures.Picture);   
                        }else{
                            $('[name="approve_NPWP_view"]').val("");        
                        }
                    }else{

                    }

                    // FotoKK
                    if (val.hasOwnProperty('FotoKK_MstPictures')) {
                        if (val.FotoKK_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="approve_KK_view"]').attr("src","data:image/jpeg;base64,"+val.FotoKK_MstPictures.Picture);   
                        }else{
                            $('[name="approve_kk_view"]').val("");        
                        }
                    }else{

                    }

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-approve').modal();
        });

        
    })
</script>
@include('modal.view_approve')
@endsection 

