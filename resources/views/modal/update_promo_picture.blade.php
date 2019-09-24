
<div class="modal fade" id="update-promo-picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Upload Picture</h4> 
            </div>
            <form id="form-update-promo-picture" action="#" method="post">

            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-update-promo-picture').click(function() {
            $('#update-promo-picture').modal('hide');
            $('#form-update-promo-picture')[0].reset();  
        });      
    });
</Script>