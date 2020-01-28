@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-dataleads', 'active')

@section('content')

<!-- TableSeamlessDataLeads -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Data Leads</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                        
                       
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
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by Leads ID, Nama, Brand, Type, etc" class="InputSearch form-control">
                </div>
                <div class="col-sm-4">
                    <select class="form-control select2" id="Bulantahunselect" style="width:100%;">
                        <option value="0" selected>-- Pilih Bulan, Tahun --</option>
                        <option value="11/2019">November 2019</option>
                        <option value="12/2019">Desember 2019</option>
                        <option value="01/2020">Januari 2020</option>
                        <option value="02/2020">Februari 2020</option>
                        <option value="03/2020">Maret 2020</option>
                        <option value="04/2020">April 2020</option>
                        <option value="05/2020">Mei 2020</option>
                    </select>
                </div>
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
            <th>Leads Id</th>
            <th>Waktu Pengajuan</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Model</th>
            <th>Cabang</th>
            <th>Tahun</th>
            <th>Tenor</th>
            <th>TDP</th>
            <th>Angsuran</th>
            <th>OTR</th>           
            <th>Action</th>      
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessDataLeads as $SeamlessDataLead)
            <tr>  
                <td><span>{{$SeamlessDataLead->LEADS_ID}}</span></td>
                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessDataLead->DT_ADDED))}}</span></td>    
                <td><span>{{$SeamlessDataLead->NAME}}</span></td>
                <td><span>{{$SeamlessDataLead->PHONE_NUMBER}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_BRAND}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_TYPE}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_MODEL}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_SP}}</span></td>
                <td><span>{{$SeamlessDataLead->TAHUN}}</span></td>
                <td><span>{{$SeamlessDataLead->TENOR}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_TDP}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_INSTALLMENT}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_OTR}}</span></td>
                <td><span> 
                
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
                null,
                null,
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

        // Condition Dropdown
        $('#Bulantahunselect').on('change',function(){
            var Bulantahunselect = $(this).val();
           
            $.ajax({
                url:'/seamless-dataleads/get-by-bulantahun',
                data: {'Bulantahun':Bulantahunselect,'_token':'{{csrf_token()}}'},
                dataType:'json',
                success: function(data){
                    console.log(data);
                    var table = $('#example2').DataTable()
                    var DataLeads = data.Object;
                    table.clear().draw()


                    DataLeads.map(e=>{
                        

                        table.row.add([
                            e.LEADS_ID,
                            e.DT_ADDED,
                            e.NAME,
                            e.PHONE_NUMBER,
                            e.DESC_BRAND,
                            e.DESC_TYPE,
                            e.DESC_MODEL,
                            e.DESC_SP,
                            e.TAHUN,
                            e.AMT_TDP,
                            e.AMT_INSTALLMENT,
                            e.AMT_OTR,
                        ]).draw(false)
                    }) 
                }
            })
        });

  // //VIEW
    
        
    })
  </script>
@endsection
