<!-- Modal ADD -->
<div class="modal fade" id="view-bug-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="box-title">View Bug Report</h4> 
                </div>
            <form id="form-view-bug-report" action="#" method="post"> 
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>User</label>
                            <input type="text" class="form-control" name="bug_report_User_view"
                            placeholder="User" readonly>
                        </div>
                        <div class="form-group">
                            <label>Report</label>
                            <textarea type="text" class="form-control" name="bug_report_Report_view"
                            placeholder="Report" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label>Flag</label>
                            <input type="text" class="form-control" name="bug_report_Flag_view"
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
            $('#view-bug-report').modal('hide');
            $('#form-view-bug-report')[0].reset();  
            });      
        });
    </Script>
    