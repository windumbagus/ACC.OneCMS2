@extends('admin.admin') 


@section('pending', 'active')
@section('account-verification', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Pending List</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name, Username, Email or Mobile Phone" class="InputSearch form-control">
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
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($Pendings as $Pending)
                <tr>  
                    @if (property_exists($Pending->User, 'Name'))
                    <td><span>{{$Pending->User->Name}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'Username'))
                    <td><span>{{$Pending->User->Username}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'Email'))
                    <td><span>{{$Pending->User->Email}}</span></td>
                    @else 
                    <td></td>
                    @endif

                    @if (property_exists($Pending->User, 'MobilePhone'))
                    <td><span>{{$Pending->User->MobilePhone}}</span></td>
                    @else 
                    <td></td>
                    @endif
                    
                    <td>
                        <span>
                            <!-- button update -->
                            <a href="#" data-id="{{ $Pending->User->Id }}" class="update-rejected btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
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



