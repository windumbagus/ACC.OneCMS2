@extends('admin.admin') 

@section('fund', 'active')
@section('trade-in', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Trade In List</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="{{asset('/trade-in/download/null/null~null')}}" class="btn btn-block btn-primary" id="button-download">Download</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" style="width:100%;" id="dropdown_tradeIn_statusTransaksi">
                    <option value="" selected>-- Choose Condition --</option>
                    @foreach ($Statuss as $Status)
                        <option value="{{$Status->Label}}">
                            {{$Status->Label}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by User" class="input-search form-control">
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
                        <input type="text" id="datepicker_tradeIn_startDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_tradeIn_resetStartDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">End Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_tradeIn_endDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_tradeIn_resetEndDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        
        <table id="trade_in_table" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Unit Pribadi</th>
                    <th>Unit Masa Depan</th>
                    <th>Added Date</th>
                    <th>Customer Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($TradeIns) --}}
                @foreach ($TradeIns as $TradeIn)
                    <tr>  
                        @if (property_exists($TradeIn->User, 'Name'))
                            <td><span>{{$TradeIn->User->Name}}</span></td>
                        @else
                            <td></td>
                        @endif

                        <td><span>
                            @if (property_exists($TradeIn->MstTransaksiPribadi, 'Brand'))
                                {{$TradeIn->MstTransaksiPribadi->Brand}}
                                @if (property_exists($TradeIn->MstTransaksiPribadi, 'Type'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($TradeIn->MstTransaksiPribadi, 'Type'))
                                {{$TradeIn->MstTransaksiPribadi->Type}}
                            @endif


                            @if ((property_exists($TradeIn->MstTransaksiPribadi, 'Brand')) || 
                                (property_exists($TradeIn->MstTransaksiPribadi, 'Type')))
                                <br>
                            @endif

                            @if (property_exists($TradeIn->MstTransaksiPribadi, 'Model'))
                                {{$TradeIn->MstTransaksiPribadi->Model}}
                                @if (property_exists($TradeIn->MstTransaksiPribadi, 'Tahun'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($TradeIn->MstTransaksiPribadi, 'Tahun'))
                                {{$TradeIn->MstTransaksiPribadi->Tahun}}
                            @endif
                        </span></td>
    
                        <td><span>
                            @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Brand'))
                                {{$TradeIn->MstTransaksiMasaDepan->Brand}}
                                @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Type'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Type'))
                                {{$TradeIn->MstTransaksiMasaDepan->Type}}
                            @endif


                            @if ((property_exists($TradeIn->MstTransaksiMasaDepan, 'Brand')) || 
                                (property_exists($TradeIn->MstTransaksiMasaDepan, 'Type')))
                                <br>
                            @endif

                            @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Model'))
                                {{$TradeIn->MstTransaksiMasaDepan->Model}}
                                @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Tahun'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($TradeIn->MstTransaksiMasaDepan, 'Tahun'))
                                {{$TradeIn->MstTransaksiMasaDepan->Tahun}}
                            @endif
                        </span></td>

                        @if (property_exists($TradeIn->MappingTransaksi, 'AddedDate'))
                        <td><span>{{date('Y-m-d', strtotime($TradeIn->MappingTransaksi->AddedDate))}}</span></td>
                        @else
                            <td>-</td>
                        @endif

                        @if (property_exists($TradeIn->MstCustomerDetail, 'FlagCustomer'))
                        <td><span>{{$TradeIn->MstCustomerDetail->FlagCustomer}}</span></td>
                        @else
                            <td></td>
                        @endif

                        <td>
                            <span>
                                <a href="#" data-Id="{{$TradeIn->MappingTransaksi->Id}}" class="update-trade-in 
                                    btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('trade-in/delete/'.$TradeIn->MappingTransaksi->Id)}}" 
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
        $('#trade_in_table').DataTable({
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
                null,
                {"searchable":false},
                {"searchable":false},
                {"searchable":false},
                {"searchable":false},
                {"searchable":false},
            ]
        })

        // Search Button 
        $('.button_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dataTable = $('#trade_in_table').DataTable()
            dataTable.search(searchData).draw()
        })

        // Reset Button 
        $('.button_Reset').on('click',function(){
            var dataTable = $('#trade_in_table').DataTable()
            dataTable.search('').draw()
            $('.input-search').val('')
            $('#dropdown_tradeIn_statusTransaksi').val('');
            $('#datepicker_tradeIn_startDate').datepicker('setDate', null);
            $('#datepicker_tradeIn_endDate').datepicker('setDate', null);
            startEndDateCondition();
        })

        // StatusTransaksi Dropdown
        $('#dropdown_tradeIn_statusTransaksi').on('change',function(){
            getByCondition();
        });

        // Start-End Datepicker
        $('#datepicker_tradeIn_startDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_tradeIn_startDate').datepicker('getDate') != null) {
                if (($('#datepicker_tradeIn_endDate').datepicker('getDate') != null) && 
                    ($('#datepicker_tradeIn_startDate').datepicker('getDate') > $('#datepicker_tradeIn_endDate').datepicker('getDate'))) {
                    $('#datepicker_tradeIn_endDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });
        $('#datepicker_tradeIn_endDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_tradeIn_endDate').datepicker('getDate') != null) {
                if (($('#datepicker_tradeIn_startDate').datepicker('getDate') != null) &&
                    ($('#datepicker_tradeIn_endDate').datepicker('getDate') < $('#datepicker_tradeIn_startDate').datepicker('getDate'))) {
                    $('#datepicker_tradeIn_startDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });

        // ResetDatePicker Button
        $('#button_tradeIn_resetStartDate').on('click',function(){
            if ($('#datepicker_tradeIn_startDate').datepicker('getDate') != null) {
                $('#datepicker_tradeIn_startDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })
        $('#button_tradeIn_resetEndDate').on('click',function(){
            if ($('#datepicker_tradeIn_endDate').datepicker('getDate') != null) {
                $('#datepicker_tradeIn_endDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })

        // StartEndDateCondition Function
        window.startEndDateCondition = function(){
            var StartDate_Date = $('#datepicker_tradeIn_startDate').datepicker('getDate')
            var EndDate_Date = $('#datepicker_tradeIn_endDate').datepicker('getDate')
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
            var Status = $('#dropdown_tradeIn_statusTransaksi').val();
            var StartDate_dMy = $('#datepicker_tradeIn_startDate').val();
            var EndDate_dMy = $('#datepicker_tradeIn_endDate').val();
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
                document.getElementById('button-download').setAttribute("href", `{{asset('/trade-in/download/${tempStatus}/${tempStartDate}~${tempEndDate}')}}`);
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
                document.getElementById('button-download').setAttribute("href", `{{asset('/trade-in/download/${tempStatus}/${tempStartDate}~${tempEndDate}')}}`);
            }

            $.ajax({
                url:'trade-in/get-by-condition',
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
                    var table = $('#trade_in_table').DataTable()
                    // var MstTransaksiList = output.MstTransaksiList;
                    table.clear().draw();
                    
                    if (typeof output !== 'undefined') {
                        output.map(x=>{

                            if (typeof x.User !== 'undefined') {
                                if (typeof x.User.Name === 'undefined') {
                                    x.User.Name = "";
                                }
                            }

                            if (typeof x.MstTransaksiPribadi.Brand === 'undefined') {
                                x.MstTransaksiPribadi.Brand = "";
                                if (typeof x.MstTransaksiPribadi.Type === 'undefined') {
                                    x.MstTransaksiPribadi.Type = "";
                                }
                            } else {
                                if (typeof x.MstTransaksiPribadi.Type === 'undefined') {
                                    x.MstTransaksiPribadi.Type = "";
                                } else {
                                    x.MstTransaksiPribadi.Brand += " ";
                                }
                            }
                            if (typeof x.MstTransaksiPribadi.Model === 'undefined') {
                                x.MstTransaksiPribadi.Model = "";
                                if (typeof x.MstTransaksiPribadi.Tahun === 'undefined') {
                                    x.MstTransaksiPribadi.Tahun = "";
                                }
                            } else {
                                if (typeof x.MstTransaksiPribadi.Tahun === 'undefined') {
                                    x.MstTransaksiPribadi.Tahun = "";
                                } else {
                                    x.MstTransaksiPribadi.Model += " ";
                                }
                            }

                            if (typeof x.MstTransaksiMasaDepan.Brand === 'undefined') {
                                x.MstTransaksiMasaDepan.Brand = "";
                                if (typeof x.MstTransaksiMasaDepan.Type === 'undefined') {
                                    x.MstTransaksiMasaDepan.Type = "";
                                }
                            } else {
                                if (typeof x.MstTransaksiMasaDepan.Type === 'undefined') {
                                    x.MstTransaksiMasaDepan.Type = "";
                                } else {
                                    x.MstTransaksiMasaDepan.Brand += " ";
                                }
                            }
                            if (typeof x.MstTransaksiMasaDepan.Model === 'undefined') {
                                x.MstTransaksiMasaDepan.Model = "";
                                if (typeof x.MstTransaksiMasaDepan.Tahun === 'undefined') {
                                    x.MstTransaksiMasaDepan.Tahun = "";
                                }
                            } else {
                                if (typeof x.MstTransaksiMasaDepan.Tahun === 'undefined') {
                                    x.MstTransaksiMasaDepan.Tahun = "";
                                } else {
                                    x.MstTransaksiMasaDepan.Model += " ";
                                }
                            }

                            if (typeof x.MappingTransaksi.AddedDate === 'undefined') {
                                x.MappingTransaksi.AddedDate = "";
                            }

                            if (typeof x.MstCustomerDetail.FlagCustomer === 'undefined') {
                                x.MstCustomerDetail.FlagCustomer = "";
                            }
                        
                            table.row.add([
                                '<span>'+x.User.Name+'</span>',
                                '<span>'+
                                    x.MstTransaksiPribadi.Brand+
                                    x.MstTransaksiPribadi.Type+
                                    '<br>'+
                                    x.MstTransaksiPribadi.Model+
                                    x.MstTransaksiPribadi.Tahun+
                                '</span>',
                                '<span>'+
                                    x.MstTransaksiMasaDepan.Brand+
                                    x.MstTransaksiMasaDepan.Type+
                                    '<br>'+
                                    x.MstTransaksiMasaDepan.Model+
                                    x.MstTransaksiMasaDepan.Tahun+
                                '</span>',
                                '<span>'+
                                        x.MappingTransaksi.AddedDate.substring(0, 10)+
                                '</span>',
                                '<span>'+x.MstCustomerDetail.FlagCustomer+'</span>',
                                '<span>'+
                                    '<a href="#" data-Id="'+x.MappingTransaksi.Id+'" class="update-trade-in '+
                                        'btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp;'+
                                    `<a href="{{asset('trade-in/delete/${x.MappingTransaksi.Id}')}}"`+
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
        $(document).on('click','.update-trade-in',function(){
            var id = $(this).attr('data-Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/trade-in/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="MappingTransaksiId"]').val(val.MappingTransaksi.Id);
                    
                    $('[name="Name"]').val(val.User.Name);
                    $('[name="Username"]').val(val.User.Username);
                    $('[name="Email"]').val(val.User.Email);
                    $('[name="MobilePhone"]').val(val.User.MobilePhone);

                    $('[name="transaction_date_pribadi"]').val(val.MstTransaksiPribadi.TransactionDate);
                    $('[name="brand_pribadi"]').val(val.MstTransaksiPribadi.Brand);
                    $('[name="kode_brand_pribadi"]').val(val.MstTransaksiPribadi.KodeBrand);
                    $('[name="type_pribadi"]').val(val.MstTransaksiPribadi.Type);
                    $('[name="kode_type_pribadi"]').val(val.MstTransaksiPribadi.KodeType);
                    $('[name="model_pribadi"]').val(val.MstTransaksiPribadi.Model);
                    $('[name="kode_model_pribadi"]').val(val.MstTransaksiPribadi.KodeModel);
                    $('[name="tahun_pribadi"]').val(val.MstTransaksiPribadi.Tahun);
                    // $('[name="MRP_pribadi"]').val(currencyFormat(val.MstTransaksiPribadi.MRP));
                    if (val.MstTransaksiPribadi.hasOwnProperty('MRP')) {
                            $('[name="MRP_pribadi"]').val(currencyFormat(val.MstTransaksiPribadi.MRP));
                    }else{
                        $('[name="MRP_pribadi"]').val("");
                    }
                    $('[name="lokasi_pribadi"]').val(val.MstTransaksiPribadi.Lokasi);
                    $('[name="unit_pribadi"]').val(val.MstTransaksiPribadi.UnitId);
                    $('[name="flag_BPKB_pribadi"]').val(val.MstTransaksiPribadi.FlagBPKB);
                    if (val.MstTransaksiPribadi.hasOwnProperty('FlagNewExist')) {
                        if (val.MstTransaksiPribadi.FlagNewExist == true) {
                            $('[name="flag_new_exist_pribadi"]').attr('checked', true);
                        }
                    }else{
                        $('[name="flag_new_exist_pribadi"]').attr('checked', false);   
                    }

                    $('[name="transaction_date_masa_depan"]').val(val.MstTransaksiMasaDepan.TransactionDate);
                    $('[name="brand_masa_depan"]').val(val.MstTransaksiMasaDepan.Brand);
                    $('[name="kode_brand_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeBrand);
                    $('[name="type_masa_depan"]').val(val.MstTransaksiMasaDepan.Type);
                    $('[name="kode_type_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeType);
                    $('[name="model_masa_depan"]').val(val.MstTransaksiMasaDepan.Model);
                    $('[name="kode_model_masa_depan"]').val(val.MstTransaksiMasaDepan.KodeModel);
                    $('[name="tahun_masa_depan"]').val(val.MstTransaksiMasaDepan.Tahun);
                    // $('[name="MRP_masa_depan"]').val(currencyFormat(val.MstTransaksiMasaDepan.MRP));
                    if (val.MstTransaksiMasaDepan.hasOwnProperty('MRP')) {
                            $('[name="MRP_masa_depan"]').val(currencyFormat(val.MstTransaksiMasaDepan.MRP));
                    }else{
                        $('[name="MRP_masa_depan"]').val("");
                    }
                    $('[name="lokasi_masa_depan"]').val(val.MstTransaksiMasaDepan.Lokasi);

                    if(val.MstTransaksiPribadi.Status == 'Pending' && val.MstTransaksiMasaDepan.Status == 'Pending') {
                        $('#button_approve_save').show();
                    } else {
                        $('#button_approve_save').hide();
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            $('#update-trade-in').modal();
        });

        window.currencyFormat = function(n) {
            return n.replace(/./g, function(c, i, a) {
                return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
            });
        }
    })
</script>

@include('modal.update_trade_in')
@endsection