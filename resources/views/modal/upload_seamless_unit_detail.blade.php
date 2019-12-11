@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Upload Unit Detail of Unit Id : {{$unitid}}</h4> 
    </div>
    <div class="box-body">
        <form id="form-upload-seamless-unit-detail" action="{{asset('/seamless-unit-detail/upload/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" method="post" enctype="multipart/form-data"> 
            @csrf
               
            Structure : ID_UNIT, CATEGORY, CD_VALUE, CHAR_VALUE, CHAR_DESC, ID_USER_ADDED, ID_USER_UPDATED<br>
            <br/><br/>
            Format &nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload_seamless_unit_detail" id="upload_seamless_unit_detail" required >
                    </div>
                    <div class="form-group">
                        <label> JSON : </label><br>
                        <textarea name="jsonObject" id="jsonObject" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Upload</button>	
                        <button type="reset" class="btn btn-danger">Cancel</button>	
                    </div>
                   


                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="{{asset('/seamless-unit-detail/cancel/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" class="btn btn-block btn-primary">Back</a>
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
        $("#upload_seamless_unit_detail").change(function(evt){
            var selectedFile = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var data = event.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
                workbook.SheetNames.forEach(function(sheetName) {
                
                    var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName],{raw:false});
                    var json_object = JSON.stringify(XL_row_object);
                    document.getElementById("jsonObject").innerHTML = json_object;
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
