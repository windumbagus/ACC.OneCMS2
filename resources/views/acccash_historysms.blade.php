@extends('admin.admin') 

@section('acccash-apply', 'active')
@section('acccash-apply-historysms', 'active')

@section('content')

<!-- TableSeamlessDataLeads -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">History SMS Pengajuan </h3> <br/>
                <!-- <h6>Silahkan Menentukan Start Date dan End Date terlebih dahulu, search by SMS ID dan lain-lain bisa dilakukan setelah filter by Start Date dan End Date </h6> -->
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-block btn-primary" id="button-download">Download</a>    
                </div> 
            </div>
        </div>
        
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
          
            <div class="col-sm-9">
                <div class="col-sm-4">
                
              
                    <input type="text" placeholder="Search by Pesan, etc" class="InputSearch form-control">
                </div>

                <div class="col-sm-8">
                    <div class="col-sm-6">
                        <h5 class="col-sm-2">Start</h5>
                        <div class="col-sm-10">
                            <input type="text" id="startdate" name="startdate" class="form-control" placeholder="dd/mm/yyyy" value="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="col-sm-2">End</h5>
                        <div class="col-sm-10">
                            <input type="text" id="enddate" name="enddate" class="form-control" placeholder="dd/mm/yyyy" value="">
                        </div>

					</div>
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
            <th>SMS ID</th>
            <th>Group ID</th>
            <th>Pesan</th>
            <th>Tgl Terkirim</th>
            <th>Nomor Tujuan</th>
            <th>Pengirim</th>
            <th>Note Error</th>
        </tr>
        </thead>
        <tbody>
        
            @foreach ($AcccashHistorySMSes as $AcccashHistorySMS)
            <tr>  
                <td><span>{{$AcccashHistorySMS->SMS_ID}}</span></td>
                <td><span>{{$AcccashHistorySMS->SMS_GROUP_ID}}</span></td>    
                <td><span>{{$AcccashHistorySMS->SMS_MSG}}</span></td>
                <td><span>{{$AcccashHistorySMS->SMS_SENT}}</span></td>
                <td><span>{{$AcccashHistorySMS->SMS_PHONENOTO}}</span></td>
                <td><span>{{$AcccashHistorySMS->ID_USER_ADDED}}</span></td>
                <td><span>{{$AcccashHistorySMS->SMS_STATUS_MSG}}</span></td>
                
            </tr>                              
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    $("#startdate").datepicker({ format: 'dd/mm/yyyy'});
    $("#enddate").datepicker({ format: 'dd/mm/yyyy'});
    var StartDate;
    var EndDate;
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
                
            ]
      })



        //Button Search
        $('.ButtonSearch').on('click', function(){
            // if($('#startdate').val()== null || $('#startdate').val()== "" || $('#enddate').val()== null || $('#enddate').val()== "") 
            // {
            //     alert("Silahkan isi Start Date dan End Date terlebih dahulu","");
            // }
            // else{
                var fullDate = new Date()
                var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
                var now= fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate() ;
                
                // If($("#startdate").val() == null || $("#startdate").val() == "")
                // {
                //     $('#startdate').attr('type', 'text');
                // }

                if($("#startdate").val() == null || $("#startdate").val() == "") // startdate kosong
                {
                   // var StartDate = '01/01/1900';
                    if($("#enddate").val() == null || $("#enddate").val() == "") // startdate dan enddate kosong
                    {
                        var StartDate = '01/01/1900';
                        var EndDate = now;

                        var tempStartDateSelect = moment(StartDate).format('DD-MM-YYYY');
                        var tempEndDateSelect = moment(EndDate).format('DD-MM-YYYY');
                        document.getElementById('button-download').setAttribute("href", "");
                        document.getElementById('button-download').setAttribute("href", `{{asset('/acccash-apply-historysms/download/${tempStartDateSelect}/${tempEndDateSelect}')}}`);
                
            
                        $.ajax({
                            
                            url:"{{asset('/acccash-apply-historysms/get-by-date')}}",
                            data: {'startdate':StartDate,'enddate':EndDate,'_token':'{{csrf_token()}}'},
                            dataType:'json',
                            success: function(data){
                                console.log(data);
                                var table = $('#example2').DataTable()
                                var DataSMS = data;
                                table.clear().draw()


                                DataSMS.map(e=>{ 
                                    if (typeof e.SMS_ID === 'undefined') {
                                    e.SMS_ID = "";
                                    }
                                    if (typeof e.SMS_GROUP_ID === 'undefined') {
                                    e.SMS_GROUP_ID = "";
                                    }
                                    if (typeof e.SMS_MSG === 'undefined') {
                                    e.SMS_MSG = "";
                                    }
                                    if (typeof e.SMS_SENT === 'undefined') {
                                    e.SMS_SENT = "";
                                    }
                                    if (typeof e.SMS_PHONENOTO === 'undefined') {
                                    e.SMS_PHONENOTO = "";
                                    }
                                    if (typeof e.ID_USER_ADDED === 'undefined') {
                                    e.ID_USER_ADDED = "";
                                    }
                                    if (typeof e.SMS_STATUS_MSG === 'undefined') {
                                    e.SMS_STATUS_MSG = "";
                                    }
                                    
                                    table.row.add([
                                        e.SMS_ID,
                                        e.SMS_GROUP_ID,
                                        e.SMS_MSG,
                                        e.SMS_SENT,
                                        e.SMS_PHONENOTO,
                                        e.ID_USER_ADDED,
                                        e.SMS_STATUS_MSG,

                                    ]).draw(false)
                                }) 
                            }
                        })


                        var searchData = $('.InputSearch').val()
                        var dtable = $('#example2').DataTable()
                        dtable.search(searchData).draw()
                    }
                    else // startdate kosong enddate isi
                    {
                        // var StartDate = now;
                        // var EndDate = $("#enddate").val();    
                        alert("Tentukan Start Date terlebih dahulu",""); 
                    }

                }
                else{ //start date isi
                    //var StartDate = $("#startdate").val();
                    if($("#enddate").val() == null || $("#enddate").val() == "") //startdate isi enddate kosong
                    {
                        // var StartDate = $("#startdate").val();
                        // var EndDate = '01/01/1900';
                        alert("Tentukan End Date terlebih dahulu",""); 
                    }
                    else //startdate dan enddate isi
                    {
                        var SDate = $("#startdate").val();
                        var Startchunks = SDate.split('/');
                        var StartDate = [Startchunks[1],Startchunks[0],Startchunks[2]].join("/");

                        var EDate = $("#enddate").val();
                        var Endchunks = EDate.split('/');
                        var EndDate = [Endchunks[1],Endchunks[0],Endchunks[2]].join("/");
                        
                        //var StartDate = $("#startdate").val();
                        //var EndDate = $("#enddate").val();    

                        // month is 0-based, that's why we need dataParts[1] - 1
                        // var StartdateObject = new Date(+StartdateParts[2], StartdateParts[1] - 1, +StartdateParts[0]); 
                        // var EnddateObject = new Date(+EnddateParts[2], EnddateParts[1] - 1, +EnddateParts[0]); 
                        // if(StartdateObject > EnddateObject)
                        // {
                        //     alert("Start Date lebih besar dari End Date","");                            
                        // }

                        var tempStartDateSelect = moment(StartDate).format('DD-MM-YYYY');
                        var tempEndDateSelect = moment(EndDate).format('DD-MM-YYYY');
                        document.getElementById('button-download').setAttribute("href", "");
                        document.getElementById('button-download').setAttribute("href", `{{asset('/acccash-apply-historysms/download/${tempStartDateSelect}/${tempEndDateSelect}')}}`);
                
            
                        $.ajax({
                            
                            url:"{{asset('/acccash-apply-historysms/get-by-date')}}",
                            data: {'startdate':StartDate,'enddate':EndDate,'_token':'{{csrf_token()}}'},
                            dataType:'json',
                            success: function(data){
                                console.log(data);
                                var table = $('#example2').DataTable()
                                var DataSMS = data;
                                table.clear().draw()


                                DataSMS.map(e=>{ 
                                    if (typeof e.SMS_ID === 'undefined') {
                                    e.SMS_ID = "";
                                    }
                                    if (typeof e.SMS_GROUP_ID === 'undefined') {
                                    e.SMS_GROUP_ID = "";
                                    }
                                    if (typeof e.SMS_MSG === 'undefined') {
                                    e.SMS_MSG = "";
                                    }
                                    if (typeof e.SMS_SENT === 'undefined') {
                                    e.SMS_SENT = "";
                                    }
                                    if (typeof e.SMS_PHONENOTO === 'undefined') {
                                    e.SMS_PHONENOTO = "";
                                    }
                                    if (typeof e.ID_USER_ADDED === 'undefined') {
                                    e.ID_USER_ADDED = "";
                                    }
                                    if (typeof e.SMS_STATUS_MSG === 'undefined') {
                                    e.SMS_STATUS_MSG = "";
                                    }
                                    
                                    table.row.add([
                                        e.SMS_ID,
                                        e.SMS_GROUP_ID,
                                        e.SMS_MSG,
                                        e.SMS_SENT,
                                        e.SMS_PHONENOTO,
                                        e.ID_USER_ADDED,
                                        e.SMS_STATUS_MSG,

                                    ]).draw(false)
                                }) 
                            }
                        })


                        var searchData = $('.InputSearch').val()
                        var dtable = $('#example2').DataTable()
                        dtable.search(searchData).draw()

                    }
                }

                // if($("#startdate").val() == null && $("#enddate").val() == null  || $("#startdate").val() == "" && $("#enddate").val() == ""){
                // var EndDate = "";
                // }else if($("#enddate").val() == null || $("#enddate").val() == ""){
                // var EndDate = now;
                // }else{
                    // var EndDate = $("#enddate").val();
               // }
                
               
   

        })



        //Reset Button Search
        $('.ResetSearch').on('click',function(){

            var fullDate = new Date()
            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
            var now= fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate() ;
            
            var StartDate = '01/01/1900';
            var EndDate = now;

            var tempStartDateSelect = moment(StartDate).format('DD-MM-YYYY');
                var tempEndDateSelect = moment(EndDate).format('DD-MM-YYYY');
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/acccash-apply-historysms/download/${tempStartDateSelect}/${tempEndDateSelect}')}}`);
        
    
                $.ajax({
                    
                    url:"{{asset('/acccash-apply-historysms/get-by-date')}}",
                    data: {'startdate':StartDate,'enddate':EndDate,'_token':'{{csrf_token()}}'},
                    dataType:'json',
                    success: function(data){
                        console.log(data);
                        var table = $('#example2').DataTable()
                        var DataSMS = data;
                        table.clear().draw()


                        DataSMS.map(e=>{ 
                            if (typeof e.SMS_ID === 'undefined') {
                            e.SMS_ID = "";
                            }
                            if (typeof e.SMS_GROUP_ID === 'undefined') {
                            e.SMS_GROUP_ID = "";
                            }
                            if (typeof e.SMS_MSG === 'undefined') {
                            e.SMS_MSG = "";
                            }
                            if (typeof e.SMS_SENT === 'undefined') {
                            e.SMS_SENT = "";
                            }
                            if (typeof e.SMS_PHONENOTO === 'undefined') {
                            e.SMS_PHONENOTO = "";
                            }
                            if (typeof e.ID_USER_ADDED === 'undefined') {
                            e.ID_USER_ADDED = "";
                            }
                            if (typeof e.SMS_STATUS_MSG === 'undefined') {
                            e.SMS_STATUS_MSG = "";
                            }
                            
                            table.row.add([
                                e.SMS_ID,
                                e.SMS_GROUP_ID,
                                e.SMS_MSG,
                                e.SMS_SENT,
                                e.SMS_PHONENOTO,
                                e.ID_USER_ADDED,
                                e.SMS_STATUS_MSG,

                            ]).draw(false)
                        }) 
                    }
                })

            var tab = $('#example2').DataTable()
            tab.search('').draw()
            tab.clear().draw()
            $('.InputSearch').val('')
            $('#startdate').val('')
            $('#enddate').val('')
        })

        // startdate
        // $('#startdate').on('change',function(){
                
        // });

        // $('#enddate').on('change',function(){

        // });

        $('.ButtonDownload').on('click', function(){
           
           $.ajax({
               xhrFields: {responseType: 'blob',},
               url:"{{asset('/acccash-apply-historysms/download')}}",
                data: {'startdate':StartDate,'enddate':EndDate,'_token':'{{csrf_token()}}'},
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
