@extends('admin.admin') 

@section('master-management', 'active')
@section('master-gcm', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-3">
                <h3 class="box-title">Master GCM</h3>
            </div>
            <div class="col-sm-9">
                <div class="col-sm-3">
                    <a href="#" class="create-master-gcm btn btn-block btn-primary">Create Master GCM </a>  
                </div>
                <div class="col-sm-3">
                    <a href="#" class=" btn btn-block btn-primary">Upload</a>  
                </div>
                <div class="col-sm-3">
                    <a href="{{asset('/master-gcm/download/null')}}" class=" btn btn-block btn-primary" id="button-download">Download </a>  
                </div>
                <div class="col-sm-3">
                    <a href="{{asset('/master-gcm/edit-gcm-access')}}" class=" btn btn-block btn-primary">Edit GCM Access </a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" id="Condition" style="width:100%;">
                    <option value="0" selected>-- Choose Condition --</option>
                    @foreach ($Conditions as $C)
                        <option value="{{$C}}">
                            {{$C}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by CharValue or CharDesc" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button-search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button-reset btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        
        <table id="datatable" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Value1</th>
                    <th>Desc1</th>
                    <th>Value2</th>
                    <th>Desc2</th>
                    <th>Value3</th>
                    <th>Desc3</th>
                    <th>IsActive</th>
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
        $('#datatable').DataTable({
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
                null,
                null,
                null,            
                {"searchable":false},
                {"searchable":false},                
            ]
        })

        //Button Search
        $('.button-search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button-reset').on('click',function(){
            var tab = $('#datatable').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })

        // Condition Dropdown
        $('#Condition').on('change',function(){
            var Condition = $(this).val();
            // console.log(Condition);

            // Function Download
            if (Condition == "" ){
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/master-gcm/download/${tempCondition}')}}`);
            } else {
                var tempCondition = Condition;
                
                if (Condition == "")
                    tempCondition = "null";
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/master-gcm/download/${tempCondition}')}}`);
            }

            $.ajax({
                url:'/master-gcm/get-by-condition',
                data: {'Condition':Condition,'_token':'{{csrf_token()}}'},
                dataType:'json',
                success: function(data){
                    console.log(data);
                    var table = $('#datatable').DataTable()
                    var MstGCM = data.MstGCM;
                    table.clear().draw()


                    MstGCM.map(e=>{
                        if (typeof e.CharValue1 === 'undefined') {
                        e.CharValue1 = "";
                        }
                        if (typeof e.CharDesc1 === 'undefined') {
                            e.CharDesc1 = "";
                        }
                        if (typeof e.CharValue2 === 'undefined') {
                            e.CharValue2 = "";
                        }
                        if (typeof e.CharDesc2 === 'undefined') {
                            e.CharDesc2 = "";
                        }
                        if (typeof e.CharValue3 === 'undefined') {
                            e.CharValue3 = "";
                        }
                        if (typeof e.CharDesc3 === 'undefined') {
                            e.CharDesc3 = "";
                        }
                        if (typeof e.IsActive === 'undefined') {
                            e.IsActive = "";
                        }

                        table.row.add([
                            e.CharValue1,
                            e.CharDesc1,
                            e.CharValue2,
                            e.CharDesc2,
                            e.CharValue3,
                            e.CharDesc3,
                            e.IsActive,
                            '<span><a href="#" MstGcmId="'+e.Id+'" class="update-mst-gcm btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; <a href="#" MstGcmId="'+e.Id+'" class="delete-mst-gcm btn btn-danger btn-sm" onclick="return confirm(\'Are you sure want to delete this ?\')" ><i class="fa fa-trash"></i></a></span>',
                        ]).draw(false)
                    }) 
                }
            })
        });

        // Delete
        $(document).on('click','.delete-mst-gcm',function(){
            var id = $(this).attr('MstGcmId');
            // console.log(id);
            $.ajax({
                url:"{{asset('/master-gcm/delete')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    window.location.assign("{{asset('/master-gcm')}}");
                    alert("Delete Master GCM Successfully!");
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        });

        // Modal Add
        $(document).on('click','.create-master-gcm',function(){
            $('#add-master-gcm').modal();
        });
        
        // Modal Update
        $(document).on('click','.update-mst-gcm',function(){
            var id = $(this).attr('MstGcmId');
            // console.log(id);
            $.ajax({
                url:"{{asset('/master-gcm/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    // MstPicture
                    if(val.hasOwnProperty('MstPicture')) {
                        $('[name="Picture_Id"]').val(val.MstPicture.Id);
                        $('[name="Picture_DataId"]').val(val.MstPicture.DataId);
                        $('[name="Picture"]').val(val.MstPicture.Picture);
                        $('[name="Picture_FileName"]').val(val.MstPicture.FileName);
                        $('[name="Picture_FileType"]').val(val.MstPicture.FileType);
                        $('[name="Picture_Type"]').val(val.MstPicture.Type);
                        if(val.MstPicture.hasOwnProperty('Picture')){
                            $('#Picture_Update').attr('src', "data:image/png;base64," + val.MstPicture.Picture);
                        }
                    }
                    
                    $('[name="Id"]').val(val.MstGCM.Id);                    
                    $('[name="Condition_Update"]').val(val.MstGCM.Condition);                    
                    $('[name="CharValue1_Update"]').val(val.MstGCM.CharValue1);
                    $('[name="CharDesc1_Update"]').val(val.MstGCM.CharDesc1);
                    $('[name="CharValue2_Update"]').val(val.MstGCM.CharValue2);
                    $('[name="CharDesc2_Update"]').val(val.MstGCM.CharDesc2);
                    $('[name="CharValue3_Update"]').val(val.MstGCM.CharValue3);
                    $('[name="CharDesc3_Update"]').val(val.MstGCM.CharDesc3);
                    $('[name="CharValue4_Update"]').val(val.MstGCM.CharValue4);
                    $('[name="CharDesc4_Update"]').val(val.MstGCM.CharDesc4);
                    $('[name="CharValue5_Update"]').val(val.MstGCM.CharValue5);
                    $('[name="CharDesc5_Update"]').val(val.MstGCM.CharDesc5);
                    
                    $('[name="TimeStamp1_Update"]').val(val.MstGCM.TimeStamp1.substring(8,10)+"-"+val.MstGCM.TimeStamp1.substring(5,7)+"-"+val.MstGCM.TimeStamp1.substring(0,4));
                    
                    $('[name="TimeStamp2_Update"]').val(val.MstGCM.TimeStamp2.substring(8,10)+"-"+val.MstGCM.TimeStamp2.substring(5,7)+"-"+val.MstGCM.TimeStamp2.substring(0,4));
                    
                    if (val.MstGCM.hasOwnProperty('IsActive')) {
                        if(val.MstGCM.IsActive == "Y"){
                            $('[name="IsActive_Update"]').attr("checked","");
                        }
                    }

                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log(jqXhr);
                    console.log( errorThrown );
                    console.log(textStatus);
                },
            });
            $('#update-master-gcm').modal();
        });

        //AutoComplete
            // var x = {!! json_encode($Conditions) !!}
            // $('#autocomplete').autocomplete({
            // source: x
            // });
            // console.log(x);

    })
</script>

@include('modal.add_master_gcm')
@include('modal.update_master_gcm')
@endsection