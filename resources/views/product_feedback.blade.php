@extends('admin.admin') 

@section('product-feedback', 'active')
@section('feedback', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Product Feedback</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <a href="{{asset('/product-feedback/download')}}" class="btn btn-block btn-primary">Download</a>
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Report or User" class="InputSearch form-control">
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
            <th>User</th>
            <th>Report</th>
            <th>Flag</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Feedbacks as $Feedback)

            <tr>  
                <td><span>{{$Feedback->User->Name}}</span></td>

                {{-- @if (property_exists($Feedback->MstKritikSaranBug, 'Report')) --}}
                @if( strlen($Feedback->MstKritikSaranBug->Report)>= 100)
                    <td><span>{{substr($Feedback->MstKritikSaranBug->Report,0,100)."..."}}</span></td>
                @else 
                    <td><span>{{$Feedback->MstKritikSaranBug->Report}}</span></td>
                @endif

                <td><span>{{$Feedback->MstKritikSaranBug->Flag}}</span></td>
                <td>
                <span>
                    <a href="#" data-id="{{ $Feedback->MstKritikSaranBug->Id}}" class="view-product-feedback btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                    @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                        <a  href="{{asset('product-feedback/delete/'.$Feedback->MstKritikSaranBug->Id)}}" 
                        data-id2="{{ $Feedback->MstKritikSaranBug->Id}}" class=" btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure want to delete this ?')" ><i class="fa fa-trash"></i>
                        </a> 
                    @endif
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
                null,
                null,
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

        //VIEW
        $(document).on('click','.view-product-feedback',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/product-feedback/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="product_feedback_User_view"]').val(val.User.Name);
                    $('[name="product_feedback_Report_view"]').val(val.MstKritikSaranBug.Report);
                    $('[name="product_feedback_Flag_view"]').val(val.MstKritikSaranBug.Flag);
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-product-feedback').modal();
        });
        
    })
</script>
@include('modal.view_product_feedback')
@endsection