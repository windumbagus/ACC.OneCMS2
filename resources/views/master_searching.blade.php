@extends('admin.admin') 

@section('master-management', 'active')
@section('master-searching', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-7">
                <h3 class="box-title">Master Searching</h3>
            </div>
            <div class="col-sm-5">
                <div class="col-sm-8">
                    <a href="#" class="add-master-searching btn btn-block btn-primary">Create New Master GCM Searching</a>  
                </div>
                <div class="col-sm-4">
                <a href="{{asset('/master-searching/upload')}}" class="btn btn-block btn-primary">Upload</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Suggestion" class="InputSearch form-control">
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
                <th>Input Keywoard</th>
                <th>Search Suggestions</th>
                <th>Destination</th>
                <th>Redirect to Screen</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($Searching as $Search)

                    <tr>  
                        <td><span>{{$Search->MstSearch->Input_Keyword}}</span></td>
                        <td><span>{{$Search->MstSearch->Search_Suggestions}}</span></td>
                        <td><span>{{$Search->MstSearch->Destination}}</span></td>
                        @if (property_exists($Search->MstSearch, 'RedirectToScreen'))
                            <td><span>{{$Search->MstSearch->RedirectToScreen}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif
                                               
                        <td>
                            <span>
                                <a href="#" data-id="{{$Search->MstSearch->Id}}" class="update-master-searching btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('master-searching/delete/'.$Search->MstSearch->Id)}}" class=" btn btn-danger btn-sm" 
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
                {"searchable":false},                
                null,
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

        //ADD
        $(document).on('click','.add-master-searching',function(){
        // $('#add-master-searching').modal();     
        });

        //VIEW
        $(document).on('click','.update-master-searching',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-kota/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    // $('[name="CD_CITY_master_kota_update"]').val(val.MstCity.CD_CITY);
                    // $('[name="CITY_master_kota_update"]').val(val.MstCity.CITY);

                    // if (val.MstCity.FLAG_ACTIVE == "Y") {
                    // $('[name="FLAG_ACTIVE_master_kota_update"]').attr('checked', true);
                    // }else{
                    // $('[name="FLAG_ACTIVE_master_kota_update"]').attr('checked', false);
                    // }

                    // if (val.MstCity.FLAG_TRANSFER == "Y") {
                    // $('[name="FLAG_TRANSFER_master_kota_update"]').attr('checked', true);
                    // }else{
                    // $('[name="FLAG_TRANSFER_master_kota_update"]').attr('checked', false);
                    // }

                    // $('[name="DT_TRANSFER_master_kota_update"]').val(val.MstCity.DT_TRANSFER);
                    // $('[name="DT_UPLOADED_master_kota_update"]').val(val.MstCity.DT_UPLOADED);
                    // $('[name="CD_SP_master_kota_update"]').val(val.MstCity.CD_SP);
                    // $('[name="CD_SP_COLL_master_kota_update"]').val(val.MstCity.CD_SP_COLL);
                    // $('[name="AREA_CODE_master_kota_update"]').val(val.MstCity.AREA_CODE);
                    
                    // if (val.MstCity.FLAG_SUB_AREA_CODE == "Y") {
                    // $('[name="FLAG_SUB_AREA_CODE_master_kota_update"]').attr('checked', true);
                    // }else{
                    // $('[name="FLAG_SUB_AREA_CODE_master_kota_update"]').attr('checked', false);
                    // }

                    // $('[name="CD_PROVINSI_master_kota_update"]').val(val.MstCity.CD_PROVINSI);

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown);
                console.log(textStatus);
                },
            });
            // $('#update-master-searching').modal();
        });
        
    })
</script>
{{-- @include('modal.add_master_searching') --}}
{{-- @include('modal.update_master_searching') --}}
@endsection