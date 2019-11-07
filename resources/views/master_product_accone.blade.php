@extends('admin.admin') 

@section('master-management', 'active')
@section('master-product-accone', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-7">
                <h3 class="box-title">Master Product AccOne</h3>
            </div>
            <div class="col-sm-5">
                @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                    <a href="{{asset('/master-product-accone/deleteAll')}}" class="btn btn-block btn-danger" 
                        onclick="return confirm('Are you sure want to delete this ?')">Delete All</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>CD Product</th>
                <th>Desc Product</th>
                <th>CD Area</th>
                <th>CD SP</th>
                <th>CD Brand</th>
                <th>CD Type</th>
                <th>CD Model</th>
                <th>DP</th>
                <th>Tenor</th>
                <th>AMT Installment</th>
                <th>AMT OTR</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($ProductsAccOne as $ProductAccOne)

                    <tr>  
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_PRODUCT}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->DESC_PRODUCT}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_AREA}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_SP}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_BRAND}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_TYPE}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->CD_MODEL}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->DP}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->TENOR}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->AMT_INSTALLMENT}}</span></td>
                        <td><span>{{$ProductAccOne->MstProductAccone->AMT_OTR}}</span></td>                        
                        <td>
                            <span>
                                <a href="#" data-id="{{$ProductAccOne->MstProductAccone->Id}}" 
                                    class="view-master-product-accone btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                            </span>
                        </td>
                    </tr>                  
                @endforeach       
            </tbody>
        </table>
        <br>

        @if ((property_exists($Role,'IsCreate')) && ($Role->IsCreate == True))
            <form id="form-add-master-kota" action="{{ asset('master-product-accone/upload') }}" method="post" 
                enctype="multipart/form-data"> 
                @csrf
                <label>Upload Excel</label>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_master_product_accone"  >
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>		
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
 </div>

 <!-- page script -->
<script>
    $(document).ready(function () {
      $('#example1').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
        //   sDom: 'lrtip', 
        //   "columns": [
        //         {"searchable":false},                
        //         null,
        //         {"searchable":false},                
        //         {"searchable":false},               
        //         {"searchable":false},
        //     ]
      })


        //VIEW
        $(document).on('click','.view-master-product-accone',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-product-accone/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="view_ProductAccOne_CD_PRODUCT"]').val(val.MstProductAccone.CD_PRODUCT);
                    $('[name="view_ProductAccOne_DESC_PRODUCT"]').val(val.MstProductAccone.DESC_PRODUCT);
                    $('[name="view_ProductAccOne_CD_AREA"]').val(val.MstProductAccone.CD_AREA);
                    $('[name="view_ProductAccOne_CD_SP"]').val(val.MstProductAccone.CD_SP);
                    $('[name="view_ProductAccOne_CD_BRAND"]').val(val.MstProductAccone.CD_BRAND);
                    $('[name="view_ProductAccOne_CD_TYPE"]').val(val.MstProductAccone.CD_TYPE);
                    $('[name="view_ProductAccOne_CD_MODEL"]').val(val.MstProductAccone.CD_MODEL);
                    $('[name="view_ProductAccOne_DP"]').val(val.MstProductAccone.DP);
                    $('[name="view_ProductAccOne_TENOR"]').val(val.MstProductAccone.TENOR);
                    $('[name="view_ProductAccOne_AMT_INSTALLMENT"]').val(val.MstProductAccone.AMT_INSTALLMENT);
                    $('[name="view_ProductAccOne_AMT_OTR"]').val(val.MstProductAccone.AMT_OTR);
                    $('[name="view_ProductAccOne_FLAG_INSURANCE"]').val(val.MstProductAccone.FLAG_INSURANCE);
                    $('[name="view_ProductAccOne_FLAG_ACP"]').val(val.MstProductAccone.FLAG_ACP);
                    $('[name="view_ProductAccOne_AMC_TDP"]').val(val.MstProductAccone.AMT_TDP);
                    $('[name="view_ProductAccOne_AMT_TOTAL_INSTALLMENT"]').val(val.MstProductAccone.AMT_TOTAL_INSTALLMENT);
                    
                    if (val.MstProductAccone.hasOwnProperty('DT_START')) {
                        $('[name="view_ProductAccOne_DT_START"]').val(val.MstProductAccone.DT_START);   
                    }
                    
                    if (val.MstProductAccone.hasOwnProperty('DT_END')) {
                        $('[name="view_ProductAccOne_DT_END"]').val(val.MstProductAccone.DT_END);   
                    }

                    if (val.MstProductAccone.hasOwnProperty('DT_ADDED')) {
                        $('[name="view_ProductAccOne_DT_ADDED"]').val(val.MstProductAccone.DT_ADDED);   
                    }
                    
                    if (val.MstProductAccone.hasOwnProperty('DT_UPDATED')) {
                        $('[name="view_ProductAccOne_DT_UPDATED"]').val(val.MstProductAccone.DT_UPDATED);   
                    }

                    $('[name="view_ProductAccOne_DESC_BRAND"]').val(val.MstProductAccone.DESC_BRAND);

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
            $('#view-master-product-accone').modal();
        });
    })
</script>
@include('modal.view_master_product_accone')
@endsection