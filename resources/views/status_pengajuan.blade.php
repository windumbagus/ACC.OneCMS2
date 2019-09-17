@extends('admin.admin') 

@section('service', 'active')
@section('status-pengajuan', 'active')

@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Status Pengajuan Aplikasi</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name or Raegistration Number" class="InputSearch form-control">
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
                    <th>Registration Number</th>
                    <th>Registration Name</th>
                    <th>Brand</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Status_pengajuans as $Status_Pengajuan)
                <tr>  
                    <td><span>{{$Status_Pengajuan->User_Name}}</span></td>
                    <td><span>{{$Status_Pengajuan->MstStatusPengajuan->RegistrationNo}}</span></td>
                    <td><span>{{$Status_Pengajuan->MstStatusPengajuan->Name}}</span></td>

                    @if (property_exists($Status_Pengajuan->MstStatusPengajuan, 'Brand'))
                        <td><span>{{$Status_Pengajuan->MstStatusPengajuan->Brand}}</span></td>
                    @else
                        <td></td>
                    @endif

                    @if (property_exists($Status_Pengajuan->MstStatusPengajuan, 'Type'))
                        <td><span>{{$Status_Pengajuan->MstStatusPengajuan->Type}}</span></td>
                    @else
                        <td></td>
                    @endif
                    
                    <td>
                        <span>
                            <a href="#" data-id="{{ $Status_Pengajuan->MstStatusPengajuan->Id }}" class="view-status-pengajuan 
                                btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                            <a href="{{asset('status-pengajuan-aplikasi/delete/'.$Status_Pengajuan->MstStatusPengajuan->Id)}}" 
                                class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')" >
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
            'deferRender' : true,
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
                {"searchable":false},
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

        // VIEW
        $(document).on('click','.view-status-pengajuan',function(){
            var id = $(this).attr('data-id');
            console.log(id);

            $.ajax({
                url:"{{asset('/status-pengajuan-aplikasi/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="status_pengajuan_User_name_data"]').val(val.User_Name);
                    $('[name="status_pengajuan_Id_data"]').val(val.MstStatusPengajuan.Id);
                    $('[name="status_pengajuan_RegistrationNo_data"]').val(val.MstStatusPengajuan.RegistrationNo);
                    $('[name="status_pengajuan_Name_data"]').val(val.MstStatusPengajuan.Name);
                    $('[name="status_pengajuan_Type_data"]').val(val.MstStatusPengajuan.Type);
                    $('[name="status_pengajuan_Model_data"]').val(val.MstStatusPengajuan.Model);
                    $('[name="status_pengajuan_Kind_data"]').val(val.MstStatusPengajuan.Kind);
                    $('[name="status_pengajuan_BranchName_data"]').val(val.MstStatusPengajuan.BranchName);
                    $('[name="status_pengajuan_SoName_data"]').val(val.MstStatusPengajuan.SoName);
                    $('[name="status_pengajuan_SoPhoneNo_data"]').val(val.MstStatusPengajuan.SoPhoneNo);
                    $('[name="status_pengajuan_Tenor_data"]').val(val.MstStatusPengajuan.Tenor);
                    $('[name="status_pengajuan_AmountInstallment_data"]').val(val.MstStatusPengajuan.AmountInstallment);
                    $('[name="status_pengajuan_ProspectID_data"]').val(val.MstStatusPengajuan.ProspectID);
                    $('[name="status_pengajuan_UserId_data"]').val(val.MstStatusPengajuan.UserId);
                    $('[name="status_pengajuan_Status_data"]').val(val.MstStatusPengajuan.Status);

                    document.getElementById('view-status-data').setAttribute('data-id2',val.MstStatusPengajuan.Id);

                    if (val.MstStatusPengajuan.hasOwnProperty('Brand')) {
                        $('[name="status_pengajuan_Brand_data"]').val(val.MstStatusPengajuan.Brand);   
                    }else{
                        $('[name="status_pengajuan_Brand_data"]').val("");        
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-status-pengajuan').modal();
        });
        
    })
</script>

@include('modal.view_status_pengajuan')
@endsection