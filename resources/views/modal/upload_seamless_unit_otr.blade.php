@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Unit OTR</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-seamless-unit-otr" action="{{asset('/seamless-unit-otr/upload/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" method="post" enctype="multipart/form-data"> 
            @csrf
               
            Structure : CD_AREA, CD_BRAND, CD_TYPE, CD_MODEL, OTR, ID_USER_ADDED, ID_USER_UPDATED, FLAG_NEWUSED, TAHUN<br>
            <br/><br/>
            Format &nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_seamless_unit_otr" id="upload_seamless_unit_otr" required >
                    </div>
                    <div class="form-group">
                        <label> JSON : </label><br>
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

        <table id="table_upload_seamless_unit_otr" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>CD_AREA</th>
                    <th>CD_BRAND</th>
                    <th>CD_TYPE</th>
                    <th>CD_MODEL</th>
                    <th>OTR</th>
                    <th>ID_USER_ADDED</th>
                    <th>ID_USER_UPDATED</th>
                    <th>FLAG_NEWUSED</th>
                    <th>TAHUN</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="{{asset('/seamless-unit-otr/cancel/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" class="btn btn-block btn-primary">Back</a>
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
        $('#table_upload_seamless_unit_otr').DataTable({
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
                
            ]
        })

        //Reset Button Search
        $('#reset-table').on('click',function(){
            var table = $('#table_upload_seamless_unit_otr').DataTable()
            table.clear().draw()
        })

        $("#upload_seamless_unit_otr").change(function(evt){
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
                
                var table = $('#table_upload_seamless_unit_otr').DataTable()
                var X = XL_row_object;
                table.clear().draw()

                X.map(e=>{
                    table.row.add([
                        e.CD_AREA,
                        e.CD_BRAND,
                        e.CD_TYPE,
                        e.CD_MODEL,
                        e.OTR,
                        e.ID_USER_ADDED,
                        e.ID_USER_UPDATED,
                        e.FLAG_NEWUSED,
                        e.TAHUN,

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
