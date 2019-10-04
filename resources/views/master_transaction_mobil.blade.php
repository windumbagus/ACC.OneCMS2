@extends('admin.admin') 

@section('master-transaction-mobil', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Master Transaction Mobil</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                <a href="{{asset('/master-transaction-mobil/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Report or User" class="InputSearch form-control">
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
            <th>Nama User</th>
            <th>Nama Tertanggung</th>
            <th>Kendaraan</th>
            <th>Pertanggungan</th>
            <th>Harga Pertanggungan</th>
            <th>Warna</th>
            <th>No Polisi</th>
            <th>No Kontrak</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Transactions as $Transaction)

            <tr>  

                @if (property_exists($Transaction->User, 'Name'))
                    <td><span>{{$Transaction->User->Name}}</span></td>
                @else 
                    <td></td>
                @endif

                <td><span>{{$Transaction->MstTransactionMobil->NamaTertanggung}}</span></td>
                <td><span>{{$Transaction->MstTransactionMobil->Kendaraan}}</span></td>

                @if($Transaction->MstTransactionMobil->Pertanggungan == "A")
                <td><span>Comprehensive</span></td>
                @else
                <td><span>Total Lost</span></td>
                @endif                
                
                <td><span>{{$Transaction->MstTransactionMobil->HargaPertanggungan}}</span></td>

                @if (property_exists($Transaction->MstTransactionMobil, 'Colour'))
                <td><span>{{$Transaction->MstTransactionMobil->Colour}}</span></td>
                @else 
                    <td></td>
                @endif

                @if (property_exists($Transaction->MstTransactionMobil, 'NomorPlat'))
                <td><span>{{$Transaction->MstTransactionMobil->NomorPlat}}</span></td>
                @else 
                    <td></td>
                @endif

                @if (property_exists($Transaction->MstTransactionMobil, 'PolicyNumber'))
                <td><span>{{$Transaction->MstTransactionMobil->PolicyNumber}}</span></td>
                @else 
                    <td></td>
                @endif

                <td>
                <span>
                    <a href="#" data-id="{{ $Transaction->MstTransactionMobil->Id}}" class="view-master-transaction-mobil btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                    <a  href="{{asset('master-transaction-mobil/delete/'.$Transaction->MstTransactionMobil->Id)}}" 
                        data-id2="{{ $Transaction->MstTransactionMobil->Id}}" class=" btn btn-danger btn-sm" 
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
                null,
                null,
                null,
                {"searchable":false},                
                {"searchable":false},
                {"searchable":false},
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
        $(document).on('click','.view-master-transaction-mobil',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-transaction-mobil/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="Nama"]').val(val.User.Name);
                    $('[name="NoPolisi"]').val(val.MstTransactionMobil.NomorPlat);
                    $('[name="NamaTertanggung"]').val(val.MstTransactionMobil.NamaTertanggung);
                    $('[name="Kendaraan"]').val(val.MstTransactionMobil.Kendaraan);
                    
                    if(val.MstTransactionMobil.Pertanggungan == "A"){
                        $('[name="Pertanggungan"]').val('Comprehensive');
                    }else{
                        $('[name="Pertanggungan"]').val('Total Lost');
                    }

                    $('[name="HargaPertanggungan"]').val(val.MstTransactionMobil.HargaPertanggungan);
                    $('[name="Warna"]').val(val.MstTransactionMobil.Colour);
                    $('[name="ColorOnSTNK"]').val(val.MstTransactionMobil.ColourSTNK);
                    $('[name="NoKontrak"]').val(val.MstTransactionMobil.PolicyNumber);
                    $('[name="DueDate"]').val(val.MstTransactionMobil.DueDate);
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-master-transaction-mobil').modal();
        });
        
    })
</script>
@include('modal.view_master_transaction_mobil')
@endsection