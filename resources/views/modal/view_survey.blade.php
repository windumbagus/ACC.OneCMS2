<!-- Modal ADD -->
<div class="modal fade" id="view-survey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Survey</h4> 
            </div>
            <form id="form-view-survey" action="#" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>User</label>
                        <input type="text" class="form-control" name="survey_User_view" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bintang</label>
                        <input type="text" class="form-control" name="survey_Star_view" readonly>
                    </div>
                    <div class="form-group">
                        <label>Komentar</label>
                        <textarea type="text" class="form-control" name="survey_Comment_view" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Last Survey Date</label>
                        <Input type="text" class="form-control" name="survey_LastSurveyDate_view" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pilihan yang disukai dari aplikasi</label>
                        <input type="text" class="form-control" name="survey_Pilihan_view" readonly>
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
        $('#view-survey').modal('hide');
        $('#form-view-survey')[0].reset();  
        });      
    });
</Script>
