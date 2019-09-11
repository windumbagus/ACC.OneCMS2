@extends('admin.admin') 

@section('rejected', 'active')
@section('account-verification', 'active')

@section('content')

<!-- TableUserCMS -->
 <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Rejected List</h3>
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
            <th>Reason</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Rejected as $Reject)

            <tr>  
                <td><span>{{$Reject->User->Name}}</span></td>
                <td><span>{{$Reject->User->Username}}</span></td>
                <td><span>{{$Reject->User->Email}}</span></td>
                <td><span>{{$Reject->User->MobilePhone}}</span></td>
                @if (property_exists($Reject->MstCustomerDetail, 'Reason'))
                <td><span>{{$Reject->MstCustomerDetail->Reason}}</span></td>
                @else 
                <td></td>
                @endif
                <td>
                <span>
                    <a href="#" data-id="{{ $Reject->User->Id}}" class="view-rejected btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
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
        $(document).on('click','.view-rejected',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/rejected/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="rejected_Name_view"]').val(val.User.Name);
                    $('[name="rejected_Username_view"]').val(val.User.Username);
                    $('[name="rejected_Email_view"]').val(val.User.Email);
                    $('[name="rejected_MobilePhone_view"]').val(val.User.MobilePhone);
                    $('[name="rejected_Last_Login_view"]').val(val.User.Last_Login);
                    $('[name="rejected_Is_Active_view"]').val(val.User.Is_Active);
                    $('[name="rejected_TanggalLahir_view"]').val(val.MstCustomerDetail.TanggalLahir);
                    $('[name="rejected_Status_view"]').val(val.MstStatus.Label);
                    //StatusNoHP
                    if (val.MstCustomerDetail.hasOwnProperty('StatusNoHP')) {
                        $('[name="rejected_StatusNoHP_view"]').val(val.MstCustomerDetail.StatusNoHP);   
                    }else{
                        $('[name="rejected_StatusNoHP_view"]').val("False");        
                    }
                    // Subscribe
                    if (val.MstCustomerDetail.hasOwnProperty('Subscribe')) {
                        $('[name="rejected_Subscribe_view"]').val(val.MstCustomerDetail.Subscribe);   
                    }else{
                        $('[name="rejected_Subscribe_view"]').val("N");        
                    }

                     // FotoProfil
                     if (val.FotoProfil_MstPicture.hasOwnProperty('Picture')) {
                        $('[name="rejected_Profile_view"]').attr("src","data:image/jpeg;base64,"+val.FotoProfil_MstPicture.Picture);   
                    }else{
                        $('[name="rejected_Profile_view"]').val("");        
                    }

                    // FotoKTP
                    if (val.hasOwnProperty('FotoKTP_MstPictures')) {
                        if (val.FotoKTP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="rejected_KTP_view"]').attr("src","data:image/jpeg;base64,"+val.FotoKTP_MstPictures.Picture);   
                        }else{
                            $('[name="rejected_KTP_view"]').val("");        
                        }
                    }else{

                    }

                    // FotoNPWP
                    if (val.hasOwnProperty('FotoNPWP_MstPictures')) {
                        if (val.FotoNPWP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="rejected_NPWP_view"]').attr("src","data:image/jpeg;base64,"+val.FotoNPWP_MstPictures.Picture);   
                        }else{
                            $('[name="rejected_NPWP_view"]').val("");        
                        }
                    }else{

                    }

                    // FotoKK
                    if (val.hasOwnProperty('FotoKK_MstPictures')) {
                        if (val.FotoKK_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="rejected_KK_view"]').attr("src","data:image/jpeg;base64,"+val.FotoKK_MstPictures.Picture);   
                        }else{
                            $('[name="rejected_kk_view"]').val("");        
                        }
                    }else{

                    }

                    $('[name="rejected_Reason_view"]').val(val.MstCustomerDetail.Reason);
                    // foto NPWP
                    // FOTO KK
                    // FOTO ktp
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-rejected').modal();
        });

        
    })
  </script>
  @include('modal.view_rejected')
@endsection 

