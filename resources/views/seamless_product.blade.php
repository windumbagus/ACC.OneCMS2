@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-product', 'active')

@section('content')

<!-- TableSeamlessProduct -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Product</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                        <a href="#" class="add-seamless-Product btn btn-block btn-primary">Create New</a>
                </div>
                <!-- <div class="col-sm-6">
                        <a href="{{asset('/acccash-apply/download')}}" class="btn btn-block btn-primary">Download</a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
          
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
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

        <table id="example2" class="table table-bordered display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Kode Produk</th>
            <th>Deskripsi</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>      
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessProducts as $SeamlessProduct)
            <tr>  
                <td><span>{{$SeamlessProduct->CD_PRODUCT}}</span></td>
                <td><span>{{$SeamlessProduct->DESC_PRODUCT}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessProduct->DT_START))}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessProduct->DT_END))}}</span></td>
                <td><span><a href="{{ asset('seamless-product-detail/'.$SeamlessProduct->CD_PRODUCT) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> </span></td>
                
            
            </tr>                              
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    $(document).ready(function () {
      $('#example2').DataTable({
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
            var dtable = $('#example2').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example2').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })

      
  // //VIEW
     $(document).on('click','.view-seamless-product',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/seamless-product/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="ID_UNIT"]').val(val.OUT_DATA[0].ID_UNIT);
                    $('[name="CATEGORY"]').val(val.OUT_DATA[0].CATEGORY);
                    $('[name="CHAR_VALUE"]').val(val.OUT_DATA[0].CHAR_VALUE);
                    $('[name="CHAR_DESC"]').val(val.OUT_DATA[0].CHAR_DESC);
                    $('[name="DT_ADDED"]').val(val.OUT_DATA[0].DT_ADDED);
                    $('[name="ID_USER_ADDED"]').val(val.OUT_DATA[0].ID_USER_ADDED);
                    $('[name="DT_UPDATED"]').val(val.OUT_DATA[0].DT_UPDATED);
                    $('[name="ID_USER_UPDATED"]').val(val.OUT_DATA[0].ID_USER_UPDATED);
                  
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-seamless-product-detail-popup').modal();
        });
        
    })
  </script>

@include('modal.view_seamless_product_detail')
@endsection
