@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-dataleads', 'active')

@section('content')

<!-- TableSeamlessDataLeads -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Data Leads </h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                        
                       
                </div>
                <div class="col-sm-6">
<<<<<<< HEAD
                    <a href="{{asset('/Seamless-dataleads/download/'.date('m/Y', strtotime(now())) )}}" class="btn btn-block btn-primary" id="button-download">Download</a>    
                </div> 
=======
                         
                         <a href="#" class="ButtonDownload btn btn-block btn-primary">Download</a>  
                </div>
>>>>>>> 74e9f9054ba56c306c82aae1dfa47eb7a1f73612
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
                        @for ($i = 0; $i > -3; $i--)
                            <option value="{{date('m/Y', strtotime(now()->addMonths($i)))}}">
                            {{date('M Y', strtotime(now()->addMonths($i)))}}
                            </option>
                        @endfor
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
            <th>Kode Cabang</th>
            <th>Cabang</th>
            <th>Tahun</th>
            <th>Tenor</th>
            <th>TDP</th>
            <th>Angsuran</th>
            <th>OTR</th>           
        </tr>
        </thead>
        <tbody>
        
            @foreach ($SeamlessDataLeads as $SeamlessDataLead)
            <tr>  
                <td><span>{{$SeamlessDataLead->LEADS_ID}}</span></td>
                <td><span>{{$SeamlessDataLead->DT_ADDED}}</span></td>    
                <td><span>{{$SeamlessDataLead->NAME}}</span></td>
                <td><span>{{$SeamlessDataLead->PHONE_NUMBER}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_BRAND}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_TYPE}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_MODEL}}</span></td>
                <td><span>{{$SeamlessDataLead->CD_SP}}</span></td>
                <td><span>{{$SeamlessDataLead->DESC_SP}}</span></td>
                <td><span>{{$SeamlessDataLead->TAHUN}}</span></td>
                <td><span>{{$SeamlessDataLead->TENOR}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_TDP}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_INSTALLMENT}}</span></td>
                <td><span>{{$SeamlessDataLead->AMT_OTR}}</span></td>
         
                
                
            </tr>                              
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    var Bulantahunselect;
    $(document).ajaxStart(function() { Pace.restart(); });
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
                null,
                
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

                var tempBulantahunselect = Bulantahunselect;
            
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/seamless-dataleads/download/${tempBulantahunselect}')}}`);
           
            $.ajax({
                
                url:"{{asset('/seamless-dataleads/get-by-bulantahun')}}",
                data: {'Bulantahun':Bulantahunselect,'_token':'{{csrf_token()}}'},
                dataType:'json',
                success: function(data){
                    console.log(data);
                    var table = $('#example2').DataTable()
                    var DataLeads = data;
                    table.clear().draw()


                    DataLeads.map(e=>{ 
                        if (typeof e.LEADS_ID === 'undefined') {
                        e.LEADS_ID = "";
                        }
                        if (typeof e.DT_ADDED === 'undefined') {
                        e.DT_ADDED = "";
                        }
                        if (typeof e.NAME === 'undefined') {
                        e.NAME = "";
                        }
                        if (typeof e.PHONE_NUMBER === 'undefined') {
                        e.PHONE_NUMBER = "";
                        }
                        if (typeof DESC_BRAND === 'undefined') {
                        DESC_BRAND = "";
                        }
                        if (typeof e.DESC_TYPE === 'undefined') {
                        e.DESC_TYPE = "";
                        }
                        if (typeof e.DESC_MODEL === 'undefined') {
                        e.DESC_MODEL = "";
                        }
                        if (typeof e.CD_SP === 'undefined') {
                        e.CD_SP = "";
                        }
                        if (typeof e.DESC_SP === 'undefined') {
                        e.DESC_SP = "";
                        }
                        if (typeof e.TAHUN === 'undefined') {
                        e.TAHUN = "";
                        }
                        if (typeof e.AMT_TDP === 'undefined') {
                        e.AMT_TDP = "";
                        }
                        if (typeof e.AMT_INSTALLMENT === 'undefined') {
                        e.AMT_INSTALLMENT = "";
                        }
                        if (typeof e.AMT_OTR === 'undefined') {
                        e.AMT_OTR = "";
                        }

                        table.row.add([
                            e.LEADS_ID,
                            e.DT_ADDED,
                            e.NAME,
                            e.PHONE_NUMBER,
                            e.DESC_BRAND,
                            e.DESC_TYPE,
                            e.DESC_MODEL,
                            e.CD_SP,
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

        $('.ButtonDownload').on('click', function(){
           
           $.ajax({
               xhrFields: {responseType: 'blob',},
               url:"{{asset('/seamless-dataleads/download')}}",
               data: {'Bulantahun':Bulantahunselect,'_token':'{{csrf_token()}}'},
               dataType:'json',
               success: function(result, status, xhr) {

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : 'example.xlsx');

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                 }
               })
        });

  // //VIEW
    
        
    })
  </script>
@endsection
