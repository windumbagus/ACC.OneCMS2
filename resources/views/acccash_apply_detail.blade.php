@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')

<!-- TableACCCashLog -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">ACCCash Log</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                       
                </div>
                <div class="col-sm-6">
                      
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           

            <div class="col-sm-8">
                <input type="text" placeholder="Search by Status or Date Added" class="InputSearch form-control">
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
            <th>Status</th>
            <th>Date Added</th>       
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($AccCashApplyDetails as $AccCashApplyDetails)
            <tr>  
                <td><span>{{$AccCashApplyDetails->STATUS}}</span></td>
                <td><span>{{$AccCashApplyDetails->DT_ADDED}}</span></td>              
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

    })
  </script>
@endsection
