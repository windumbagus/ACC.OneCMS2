@extends('admin.admin') 

@section('content-management', 'active')
@section('master-content', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Master Content</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#" class="button_masterContent_create btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" id="dropdown_masterContent_contentType" style="width:100%;">
                    <option value="0" selected>-- Choose Content Type --</option>
                    @foreach ($MstGCM_ContentTypeList as $MstGCM_ContentType)
                        <option value="{{$MstGCM_ContentType}}">
                            {{$MstGCM_ContentType}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by Order, Title or Category" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button_masterContent_search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button_masterContent_resetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        
        <table id="datatable_1" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Crated Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</div>

<!-- page script -->
<script>
    $(document).ready(function () {
        $('#datatable_1').DataTable({
            'deferRender' : true,
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
            ]
        })

        //Button Search
        $('.button_masterContent_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable_1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button_masterContent_resetSearch').on('click',function(){
            var tab = $('#datatable_1').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })

        // ContentType Dropdown
        $('#dropdown_masterContent_contentType').on('change',function(){
            var SelectedContentType = $(this).val();
            // console.log(SelectedContentType);
            $.ajax({
                url:'master-content/get-by-content-type',
                data: {'ContentType':SelectedContentType},
                dataType:'json',
                success: function(data){
                    // console.log(data);
                    var table = $('#datatable_1').DataTable()
                    var MstContentList = data.MstContentList;
                    table.clear().draw()
                    MstContentList.map(e=>{
                        table.row.add([
                            e.Order,
                            e.Title,
                            e.Category,
                            e.Status,
                            e.AddedDate,
                            '<span><a href="#" MstContentId="'+e.Id+'" class="button-masterContent-update btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; <a href="#" MstContentId="'+e.Id+'" class="button-masterContent-delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure want to delete this ?\')" ><i class="fa fa-trash"></i></a></span>',
                        ]).draw(false)
                    }) 
                }
            })
        });

        // Delete
        $(document).on('click','.button-masterContent-delete',function(){
            var id = $(this).attr('MstContentId');
            // console.log(id);
            $.ajax({
                url:"{{asset('/master-content/delete')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    window.location.assign("{{asset('/master-content')}}");
                    alert("Delete Master Content Successfully!");
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        });

        // Modal Add
        $(document).on('click','.button_masterContent_create',function(){
            $('#modal_masterContent_add').modal();
        });
        
        // Modal Update
        $(document).on('click','.button-masterContent-update',function(){
            var id = $(this).attr('MstContentId');
            // console.log(id);
            $.ajax({
                url:"{{asset('/master-content/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    // console.log(val);

                    // MstPicture
                    if(val.hasOwnProperty('MstPicture')) {
                        $('[name="updateMasterContent_MstPicture_Id"]').val(val.MstPicture.Id);
                        $('[name="updateMasterContent_MstPicture_DataId"]').val(val.MstPicture.DataId);
                        $('[name="updateMasterContent_MstPicture_Picture"]').val(val.MstPicture.Picture);
                        $('[name="updateMasterContent_MstPicture_FileName"]').val(val.MstPicture.FileName);
                        $('[name="updateMasterContent_MstPicture_FileType"]').val(val.MstPicture.FileType);
                        $('[name="updateMasterContent_MstPicture_Type"]').val(val.MstPicture.Type);
                        $('#placeholder_masterContentModalUpdate_picture').attr('src', "data:image/png;base64," + val.MstPicture.Picture);
                    }
                    
                    
                    $('[name="updateMasterContent_MstContent_Id"]').val(val.MstContent.Id);
                    $('[name="updateMasterContent_MstContent_ContentType"]').val(val.MstContent.ContentType);
                    $('[name="updateMasterContent_MstContent_Order"]').val(val.MstContent.Order);
                    $('[name="updateMasterContent_MstContent_Title"]').val(val.MstContent.Title);
                    $('[name="updateMasterContent_MstContent_Snippet"]').val(val.MstContent.Snippet);
                    $('[name="updateMasterContent_MstContent_Detail"]').val(val.MstContent.Detail);
                    $('[name="updateMasterContent_MstContent_Category"]').val(val.MstContent.Category);
                    $('[name="updateMasterContent_MstContent_Status"]').val(val.MstContent.Status);
                    $('[name="updateMasterContent_MstContent_AddedDate"]').val(val.MstContent.AddedDate);
                    $('[name="updateMasterContent_MstContent_UserAdded"]').val(val.MstContent.UserAdded);
                    // $('[name="updateMasterContent_MstContent_UpdatedDate"]').val(val.MstContent.UpdatedDate);
                    // $('[name="updateMasterContent_MstContent_UserUpdated"]').val(val.MstContent.UserUpdated);
                    $('[name="updateMasterContent_MstContent_ProductOwner"]').val(val.MstContent.ProductOwner);

                    // CKEditor
                    CKEDITOR.instances.textarea_masterContentModalUpdate_snippet.setData(val.MstContent.Snippet);
                    CKEDITOR.instances.textarea_masterContentModalUpdate_description.setData(val.MstContent.Detail);

                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log(jqXhr);
                    console.log( errorThrown );
                    console.log(textStatus);
                },
            });
            $('#modal_masterContent_update').modal();
        });
    })
</script>

@include('modal.add_master_content')
@include('modal.update_master_content')
@endsection