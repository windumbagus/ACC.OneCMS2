@extends('admin.admin') 

@section('master-management', 'active')
@section('master-searching', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-7">
                <h3 class="box-title">Master Searching</h3>
            </div>
            <div class="col-sm-5">
                <div class="col-sm-8">
                    <a href="#" class="add-master-searching btn btn-block btn-primary">Create New Master GCM Searching</a>  
                </div>
                <div class="col-sm-4">
                <a href="#" class="upload-master-searching btn btn-block btn-primary">Upload</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Suggestion" class="InputSearch form-control">
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="ResetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Input Keywoard</th>
                <th>Search Suggestions</th>
                <th>Destination</th>
                <th>Redirect to Screen</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($Searching as $Search)

                    <tr>  
                        <td><span>{{$Search->Input_Keyword}}</span></td>
                        <td><span>{{$Search->Search_Suggestions}}</span></td>
                        <td><span>{{$Search->Destination}}</span></td>
                        @if (property_exists($Search, 'RedirectToScreen'))
                            <td><span>{{$Search->RedirectToScreen}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif
                                               
                        <td>
                            <span>
                                <a href="#" data-id="{{$Search->Id}}" class="update-master-searching btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('master-searching/delete/'.$Search->Id)}}" class=" btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure want to delete this data?')" ><i class="fa fa-trash"></i>
                                </a> 
                            </span>
                        </td>
                    </tr>   
                                    
                @endforeach       
            </tbody>
        </table>
    </div>
 </div>

 <!-- page script -->
<script>
    $(document).ready(function () {
        
      $('#RedirectToScreenAdd').hide()
      $('#RedirectToScreenUpdate').hide()

      $('#example1').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                {"searchable":false},                
                null,
                {"searchable":false},                
                {"searchable":false},               
                {"searchable":false},
            ]
      })

        //Button Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })

        //ADD
        $(document).on('click','.add-master-searching',function(){
        $('#add-master-searching').modal();     
        });
        
        //Upload
        $(document).on('click','.upload-master-searching',function(){
        $('#upload-master-searching').modal();     
        });

        //VIEW
        $(document).on('click','.update-master-searching',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/master-searching/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="input_keyword_update"]').val(val.MstSearch.Input_Keyword);
                    $('[name="search_suggestion_update"]').val(val.MstSearch.Search_Suggestions);
                    $('[name="destination_update"]').val(val.MstSearch.Destination);
                    $('[name="redirect_to_screen_update"]').val(val.MstSearch.RedirectToScreen);
                    $('[name="id_update"]').val(val.MstSearch.Id);
                    if(val.MstSearch.Destination=="acc.one"){
                        $('#RedirectToScreenUpdate').show()
                    }

                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown);
                console.log(textStatus);
                },
            });
            $('#update-master-searching').modal();
        });
        
    })
</script>
@include('modal.add_master_searching')
@include('modal.update_master_searching')
@include('modal.upload_master_searching')
@endsection