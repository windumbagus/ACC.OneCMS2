@extends('admin.admin') 

@section('customer', 'active')
@section('bank-account', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Customer</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Nama Bank, No Rekening or Nama Rekening" class="InputSearch form-control">
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
            <th>Nama</th>
            <th>Nama Bank</th>
            <th>No Rekening</th>
            <th>Nama Rekening</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Customers as $Customer)

            <tr>  
                <td><span>{{$Customer->User->Name}}</span></td>
                <td><span>{{$Customer->MstGCM->CharDesc1}}</span></td>
                <td><span>{{$Customer->MstBankAccountCustomer->NoRekening}}</span></td>
                <td><span>{{$Customer->MstBankAccountCustomer->NamaRekening}}</span></td>
                {{-- @if (property_exists($Customer->MstCustomerDetail, 'Reason'))
                <td><span>{{$Customer->MstCustomerDetail->Reason}}</span></td>
                @else 
                <td></td>
                @endif --}}
                <td>
                <span>
                    <a href="#" data-id="{{ $Customer->User->Id}}" class="view-rejected btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
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
                {"searchable":false},                
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