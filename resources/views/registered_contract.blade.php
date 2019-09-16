@extends('admin.admin') 

@section('service', 'active')
@section('registered-contract', 'active')

@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Registered Contract</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by No Contract or Username" class="InputSearch form-control">
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
            <th>Username</th>
            <th>Contract</th>
            <th>V Account</th>
            <th>Date</th>
            <th>Police No</th>
            <th>Car Type</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Contracts as $Contract)

            <tr>  
                <td><span>{{$Contract->User->Username}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->CONTRACT_NO}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->V_ACCOUNT}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->BILL_DATE}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->POLICE_NO}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->CAR_TYPE}}</span></td>
                
                {{-- @if (property_exists($Bug->MstKritikSaranBug, 'Report')) --}}
                {{-- @if( strlen($Contract->MstKritikSaranBug->Report)>= 100)
                    <td><span>{{substr($Contract->MstKritikSaranBug->Report,0,100)."..."}}</span></td>
                @else 
                    <td><span>{{$Contract->MstKritikSaranBug->Report}}</span></td>
                @endif --}}
                <td>
                <span>
                    <a href="#" data-id="{{ $Contract->MstRegisteredContract->Id}}" class="view-registered-contract btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                    <a  href="{{asset('bug-report/delete/'.$Contract->MstRegisteredContract->Id)}}" 
                        data-id2="{{ $Contract->MstRegisteredContract->Id}}" class=" btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure want to delete this ?')" ><i class="fa fa-trash"></i>
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

        //VIEW
        $(document).on('click','.view-registered-contract',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/registered-contract/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    // $('[name="bug_report_User_view"]').val(val.User.Name);
                    // $('[name="bug_report_Report_view"]').val(val.MstKritikSaranBug.Report);
                    // $('[name="bug_report_Flag_view"]').val(val.MstKritikSaranBug.Flag);
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            // $('#view-bug-report').modal();
        });
        
    })
</script>


@endsection