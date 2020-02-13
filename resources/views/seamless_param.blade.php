@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-param', 'active')

@section('content')

<!-- TableSeamlessParam -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Master Param Simulation</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                <a href="{{asset('/seamless-param-create')}}" class="btn btn-block btn-primary">Create New</a>
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
                <input type="text" placeholder="Search by Kode Product" class="InputSearch form-control">
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
            <th>Kode Product</th>
            <th>DP (%)</th>
            <th>Tenor</th>
            <th>Type Insurance</th>
            <th>Mode Insurance</th>
            <th>Flag ACP</th>
            <th>Flag ADDM</th>
            <th>Action</th>

            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessParams as $SeamlessParam)
            <tr>  
                <td><span>{{$SeamlessParam->CD_PRODUCT}}</span></td>
                <td><span>{{$SeamlessParam->PERC_DP}}</span></td>
                <td><span>{{$SeamlessParam->TENOR}}</span></td>
                <td><span>
                @if ($SeamlessParam->TYPE_INSU == 'A')
                All Risk
                @elseif ($SeamlessParam->TYPE_INSU == 'T')
                TLO
                @endif
                </span></td>
                <td><span>
                @if ($SeamlessParam->MODE_INSU == 'C')
                Cash
                @elseif ($SeamlessParam->MODE_INSU == 'K')
                Kredit
                @endif
                </span></td>
                <td><span>
                @if ($SeamlessParam->FLAG_ACP == 'Y')
                Yes
                @elseif ($$SeamlessParam->FLAG_ACP == 'N')
                No
                @endif
                </span></td>
                <td><span>{{$SeamlessParam->FLAG_ADDM}}</span></td>
                <td><span>
                <a href="{{asset('/seamless-param-update/'.$SeamlessParam->CD_PRODUCT)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 
                <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></button> -->
                
                <a href="{{asset('/seamless-param/delete/'.$SeamlessParam->CD_PRODUCT)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')"><i class="fa fa-trash"></i></a>
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
                {"searchable":false},
                {"searchable":false},
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
