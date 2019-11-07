@extends('admin.admin') 

@section('master-management', 'active')
@section('master-otr', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">Master OTR</h3>
            </div>
            <div class="col-sm-6">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <div class="col-sm-3 pull-right">
                        <a href="{{asset('/master-otr/download')}}" class="btn btn-block btn-primary">Download</a>
                    </div>
                @endif
                @if ((property_exists($Role,'IsCreate')) && ($Role->IsCreate == True))
                    <div class="col-sm-3 pull-right">
                        <a href="{{route('master-otr/upload-page')}}" class="btn btn-block btn-primary">Upload</a>
                    </div>
                    <div class="col-sm-6 pull-right">
                        <a href="#" class="add-master-otr btn btn-block btn-primary">Create New Master OTR</a>  
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Brand, Type, Model, Tahun dan OTR" class="InputSearch form-control">
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
                <th>Brand</th>
                <th>Type</th>
                <th>Model</th>
                <th>New/Used</th>
                <th>Tahun</th>
                <th>OTR</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($OTRs as $otr)
                    <tr>  
                        <td>
                            @if (property_exists($otr->MstOtr, 'CD_BRAND'))
                            <span style="font-size:12px">{{$otr->MstOtr->CD_BRAND}}</span><br>
                            @else
                            <span>-</span><br>
                            @endif

                            @if (property_exists($otr->MstOtr, 'DESC_BRAND'))
                            <span>{{$otr->MstOtr->DESC_BRAND}}</span><br>
                            @else
                            <span>-</span>
                            @endif
                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_BRAND}}</span><br>
                            <span>{{$otr->MstOtr->DESC_BRAND}}</span> --}}
                        </td>
                        <td>
                            @if (property_exists($otr->MstOtr, 'CD_TYPE'))
                            <span style="font-size:12px">{{$otr->MstOtr->CD_TYPE}}</span><br>
                            @else
                            <span>-</span><br>
                            @endif

                            @if (property_exists($otr->MstOtr, 'DESC_TYPE'))
                            <span>{{$otr->MstOtr->DESC_TYPE}}</span><br>
                            @else
                            <span>-</span>
                            @endif

                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_TYPE}}</span><br>
                            <span>{{$otr->MstOtr->DESC_TYPE}}</span> --}}
                        </td>
                        <td>
                                @if (property_exists($otr->MstOtr, 'CD_MODEL'))
                                <span style="font-size:12px">{{$otr->MstOtr->CD_MODEL}}</span><br>
                                @else
                                <span>-</span><br>
                                @endif
    
                                @if (property_exists($otr->MstOtr, 'DESC_MODEL'))
                                <span>{{$otr->MstOtr->DESC_MODEL}}</span><br>
                                @else
                                <span>-</span>
                                @endif
                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_MODEL}}</span><br>
                            <span>{{$otr->MstOtr->DESC_MODEL}}</span> --}}
                        </td>

                        @if (property_exists($otr->MstOtr, 'FLAG_NEW_USED'))
                            @if($otr->MstOtr->FLAG_NEW_USED == "N")
                            <td><span>New</span></td>
                            @else
                            <td><span>Used</span></td>
                            @endif
                        @else
                        <td><span>-</span></td>
                        @endif

                        @if (property_exists($otr->MstOtr, 'TAHUN'))
                        <td><span>{{$otr->MstOtr->TAHUN}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif

                        @if (property_exists($otr->MstOtr, 'OTR'))
                            <td><span>{{ "Rp " . number_format($otr->MstOtr->OTR,2,',','.')}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif
                                               
                        <td>
                            <span>
                                @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                                    <a href="#" data-id="{{$otr->MstOtr->Id}}" data-brand="{{$otr->MstOtr->DESC_BRAND}}" 
                                        data-type="{{$otr->MstOtr->DESC_TYPE}}" class="update-master-otr btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a> &nbsp; 
                                @else
                                    <a href="#" data-id="{{$otr->MstOtr->Id}}" data-brand="{{$otr->MstOtr->DESC_BRAND}}" 
                                        data-type="{{$otr->MstOtr->DESC_TYPE}}" class="update-master-otr btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a> &nbsp;
                                @endif
                                @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                                    <a href="{{asset('master-otr/delete/'.$otr->MstOtr->Id)}}" class=" btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure want to delete this data?')" >
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
        
      $('#RedirectToScreenAdd').hide()
      $('#RedirectToScreenUpdate').hide()

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
                {"searchable":false},                
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

        //ADD
        $(document).on('click','.add-master-otr',function(){
        $('#add-master-otr').modal();     
        });
        
        //Upload
        // $(document).on('click','.upload-master-otr',function(){
        // $('#upload-master-otr').modal();     
        // });

        // get by id to modal
        $(document).on('click','.update-master-otr',function(){
            var id = $(this).attr('data-id');
            var Brand = $(this).attr('data-Brand');
            var Type = $(this).attr('data-Type');

            console.log(Type);
            $.ajax({
                url:"{{asset('/master-otr/show')}}",
                data: {'Id':id ,'Brand':Brand,'Type':Type,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (data){
                    console.log(data);

                    $('#DESC_TYPE_master_otr_update').empty()
                    $('#DESC_TYPE_master_otr_update').append('<option value="" selected disabled>-</option>')
                    if(data.Type != null)  {                    
                         data.Type.map(d=>{ 
                            $('#DESC_TYPE_master_otr_update').append('<option cd-type="'+d.CD_TYPE+'" value="'+d.DESC_TYPE+'">'+d.DESC_TYPE+'</option>')
                        })
                    }
                    $('#DESC_MODEL_master_otr_update').empty()
                    $('#DESC_MODEL_master_otr_update').append('<option value="" selected disabled>-</option>')
                    if(data.Model != null)  {
                        data.Model.map(d=>{
                            $('#DESC_MODEL_master_otr_update').append('<option cd-model="'+d.CD_MODEL+'" value="'+d.DESC_MODEL+'">'+d.DESC_MODEL+'</option>')
                        })
                    }

                    $('[name="Id_master_otr_update"]').val(data.GetMstOtrById.Id);
                    $('[name="CD_AREA_master_otr_update"]').val(data.GetMstOtrById.CD_AREA);
                    $('[name="CD_BRAND_master_otr_update"]').val(data.GetMstOtrById.CD_BRAND);
                    $('[name="CD_SP_master_otr_update"]').val(data.GetMstOtrById.CD_SP);
                    $('[name="CD_TYPE_master_otr_update"]').val(data.GetMstOtrById.CD_TYPE);
                    $('[name="DESC_BRAND_master_otr_update"]').val(data.GetMstOtrById.DESC_BRAND);
                    $('[name="DESC_TYPE_master_otr_update"]').val(data.GetMstOtrById.DESC_TYPE);
                    $('[name="OTR_master_otr_update"]').val(data.GetMstOtrById.OTR);
                    $('[name="TAHUN_master_otr_update"]').val(data.GetMstOtrById.TAHUN);

                    if (data.GetMstOtrById.hasOwnProperty('DESC_MODEL')) {
                    $('[name="DESC_MODEL_master_otr_update"]').val(data.GetMstOtrById.DESC_MODEL);
                    }

                    if (data.GetMstOtrById.hasOwnProperty('CD_MODEL')) {
                    $('[name="CD_MODEL_master_otr_update"]').val(data.GetMstOtrById.CD_MODEL);
                    }
                    if (data.GetMstOtrById.hasOwnProperty('DEVIASI')) {
                        $('[name="DEVIASI_master_otr_update"]').val(data.GetMstOtrById.DEVIASI);   
                    }
                    
                    if (data.GetMstOtrById.FLAG_ACTIVE == "Y"){
                    $('[name="IS_ACTIVE_master_otr_update"]').attr('checked', true);
                    }else{
                    $('[name="IS_ACTIVE_master_otr_update"]').attr('checked', false);
                    }

                    if (data.GetMstOtrById.FLAG_NEW_USED == "N"){
                    $('[name="IS_NEW_master_otr_update"]').attr('checked', true);
                    }else{
                    $('[name="IS_NEW_master_otr_update"]').attr('checked', false);
                    }
                    
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown);
                console.log(textStatus);
                },
            });
            $('#update-master-otr').modal();
        });
        
    })
</script>
@include('modal.add_master_otr')
@include('modal.update_master_otr')
{{-- @include('modal.upload_master_otr') --}}
@endsection