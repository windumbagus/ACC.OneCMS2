@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-banner', 'active')

@section('content')

<!-- TableSeamlessBanner -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Banner</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
<!-- 
                        <a href="#" class="add-seamless-Product btn btn-block btn-primary">Create New</a> -->
                </div>
                <!-- <div class="col-sm-6">
                        
                </div> -->
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
          
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="ResetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="example2" class="table table-bordered display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Kode Promo</th>
            <th>Is Active Promo</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Promo Type</th>
            <th>Promo Ammount</th>
            <th>Product Owner</th>
            <th>Jenis Promo</th>
            <th>Periode Promo</th>
            <th>Is Active Banner</th>
            <th>Picture</th>
            <th>Action</th>

            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessBanners as $SeamlessBanner)
            <tr>  
                <td><span>{{$SeamlessBanner->NAME}}</span></td>
                <td><span>{{$SeamlessBanner->PROMO_CODE}}</span></td>
                <td><span>{{$SeamlessBanner->IS_ACTIVE_PROMO}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessBanner->START_DATE))}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessBanner->END_DATE))}}</span></td>
                <td><span>{{$SeamlessBanner->PROMO_TYPE}}</span></td>
                <td><span>{{$SeamlessBanner->PROMO_AMOUNT}}</span></td>
                <td><span>{{$SeamlessBanner->PRODUCT_OWNER}}</span></td>
                <td><span>{{$SeamlessBanner->JENIS_PROMO}}</span></td>
                <td><span>{{$SeamlessBanner->PERIODE_PROMO}}</span></td>
                <td><span>{{$SeamlessBanner->IS_ACTIVE_BANNER}}</span></td>
                <td><span><img class="myImg" style="width: 30%; height: 30%;" alt="" src="{{$SeamlessBanner->URL_FILE}}" /></span></td>

                <td><span>
                <a href="{{asset('/seamless-banner-update/'.$SeamlessBanner->ID)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 
                <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></button> -->
                <a href="{{ route('seamless-banner.delete',array($SeamlessBanner->ID))}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash-o"></i></a>
                </span></td>
                
            
            </tr>                              
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    $(document).ready(function () {
      $('#example2').DataTable({
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
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"searchable":false},
                {"searchable":false},
                
            ]
      })


   
        //Button Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example2').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example2').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })

      

        
    })
  </script>

@endsection
