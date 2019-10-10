@extends('admin.admin') 

@section('customer', 'active')
@section('bank-account', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Customer</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                <a href="{{asset('/customer/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
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
                @if (property_exists($Customer->User, 'Name'))
                    <td><span>{{$Customer->User->Name}}</span></td>
                @else 
                    <td></td>
                @endif
                {{-- <td><span>{{$Customer->User->Name}}</span></td> --}}
                <td><span>{{$Customer->MstGCM->CharDesc1}}</span></td>
                <td><span>{{$Customer->MstBankAccountCustomer->NoRekening}}</span></td>
                <td><span>{{$Customer->MstBankAccountCustomer->NamaRekening}}</span></td>

                <td>
                <span>
                    <a href="#" data-id="{{ $Customer->MstBankAccountCustomer->Id}}" class="update-customer btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                    <a  href="{{asset('customer/delete/'.$Customer->MstBankAccountCustomer->Id)}}" 
                        data-id2="{{ $Customer->MstBankAccountCustomer->Id}}" class=" btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure want to delete this ?')" ><i class="fa fa-trash"></i>
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

        //VIEW
        $(document).on('click','.update-customer',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/customer/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="customer_Id_update"]').val(val.MstBankAccountCustomer.Id);
                    $('[name="customer_UserId_update"]').val(val.MstBankAccountCustomer.UserId);
                    $('[name="customer_GCMId_update"]').val(val.MstBankAccountCustomer.GCMId);
                    $('[name="customer_User_update"]').val(val.User.Email);
                    $('[name="customer_UserAdded_update"]').val(val.MstBankAccountCustomer.UserAdded);
                    $('[name="customer_AddedDate_update"]').val(val.MstBankAccountCustomer.AddedDate);
                    $('[name="customer_BankCode_update"]').val(val.MstBankAccountCustomer.BankCode);
                    $('[name="customer_NamaBank_update"]').val(val.MstGCM.CharDesc2);
                    $('[name="customer_NoRekening_update"]').val(val.MstBankAccountCustomer.NoRekening);
                    $('[name="customer_NamaRekening_update"]').val(val.MstBankAccountCustomer.NamaRekening);
                    //Rekening Utama
                    if (val.MstBankAccountCustomer.hasOwnProperty('RekeningUtama')) {
                        $('[name="customer_RekeningUtama_update"]').val(val.MstBankAccountCustomer.RekeningUtama);   
                    }else{
                        $('[name="customer_RekeningUtama_update"]').val("Tidak");        
                    }
                    $('[name="customer_Cabang_update"]').val(val.MstBankAccountCustomer.Cabang);
                    
                    //kalo ga ada true kalo ada false 
                    if (val.MstBankAccountCustomer.hasOwnProperty('Is_Active')) {
                        if (val.MstBankAccountCustomer.Is_Active == false) {
                            $('[name="customer_IsActive_update"]').attr('checked', false);
                        }
                    }else{
                        $('[name="customer_IsActive_update"]').attr('checked', true);   
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-customer').modal();
        });

        // $(document).on('click','.delete-customer',function(){
        //     var id2 = $(this).attr('data-id2');
        //     console.log(id2);     
        // });
        
    })
  </script>

@include('modal.update_customer')
@endsection