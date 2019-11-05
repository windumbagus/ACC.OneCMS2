@extends('admin.admin') 

@section('history-pembayaran-asuransi-jiwa', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">History Pembayaran Asuransi Jiwa</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                {{-- <a href="{{asset('/customer/download')}}" class="btn btn-block btn-primary">Download</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Polis or Product" class="InputSearch form-control">
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
            <th>Polish</th>
            <th>Product</th>
            <th>Total Biaya Premi</th>
            <th>Status Pembayaran</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($As as $A)

            <tr>  
                <td><span>{{$A->MstDataPemegangPolis->Nama}}</span></td>
                <td><span>{{$A->MstHistoryPembayaranAsuransiJiwa->Product}}</span></td>
                <td><span>{{$A->MstHistoryPembayaranAsuransiJiwa->TotalBiayaPremi}}</span></td>
                <td><span>{{$A->MstHistoryPembayaranAsuransiJiwa->StatusPembayaran}}</span></td>
                <td>
                <span>
                    <a href="#" data-id="{{ $A->MstHistoryPembayaranAsuransiJiwa->Id}}" class="view-history-pembayaran-asuransi-jiwa btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                    @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                        <a  href="{{asset('history-pembayaran-asuransi-jiwa/delete/'.$A->MstHistoryPembayaranAsuransiJiwa->Id)}}" 
                            data-id2="{{ $A->MstHistoryPembayaranAsuransiJiwa->Id}}" class=" btn btn-danger btn-sm" 
                            onclick="return confirm('Are you sure want to delete this ?')" ><i class="fa fa-trash"></i>
                        </a> 
                    @endif
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
        $(document).on('click','.view-history-pembayaran-asuransi-jiwa',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/history-pembayaran-asuransi-jiwa/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="Nama"]').val(val.MstDataPemegangPolis.Nama);
                    $('[name="TanggalLahir"]').val(val.MstDataPemegangPolis.TanggalLahir);
                    $('[name="JenisKelamin"]').val(val.MstDataPemegangPolis.JenisKelamin);
                    $('[name="Handphone"]').val(val.MstDataPemegangPolis.Handphone);
                    $('[name="NoKTP"]').val(val.MstDataPemegangPolis.NoKTP);
                    $('[name="Email"]').val(val.MstDataPemegangPolis.Email);
                    $('[name="Alamat"]').val(val.MstDataPemegangPolis.Alamat);
                    $('[name="KodePos"]').val(val.MstDataPemegangPolis.KodePos);
                    $('[name="NamaRekening"]').val(val.MstDataPemegangPolis.NamaRekening);
                    $('[name="NomorRekening"]').val(val.MstDataPemegangPolis.NomorRekening);
                    $('[name="NamaBank"]').val(val.MstDataPemegangPolis.NamaBank);
                    $('[name="TransIdMerchant"]').val(val.MstHistoryPembayaranAsuransiJiwa.TransIdMerchant);
                    $('[name="Product"]').val(val.MstHistoryPembayaranAsuransiJiwa.Product);
                    $('[name="TotalBiayaPremi"]').val(val.MstHistoryPembayaranAsuransiJiwa.TotalBiayaPremi);
                    $('[name="StatusPembayaran"]').val(val.MstHistoryPembayaranAsuransiJiwa.StatusPembayaran);

                   
                    // if (val.MstBankAccountCustomer.hasOwnProperty('RekeningUtama')) {
                    //     $('[name="customer_RekeningUtama_update"]').val(val.MstBankAccountCustomer.RekeningUtama);   
                    // }else{
                    //     $('[name="customer_RekeningUtama_update"]').val("Tidak");        
                    // }
                    // $('[name="customer_Cabang_update"]').val(val.MstBankAccountCustomer.Cabang);
                    
                    // //kalo ga ada true kalo ada false 
                    // if (val.MstBankAccountCustomer.hasOwnProperty('Is_Active')) {
                    //     if (val.MstBankAccountCustomer.Is_Active == false) {
                    //         $('[name="customer_IsActive_update"]').attr('checked', false);
                    //     }
                    // }else{
                    //     $('[name="customer_IsActive_update"]').attr('checked', true);   
                    // }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-history-pembayaran-asuransi-jiwa').modal();
        });

        
    })
  </script>

@include('modal.view_history_pembayaran_asuransi_jiwa')
@endsection