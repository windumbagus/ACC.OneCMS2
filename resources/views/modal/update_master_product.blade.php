<!-- Modal ADD -->
<div class="modal fade" id="update-master-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master Product</h4> 
            </div>
        <form id="form-update-master-product" action="{{ asset('master-product/update') }}" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" name="Id"
                    placeholder="">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="MstPictureId"
                    placeholder="">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="DataId"
                    placeholder="">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="IdPicture"
                    placeholder="">
                </div>
                <div class="form-group">
                    <label>Product Code</label>
                    <input type="text" class="form-control" name="ProductCode"
                    placeholder="">
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="ProductName"
                    placeholder="">
                </div>
                <div class="form-group">
                    <label>Description</label>                
                    <input type="text" class="form-control" name="Description"
                    placeholder="">
                </div>
                <div class="form-group">
                    <label>Mst Picture:</label><br>
                    <img style="width: 200px; height: 200px;" name="Picture" alt="" id="Picture"/><br><br>
                    <input type="file" class="form-control" name="PictureInput" id="PictureInput">
                </div>

                <div class="form-group">
                    <label>Pernyataan 1</label>
                    <textarea type="text" class="form-control" name="Pernyataan1"
                    placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label>Pernyataan 2</label>
                    <textarea type="text" class="form-control" name="Pernyataan2"
                    placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label>Pernyataan 3</label>
                    <textarea type="text" class="form-control" name="Pernyataan3"
                    placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label>Mapping Answer Char Value</label>
                    <select name="MappingAnswerCharValue" id="MappingAnswerCharValue" class="form-control">
                        <option selected disabled value="">--Silahkan Pilih--</option>
                        @foreach ($CharValues as $CharValue)
                            <option value="{{$CharValue}}">{{$CharValue}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mapping Answer Char Desc</label>
                    <select name="MappingAnswerDesc" id="MappingAnswerDesc" class="form-control">
                        <option selected disabled value="">--Silahkan Pilih--</option>
                        @foreach ($CharDescs as $CharDesc)
                            <option value="{{$CharDesc}}">{{$CharDesc}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close-modal btn btn-default" >Close</button>		
                <button type="submit" class="btn btn-success">Save</button>		
            </div>	
        </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal').click(function() {
        $('#update-master-product').modal('hide');
        $('#form-update-master-product')[0].reset();  
        $('#Picture').attr('src', "");
        });      
    });
</Script>
