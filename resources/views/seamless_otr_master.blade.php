@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-otr-master', 'active')

@section('content')

<!-- TableSeamlessUnit -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">OTR</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                        <a href="{{ asset('seamless-otrupload') }}" class="btn btn-block btn-primary">Upload</a>
                       
                </div>
                <div class="col-sm-6">
                        <a href="#" class="btn btn-block btn-danger" onclick="deleteotrSelected()">Delete Selected</a>
                </div>
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
            <th>ID OTR</th>
            <th>Kode Area</th>
            <th>ID Unit</th>
            <th>OTR</th>
            <th>Date Added</th>
            <th>User Added</th>
            <th>Date Updated</th>
            <th>User Updated</th>
            <th>New/Used</th>
            <th>Tahun</th>   
            <th>Action</th>      
            
            
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessOtrMasters as $SeamlessOtrMaster)
            <tr>  
                <td><span>{{$SeamlessOtrMaster->GUID}}</span></td>
                <td><span>{{$SeamlessOtrMaster->CD_AREA}}</span></td>
                <td><span>{{$SeamlessOtrMaster->ID_UNIT}}</span></td>
                <td><span>{{$SeamlessOtrMaster->OTR}}</span></td>
                <td><span>{{$SeamlessOtrMaster->DT_ADDED}}</span></td>  
                <td><span>{{$SeamlessOtrMaster->ID_USER_ADDED}}</span></td>
                <td><span>{{$SeamlessOtrMaster->DT_UPDATED}}</span></td>
                <td><span>{{$SeamlessOtrMaster->ID_USER_UPDATED}}</span></td>
                <td><span>{{$SeamlessOtrMaster->FLAG_NEWUSED}}</span></td>
                <td><span>{{$SeamlessOtrMaster->TAHUN}}</span></td>
                <td><span> 
                <input type="checkbox" class="deleteotrSelected" GUID="{{$SeamlessOtrMaster->GUID}}" ID_UNIT="{{$SeamlessOtrMaster->ID_UNIT}}" >
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
                {"searchable":false},
                
            ]
      })


    //Fungsi OTR Selected
    deleteotrSelected=()=>{
    	const data = [];
      let x = document.getElementsByClassName("deleteotrSelected");
      for(i = 0; i < x.length; i++){
          if(x[i].checked){
            data.push(
              {
                "GUID": x[i].getAttribute("GUID"),
                "ID_UNIT": x[i].getAttribute("ID_UNIT")
              }
            )
          }
      }
      console.log(data);
      $.ajax({
        url:"{{asset('/seamless-otr-master/delete-otr-selected')}}",
        data: {
          'data': data,
          '_token':'{{csrf_token()}}'
        },
        dataType:'JSON', 
        type:'POST',
        success: function (val){
          console.log(val);
          window.location.reload();
          alert("Delete OTR Successfully!");
        },
        error: function( jqXhr, textStatus, errorThrown ){
          console.log(jqXhr);
          console.log(errorThrown);
          console.log(textStatus);
        },
      });
    }
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

       


  // //VIEW
    
        
    })
  </script>
@endsection
