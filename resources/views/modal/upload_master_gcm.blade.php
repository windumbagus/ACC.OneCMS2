@extends('admin.admin') 

@section('master-management', 'active')
@section('master-gcm', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Master GCM</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-master-gcm" action="{{asset('/master-gcm/upload')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            
            Structure : Condition, CharValue1, CharDesc1, CharValue2, CharDesc2, CharValue3, CharDesc3, CharValue4, CharDesc4, CharValue5, CharDesc5, IsActive, TimeStamp1, TimeStamp2<br>
            Format &nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_master_gcm" required >
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
                    <a href="{{asset('/master-gcm/proceed')}}" class="btn btn-block btn-primary">Proceed</a>
                </div>
                <div class="col-sm-6">
                    <a href="{{asset('/master-gcm/cancel')}}" class="btn btn-block btn-danger">Cancel</a>
                </div>
            </div>
            <div class="col-sm-8"></div>
        </div><br>

        <table id="table_upload_master_gcm" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Condition</th>
                    <th>Char Value 1</th>
                    <th>Char Desc 1</th>
                    <th>Char Value 2</th>
                    <th>Char Desc 2</th>
                    <th>Char Value 3</th>
                    <th>Char Desc 3</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($TmpGCMs); --}}
                @foreach ($TmpGCMs as $x)
                    <tr>                   
                        @if (property_exists($x->TmpGcm, 'Condition'))
                            <td><span>{{$x->TmpGcm->Condition}}</span></td>
                        @else 
                            <td><span></span></td>
                        @endif

                        @if (property_exists($x->TmpGcm, 'CharValue1'))
                            <td><span>{{$x->TmpGcm->CharValue1}}</span></td>                        
                        @else 
                            <td><span></span></td>
                        @endif  

                        @if (property_exists($x->TmpGcm, 'CharDesc1'))
                            <td><span>{{$x->TmpGcm->CharDesc1}}</span></td> 
                        @else 
                            <td><span></span></td>
                        @endif  

                        @if (property_exists($x->TmpGcm, 'CharValue2'))
                            <td><span>{{$x->TmpGcm->CharValue2}}</span></td>                        
                        @else 
                            <td><span></span></td>
                        @endif  

                        @if (property_exists($x->TmpGcm, 'CharDesc2'))
                            <td><span>{{$x->TmpGcm->CharDesc2}}</span></td> 
                        @else 
                        <td><span></span></td>
                        @endif 

                        @if (property_exists($x->TmpGcm, 'CharValue3'))
                            <td><span>{{$x->TmpGcm->CharValue3}}</span></td>                        
                        @else 
                            <td><span></span></td>
                        @endif  

                        @if (property_exists($x->TmpGcm, 'CharDesc3'))
                            <td><span>{{$x->TmpGcm->CharDesc3}}</span></td> 
                        @else 
                            <td><span></span></td>
                        @endif

                        @if (property_exists($x, 'IsAdd'))
                            @if($x->IsAdd== true)
                            <td><span>New!</span></td>
                            @endif             
                        @elseif (property_exists($x, 'IsAlreadyUse'))
                            @if($x->IsAlreadyUse== true)
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
        $('#table_upload_master_gcm').DataTable({
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
