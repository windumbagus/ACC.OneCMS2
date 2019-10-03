@extends('admin.admin') 

@section('master-pernyataan', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Master Pernyataan</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#" class="add-master-pernyataan btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Perlindungan Untuk, Jenis Proteksi or Nama Product" class="InputSearch form-control">
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
            <th>Perlindungan Untuk</th>
            <th>jenis Proteksi</th>
            <th>Nama Product</th>
            <th>Is Pemegang Polis Tertanggung Utama</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Pernyataans as $Pernyataan)

            <tr>  
                <td><span>{{$Pernyataan->PerlindunganUntuk}}</span></td>
                <td><span>{{$Pernyataan->JenisProteksi}}</span></td>

                <td><span>{{$Pernyataan->NamaProduk}}</span></td> 
                
                @if (property_exists($Pernyataan, 'IsPemegangPolisTertanggungUt'))
                    @if($Pernyataan->IsPemegangPolisTertanggungUt== 1)
                    <td><span><i class="fa fa-check" style="color:green;"></i></span></td>
                    @endif
                @else 
                    <td><i class="fa fa-close" style="color:red;"></i></td>
                @endif

                <td>
                <span>
                    <a href="#" data-id="{{ $Pernyataan->Id}}" class="update-master-pernyataan btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                    <a href="{{asset('master-pernyataan/delete/'.$Pernyataan->Id)}}" class=" btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure want to delete this data?')" ><i class="fa fa-trash"></i>
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

        
        //ADD
        $(document).on('click','.add-master-pernyataan',function(){
        $('#add-master-pernyataan').modal();     
        });

        // VIEW
        $(document).on('click','.update-master-pernyataan',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-pernyataan/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="Id_update"]').val(val.MstPernyataan.Id);
                    $('[name="perlindungan_untuk_update"]').val(val.MstPernyataan.PerlindunganUntuk);
                    $('[name="jenis_proteksi_update"]').val(val.MstPernyataan.JenisProteksi);
                    $('[name="nama_product_update"]').val(val.MstPernyataan.NamaProduk);

                    if (val.MstPernyataan.hasOwnProperty('IsPemegangPolisTertanggungUt')) {
                        if(val.MstPernyataan.IsPemegangPolisTertanggungUt == true){
                        $('[name="pemegang_polis_tertanggung_utama_update"]').attr('checked', true);
                        }else{
                            $('[name="pemegang_polis_tertanggung_utama_update"]').attr('checked', false);
                        }
                    }

                    if (val.MstPernyataan.hasOwnProperty('IsiDataTertanggungUtama')) {
                    $('[name="data_tertanggung_utama_update"]').val(val.MstPernyataan.IsiDataTertanggungUtama);
                    }

                    if (val.MstPernyataan.hasOwnProperty('IsAsuransiTambahan')) {
                        if(val.MstPernyataan.IsAsuransiTambahan == true){
                            $('[name="asuransi_tambahan_update"]').attr('checked', true);
                        }else{
                            $('[name="asuransi_tambahan_update"]').attr('checked', false);                            
                        }
                    }

                    $('[name="pernyataan_update"]').val(val.MstPernyataan.Pernyataan);
                    

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-master-pernyataan').modal();
        });

        
    })
  </script>

@include('modal.add_master_pernyataan')
@include('modal.update_master_pernyataan')
@endsection