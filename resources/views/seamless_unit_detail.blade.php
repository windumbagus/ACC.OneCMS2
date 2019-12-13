@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit-detail', 'active')

@section('content')

<!-- TableSeamlessUnitDetail -->

          <div class="box box-solid">
            <div class="box-header with-border">
                <div class="col-sm-8">
                    <h3 class="box-title">Unit Details</h3>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-6">
                            <a href="{{asset('seamless-unit') }}" class="add-seamless-Product btn btn-block btn-primary">Back</a>
                    </div>
                    <div class="col-sm-6">
                            <a href="{{asset('/seamless-unit-detail/upload-page/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" class="btn btn-block btn-primary">Upload</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        OTR
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                 
                        <table style="width:100%">
                        
                        <tr>
                            <th>Kode Area</th>
                            <td> <span>@if( !empty($SeamlessUnitOtrs[0]->CD_AREA))
                                {{$SeamlessUnitOtrs[0]->CD_AREA}} 
                                @else
                                tidak ditemukan
                                @endif
                            </span></td>
                         
                        </tr>
                        <tr>
                            <th>OTR</th>
                            <td><span> @if( !empty($SeamlessUnitOtrs[0]->OTR))
                                {{$SeamlessUnitOtrs[0]->OTR}} 
                                @else
                                tidak ditemukan
                                @endif
                            </span></td>
                        </tr>
                        </table>
                        <br/>
                        <br/>
                        <div class="col-sm-2">
                            <a href="{{asset('/seamless-unit-otr/upload-page/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" class="btn btn-block btn-primary">Upload OTR</a>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Color and Picture
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-8">
                                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
                            </div>
                            <div class="col-sm-3">
                                <div class="col-sm-6">
                                    <a href="#" class="ButtonSearch2 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="ResetSearch2 btn btn-block btn-info">Reset</a>    
                                </div>
                            </div>
                        </div><br>

                        <table id="example2" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Color Code</th>
                            <th>Color Description</th>
                            <th>ID File</th>
                            <th>Category</th>
                            <th>File Name</th>
                            <th>Type File</th>
                            <th>Picture</th>     
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($SeamlessUnitColors as $SeamlessUnitColor)
                            <tr>  
                                <td><span>{{$SeamlessUnitColor->CD_COLOR}}</span></td>
                                <td><span>{{$SeamlessUnitColor->DESC_COLOR}}</span></td>
                                <td><span>{{$SeamlessUnitColor->ID_FILE}}</span></td>
                                <td><span>{{$SeamlessUnitColor->CATEGORY}}</span></td>
                                <td><span>{{$SeamlessUnitColor->FILE_NAME}}</span></td>          
                                <td><span>{{$SeamlessUnitColor->TYPE_FILE}}</span></td>
                                <td><span><img style="width: 50px; height: 50px;" alt=""
                                                    src="{{$SeamlessUnitColor->PATH_FILE}}" /></span></td>
                                
                                
                            </tr>                              
                            @endforeach       
                        </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Detail
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-6">
                                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
                            </div>
                            <div class="col-sm-5">
                                <div class="col-sm-4">
                                    <a href="#" class="ButtonSearch1 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" class="ResetSearch1 btn btn-block btn-info">Reset</a>    
                                </div>
                                <div class="col-sm-4">
                                  <a href="{{asset('/seamless-unit-detail/upload-page/'.$unitid.'&'.$brand.'&'.$type.'&'.$model.'&'.$tahun)}}" class="btn btn-block btn-primary">Upload</a>
                                </div>
                            </div>
                        </div><br>

                        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Char Value</th>
                            <th>Char Desc</th>
                            <th>Date Added</th>
                            <th>Id User Added</th>
                            <th>Date Updated</th>
                            <th>Id User Updated</th>     
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($SeamlessUnitDetails as $SeamlessUnitDetail)
                            <tr>  
                                <td><span>{{$SeamlessUnitDetail->CATEGORY}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->CHAR_VALUE}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->CHAR_DESC}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->DT_ADDED}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->ID_USER_ADDED}}</span></td>          
                                <td><span>{{$SeamlessUnitDetail->DT_UPDATED}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->ID_USER_UPDATED}}</span></td>
                                            
                                
                            </tr>                              
                            @endforeach       
                        </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
        <!-- /.col -->



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
                null,
                null,
                null,                
                null,
               
                
            ]
      })

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
               
                
            ]
      })


        //Button Search
        $('.ButtonSearch1').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

    
        $('.ResetSearch1').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })


        $('.ButtonSearch2').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example2').DataTable()
            dtable.search(searchData).draw()
        })

        $('.ResetSearch2').on('click',function(){
            var tab = $('#example2').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })


        
    })
  </script>

@endsection
