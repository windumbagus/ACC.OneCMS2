@extends('admin.admin') 


@section('user-management', 'active')
@section('acc-yes-migration', 'active')


@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">ACC Yes Migration</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="{{route('acc-yes-migration/upload-page')}}" class="btn btn-block btn-primary">Upload</a> 
                </div>   
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Name, Email or Mobile Phone" class="InputSearch form-control">
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
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Password</th>
            <th>Flag Send</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            {{-- @dd($Migrations); --}}
            @foreach ($Migrations as $Migration)

            <tr>  
                {{-- @if (property_exists($Approve->User, 'Name'))
                    <td><span>{{$Migration->Name}}</span></td>
                    @else 
                    <td></td>
                    @endif --}}
                <td><span>{{$Migration->NAME}}</span></td>
                <td><span>{{$Migration->PHONE_NUMBER}}</span></td>
                <td><span>{{$Migration->EMAIL}}</span></td>
                
                @if(property_exists($Migration,'PASSWORD'))
                    <td><span>{{$Migration->PASSWORD}}</span></td>
                @else
                    <td><span>-</span></td>
                @endif

                @if(property_exists($Migration,'FLAG_SEND'))
                    @if($Migration->FLAG_SEND== true)
                        <td><span><i class="fa fa-check" style="color:green;"></i></span></td>
                    @else 
                        <td><span><i class="fa fa-close" style="color:red;"></i></span></td>
                    @endif
                @else
                    <td><span><i class="fa fa-close" style="color:red;"></i></span></td>
                @endif
                
                <td>
                <span>
                    <a href="{{asset('/acc-yes-migration/delete/'.$Migration->Id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></a> 
                </span>
                </td>
            </tr>   
                            
            @endforeach       
        </tbody>
        </table>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="btn btn-block btn-success">Migrate</a>                     
                </div>  
                <div class="col-sm-6"></div>
            </div>
            <div class="col-sm-8"></div>
        </div>
        

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

    })
</script>
@endsection 

