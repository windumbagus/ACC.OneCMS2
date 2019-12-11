@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit-detail', 'active')

@section('content')

<!-- TableSeamlessUnitDetail -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <div class="col-sm-8">
                  <h3 class="box-title">Product Details</h3>
              </div>
              <div class="col-sm-4">
                  <div class="col-sm-6">

                          <a href="{{ asset('seamless-product') }}" class="add-seamless-Product btn btn-block btn-primary">Back</a>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Picture
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                 
                        <table style="width:100%">
                        
                        <tr>
                            <th>Product Name</th>
                            <td> <span>@if( !empty($SeamlessProductPicts[0]->DESC_PRODUCT))
                                {{$SeamlessProductPicts[0]->DESC_PRODUCT}} 
                                @else
                                -
                                @endif
                            </span></td>
                         
                        </tr>
                        <tr>
                            <th>TNC</th>
                            <td> @if( !empty($SeamlessProductPicts[0]->TNC))
                            {!! $SeamlessProductPicts[0]->TNC !!} 
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td><span> @if( !empty($SeamlessProductPicts[0]->DESC_DETAIL))
                                {{$SeamlessProductPicts[0]->DESC_DETAIL}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>Picture</th>
                            <td><span> @if( !empty($SeamlessProductPicts[0]->PATH_FILE))
                            <img style="width: 100px; height: 100px;" alt=""
                                                    src="{{$SeamlessProductPicts[0]->PATH_FILE}}" />
                                @else
                                tidak ditemukan
                                @endif
                            </span></td>
                        </tr>
                        </table>
                    
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Detail
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-8">
                                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
                            </div>
                            <div class="col-sm-3">
                                <div class="col-sm-6">
                                    <a href="#" class="ButtonSearch1 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="ResetSearch1 btn btn-block btn-info">Reset</a>    
                                </div>
                            </div>
                        </div><br>

                        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Kode Cabang</th>
                           
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($SeamlessProductDetails as $SeamlessProductDetail)
                            <tr>  
                                <td><span>{{$SeamlessProductDetail->DESC_BRAND}}</span></td>
                                <td><span>{{$SeamlessProductDetail->DESC_TYPE}}</span></td>
                                <td><span>{{$SeamlessProductDetail->CD_SP}}</span></td>
                                
                            </tr>                              
                            @endforeach       
                        </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
        <!-- /.col -->



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
                
            ]
      })



        //Button Search
        $('.ButtonSearch1').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

    
        $('.ResetSearch1').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })


    })
  </script>

@endsection
