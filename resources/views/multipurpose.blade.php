@extends('admin.admin') 

@section('fund', 'active')
@section('multipurpose', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Multipurpose</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="{{asset('/multipurpose/download/null/null~null')}}" class="btn btn-block btn-primary" id="button-download">Download</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" style="width:100%;" id="dropdown_multipurpose_statusTransaksi">
                    <option value="" selected>-- Choose Condition --</option>
                    @foreach ($Statuss as $Status)
                        <option value="{{$Status->Label}}">
                            {{$Status->Label}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by Brand" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button_search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button_Reset btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">Start Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_multipurpose_startDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_multipurpose_resetStartDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">End Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_multipurpose_endDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_multipurpose_resetEndDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        
        <table id="multipurpose_table" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Transaction Date</th>
                    <th>Car Detail</th>
                    <th>Customer Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($Multipurposes) --}}
                @foreach ($Multipurposes as $Multipurpose)
                    <tr>  
                        @if (property_exists($Multipurpose->User, 'Name'))
                            <td><span>{{$Multipurpose->User->Name}}</span></td>
                        @else
                            <td></td>
                        @endif

                        @if (property_exists($Multipurpose->MstTransaksi, 'TransactionDate'))
                            <td><span>{{date('Y-m-d', strtotime($Multipurpose->MstTransaksi->TransactionDate))}}</span></td>
                        @else
                            <td></td>
                        @endif

                        <td><span>
                            @if (property_exists($Multipurpose->MstTransaksi, 'Brand'))
                                {{$Multipurpose->MstTransaksi->Brand}}
                                @if (property_exists($Multipurpose->MstTransaksi, 'Type'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($Multipurpose->MstTransaksi, 'Type'))
                                {{$Multipurpose->MstTransaksi->Type}}
                            @endif


                            @if ((property_exists($Multipurpose->MstTransaksi, 'Brand')) || 
                                (property_exists($Multipurpose->MstTransaksi, 'Type')))
                                <br>
                            @endif

                            @if (property_exists($Multipurpose->MstTransaksi, 'Model'))
                                {{$Multipurpose->MstTransaksi->Model}}
                                @if (property_exists($Multipurpose->MstTransaksi, 'Tahun'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($Multipurpose->MstTransaksi, 'Tahun'))
                                {{$Multipurpose->MstTransaksi->Tahun}}
                            @endif
                        </span></td>
                        
                        @if (property_exists($Multipurpose->MstCustomerDetail, 'FlagCustomer'))
                            <td><span>{{$Multipurpose->MstCustomerDetail->FlagCustomer}}</span></td>
                        @else
                            <td></td>
                        @endif
                        
                        <td>
                            <span>
                                <a href="#" data-Id="{{$Multipurpose->MstTransaksi->Id}}" class="update-multipurpose 
                                    btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('multipurpose/delete/'.$Multipurpose->MstTransaksi->Id)}}" 
                                    class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')" >
                                    <i class="fa fa-trash"></i>
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
    $(document).ajaxStart(function() { Pace.restart(); });
    $(document).ready(function () {
        $('#multipurpose_table').DataTable({
            'deferRender' : true,
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
                {"searchable":false},
                null,
                {"searchable":false},
                {"searchable":false},
            ]
        })

        // Search Button 
        $('.button_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dataTable = $('#multipurpose_table').DataTable()
            dataTable.search(searchData).draw()
        })

        // Reset Button 
        $('.button_Reset').on('click',function(){
            var dataTable = $('#multipurpose_table').DataTable()
            dataTable.search('').draw()
            $('.input-search').val('')
            $('#dropdown_multipurpose_statusTransaksi').val('');
            $('#datepicker_multipurpose_startDate').datepicker('setDate', null);
            $('#datepicker_multipurpose_endDate').datepicker('setDate', null);
            startEndDateCondition();
        })

        // StatusTransaksi Dropdown
        $('#dropdown_multipurpose_statusTransaksi').on('change',function(){
            getByCondition();
        });

        // Start-End Datepicker
        $('#datepicker_multipurpose_startDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_multipurpose_startDate').datepicker('getDate') != null) {
                if (($('#datepicker_multipurpose_endDate').datepicker('getDate') != null) && 
                    ($('#datepicker_multipurpose_startDate').datepicker('getDate') > $('#datepicker_multipurpose_endDate').datepicker('getDate'))) {
                    $('#datepicker_multipurpose_endDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });
        $('#datepicker_multipurpose_endDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_multipurpose_endDate').datepicker('getDate') != null) {
                if (($('#datepicker_multipurpose_startDate').datepicker('getDate') != null) &&
                    ($('#datepicker_multipurpose_endDate').datepicker('getDate') < $('#datepicker_multipurpose_startDate').datepicker('getDate'))) {
                    $('#datepicker_multipurpose_startDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });

        // ResetDatePicker Button
        $('#button_multipurpose_resetStartDate').on('click',function(){
            if ($('#datepicker_multipurpose_startDate').datepicker('getDate') != null) {
                $('#datepicker_multipurpose_startDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })
        $('#button_multipurpose_resetEndDate').on('click',function(){
            if ($('#datepicker_multipurpose_endDate').datepicker('getDate') != null) {
                $('#datepicker_multipurpose_endDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })

        // StartEndDateCondition Function
        window.startEndDateCondition = function(){
            var StartDate_Date = $('#datepicker_multipurpose_startDate').datepicker('getDate')
            var EndDate_Date = $('#datepicker_multipurpose_endDate').datepicker('getDate')
            // console.log(StartDate_Date);
            // console.log(EndDate_Date);
            // console.log(StartDate_Date > EndDate_Date);

            if ((StartDate_Date != null) && (EndDate_Date != null)) {
                if (StartDate_Date < EndDate_Date) {
                    getByCondition();
                }
            } else if ((StartDate_Date == null) || (EndDate_Date == null)) {
                getByCondition();
            }
        };

        window.getByCondition = function(){
            var Status = $('#dropdown_multipurpose_statusTransaksi').val();
            var StartDate_dMy = $('#datepicker_multipurpose_startDate').val();
            var EndDate_dMy = $('#datepicker_multipurpose_endDate').val();
            var StartDate = 
                StartDate_dMy.substring(6,10)+'-'+StartDate_dMy.substring(3,5)+'-'+StartDate_dMy.substring(0,2);
            var EndDate = 
                EndDate_dMy.substring(6,10)+'-'+EndDate_dMy.substring(3,5)+'-'+EndDate_dMy.substring(0,2);
            // console.log(Status);
            // console.log(StartDate);
            // console.log(EndDate);

            // Function Download
            if ((Status == "") && (StartDate == "") && (EndDate == "") ){
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/multipurpose/download/${tempStatus}/${tempStartDate}~${tempEndDate}')}}`);
            } else {
                var tempStatus = Status;
                var tempStartDate = StartDate;
                var tempEndDate = EndDate;
                
                if (Status == "")
                    tempStatus = "null";
                if (StartDate == "--")
                    tempStartDate = "null";
                if (EndDate == "--")
                    tempEndDate = "null";
                document.getElementById('button-download').setAttribute("href", "");
                document.getElementById('button-download').setAttribute("href", `{{asset('/multipurpose/download/${tempStatus}/${tempStartDate}~${tempEndDate}')}}`);
            }

            $.ajax({
                url:'multipurpose/get-by-condition',
                data: {
                    'Status':Status,
                    'StartDate':StartDate,
                    'EndDate':EndDate,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'json',
                type:'POST',
                success: function(output){
                    console.log(output);
                    var table = $('#multipurpose_table').DataTable()
                    // //var MstTransaksiList = output.MstTransaksiList;
                    
                    table.clear().draw();
                    if (typeof output !== 'undefined') {
                        output.map(x=>{

                            if (typeof x.User !== 'undefined') {
                                if (typeof x.User.Name === 'undefined') {
                                    x.User.Name = "";
                                }
                            }                            
                            if (typeof x.MstTransaksi.TransactionDate === 'undefined') {
                                x.MstTransaksi.TransactionDate = "";
                            }

                            if (typeof x.MstTransaksi.Brand === 'undefined') {
                                x.MstTransaksi.Brand = "";
                                if (typeof x.MstTransaksi.Type === 'undefined') {
                                    x.MstTransaksi.Type = "";
                                }
                            } else {
                                if (typeof x.MstTransaksi.Type === 'undefined') {
                                    x.MstTransaksi.Type = "";
                                } else {
                                    x.MstTransaksi.Brand += " ";
                                }
                            }
                            if (typeof x.MstTransaksi.Model === 'undefined') {
                                x.MstTransaksi.Model = "";
                                if (typeof x.MstTransaksi.Tahun === 'undefined') {
                                    x.MstTransaksi.Tahun = "";
                                }
                            } else {
                                if (typeof x.MstTransaksi.Tahun === 'undefined') {
                                    x.MstTransaksi.Tahun = "";
                                } else {
                                    x.MstTransaksi.Model += " ";
                                }
                            }

                            if (typeof x.MstCustomerDetail.FlagCustomer === 'undefined') {
                                x.MstCustomerDetail.FlagCustomer = "";
                            }
                        
                            table.row.add([
                                '<span>'+x.User.Name+'</span>',
                                '<span>'+ x.MstTransaksi.TransactionDate.substring(0, 10)+'</span>',
                                '<span>'+
                                    x.MstTransaksi.Brand+
                                    x.MstTransaksi.Type+
                                    '<br>'+
                                    x.MstTransaksi.Model+
                                    x.MstTransaksi.Tahun+
                                '</span>',
                                '<span>'+x.MstCustomerDetail.FlagCustomer+'</span>',
                                '<span>'+
                                    '<a href="#" data-Id="'+x.MstTransaksi.Id+'" class="update-multipurpose'+
                                        'btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp;'+
                                    `<a href="{{asset('multipurpose/delete/${x.MstTransaksi.Id}')}}"`+
                                        `class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')">`+
                                        '<i class="fa fa-trash"></i>'+
                                    '</a>'+
                                '</span>',
                            ]).draw(false)
                        })
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            })
        };
        
        // Modal View/Update
        $(document).on('click','.update-multipurpose',function(){
            var id = $(this).attr('data-Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/multipurpose/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    // $('[name="MappingTransaksiId"]').val(val.MappingTransaksi.Id);
                    
                    // $('[name="Name"]').val(val.User.Name);
                    // $('[name="Username"]').val(val.User.Username);
                    // $('[name="Email"]').val(val.User.Email);
                    // $('[name="MobilePhone"]').val(val.User.MobilePhone);

                    // $('[name="transaction_date_pribadi"]').val(val.MstTransaksiPribadi.TransactionDate);
                    // $('[name="brand_pribadi"]').val(val.MstTransaksiPribadi.Brand);
                    // $('[name="kode_brand_pribadi"]').val(val.MstTransaksiPribadi.KodeBrand);
                    // $('[name="type_pribadi"]').val(val.MstTransaksiPribadi.Type);
                    // $('[name="kode_type_pribadi"]').val(val.MstTransaksiPribadi.KodeType);
                    // $('[name="model_pribadi"]').val(val.MstTransaksiPribadi.Model);
                    // $('[name="kode_model_pribadi"]').val(val.MstTransaksiPribadi.KodeModel);
                    // $('[name="tahun_pribadi"]').val(val.MstTransaksiPribadi.Tahun);
                    // // $('[name="MRP_pribadi"]').val(currencyFormat(val.MstTransaksiPribadi.MRP));
                    // if (val.MstTransaksiPribadi.hasOwnProperty('MRP')) {
                    //         $('[name="MRP_pribadi"]').val(currencyFormat(val.MstTransaksiPribadi.MRP));
                    // }else{
                    //     $('[name="MRP_pribadi"]').val("");
                    // }
                    // $('[name="lokasi_pribadi"]').val(val.MstTransaksiPribadi.Lokasi);
                    // $('[name="unit_pribadi"]').val(val.MstTransaksiPribadi.UnitId);
                    // $('[name="flag_BPKB_pribadi"]').val(val.MstTransaksiPribadi.FlagBPKB);
                    // if (val.MstTransaksiPribadi.hasOwnProperty('FlagNewExist')) {
                    //     if (val.MstTransaksiPribadi.FlagNewExist == true) {
                    //         $('[name="flag_new_exist_pribadi"]').attr('checked', true);
                    //     }
                    // }else{
                    //     $('[name="flag_new_exist_pribadi"]').attr('checked', false);   
                    // }

                    // $('[name="transaction_date_masa_depan"]').val(val.MstTransaksiMasaDepan.TransactionDate);
                    // $('[name="brand_masa_depan"]').val(val.MstTransaksiMasaDepan.Brand);
                    // $('[name="kode_brand_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeBrand);
                    // $('[name="type_masa_depan"]').val(val.MstTransaksiMasaDepan.Type);
                    // $('[name="kode_type_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeType);
                    // $('[name="model_masa_depan"]').val(val.MstTransaksiMasaDepan.Model);
                    // $('[name="kode_model_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeModel);
                    // $('[name="tahun_masa_depan"]').val(val.MstTransaksiMasaDepan.Tahun);
                    // // $('[name="MRP_masa_depan"]').val(currencyFormat(val.MstTransaksiMasaDepan.MRP));
                    // if (val.MstTransaksiMasaDepan.hasOwnProperty('MRP')) {
                    //         $('[name="MRP_masa_depan"]').val(currencyFormat(val.MstTransaksiMasaDepan.MRP));
                    // }else{
                    //     $('[name="MRP_masa_depan"]').val("");
                    // }
                    // $('[name="lokasi_masa_depan"]').val(val.MstTransaksiMasaDepan.Lokasi);

                    // if(val.MstTransaksiPribadi.Status == 'Pending' && val.MstTransaksiMasaDepan.Status == 'Pending') {
                    //     $('#button_approve_save').show();
                    // } else {
                    //     $('#button_approve_save').hide();
                    // }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            // $('#update-trade-in').modal();
        });

        window.currencyFormat = function(n) {
            return n.replace(/./g, function(c, i, a) {
                return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
            });
        }
    })
</script>

{{-- @include('modal.update_trade_in') --}}
@endsection