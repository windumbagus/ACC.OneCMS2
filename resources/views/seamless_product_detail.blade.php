@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-product', 'active')

@section('content')

<style>
	
	body {font-family: Arial, Helvetica, sans-serif;}
	
	#myImg {
	  border-radius: 5px;
	  cursor: pointer;
	  transition: 0.3s;
	}
	
	#myImg :hover {opacity: 0.7;}
	
	/* The Modal (background) */
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 120px; /* Location of the box */
	  left: 0%;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}
	
	/* Modal Content (image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 100%;
	  max-width: 700px;
	}
	

	
	/* Add Animation */
	.modal-content, #caption {  
	  -webkit-animation-name: zoom;
	  -webkit-animation-duration: 0.6s;
	  animation-name: zoom;
	  animation-duration: 0.6s;
	}
	
	@-webkit-keyframes zoom {
	  from {-webkit-transform:scale(0)} 
	  to {-webkit-transform:scale(1)}
	}
	
	@keyframes zoom {
	  from {transform:scale(0)} 
	  to {transform:scale(1)}
	}
	
	/* The Close Button */
	.close {
	  position: fixed;
	  top: 55px;
	  right: 35px;
	  color: #f1f1f1;
	  font-size: 40px;
	  font-weight: bold;
	  transition: 0.3s;
	}
	
	.close:hover,
	.close:focus {
	  color: #bbb;
	  text-decoration: none;
	  cursor: pointer;
	}
	
	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
	  .modal-content {
		width: 100%;
	  }
	}
</style>

<!-- TableSeamlessUnitDetail -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <div class="col-sm-8">
                  <h3 class="box-title">Product Details</h3>
              </div>
              <div class="col-sm-4">
                  <div class="col-sm-6">

                          <a href="{{ asset('seamless-product') }}" class="add-seamless-Product btn btn-block btn-primary">Back</a>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-warning">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Detail
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                        
                        <table style="width:100%">
                        
                        <tr>
                            <th>Product Code</th>
                            <td> <span>@if( !empty($SeamlessProducts[0]->CD_PRODUCT))
                                {{$SeamlessProducts[0]->CD_PRODUCT}} 
                                @else
                                -
                                @endif
                            </span></td>
                         
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td> <span>@if( !empty($SeamlessProducts[0]->DESC_PRODUCT))
                                {{$SeamlessProducts[0]->DESC_PRODUCT}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td><span> @if( !empty($SeamlessProducts[0]->DT_START))
                                {{$SeamlessProducts[0]->DT_START}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td><span> @if( !empty($SeamlessProducts[0]->DT_END))
                                {{$SeamlessProducts[0]->DT_END}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>Is Active</th>
                            <td><span> @if( !empty($SeamlessProducts[0]->FLAG_ACTIVE))
                                {{$SeamlessProducts[0]->FLAG_ACTIVE}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>Is Promoted</th>
                            <td><span> @if( !empty($SeamlessProducts[0]->FLAG_PROMOTED))
                                {{$SeamlessProducts[0]->FLAG_PROMOTED}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        </table>
                        <div id="myModal" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img01">
														<div id="caption"></div>
													</div>
                        <br/><br/>
                        <div class="col-sm-2">
                                <a href="{{asset('/seamless-product-detail-update/'.$SeamlessProducts[0]->CD_PRODUCT)}}" class="btn btn-block btn-primary">Update</a>         
                        </div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Picture
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                        
                        <table style="width:100%">
                        
                        <tr>
                            <th>Product Name</th>
                            <td> <span>@if( !empty($SeamlessProductPicts[0]->DESC_PRODUCT))
                                {{$SeamlessProductPicts[0]->DESC_PRODUCT}} 
                                @else
                                -
                                @endif
                            </span></td>
                         
                        </tr>
                        <tr>
                            <th>TNC</th>
                            <td> @if( !empty($SeamlessProductPicts[0]->TNC))
                            {!! $SeamlessProductPicts[0]->TNC !!} 
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td><span> @if( !empty($SeamlessProductPicts[0]->DESC_DETAIL))
                                {{$SeamlessProductPicts[0]->DESC_DETAIL}} 
                                @else
                                -
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <th>Picture</th>
                            <td><span> @if( !empty($SeamlessProductPicts[0]->URL))
                            <img id="myImg" style="width: 30%; height: 30%;" alt=""
                                                    src="{{$SeamlessProductPicts[0]->URL}}" />
                                @else
                                tidak ditemukan
                                @endif
                            </span></td>
                        </tr>
                        </table>
                        <div id="myModal" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img01">
														<div id="caption"></div>
													</div>
                        <br/><br/>
                        <div class="col-sm-2">
                                <a href="{{asset('/seamless-product-picture/'.$SeamlessProductPicts[0]->CD_PRODUCT)}}" class="btn btn-block btn-primary">Update</a>         
                        </div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Unit List
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                  <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-8">
                                <input type="text" placeholder="Search by Brand, Type, Model, Year, etc" class="InputSearch form-control">
                            </div>
                            <div class="col-sm-3">
                                <div class="col-sm-6">
                                    <a href="#" class="ButtonSearch1 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="ResetSearch1 btn btn-block btn-info">Reset</a>    
                                </div>
                            </div>
                        </div><br>

                        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Kode Cabang</th>
                           
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($SeamlessProductDetails as $SeamlessProductDetail)
                            <tr>  
                                <td><span>{{$SeamlessProductDetail->DESC_BRAND}}</span></td>
                                <td><span>{{$SeamlessProductDetail->DESC_TYPE}}</span></td>
                                <td><span>{{$SeamlessProductDetail->CD_SP}}</span></td>
                                
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


    })

    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    };

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    };


  </script>

@endsection
