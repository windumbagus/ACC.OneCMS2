@extends('admin.admin') 

@section('master-management', 'active')
@section('master-otr', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Master OTR</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-master-otr" action="{{asset('/master-otr/upload')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            Structure : CD_BRAND, DESC_BRAND, CD_TYPE, DESC_TYPE, CD_MODEL, DESC_MODEL, FLAG_NEW_USED, TAHUN, CD_SP, CD_AREA, OTR, DEVIASI, FLAG_ACTIVE<br>
            Format &nbsp;&nbsp;&nbsp; : .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_master_otr" required >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Upload</button>		
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="{{asset('/master-otr/proceed')}}" class="btn btn-block btn-primary">Proceed</a>
                </div>
                <div class="col-sm-6">
                    <a href="{{asset('/master-otr/cancel')}}" class="btn btn-block btn-danger">Cancel</a>
                </div>
            </div>
            <div class="col-sm-8"></div>
        </div><br>

        <table id="table_upload_otr" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>New/Used</th>
                    <th>Tahun</th>
                    <th>Area/Cabang</th>
                    <th>OTR</th>
                    <th>Deviasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($TmpOTRs); --}}
                @foreach ($TmpOTRs as $TmpOTR)
                    <tr>  
                        <td>
                            <span style="font-size:12px">{{$TmpOTR->TmpOtr->CD_BRAND}}</span><br>
                            <span>{{$TmpOTR->TmpOtr->DESC_BRAND}}</span>
                        </td>
                        <td>
                            <span style="font-size:12px">{{$TmpOTR->TmpOtr->CD_TYPE}}</span><br>
                            <span>{{$TmpOTR->TmpOtr->DESC_TYPE}}</span>
                        </td>    
                        <td>
                            <span style="font-size:12px">{{$TmpOTR->TmpOtr->CD_MODEL}}</span><br>
                            <span>{{$TmpOTR->TmpOtr->DESC_MODEL}}</span>
                        </td> 
                        <td><span>{{$TmpOTR->TmpOtr->FLAG_NEW_USED}}</span></td>                        
                        <td><span>{{$TmpOTR->TmpOtr->TAHUN}}</span></td>
                        <td>
                            <span style="font-size:12px">{{$TmpOTR->TmpOtr->CD_AREA}}</span><br>
                            <span>{{$TmpOTR->TmpOtr->CD_SP}}</span>
                        </td>                                                
                        <td><span>{{$TmpOTR->TmpOtr->OTR}}</span></td>                        
                        <td><span>{{$TmpOTR->TmpOtr->DEVIASI}}</span></td>                        
                        <td><span>{{$TmpOTR->TmpOtr->FLAG_ACTIVE}}</span></td>                        
                    </tr>                  
                @endforeach     
            </tbody>
        </table>        
    </div>
</div>

<Script>
    $(document).ready(function () {
        $('#table_upload_otr').DataTable({
            'deferRender': true,
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            //   'scrollX': true,
            //   sDom: 'lrtip', 
            //   "columns": [
            //         null,
            //         null,
            //         null,
            //         {"searchable":false},                
            //         null,
            //         null,
            //         {"searchable":false},                                
            //         {"searchable":false},                                
            //         {"searchable":false},                                
            //     ]
        })
    })
</Script>
@endsection
