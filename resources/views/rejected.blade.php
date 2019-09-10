@extends('admin.admin') 


@section('rejected', 'active')
@section('account-verification', 'active')


@section('content')

<!-- TableUserCMS -->
 <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Rejected List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Name, Username, or Mobile Phone" class="InputSearch form-control">
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
            <th>Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Mobile Phone</th>
            <th>Reason</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Rejected as $Reject)

            <tr>  
                <td><span>{{$Reject->User->Name}}</span></td>
                <td><span>{{$Reject->User->Username}}</span></td>
                <td><span>{{$Reject->User->Email}}</span></td>
                <td><span>{{$Reject->User->MobilePhone}}</span></td>
                @if (property_exists($Reject->MstCustomerDetail, 'Reason'))
                <td><span>{{$Reject->MstCustomerDetail->Reason}}</span></td>
                @else 
                <td></td>
                @endif
                <td>
                <span>
                    <a href="#" data-id="{{ $Reject->User->Id}}" class="update-rejected btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
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

        
        
    })
  </script>
  
@endsection 

