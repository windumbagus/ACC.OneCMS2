@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-diskon', 'active')

@section('content')

<!-- TableSeamlessDiskon -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Master Discount</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                <a href="{{asset('/seamless-diskon-create')}}" class="btn btn-block btn-primary">Create New</a>
<!-- 
                        <a href="#" class="add-seamless-Product btn btn-block btn-primary">Create New</a> -->
                </div>
                <!-- <div class="col-sm-6">
                        
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
            <th>Id Unit</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Model</th>
            <th>Tahun</th>
            <th>Diskon</th>
            <th>Action</th>

            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessDiskons as $SeamlessDiskon)
            <tr>  
                <td><span>{{$SeamlessDiskon->ID_UNIT}}</span></td>
                <td><span>{{$SeamlessDiskon->DESC_BRAND}}</span></td>
                <td><span>{{$SeamlessDiskon->DESC_TYPE}}</span></td>
                <td><span>{{$SeamlessDiskon->DESC_MODEL}}</span></td>
                <td><span>{{$SeamlessDiskon->YEAR}}</span></td>
                <td><span>{{number_format($SeamlessDiskon->DISCOUNT, 0, ',', '.')}}</span></td>
                <td><span>
                <a href="{{asset('/seamless-diskon-update/'.$SeamlessDiskon->GUID)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 
                <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></button> -->
                
                <a href="{{asset('/seamless-diskon/delete/'.$SeamlessDiskon->GUID)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></a>
                </span></td>
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

      

        
    })
  </script>

@endsection
