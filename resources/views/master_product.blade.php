@extends('admin.admin') 

@section('master-product', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Master Product</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                <a href="{{asset('/master-product/sync-api-product')}}" class="btn btn-block btn-primary">Sync API to Product</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Product Name or Product Code" class="InputSearch form-control">
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
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Products as $Product)

            <tr>  
                <td><span>{{$Product->ProductCode}}</span></td>
                <td><span>{{$Product->ProductName}}</span></td>
                <td><span>{{$Product->Description}}</span></td>
                <td>
                <span>
                    <a href="#" data-id="{{ $Product->Id}}" class="update-master-product btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
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
        $(document).on('click','.update-master-product',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-product/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="Id"]').val(val.MstProduct.Id);
                    $('[name="MstPictureId"]').val(val.MstProduct.MstPictureId);
                    $('[name="IdPicture"]').val(val.MstPicture.Id);
                    $('[name="DataId"]').val(val.MstPicture.DataId);
                    $('[name="ProductCode"]').val(val.MstProduct.ProductCode);
                    $('[name="ProductName"]').val(val.MstProduct.ProductName);
                    $('[name="Description"]').val(val.MstProduct.Description);
                    $('[name="MappingAnswerCharValue"]').val(val.MstProduct.MappingAnswerCharValue);
                    $('[name="MappingAnswerDesc"]').val(val.MstProduct.MappingAnswerDesc);
                    $('[name="Picture"]').attr("src","data:image/jpeg;base64,"+val.MstPicture.Picture); 

                    if (val.MstProduct.hasOwnProperty('Pernyataan1')) {
                    $('[name="Pernyataan1"]').val(val.MstProduct.Pernyataan1);
                    }

                    if (val.MstProduct.hasOwnProperty('Pernyataan2')) {
                    $('[name="Pernyataan2"]').val(val.MstProduct.Pernyataan2);
                    }

                    if (val.MstProduct.hasOwnProperty('Pernyataan3')) {
                    $('[name="Pernyataan3"]').val(val.MstProduct.Pernyataan3);
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-master-product').modal();
        });
        
    })
  </script>

@include('modal.update_master_product')
@endsection