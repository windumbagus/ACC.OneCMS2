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
                        $('[name="updateLandingPage_MstPicture_Id"]').val(val.MstPicture.Id);
                        $('[name="updateLandingPage_MstPicture_DataId"]').val(val.MstPicture.DataId);
                        $('[name="updateLandingPage_MstPicture_Picture"]').val(val.MstPicture.Picture);
                        $('[name="updateLandingPage_MstPicture_FileName"]').val(val.MstPicture.FileName);
                        $('[name="updateLandingPage_MstPicture_FileType"]').val(val.MstPicture.FileType);
                        $('[name="updateLandingPage_MstPicture_Type"]').val(val.MstPicture.Type);
                        $('#placeholder_landingPageModalUpdate_picture').attr('src', "data:image/png;base64," + val.MstPicture.Picture);
                    }
                    
                    $('[name="updateLandingPage_MstLandingPage_Id"]').val(val.MstLandingPage.Id);
                    // $('[name="updateLandingPage_MstLandingPage_Category"]').val(val.MstLandingPage.Category);
                    $('[name="updateLandingPage_MstLandingPage_Description"]').val(val.MstLandingPage.Description);
                    $('[name="updateLandingPage_MstLandingPage_Type"]').val(val.MstLandingPage.Type);
                    $('[name="updateLandingPage_MstLandingPage_DtAdded"]').val(val.MstLandingPage.DtAdded);
                    // $('[name="updateLandingPage_MstLandingPage_DtUpdated"]').val(val.MstLandingPage.DtUpdated);

                    $('[name="updateLandingPage_MstLandingPage_Category"]').val(val.MstLandingPage_Category);
                    $('[name="updateLandingPage_MstLandingPage_SubCategory"]').val(val.MstLandingPage_SubCategory);
                    $('#dropdown_landingPageModalUpdate_subCategory').empty();
                    $('#dropdown_landingPageModalUpdate_subCategory')
                        .append('<option value="">Silahkan Pilih Sub-Category</option>')
                    val.LandingPageSubCategoryList.map(SubCategory=>{
                        if (SubCategory == val.MstLandingPage_SubCategory) {
                            $('#dropdown_landingPageModalUpdate_subCategory')
                                .append('<option value="'+SubCategory+'" selected>'+SubCategory+'</option>')
                        } else {
                            $('#dropdown_landingPageModalUpdate_subCategory')
                                .append('<option value="'+SubCategory+'">'+SubCategory+'</option>')
                        }
                    })

                    // CKEditor
                    CKEDITOR.instances.textarea_landingPageModalUpdate_description.setData(val.MstLandingPage.Description);
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            $('#modal_landingPage_update').modal();
        });
    })
</script>

@include('modal.add_landing_page')
@include('modal.update_landing_page')
@endsection