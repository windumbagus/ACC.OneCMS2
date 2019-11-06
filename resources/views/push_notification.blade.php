@extends('admin.admin') 

@section('push-notification', 'active')
@section('content-management', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Push Notification</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-9">
                <input type="text" placeholder="Search by Message, User, or Code Push Notif" class="InputSearch form-control">
            </div>
            <div class="col-sm-3">
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
                    <th>Message</th>
                    <th>User</th>
                    <th>Created Date</th>
                    <th>Code Push Notif</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Push_Notifications as $Push_Notification)
                <tr>  
                    @if (property_exists($Push_Notification->MplNotifikasiUser, 'Message'))
                        <td><span>{{$Push_Notification->MplNotifikasiUser->Message}}</span></td>
                    @else 
                        <td></td>
                    @endif

                    @if (property_exists($Push_Notification, 'User_Name'))
                        <td><span>{{$Push_Notification->User_Name}}</span></td>
                    @else 
                        <td></td>
                    @endif

                    @if (property_exists($Push_Notification->MplNotifikasiUser, 'CreatedDate'))
                        <td><span>{{$Push_Notification->MplNotifikasiUser->CreatedDate}}</span></td>
                    @else 
                        <td></td>
                    @endif

                    @if (property_exists($Push_Notification->MplNotifikasiUser, 'CodePushNotif'))
                        <td><span>{{$Push_Notification->MplNotifikasiUser->CodePushNotif}}</span></td>
                    @else 
                        
                    @endif
                    
                    <td>
                        <span>
                            @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                                <a href="#" data-id="{{ $Push_Notification->MplNotifikasiUser->Id }}" 
                                    class="pushnotification_updateonclick btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                </a>
                            @endif
                            
                            @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                                <a href="{{asset('push-notification/delete/'.$Push_Notification->MplNotifikasiUser->Id)}}" 
                                    class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')" >
                                    <i class="fa fa-trash"></i>
                                </a> 
                            @endif
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
                {"searchable":false},
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
        $(document).on('click','.pushnotification_updateonclick',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/push-notification/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="push_notification_Message_update_data"]').val(val.Message);
                    $('[name="push_notification_CodePushNotif_update_data"]').val(val.CodePushNotif);
                    $('[name="push_notification_CreatedDate_update_data"]').val(val.CreatedDate);

                    $('[name="push_notification_Id_update_data"]').val(val.Id);
                    $('[name="push_notification_UserId_update_data"]').val(val.UserId);
                    $('[name="push_notification_ProductOwner_update_data"]').val(val.ProductOwner);
                    
                    if (val.hasOwnProperty('InvoiceId')) {
                        $('[name="push_notification_InvoiceId_update_data"]').val(val.InvoiceId);   
                    }else{
                        $('[name="push_notification_InvoiceId_update_data"]').val("0");        
                    }

                    if (val.hasOwnProperty('HasNewPushNotif')) {
                        $('[name="push_notification_HasNewPushNotif_update_data"]').val(val.HasNewPushNotif);   
                    }else{
                        $('[name="push_notification_HasNewPushNotif_update_data"]').val("false");        
                    }

                    if (val.hasOwnProperty('DataId')) {
                        $('[name="push_notification_DataId_update_data"]').val(val.DataId);   
                    }else{
                        $('[name="push_notification_DataId_update_data"]').val("0");        
                    }

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown );
                console.log(textStatus);
                },
            });
            $('#push_notification_update_modal').modal();
        });        
    })

</script>

@include('modal.update_push_notification')
@endsection 



