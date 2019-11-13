@extends('admin.admin') 

@section('feedback', 'active')
@section('bug-report', 'active')

@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Bug Report</h3>
            </div>
            <div class="col-sm-4">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                    <a href="{{asset('/bug-report/download')}}" class="btn btn-block btn-primary">Download</a>
                    </div>
                @endif
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
            @foreach ($Bugs as $Bug)

                <tr>  
                    @if (property_exists($Bug->User, 'Name'))
                        <td><span>{{$Bug->User->Name}}</span></td>
                    @else 
                        <td><span>Anonymous</span></td>
                    @endif

                    @if( strlen($Bug->MstKritikSaranBug->Report)>= 100)
                        <td><span>{{substr($Bug->MstKritikSaranBug->Report,0,100)."..."}}</span></td>
                    @else 
                        <td><span>{{$Bug->MstKritikSaranBug->Report}}</span></td>
                    @endif

                    <td><span>{{$Bug->MstKritikSaranBug->Flag}}</span></td>
                    <td>
                    <span>
                        <a href="#" data-id="{{ $Bug->MstKritikSaranBug->Id}}" class="view-bug-report btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                        @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                            <a  href="{{asset('bug-report/delete/'.$Bug->MstKritikSaranBug->Id)}}" 
                                data-id2="{{ $Bug->MstKritikSaranBug->Id}}" class=" btn btn-danger btn-sm" 
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
        $(document).on('click','.view-bug-report',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/bug-report/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    if (val.User.hasOwnProperty('Name')) {
                        $('[name="bug_report_User_view"]').val(val.User.Name);
                    }else{
                        $('[name="bug_report_User_view"]').val("Anonymous");
                    }
                    $('[name="bug_report_Report_view"]').val(val.MstKritikSaranBug.Report);
                    $('[name="bug_report_Flag_view"]').val(val.MstKritikSaranBug.Flag);
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-bug-report').modal();
        });
        
    })
</script>
@include('modal.view_bug_report')
@endsection