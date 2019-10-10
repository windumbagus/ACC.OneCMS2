@extends('admin.admin') 

@section('content-management', 'active')
@section('landing-page', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Landing Page</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#" class="button_landingPage_create btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-9">
                <input type="text" placeholder="Search by Order, Title or Category" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button_landingPage_search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button_landingPage_resetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        
        <table id="datatable_1" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($MstLandingPageList as $MstLandingPage)
                    <tr>  
                        @if (property_exists($MstLandingPage, 'Category'))
                            <td><span>{{$MstLandingPage->Category}}</span></td>
                        @else
                            <td></td>
                        @endif
                        
                        @if (property_exists($MstLandingPage, 'Description'))
                            @if(strlen($MstLandingPage->Description)>= 20)
                                <td><span>{{substr($MstLandingPage->Description,0,20)."..."}}</span></td>
                            @else 
                                <td><span>{{$MstLandingPage->Description}}</span></td>
                            @endif
                        @else
                            <td></td>
                        @endif

                        <td>
                            <span>
                                <a href="#" MstLandingPage_Id="{{$MstLandingPage->Id}}" class="button_landingPage_update 
                                    btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('landing-page/delete/'.$MstLandingPage->Id)}}" 
                                    class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')" >
                                    <i class="fa fa-trash"></i>
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
                {"searchable":false},
            ]
        })

        //Button Search
        $('.button_landingPage_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable_1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button_landingPage_resetSearch').on('click',function(){
            var tab = $('#datatable_1').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })

        // Modal Add
        $(document).on('click','.button_landingPage_create',function(){
            $('#modal_landingPage_add').modal();
        });
        
        // Modal Update
        $(document).on('click','.button_landingPage_update',function(){
            var id = $(this).attr('MstLandingPage_Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/landing-page/show')}}",
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
            $('#modal_landingPage_update').modal();
        });
    })
</script>

@include('modal.add_master_content')
@include('modal.update_master_content')
@endsection