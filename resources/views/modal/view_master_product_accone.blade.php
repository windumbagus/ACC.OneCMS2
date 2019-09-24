<!-- Modal ADD -->
<div class="modal fade" id="view-master-product-accone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="box-title">View Master Product AccOne</h4> 
                </div>
                <form id="form-view-master-product-accone" action="#" method="post"> 
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>CD PRODUCT</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_PRODUCT" readonly>
                        </div>
                        <div class="form-group">
                            <label>DESC PRODUCT</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DESC_PRODUCT" readonly>
                        </div>
                        <div class="form-group">
                            <label>CD AREA</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_AREA" readonly>
                        </div>
                        <div class="form-group">
                            <label>CD SP</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_SP" readonly>
                        </div>
                        <div class="form-group">
                            <label>CD BRAND</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_BRAND" readonly>
                        </div>
                        <div class="form-group">
                            <label>CD TYPE</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_TYPE" readonly>
                        </div>
                        <div class="form-group">
                            <label>CD MODEL</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_CD_MODEL" readonly>
                        </div>
                        <div class="form-group">
                            <label>DP</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DP" readonly>
                        </div>
                        <div class="form-group">
                            <label>TENOR</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_TENOR" readonly>
                        </div>
                        <div class="form-group">
                            <label>AMT INSTALLMENT</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_AMT_INSTALLMENT" readonly>
                        </div>
                        <div class="form-group">
                            <label>AMT OTR</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_AMT_OTR" readonly>
                        </div>
                        <div class="form-group">
                            <label>FLAG INSURANCE</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_FLAG_INSURANCE" readonly>
                        </div>
                        <div class="form-group">
                            <label>FLAG ACP</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_FLAG_ACP" readonly>
                        </div>
                        <div class="form-group">
                            <label>AMC TDP</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_AMC_TDP" readonly>
                        </div>
                        <div class="form-group">
                            <label>AMT TOTAL INSTALLMENT</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_AMT_TOTAL_INSTALLMENT" readonly>
                        </div>
                        <div class="form-group">
                            <label>DT START</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DT_START" readonly>
                        </div>
                        <div class="form-group">
                            <label>DT END</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DT_END" readonly>
                        </div>
                        <div class="form-group">
                            <label>DT ADDED</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DT_ADDED" readonly>
                        </div>
                        <div class="form-group">
                            <label>DT UPDATED</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DT_UPDATED" readonly>
                        </div>
                        <div class="form-group">
                            <label>DESC BRAND</label>
                            <input type="text" class="form-control" name="view_ProductAccOne_DESC_BRAND" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="close-modal">Close</button>		
                    </div>	
                </form>
            </div>
        </div>
    </div>
    
    <Script>
        $(function() {
            $('#close-modal').click(function() {
            $('#view-master-product-accone').modal('hide');
            $('#form-view-master-product-accone')[0].reset();  
            });      
        });
    </Script>
    