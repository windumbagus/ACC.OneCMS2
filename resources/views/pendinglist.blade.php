@extends('admin.admin') 

@section('pending', 'active')
@section('account-verification', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Pending List</h3>
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

                @foreach ($Pendings as $Pending)
                <tr>  
                    @if (property_exists($Pending->User, 'Name'))
                    <td><span>{{$Pending->User->Name}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'Username'))
                    <td><span>{{$Pending->User->Username}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'Email'))
                    <td><span>{{$Pending->User->Email}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'MobilePhone'))
                    <td><span>{{$Pending->User->MobilePhone}}</span></td>
                    @else 
                    <td></td>
                    @endif
                    
                    <td>
                        <span>
                            <!-- button update -->
                            <a href="#" data-userid="{{ $Pending->User->Id }}" class="pendinglist_updateonclick btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
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
                null,
                null,
                null,
                {"searchable":false},
            ]
      })

        //Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })

        //Update
        $(document).on('click','.pendinglist_updateonclick',function(){
            var id = $(this).attr('datauser-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/pendinglist/update')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    // FotoProfil
                    if (val.hasOwnProperty('FotoKTP_MstPictures')) {
                        if (val.FotoProfil_MstPicture.hasOwnProperty('Picture')) {
                            $('[name="pendinglist_Profile_update_data"]').attr("src","data:image/jpeg;base64,"+val.FotoProfil_MstPicture.Picture);   
                        }else{
                            $('[name="pendinglist_Profile_update_data"]').val("");  
                        }      
                    }else{
                    
                    }

                    $('[name="pendinglist_Name_update_data"]').val(val.User.Name);
                    $('[name="pendinglist_Username_update_data"]').val(val.User.Username);
                    $('[name="pendinglist_Email_update_data"]').val(val.User.Email);
                    $('[name="pendinglist_MobilePhone_update_data"]').val(val.User.MobilePhone);
                    $('[name="pendinglist_Last_Login_update_data"]').val(val.User.Last_Login);
                    $('[name="pendinglist_Is_Active_update_data"]').val(val.User.Is_Active);
                    $('[name="pendinglist_TanggalLahir_update_data"]').val(val.MstCustomerDetail.TanggalLahir);
                    $('[name="pendinglist_Status_update_data"]').val(val.MstStatus.Label);
                    //StatusNoHP
                    if (val.MstCustomerDetail.hasOwnProperty('StatusNoHP')) {
                        $('[name="pendinglist_StatusNoHP_update_data"]').val(val.MstCustomerDetail.StatusNoHP);   
                    }else{
                        $('[name="pendinglist_StatusNoHP_update_data"]').val("False");        
                    }
                    // Subscribe
                    if (val.MstCustomerDetail.hasOwnProperty('Subscribe')) {
                        $('[name="pendinglist_Subscribe_update_data"]').val(val.MstCustomerDetail.Subscribe);   
                    }else{
                        $('[name="pendinglist_Subscribe_update_data"]').val("N");        
                    }

                    // FotoKTP
                    if (val.hasOwnProperty('FotoKTP_MstPictures')) {
                        if (val.FotoKTP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="pendinglist_KTP_update_data"]').attr("src","data:image/jpeg;base64,"+val.FotoKTP_MstPictures.Picture);   
                        }else{
                            $('[name="pendinglist_KTP_update_data"]').val("");        
                        }
                    }else{
                    
                    }

                    // FotoNPWP
                    if (val.hasOwnProperty('FotoNPWP_MstPictures')) {
                        if (val.FotoNPWP_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="pendinglist_NPWP_update_data"]').attr("src","data:image/jpeg;base64,"+val.FotoNPWP_MstPictures.Picture);   
                        }else{
                            $('[name="pendinglist_NPWP_update_data"]').val("");        
                        }
                    }else{

                    }

                    // FotoKK
                    if (val.hasOwnProperty('FotoKK_MstPictures')) {
                        if (val.FotoKK_MstPictures.hasOwnProperty('Picture')) {
                            $('[name="pendinglist_KK_update_data"]').attr("src","data:image/jpeg;base64,"+val.FotoKK_MstPictures.Picture);   
                        }else{
                            $('[name="pendinglist_KK_update_data"]').val("");        
                        }
                    }else{

                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown );
                console.log(textStatus);
                },
            });
            $('#pendinglist_update_modal').modal();
        });        
    })
  </script>
  @include('modal.pendinglist_update')
@endsection 



