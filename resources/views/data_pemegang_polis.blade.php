@extends('admin.admin') 

@section('data-pemegang-polis', 'active')
@section('acc-safe', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">Data Pemegang Polis</h3>
            </div>
            <div class="col-sm-6">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <div class="col-sm-4">
                        <a href="{{asset('/data-pemegang-polis/download-simulasi')}}" class="btn btn-block btn-primary">Download Simulasi</a>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{asset('/data-pemegang-polis/download-summary')}}" class="btn btn-block btn-primary">Download Summary</a>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{asset('/data-pemegang-polis/download-golive')}}" class="btn btn-block btn-primary">Download Go Live</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#Simulasi">Simulasi</a></li>
            <li><a data-toggle="tab" href="#Summary">Summary</a></li>
            <li><a data-toggle="tab" href="#GoLive">Go Live</a></li>
        </ul>
        <div class="tab-content">
           
            {{-- Simulasi Tab --}}
            <div id="Simulasi" class="tab-pane fade in active"><br>
                <div class="row">
                    <div class="col-sm-8">
                        <input type="text" placeholder="Search by Name, Handphone, E-Mail or KTP" class="InputSearchSimulasi form-control">
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-6">
                            <a href="#" class="ButtonSearchSimulasi btn btn-block btn-info">Search</a>    
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="ResetSearchSimulasi btn btn-block btn-info">Reset</a>    
                        </div>
                    </div>
                </div><br>

                <table id="SimulasiTable" class="table table-bordered display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Handphone</th>
                    <th>E-Mail</th>
                    <th>KTP</th>
                    <th>Alamat</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                    {{-- @dd($Poliss->Simulasi); --}}
                    @foreach ($Poliss->Simulasi as $Simulasi)

                    <tr>  
                        <td><span>{{$Simulasi->Nama}}</span></td>
                        <td><span>{{$Simulasi->TanggalLahir}}</span></td>
                        <td><span>{{$Simulasi->JenisKelamin}}</span></td> 
                        <td><span>{{$Simulasi->Handphone}}</span></td> 
                        <td><span>{{$Simulasi->Email}}</span></td> 
                        <td><span>{{$Simulasi->NoKTP}}</span></td> 
                        <td><span>{{$Simulasi->Alamat}}</span></td> 
                        <td>
                            <span>
                                <a href="#" data-id="{{ $Simulasi->Id}}" class="view-data-pemegang-polis-simulasi btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                            </span>
                        </td>
                    </tr>        
                    @endforeach       
                </tbody>
                </table>
            </div>

            {{-- Summary Tab --}}
            <div id="Summary" class="tab-pane"><br>
                <div class="row">
                    <div class="col-sm-8">
                        <input type="text" placeholder="Search by Name, Handphone, E-Mail or KTP" class="InputSearchSummary form-control">
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-6">
                            <a href="#" class="ButtonSearchSummary btn btn-block btn-info">Search</a>    
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="ResetSearchSummary btn btn-block btn-info">Reset</a>    
                        </div>
                    </div>
                </div><br>

                <table id="SummaryTable" class="table table-bordered display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Handphone</th>
                    <th>E-Mail</th>
                    <th>KTP</th>
                    <th>Alamat</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                    {{-- @dd($Poliss->Simulasi); ganti summary if exist--}}
                    @if(property_exists($Poliss,'Summary'))
                    @foreach ($Poliss->Summary as $Summary)

                    <tr>  
                        <td><span>{{$Summary->Nama}}</span></td>
                        <td><span>{{$Summary->TanggalLahir}}</span></td>
                        <td><span>{{$Summary->JenisKelamin}}</span></td> 
                        <td><span>{{$Summary->Handphone}}</span></td> 
                        <td><span>{{$Summary->Email}}</span></td> 
                        <td><span>{{$Summary->NoKTP}}</span></td> 
                        <td><span>{{$Summary->Alamat}}</span></td> 
                        <td>
                            <span>
                                <a href="#" data-id="{{ $Summary->Id}}" class="view-data-pemegang-polis btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                            </span>
                        </td>
                    </tr>        
                    @endforeach    
                    @endif   
                </tbody>
                </table>
            </div>


            {{-- GoLive Tab --}}
            <div id="GoLive" class="tab-pane"><br>
                <div class="row">
                    <div class="col-sm-8">
                        <input type="text" placeholder="Search by Name, Handphone, E-Mail or KTP" class="InputSearchGoLive form-control">
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-6">
                            <a href="#" class="ButtonSearchGoLive btn btn-block btn-info">Search</a>    
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="ResetSearchGoLive btn btn-block btn-info">Reset</a>    
                        </div>
                    </div>
                </div><br>

                <table id="GoLiveTable" class="table table-bordered display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Handphone</th>
                    <th>E-Mail</th>
                    <th>KTP</th>
                    <th>Alamat</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                    {{-- @dd($Poliss->Simulasi); ganti GoLive if exist--}}
                    @if(property_exists($Poliss,'GoLive'))                    
                    @foreach ($Poliss->Simulasi as $GoLive)

                    <tr>  
                        <td><span>{{$GoLive->Nama}}</span></td>
                        <td><span>{{$GoLive->TanggalLahir}}</span></td>
                        <td><span>{{$GoLive->JenisKelamin}}</span></td> 
                        <td><span>{{$GoLive->Handphone}}</span></td> 
                        <td><span>{{$GoLive->Email}}</span></td> 
                        <td><span>{{$GoLive->NoKTP}}</span></td> 
                        <td><span>{{$GoLive->Alamat}}</span></td> 
                        <td>
                            <span>
                                <a href="#" data-id="{{ $GoLive->Id}}" class="view-data-pemegang-polis btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                            </span>
                        </td>
                    </tr>        
                    @endforeach    
                    @endif   
                </tbody>
                </table>
            </div>


        </div>
    </div>
 </div>

 <!-- page script -->
