@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply-plafon', 'active')

@section('content')

<!-- TableACCCash -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">acccash Plafond List</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                   
                       
                </div>
                <div class="col-sm-6">
                <a href="{{asset('/acccash-apply-plafon/broadcast')}}" class="btn btn-block btn-primary">Broadcast</a>   
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           

            <div class="col-sm-8">
                <input type="text" placeholder="Search by Nama, Email, Plafond" class="InputSearch form-control">
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

            <th>Nama</th>
            <th>Email</th>
            <th>Plafond</th> 
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($ACCCashPlafonds as $ACCCashPlafond)
            <tr>

                <td><span>{{$ACCCashPlafond->NAME}}</span></td>
                <td><span>{{$ACCCashPlafond->EMAIL}}</span></td>
                <td><span>{{$ACCCashPlafond->PLAFOND}}</span></td>
                            
                
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
          'order': [[ 0, "desc" ]],
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
