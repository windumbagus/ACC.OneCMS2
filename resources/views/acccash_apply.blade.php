@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')

<!-- TableACCCash -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">ACCCash {{$Statusapply}} List</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                       
                </div>
                <div class="col-sm-6">
                        <a href="{{asset('/acccash-apply/'.$Statusapply.'/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
           

            <div class="col-sm-8">
                <input type="text" placeholder="Search by No Aggr, Id User, Tujuan Penggunaan, etc" class="InputSearch form-control">
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
            <th>Waktu Pengajuan</th>
            <th>Id User</th>
            <th>No HP</th>
            <th>No Kontrak Induk</th>
            <th>Disbursement</th>
            <th>Amt Installment</th>
            <th>Penyedia</th>
            <th>Status</th>
            <th>Action</th>            
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($ACCCashApplys[0]->dataApply as $ACCCashApply)
            <tr>  
                <td><span>{{date('d/m/Y H:i:s', strtotime($ACCCashApply->DT_ADDED))}}</span></td>
                <td><span>{{$ACCCashApply->ID_USER}}</span></td>
                <td><span>{{$ACCCashApply->PHONE_MOBILE1}}</span></td>
                <td><span>{{$ACCCashApply->NO_AGGR}}</span></td>          
                <td><span>{{number_format($ACCCashApply->DISBURSEMENT, 0, ',', '.')}}</span></td>
                <td><span>{{number_format($ACCCashApply->AMT_INSTALLMENT, 0, ',', '.')}}</span></td>
                <td><span>{{$ACCCashApply->PENYEDIA}}</span></td>
                <td><span>{{$ACCCashApply->STATUS}}</span></td>
                

                <!-- <td>
                <span>
                <a href="{{asset('acccash-apply/changestatus/'.$ACCCashApply->GUID)}}" 
                        class=" btn btn-warning btn-sm" onclick="return confirm('Are you sure want to update this apply ?')" >
                        <i class="fa fa-edit"></i></a>
                </span>
                </td> -->

                <td>
                <span>
                @if ($Statusapply == "PENDING")
                    <a href="{{ asset('acccash-apply-detail/'.$ACCCashApply->GUID.'&'.$Statusapply) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <!-- <a href="#" data-id="{{$ACCCashApply->GUID}}" class="update-acccash-apply btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; -->
                @else
                <a href="{{ asset('acccash-apply-detail/'.$ACCCashApply->GUID.'&'.$Statusapply) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
                null,
                null,
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



        // // ADD
        // $(document).on('click','.update-acccash-apply',function(){
        //     console.log('test');
        //     $('#update-acccash-apply1').modal();
        // });

        // //UPDATE FOR PENDING
        $(document).on('click','.update-acccash-apply',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/acccash-apply/'.$Statusapply.'/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="GUID"]').val(val.OUT_DATA[0].dataApply[0].GUID);
                    $('[name="NO_AGGR"]').val(val.OUT_DATA[0].dataApply[0].NO_AGGR);
                    $('[name="DISBURSEMENT"]').val(val.OUT_DATA[0].dataApply[0].DISBURSEMENT);
                    $('[name="AMT_INSTALLMENT"]').val(val.OUT_DATA[0].dataApply[0].AMT_INSTALLMENT);
                    $('[name="TENOR"]').val(val.OUT_DATA[0].dataApply[0].TENOR);
                    $('[name="TUJUAN_PENGGUNAAN"]').val(val.OUT_DATA[0].dataApply[0].TUJUAN_PENGGUNAAN);
                    $('[name="PENYEDIA"]').val(val.OUT_DATA[0].dataApply[0].PENYEDIA);
                    $('[name="ID_USER"]').val(val.OUT_DATA[0].dataApply[0].ID_USER);
                    $('[name="DT_ADDED"]').val(val.OUT_DATA[0].dataApply[0].DT_ADDED);
                    $('[name="ID_USER_UPDATED"]').val(val.OUT_DATA[0].dataApply[0].ID_USER_UPDATED);
                    $('[name="DT_UPDATED"]').val(val.OUT_DATA[0].dataApply[0].DT_UPDATED);
                    $('[name="BTMY"]').val(val.OUT_DATA[0].dataApply[0].BTMY);
                    $('[name="PHONE_MOBILE1"]').val(val.OUT_DATA[0].dataApply[0].PHONE_MOBILE1);
                    $('[name="PHONE_MOBILE2"]').val(val.OUT_DATA[0].dataApply[0].PHONE_MOBILE2);
                    $('[name="AREA"]').val(val.OUT_DATA[0].dataApply[0].AREA);
                    $('[name="CABANG"]').val(val.OUT_DATA[0].dataApply[0].CABANG);
                    $('[name="NO_CAR_POLICE"]').val(val.OUT_DATA[0].dataApply[0].NO_CAR_POLICE);
                    $('[name="PEFINDO_SCORE"]').val(val.OUT_DATA[0].dataApply[0].PEFINDO_SCORE);
                    $('[name="PEFINDO_DETAIL"]').val(val.OUT_DATA[0].dataApply[0].PEFINDO_DETAIL);
                    $('[name="STATUS"]').val(val.OUT_DATA[0].dataApply[0].STATUS);
                    $('[name="REASON"]').val(val.OUT_DATA[0].dataApply[0].REASON);
                    $('#PATH_FILE0').attr('src', val.OUT_DATA[0].dataPicture[0].PATH_FILE);
                    $('#PATH_FILE1').attr('src', val.OUT_DATA[0].dataPicture[1].PATH_FILE);
                   
                   
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-acccash-apply-popup').modal();
        });

  // //VIEW APPROVED AND REJECTED
     $(document).on('click','.view-acccash-apply',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
               
                url:"{{asset('/acccash-apply/'.$Statusapply.'/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="GUID"]').val(val.OUT_DATA[0].dataApply[0].GUID);
                    $('[name="NO_AGGR"]').val(val.OUT_DATA[0].dataApply[0].NO_AGGR);
                    $('[name="DISBURSEMENT"]').val(val.OUT_DATA[0].dataApply[0].DISBURSEMENT);
                    $('[name="AMT_INSTALLMENT"]').val(val.OUT_DATA[0].dataApply[0].AMT_INSTALLMENT);
                    $('[name="TENOR"]').val(val.OUT_DATA[0].dataApply[0].TENOR);
                    $('[name="TUJUAN_PENGGUNAAN"]').val(val.OUT_DATA[0].dataApply[0].TUJUAN_PENGGUNAAN);
                    $('[name="PENYEDIA"]').val(val.OUT_DATA[0].dataApply[0].PENYEDIA);
                    $('[name="ID_USER"]').val(val.OUT_DATA[0].dataApply[0].ID_USER);
                    $('[name="DT_ADDED"]').val(val.OUT_DATA[0].dataApply[0].DT_ADDED);
                    $('[name="ID_USER_UPDATED"]').val(val.OUT_DATA[0].dataApply[0].ID_USER_UPDATED);
                    $('[name="DT_UPDATED"]').val(val.OUT_DATA[0].dataApply[0].DT_UPDATED);
                    $('[name="BTMY"]').val(val.OUT_DATA[0].dataApply[0].BTMY);
                    $('[name="PHONE_MOBILE1"]').val(val.OUT_DATA[0].dataApply[0].PHONE_MOBILE1);
                    $('[name="PHONE_MOBILE2"]').val(val.OUT_DATA[0].dataApply[0].PHONE_MOBILE2);
                    $('[name="AREA"]').val(val.OUT_DATA[0].dataApply[0].AREA);
                    $('[name="CABANG"]').val(val.OUT_DATA[0].dataApply[0].CABANG);
                    $('[name="NO_CAR_POLICE"]').val(val.OUT_DATA[0].dataApply[0].NO_CAR_POLICE);
                    $('[name="PEFINDO_SCORE"]').val(val.OUT_DATA[0].dataApply[0].PEFINDO_SCORE);
                    $('[name="PEFINDO_DETAIL"]').val(val.OUT_DATA[0].dataApply[0].PEFINDO_DETAIL);
                    $('[name="STATUS"]').val(val.OUT_DATA[0].dataApply[0].STATUS);
                    $('[name="REASON"]').val(val.OUT_DATA[0].dataApply[0].REASON);
                    $('#PATH_FILE0').attr('src', val.OUT_DATA[0].dataPicture[0].PATH_FILE);
                    $('#PATH_FILE1').attr('src', val.OUT_DATA[0].dataPicture[1].PATH_FILE);
                    
                   
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-acccash-apply-popup').modal();
        });
        
    })
  </script>

@include('modal.update_acccash_apply')
@include('modal.view_acccash_apply')
@endsection
