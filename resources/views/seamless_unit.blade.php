@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit', 'active')

@section('content')

<!-- TableSeamlessUnit -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Unit</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                        <a href="{{asset('/seamless-unit/upload-page')}}" class="btn btn-block btn-primary">Upload</a>
                       
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
            <th>Unit Id</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Model</th>
            <th>Year</th>
            <th>Date Added</th>
            <th>Type Machine</th>
            <th>Machine Capacity</th>
            <th>Transmission</th>
            <th>New / Used</th>
            <th>Is Active</th>           
            <th>Action</th>      
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessUnits as $SeamlessUnit)
            <tr>  
                <td><span>{{$SeamlessUnit->GUID}}</span></td>
                <td><span>{{$SeamlessUnit->DESC_BRAND}}</span></td>
                <td><span>{{$SeamlessUnit->DESC_TYPE}}</span></td>
                <td><span>{{$SeamlessUnit->DESC_MODEL}}</span></td>
                <td><span>{{$SeamlessUnit->TAHUN}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessUnit->DT_ADDED))}}</span></td>          
                <td><span>{{$SeamlessUnit->TYPE_MACHINE}}</span></td>
                <td><span>{{$SeamlessUnit->MACHINE_CAPACITY}}</span></td>
                <td><span>{{$SeamlessUnit->TRANSMISSION}}</span></td>
                <td><span>{{$SeamlessUnit->FLAG_NEWUSED}}</span></td>
                <td><span>{{$SeamlessUnit->FLAG_ACTIVE}}</span></td>
                <td><span> 
                <a href="{{ asset('/seamless-unit-detail/'.$SeamlessUnit->GUID) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                <a href="{{ asset('/seamless-unit-update/'.$SeamlessUnit->GUID) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 
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
                null,                
                null,
                null,
                {"searchable":false},
                {"searchable":false},
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
    
        
    })
  </script>
@endsection
