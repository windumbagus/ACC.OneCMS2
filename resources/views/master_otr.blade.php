@extends('admin.admin') 

@section('master-management', 'active')
@section('master-otr', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">Master OTR</h3>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <a href="#" class="add-master-otr btn btn-block btn-primary">Create New Master OTR</a>  
                </div>
                <div class="col-sm-3">
                    <a href="#" class="upload-master-otr btn btn-block btn-primary">Upload</a>
                </div>
                <div class="col-sm-3">
                    <a href="{{asset('/master-otr/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Brand, Type, Model, Tahun dan OTR" class="InputSearch form-control">
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
                <th>Brand</th>
                <th>Type</th>
                <th>Model</th>
                <th>New/Used</th>
                <th>Tahun</th>
                <th>OTR</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($OTRs as $otr)
                    <tr>  
                        <td>
                            @if (property_exists($otr->MstOtr, 'CD_BRAND'))
                            <span style="font-size:12px">{{$otr->MstOtr->CD_BRAND}}</span><br>
                            @else
                            <span>-</span><br>
                            @endif

                            @if (property_exists($otr->MstOtr, 'DESC_BRAND'))
                            <span>{{$otr->MstOtr->DESC_BRAND}}</span><br>
                            @else
                            <span>-</span>
                            @endif
                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_BRAND}}</span><br>
                            <span>{{$otr->MstOtr->DESC_BRAND}}</span> --}}
                        </td>
                        <td>
                            @if (property_exists($otr->MstOtr, 'CD_TYPE'))
                            <span style="font-size:12px">{{$otr->MstOtr->CD_TYPE}}</span><br>
                            @else
                            <span>-</span><br>
                            @endif

                            @if (property_exists($otr->MstOtr, 'DESC_TYPE'))
                            <span>{{$otr->MstOtr->DESC_TYPE}}</span><br>
                            @else
                            <span>-</span>
                            @endif

                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_TYPE}}</span><br>
                            <span>{{$otr->MstOtr->DESC_TYPE}}</span> --}}
                        </td>
                        <td>
                                @if (property_exists($otr->MstOtr, 'CD_MODEL'))
                                <span style="font-size:12px">{{$otr->MstOtr->CD_MODEL}}</span><br>
                                @else
                                <span>-</span><br>
                                @endif
    
                                @if (property_exists($otr->MstOtr, 'DESC_MODEL'))
                                <span>{{$otr->MstOtr->DESC_MODEL}}</span><br>
                                @else
                                <span>-</span>
                                @endif
                            {{-- <span style="font-size:12px">{{$otr->MstOtr->CD_MODEL}}</span><br>
                            <span>{{$otr->MstOtr->DESC_MODEL}}</span> --}}
                        </td>

                        @if (property_exists($otr->MstOtr, 'FLAG_NEW_USED'))
                            @if($otr->MstOtr->FLAG_NEW_USED == "N")
                            <td><span>New</span></td>
                            @else
                            <td><span>Used</span></td>
                            @endif
                        @else
                        <td><span>-</span></td>
                        @endif

                        @if (property_exists($otr->MstOtr, 'TAHUN'))
                        <td><span>{{$otr->MstOtr->TAHUN}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif

                        @if (property_exists($otr->MstOtr, 'OTR'))
                            <td><span>{{$otr->MstOtr->OTR}}</span></td>
                        @else
                        <td><span>-</span></td>
                        @endif
                                               
                        <td>
                            <span>
                                <a href="#" data-id="{{$otr->MstOtr->Id}}" class="update-master-otr btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('master-otr/delete/'.$otr->MstOtr->Id)}}" class=" btn btn-danger btn-sm" 
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
                null,
                null,
                null,
                {"searchable":false},                
                null,
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
        $(document).on('click','.add-master-otr',function(){
        $('#add-master-otr').modal();     
        });
        
        // //Upload
        // $(document).on('click','.upload-master-searching',function(){
        // $('#upload-master-searching').modal();     
        // });

        // //VIEW
        // $(document).on('click','.update-master-searching',function(){
        //     var id = $(this).attr('data-id');
        //     console.log(id);
        //     $.ajax({
        //         url:"{{asset('/master-searching/show')}}",
        //         data: {'Id':id ,'_token':'{{csrf_token()}}' },
        //         dataType:'JSON', 
        //         type:'GET',
        //         success: function (val){
        //             console.log(val);

        //             $('[name="input_keyword_update"]').val(val.MstSearch.Input_Keyword);
        //             $('[name="search_suggestion_update"]').val(val.MstSearch.Search_Suggestions);
        //             $('[name="destination_update"]').val(val.MstSearch.Destination);
        //             $('[name="redirect_to_screen_update"]').val(val.MstSearch.RedirectToScreen);
        //             $('[name="id_update"]').val(val.MstSearch.Id);
        //             if(val.MstSearch.Destination=="acc.one"){
        //                 $('#RedirectToScreenUpdate').show()
        //             }

        //         },
        //         error: function( jqXhr, textStatus, errorThrown ){
        //         console.log(jqXhr);
        //         console.log(errorThrown);
        //         console.log(textStatus);
        //         },
        //     });
        //     $('#update-master-searching').modal();
        // });
        
    })
</script>
@include('modal.add_master_otr')
{{-- @include('modal.update_master_searching')
@include('modal.upload_master_searching') --}}
@endsection