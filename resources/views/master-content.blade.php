@extends('admin.admin') 

@section('content-management', 'active')
@section('master-content', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Master Content</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#" class="button-promo-add btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-4">
                <input type="text" placeholder="Content Type" class="input-search form-control">
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by Title or Description" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button-search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button-resetsearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        

    </div>
</div>

<!-- page script -->
<script>
    $(document).ready(function () {
        $('#datatable_1').DataTable({
            'deferRender' : true,
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX': true,
            sDom: 'lrtip', 
            "columns": [
                null,
                {"searchable":false},    
                null,            
                {"searchable":false},
                {"searchable":false},                
                {"searchable":false},               
                {"searchable":false},
            ]
        })

        //Button Search
        $('.button-search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable_1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button-resetsearch').on('click',function(){
            var tab = $('#datatable_1').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })

        
    })
</script>

@endsection