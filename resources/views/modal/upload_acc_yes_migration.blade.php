@extends('admin.admin') 

@section('master-management', 'active')
@section('acc-yes-migration', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Acc Yes Migration</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-acc-yes-migration" action="{{asset('/acc-yes-migration/upload')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            Structure : NAME, PHONE_NUMBER, EMAIL<br>
            Format &nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_acc_yes_migration" required >
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
                    <a href="{{asset('/acc-yes-migration/proceed')}}" class="btn btn-block btn-primary">Proceed</a>
                </div>
                <div class="col-sm-6">
                    <a href="{{asset('/acc-yes-migration/cancel')}}" class="btn btn-block btn-danger">Cancel</a>
                </div>
            </div>
            <div class="col-sm-8"></div>
        </div><br>

        <table id="table_upload_otr" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($UploadMigrations); --}}
                @foreach ($UploadMigrations as $UploadMigration)
                    <tr>  
                                                                   
                        <td><span>{{$UploadMigration->TmpUserAccYes->NAME}}</span></td>                        
                        <td><span>{{$UploadMigration->TmpUserAccYes->PHONE_NUMBER}}</span></td>                        
                        <td><span>{{$UploadMigration->TmpUserAccYes->EMAIL}}</span></td>  

                        @if (property_exists($UploadMigration, 'IsAdd'))
                            @if($UploadMigration->IsAdd== true)
                            <td><span>New!</span></td>
                            @endif             
                        @elseif (property_exists($UploadMigration, 'IsAlreadyUse'))
                            @if($UploadMigration->IsAlreadyUse== true)
                            <td><span>Already Exist!</span></td>             
                            @endif
                        @endif
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
        })
    })
</Script>
@endsection
