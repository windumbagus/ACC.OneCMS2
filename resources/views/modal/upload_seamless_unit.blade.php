@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Unit</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-seamless-unit" action="{{asset('/seamless-unit/upload')}}" method="post" enctype="multipart/form-data"> 
            @csrf
            
            Structure : CD_BRAND, DESC_BRAND, CD_TYPE, DESC_TYPE, CD_MODEL, DESC_MODEL, TAHUN, TYPE_MACHINE, MACHINE_CAPACITY, TRANSMISSION, FLAG_NEWUSED, ID_USER_ADDED, ID_USER_UPDATED, FLAG_ACTIVE, DESC_PRODUCT<br>
            <br/><br/>
            Format &nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_seamless_unit" id="upload_seamless_unit" required >
                    </div>
                    <div class="form-group">
                        {{-- <label> JSON : </label><br> --}}
                        <textarea name="jsonObject" id="jsonObject" class="form-control" style="display:none;"></textarea>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Upload</button>	
                        <button type="reset" class="btn btn-danger" id="reset-table">Cancel</button>		
                    </div>
                </div>
            </div>
        </form>

        <table id="table_upload_seamless_unit" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>CD_BRAND</th>
                    <th>DESC_BRAND</th>
                    <th>CD_TYPE</th>
                    <th>DESC_TYPE</th>
                    <th>CD_MODEL</th>
                    <th>DESC_MODEL</th>
                    <th>TAHUN</th>
                    <th>TYPE_MACHINE</th>
                    <th>MACHINE_CAPACITY</th>
                    <th>TRANSMISSION</th>
                    <th>FLAG_NEWUSED</th>
                    <th>ID_USER_ADDED</th>
                    <th>ID_USER_UPDATED</th>
                    <th>FLAG_ACTIVE</th>
                    <th>DESC_PRODUCT</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="{{asset('/seamless-unit/cancel')}}" class="btn btn-block btn-primary">Back</a>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
            <div class="col-sm-8"></div>
        </div>

    </div>
</div>

<Script>
    $(document).ready(function(){
        $('#table_upload_seamless_unit').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
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
                null,
                null,
                null,
                null,
                null,
                null,
                {"searchable":false},      
            ]
        })

        //Reset Button Search
        $('#reset-table').on('click',function(){
            var table = $('#table_upload_seamless_unit').DataTable()
            table.clear().draw()
        })

        $("#upload_seamless_unit").change(function(evt){
            var selectedFile = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var data = event.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
                var XL_row_object;
                var json_object;
                workbook.SheetNames.forEach(function(sheetName) {
                    XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName],{raw:false,defval:""});
                    json_object = JSON.stringify(XL_row_object);
                    document.getElementById("jsonObject").innerHTML = json_object;
                })
                
                var table = $('#table_upload_seamless_unit').DataTable()
                var X = XL_row_object;
                table.clear().draw()

                X.map(e=>{
                    table.row.add([
                        e.CD_BRAND,
                        e.DESC_BRAND,
                        e.CD_TYPE,
                        e.DESC_TYPE,
                        e.CD_MODEL,
                        e.DESC_MODEL,
                        e.TAHUN,
                        e.TYPE_MACHINE,
                        e.MACHINE_CAPACITY,
                        e.TRANSMISSION,
                        e.FLAG_NEWUSED,
                        e.ID_USER_ADDED,
                        e.ID_USER_UPDATED,
                        e.FLAG_ACTIVE,
                        e.DESC_PRODUCT,
                    ]).draw(false)
                }) 
            };
            reader.onerror = function(event) {
                console.error("File could not be read! Code " + event.target.error.code);
            };
            reader.readAsBinaryString(selectedFile);
        });
    });
</Script>
@endsection
