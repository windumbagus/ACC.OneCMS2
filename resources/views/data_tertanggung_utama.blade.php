@extends('admin.admin') 

@section('data-tertanggung-utama', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Data Tertanggung Utama</h3>
            </div>
            <div class="col-sm-4">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                    <a href="{{asset('/data-tertanggung-utama/download')}}" class="btn btn-block btn-primary">Download</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name or NoKTP" class="InputSearch form-control">
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
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Hubungan</th>
            <th>No KTP</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Utamas as $Utama)

            <tr>  
                <td><span>{{$Utama->MstDataTertanggungUtama->Nama}}</span></td>
                <td><span>{{$Utama->MstDataTertanggungUtama->TanggalLahir}}</span></td>
                @if($Utama->MstDataTertanggungUtama->JenisKelamin== "F")
                <td><span>Perempuan</span></td>
                @else
                <td><span>Laki Laki</span></td>
                @endif

                {{-- hubungan --}}
                <td><span>{{$Utama->MstGCM->CharDesc1}}</span></td> 
                
                @if (property_exists($Utama->MstDataTertanggungUtama, 'NoKTP'))
                <td><span>{{$Utama->MstDataTertanggungUtama->NoKTP}}</span></td>
                @else 
                <td></td>
                @endif

                <td>
                <span>
                    <a href="#" data-id="{{ $Utama->MstDataTertanggungUtama->Id}}" class="view-data-tertanggung-utama btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
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
                {"searchable":false},                
                {"searchable":false},                
                {"searchable":false},
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
        $(document).on('click','.view-data-tertanggung-utama',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/data-tertanggung-utama/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="Nama"]').val(val.MstDataTertanggungUtama.Nama);
                    $('[name="TanggalLahir"]').val(val.MstDataTertanggungUtama.TanggalLahir);
                    $('[name="JenisKelamin"]').val(val.MstDataTertanggungUtama.JenisKelamin);
                    $('[name="NoKTP"]').val(val.MstDataTertanggungUtama.NoKTP);
                    $('[name="NamaData"]').val(val.MstDataPemegangPolis.Nama);
                    $('[name="AddedDate"]').val(val.MstDataTertanggungUtama.AddedDate);
                    $('[name="Hubungan"]').val(val. MstGCM.CharDesc1);
                    $('[name="UserAdded"]').val(val.User.Name);
                    $('#KTP').attr('src', "data:image/png;base64," + val.MstPictures.Picture);

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-data-tertanggung-utama').modal();
        });

        
    })
  </script>

@include('modal.view_data_tertanggung_utama')
@endsection