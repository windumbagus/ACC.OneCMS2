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
        $("#upload_seamless_unit").change(function(evt){
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
