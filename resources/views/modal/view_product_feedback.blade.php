<!-- Modal ADD -->
<div class="modal fade" id="view-product-feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Product Feedback</h4> 
            </div>
        <form id="form-view-product-feedback" action="#" method="post"> 
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>User</label>
                        <input type="text" class="form-control" name="product_feedback_User_view"
                        placeholder="User" readonly>
                    </div>
                    <div class="form-group">
                        <label>Report</label>
                        <textarea type="text" class="form-control" name="product_feedback_Report_view"
                        placeholder="Report" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Flag</label>
                        <input type="text" class="form-control" name="product_feedback_Flag_view"
                        placeholder="Flag" readonly>
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
        $('#view-product-feedback').modal('hide');
        $('#form-view-product-feedback')[0].reset();  
        });      
    });
</Script>
