@extends('admin.admin') 

@section('master-management', 'active')
@section('master-holiday', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Holiday GCM</h3>
            </div>
            <div class="col-sm-4">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <div class="col-sm-6 pull-right">
                        <a href="{{asset('/holiday-gcm/download')}}" class="btn btn-block btn-primary">Download</a>
                    </div>
                @endif
                @if ((property_exists($Role,'IsCreate')) && ($Role->IsCreate == True))
                    <div class="col-sm-6 pull-right">
                        <a href="#" class="add-holiday-gcm btn btn-block btn-primary">Create New Holiday</a>  
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Description" class="InputSearch form-control">
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
            <th>Tanggal Holiday</th>
            <th>Description</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Holidays as $Holiday)
            <tr>  
                <td><span>{{$Holiday->HolidayCMS->TanggalHoliday}}</span></td>
                <td><span>{{$Holiday->HolidayCMS->Description}}</span></td>
                {{-- @if (property_exists($Holiday->HolidayCMS, 'TanggalHoliday'))
                <td><span>{{$Holiday->HolidayCMS->TanggalHoliday}}</span></td>
                @else 
                <td></td>
                @endif --}}
                <td>
                <span>
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        <a href="#" data-id="{{ $Holiday->HolidayCMS->Id}}" class="update-holiday-gcm btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a> &nbsp; 
                    @else
                        <a href="#" data-id="{{ $Holiday->HolidayCMS->Id}}" class="update-holiday-gcm btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a> &nbsp; 
                    @endif
                    @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                        <a  href="{{asset('holiday-gcm/delete/'.$Holiday->HolidayCMS->Id)}}" class=" btn btn-danger btn-sm" 
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
                {"searchable":false},                
                null,
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
        $(document).on('click','.add-holiday-gcm',function(){
        $('#add-holiday-gcm').modal();     
        });

        //VIEW
        $(document).on('click','.update-holiday-gcm',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/holiday-gcm/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="id_holiday_update"]').val(val.Id);
                    $('[name="tanggal_holiday_update"]').val(val.TanggalHoliday);
                    $('[name="description_holiday_update"]').val(val.Description);
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#update-holiday-gcm').modal();
        });


        
    })
  </script>

@include('modal.add_holiday_gcm')
@include('modal.update_holiday_gcm')
@endsection