<script>
    $(document).ready(function () {

      $('#SimulasiTable').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
        //   'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                null,
                {"searchable":false},                
                {"searchable":false},                
                null,
                null,
                null,
                {"searchable":false},
                {"searchable":false},
            ]
      })

      $('#SummaryTable').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
        //   'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                null,
                {"searchable":false},                
                {"searchable":false},                
                null,
                null,
                null,
                {"searchable":false},
                {"searchable":false},
            ]
      })

      $('#GoLiveTable').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
        //   'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                null,
                {"searchable":false},                
                {"searchable":false},                
                null,
                null,
                null,
                {"searchable":false},
                {"searchable":false},
            ]
      })

        //Button Search Simulasi
        $('.ButtonSearchSimulasi').on('click', function(){
            var searchData = $('.InputSearchSimulasi').val()
            var dtable = $('#SimulasiTable').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearchSimulasi').on('click',function(){
            var tab = $('#SimulasiTable').DataTable()
            tab.search('').draw()
            $('.InputSearchSimulasi').val('')
        })

        //Button Search Summary
        $('.ButtonSearchSummary').on('click', function(){
            var searchData = $('.InputSearchSummary').val()
            var dtable = $('#SummaryTable').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearchSummary').on('click',function(){
            var tab = $('#SummaryTable').DataTable()
            tab.search('').draw()
            $('.InputSearchSummary').val('')
        })

        //Button Search GoLive
        $('.ButtonSearchGoLive').on('click', function(){
            var searchData = $('.InputSearchGoLive').val()
            var dtable = $('#GoLiveTable').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearchGoLive').on('click',function(){
            var tab = $('#GoLiveTable').DataTable()
            tab.search('').draw()
            $('.InputSearchGoLive').val('')
        })

        //VIEW
        $(document).on('click','.view-data-pemegang-polis-simulasi',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/data-pemegang-polis-simulasi/show')}}",
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
                    $('[name="Provinsi"]').val(val.MstGCM.CharDesc1);
                    $('[name="KodePos"]').val(val.MstDataPemegangPolis.KodePos);
                    $('[name="Status"]').val(val.MstStatus.Label);
                    $('[name="AddedDate"]').val(val.MstDataPemegangPolis.AddedDate);
                    $('[name="UserAdded"]').val(val.User.Name);
                    $('#KTP').attr('src', "data:image/png;base64," + val.MstPictures.Picture);

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-data-pemegang-polis').modal();
        });

        
    })
  </script>

@include('modal.view_data_pemegang_polis')
@endsection