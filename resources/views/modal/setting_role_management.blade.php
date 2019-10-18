@extends('admin.admin') 

@section('user-management', 'active')
@section('role-management', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Setting Role ACC.One for User "{{$RoleName}}"</h4> 
    </div>
    <div class="box-body">
        <table id="table_upload_otr" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Menu Name</th>
                    <th>View/Search</th>
                    <th>Create/Upload</th>
                    <th>Update</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($Settings); --}}
                @foreach ($Settings as $Setting)
                    <tr>  
                        <td><span>{{$Setting->MenuItem->Caption}} - {{$Setting->MenuSubItem->Caption}}</span></td>                        
                        
                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsView'))
                                @if($Setting->MstRoleDetail->IsView == true)
                                    <input type="checkbox" name="ViewSearch" checked="checked">
                                @else
                                    <input type="checkbox" name="ViewSearch" >
                                @endif
                            @else
                                <input type="checkbox" name="ViewSearch" >
                            @endif
                        </span></td>  

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsCreate'))
                                @if($Setting->MstRoleDetail->IsCreate == true)
                                   <input type="checkbox" name="CreateUpload" checked="checked">
                                @else
                                   <input type="checkbox" name="CreateUpload" >
                                @endif
                            @else
                                <input type="checkbox" name="CreateUpload" >
                            @endif
                        </span></td>  

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsUpdate'))
                                @if($Setting->MstRoleDetail->IsUpdate == true)
                                    <input type="checkbox" name="Update" checked="checked">
                                @else
                                    <input type="checkbox" name="Update" >
                                @endif
                            @else
                                <input type="checkbox" name="Update" >
                            @endif
                        </span></td>
                  
                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsDownload'))
                                @if($Setting->MstRoleDetail->IsDownload == true)
                                <input type="checkbox" name="Download" checked="checked">
                                @endif
                            @else
                              <input type="checkbox" name="Download" >
                            @endif
                        </span></td>

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsDelete'))
                                @if($Setting->MstRoleDetail->IsDelete == true)
                                   <input type="checkbox" name="Delete" checked="checked">
                                @else
                                   <input type="checkbox" name="Delete" >
                                @endif
                            @else
                               <input type="checkbox" name="Delete" >
                            @endif
                        </span></td>                 
                    </tr>                  
                @endforeach     
            </tbody>
        </table>  

        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-4">
                    <a  class="btn btn-block btn-primary" href="{{asset('/role-management')}}">Back</a>
                </div>
                <div class="col-sm-8"></div>
            </div>
            <div class="col-sm-8"></div>
        </div>    
    </div>
</div>

<Script>
    $(document).ready(function () {
        $('#table_upload_otr').DataTable({
            'deferRender': true,
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
        })
    })
</Script>
@endsection
