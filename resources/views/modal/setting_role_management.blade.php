@extends('admin.admin') 

@section('user-management', 'active')
@section('role-management', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Setting Role ACC.One for User "{{$RoleName}}"</h4> 
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
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
                                    <input class="OnChangeView" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="ViewSearch" checked="checked">
                                @else
                                    <input class="OnChangeView" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="ViewSearch" >
                                @endif
                            @else
                                <input class="OnChangeView" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="ViewSearch" >
                            @endif
                        </span></td>  

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsCreate'))
                                @if($Setting->MstRoleDetail->IsCreate == true)
                                   <input class="OnChangeCreate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="CreateUpload" checked="checked">
                                @else
                                   <input class="OnChangeCreate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="CreateUpload" >
                                @endif
                            @else
                                <input class="OnChangeCreate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="CreateUpload" >
                            @endif
                        </span></td>  

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsUpdate'))
                                @if($Setting->MstRoleDetail->IsUpdate == true)
                                    <input class="OnChangeUpdate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Update" checked="checked">
                                @else
                                    <input class="OnChangeUpdate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Update" >
                                @endif
                            @else
                                <input class="OnChangeUpdate" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Update" >
                            @endif
                        </span></td>
                  
                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsDownload'))
                                @if($Setting->MstRoleDetail->IsDownload == true)
                                    <input class="OnChangeDownload" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Download" checked="checked">
                                @else
                                    <input class="OnChangeDownload" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Download" >      
                                @endif
                            @else
                              <input class="OnChangeDownload" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Download" >
                            @endif
                        </span></td>

                        <td><span>
                            @if (property_exists($Setting->MstRoleDetail, 'IsDelete'))
                                @if($Setting->MstRoleDetail->IsDelete == true)
                                   <input class="OnChangeDelete" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Delete" checked="checked">
                                @else
                                   <input class="OnChangeDelete" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Delete" >
                                @endif
                            @else
                               <input class="OnChangeDelete" data-id="{{ $Setting->MstRoleDetail->Id}}" type="checkbox" name="Delete" >
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
        $('#example1').DataTable({
            'deferRender': true,
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
        })
    })

    $('.OnChangeView').change(function(){
        var Id = $(this).attr('data-id');
        
        $.ajax({
            url: '/setting-role-management/OnChangeView/'+Id,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })

    $('.OnChangeCreate').change(function(){
        var Id = $(this).attr('data-id');
        
        $.ajax({
            url: '/setting-role-management/OnChangeCreate/'+Id,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })

    $('.OnChangeUpdate').change(function(){
        var Id = $(this).attr('data-id');
        
        $.ajax({
            url: '/setting-role-management/OnChangeUpdate/'+Id,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })

    $('.OnChangeDownload').change(function(){
        var Id = $(this).attr('data-id');
        
        $.ajax({
            url: '/setting-role-management/OnChangeDownload/'+Id,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })

    $('.OnChangeDelete').change(function(){
        var Id = $(this).attr('data-id');
        
        $.ajax({
            url: '/setting-role-management/OnChangeDelete/'+Id,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })
</Script>
@endsection
