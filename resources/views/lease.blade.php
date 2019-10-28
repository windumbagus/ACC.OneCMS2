@extends('admin.admin') 

@section('car', 'active')
@section('lease', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">Lease</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="{{asset('lease/download/null&amp;null&amp;null')}}" class="btn btn-block btn-primary" 
                        id="button_lease_download">Download</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" style="width:100%;" id="dropdown_lease_statusTransaksi">
                    <option value="" selected>-- Choose Condition --</option>
                    @foreach ($MstTrsansaksi_StatusList as $MstTrsansaksi_Status)
                        <option value="{{$MstTrsansaksi_Status}}">
                            {{$MstTrsansaksi_Status}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" placeholder="Search by Name or Car Detail" class="input-search form-control">
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6">
                    <a href="#" class="button_lease_search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button_lease_resetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">Start Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_lease_startDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_lease_resetStartDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">End Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_lease_endDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_lease_resetEndDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        
        <table id="datatable_lease_leaseData" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Car Detail</th>
                    <th>Email/Phone</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Cust. Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($MstTransaksiList as $MstTransaksi)
                    <tr>  
                        @if (property_exists($MstTransaksi, 'User'))
                            @if (property_exists($MstTransaksi->User, 'Name'))
                                <td><span>{{$MstTransaksi->User->Name}}</span></td>
                            @else
                                <td></td>
                            @endif
                        @endif

                        @if (property_exists($MstTransaksi->MstTransaksi, 'TransactionDate'))
                            <td><span>{{
                                date('Y-m-d', strtotime($MstTransaksi->MstTransaksi->TransactionDate))
                            }}</span></td>
                        @else
                            <td></td>
                        @endif

                        <td><span>
                            @if (property_exists($MstTransaksi->MstTransaksi, 'Brand'))
                                {{$MstTransaksi->MstTransaksi->Brand}}
                                @if (property_exists($MstTransaksi->MstTransaksi, 'Type'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($MstTransaksi->MstTransaksi, 'Type'))
                                {{$MstTransaksi->MstTransaksi->Type}}
                            @endif


                            @if ((property_exists($MstTransaksi->MstTransaksi, 'Brand')) || 
                                (property_exists($MstTransaksi->MstTransaksi, 'Type')))
                                <br>
                            @endif

                            @if (property_exists($MstTransaksi->MstTransaksi, 'Model'))
                                {{$MstTransaksi->MstTransaksi->Model}}
                                @if (property_exists($MstTransaksi->MstTransaksi, 'Tahun'))
                                    {{" "}}
                                @endif
                            @endif
                            @if (property_exists($MstTransaksi->MstTransaksi, 'Tahun'))
                                {{$MstTransaksi->MstTransaksi->Tahun}}
                            @endif
                        </span></td>

                        <td><span>
                            @if (property_exists($MstTransaksi->User, 'Email'))
                                {{$MstTransaksi->User->Email}}<br>
                            @endif
                            @if (property_exists($MstTransaksi->User, 'MobilePhone'))
                                {{$MstTransaksi->User->MobilePhone}}
                            @endif
                        </span></td>

                        @if (property_exists($MstTransaksi->MstTransaksi, 'Status'))
                            <td><span>{{$MstTransaksi->MstTransaksi->Status}}</span></td>
                        @else
                            <td></td>
                        @endif
                        
                        @if (property_exists($MstTransaksi->MstTransaksi, 'Status'))
                            @if ($MstTransaksi->MstTransaksi->Status == 'Followed_Up')
                                @if (property_exists($MstTransaksi->MstTransaksi, 'Notes'))
                                    @if(strlen($MstTransaksi->MstTransaksi->Notes) >= 25)
                                        <td><span>{{substr($MstTransaksi->MstTransaksi->Notes,0,25)."..."}}</span></td>
                                    @else 
                                        <td><span>{{$MstTransaksi->MstTransaksi->Notes}}</span></td>
                                    @endif
                                @else
                                    <td></td>
                                @endif
                            @else
                                <td></td>
                            @endif
                        @else
                            <td></td>
                        @endif

                        @if (property_exists($MstTransaksi->MstCustomerDetail, 'FlagCustomer'))
                            @if ($MstTransaksi->MstCustomerDetail->FlagCustomer != '')
                                <td><span>{{$MstTransaksi->MstCustomerDetail->FlagCustomer}}</span></td>
                            @else
                                <td><span>-</span></td>
                            @endif
                        @else
                            <td></td>
                        @endif

                        <td>
                            <span>
                                <a href="#" MstTransaksi_Id="{{$MstTransaksi->MstTransaksi->Id}}" class="button_lease_view 
                                    btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('lease/delete/'.$MstTransaksi->MstTransaksi->Id)}}" 
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
        $('#datatable_lease_leaseData').DataTable({
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
                {name: "Name"},                
                {name: "Date", "searchable":false},
                {name: "Car_Detail"},       
                {name: "Email_Phone", "searchable":false},
                {name: "Status", "searchable":false},
                {name: "Notes", "searchable":false},
                {name: "Cust_Type", "searchable":false},        
                {name: "Action", "searchable":false, "orderable":false},
            ]
        })

        // Search Button 
        $('.button_lease_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dataTable = $('#datatable_lease_leaseData').DataTable()
            dataTable.search(searchData).draw()
        })

        // Reset-Search Button 
        $('.button_lease_resetSearch').on('click',function(){
            var dataTable = $('#datatable_lease_leaseData').DataTable()
            dataTable.search('').draw()
            $('.input-search').val('')
            $('#dropdown_lease_statusTransaksi').val('');
            $('#datepicker_lease_startDate').datepicker('setDate', null);
            $('#datepicker_lease_endDate').datepicker('setDate', null);
            startEndDateCondition();
        })

        // StatusTransaksi Dropdown
        $('#dropdown_lease_statusTransaksi').on('change',function(){
            getByCondition();
        });

        // Start-End Datepicker
        $('#datepicker_lease_startDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_lease_startDate').datepicker('getDate') != null) {
                if (($('#datepicker_lease_endDate').datepicker('getDate') != null) && 
                    ($('#datepicker_lease_startDate').datepicker('getDate') > $('#datepicker_lease_endDate').datepicker('getDate'))) {
                    $('#datepicker_lease_endDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });
        $('#datepicker_lease_endDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_lease_endDate').datepicker('getDate') != null) {
                if (($('#datepicker_lease_startDate').datepicker('getDate') != null) &&
                    ($('#datepicker_lease_endDate').datepicker('getDate') < $('#datepicker_lease_startDate').datepicker('getDate'))) {
                    $('#datepicker_lease_startDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });

        // ResetDatePicker Button
        $('#button_lease_resetStartDate').on('click',function(){
            if ($('#datepicker_lease_startDate').datepicker('getDate') != null) {
                $('#datepicker_lease_startDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })
        $('#button_lease_resetEndDate').on('click',function(){
            if ($('#datepicker_lease_endDate').datepicker('getDate') != null) {
                $('#datepicker_lease_endDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })

        // StartEndDateCondition Function
        window.startEndDateCondition = function(){
            var StartDate_Date = $('#datepicker_lease_startDate').datepicker('getDate')
            var EndDate_Date = $('#datepicker_lease_endDate').datepicker('getDate')
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
            var Status = $('#dropdown_lease_statusTransaksi').val();
            var StartDate_DateFormat = $('#datepicker_lease_startDate').val();
            var EndDate_DateFormat = $('#datepicker_lease_endDate').val();
            if (StartDate_DateFormat !== "") {
                var StartDate = 
                    StartDate_DateFormat.substring(6,10)+'-'+StartDate_DateFormat.substring(3,5)+'-'+StartDate_DateFormat.substring(0,2);
            } else {
                StartDate = "";
            }
            if (EndDate_DateFormat !== "") {
                var EndDate = 
                    EndDate_DateFormat.substring(6,10)+'-'+EndDate_DateFormat.substring(3,5)+'-'+EndDate_DateFormat.substring(0,2);
            } else {
                EndDate = "";
            }
            // console.log(Status);
            // console.log(StartDate);
            // console.log(EndDate);

            // Function Download
            var tempStatus_Donwload = Status;
            var tempStartDate_Donwload = StartDate;
            var tempEndDate_Donwload = EndDate;
            if (Status == "")
                tempStatus_Donwload = "null";
            if (StartDate == "")
                tempStartDate_Donwload = "null";
            if (EndDate == "")
                tempEndDate_Donwload = "null";
            document.getElementById('button_lease_download').setAttribute("href", "");
            document.getElementById('button_lease_download')
                .setAttribute("href", `{{asset('lease/download/${tempStatus_Donwload}&${tempStartDate_Donwload}&${tempEndDate_Donwload}')}}`);

            $.ajax({
                url:'lease/get-by-condition',
                data: {
                    'Status':Status,
                    'StartDate':StartDate,
                    'EndDate':EndDate,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'json',
                type:'POST',
                success: function(output){
                    // console.log(output);

                    var table = $('#datatable_lease_leaseData').DataTable()
                    var MstTransaksiList = output.MstTransaksiList;
                    table.clear().draw();
                    if (typeof MstTransaksiList !== 'undefined') {
                        MstTransaksiList.map(MstTransaksi=>{
                            if (typeof MstTransaksi.User === 'undefined') {    
                                if (typeof MstTransaksi.User.Name === 'undefined') {
                                    MstTransaksi.User.Name = "";
                                }
                            }
                            if (typeof MstTransaksi.MstTransaksi.TransactionDate === 'undefined') {
                                MstTransaksi.MstTransaksi.TransactionDate = "";
                            }
                            if (typeof MstTransaksi.MstTransaksi.Brand === 'undefined') {
                                MstTransaksi.MstTransaksi.Brand = "";
                                if (typeof MstTransaksi.MstTransaksi.Type === 'undefined') {
                                    MstTransaksi.MstTransaksi.Type = "";
                                }
                            } else {
                                if (typeof MstTransaksi.MstTransaksi.Type === 'undefined') {
                                    MstTransaksi.MstTransaksi.Type = "";
                                } else {
                                    MstTransaksi.MstTransaksi.Brand += " ";
                                }
                            }
                            if (typeof MstTransaksi.MstTransaksi.Model === 'undefined') {
                                MstTransaksi.MstTransaksi.Model = "";
                                if (typeof MstTransaksi.MstTransaksi.Tahun === 'undefined') {
                                    MstTransaksi.MstTransaksi.Tahun = "";
                                }
                            } else {
                                if (typeof MstTransaksi.MstTransaksi.Tahun === 'undefined') {
                                    MstTransaksi.MstTransaksi.Tahun = "";
                                } else {
                                    MstTransaksi.MstTransaksi.Model += " ";
                                }
                            }
                            if (typeof MstTransaksi.User.Email === 'undefined') {
                                MstTransaksi.User.Email = "";
                            }
                            if (typeof MstTransaksi.User.MobilePhone === 'undefined') {
                                MstTransaksi.User.MobilePhone = "";
                            }
                            if (typeof MstTransaksi.MstTransaksi.Status === 'undefined') {
                                MstTransaksi.MstTransaksi.Status = "";
                                MstTransaksi.MstTransaksi.Notes = "";
                            } else {
                                if (MstTransaksi.MstTransaksi.Status === 'Followed_Up') {
                                    if (typeof MstTransaksi.MstTransaksi.Notes === 'undefined') {
                                        MstTransaksi.MstTransaksi.Notes = "";
                                    } else {
                                        if(MstTransaksi.MstTransaksi.Notes.length >= 25) {
                                            MstTransaksi.MstTransaksi.Notes = MstTransaksi.MstTransaksi.Notes.substring(0, 25);
                                        }
                                    }
                                } 
                                else {
                                    MstTransaksi.MstTransaksi.Notes = "";
                                }
                            }
                            if (typeof MstTransaksi.MstCustomerDetail.FlagCustomer === 'undefined') {
                                MstTransaksi.MstCustomerDetail.FlagCustomer = "";
                            }
                        
                            table.row.add([
                                '<span>'+MstTransaksi.User.Name+'</span>',
                                '<span>'+
                                    MstTransaksi.MstTransaksi.TransactionDate.substring(0, 10)+
                                '</span>',
                                '<span>'+
                                    MstTransaksi.MstTransaksi.Brand+
                                    MstTransaksi.MstTransaksi.Type+
                                    '<br>'+
                                    MstTransaksi.MstTransaksi.Model+
                                    MstTransaksi.MstTransaksi.Tahun+
                                '</span>',
                                '<span>'+
                                    MstTransaksi.User.Email+
                                    '<br>'+
                                    MstTransaksi.User.MobilePhone+
                                '</span>',
                                '<span>'+MstTransaksi.MstTransaksi.Status+'</span>',
                                '<span>'+MstTransaksi.MstTransaksi.Notes+'</span>',
                                '<span>'+MstTransaksi.MstCustomerDetail.FlagCustomer+'</span>',
                                '<span>'+
                                    '<a href="#" MstTransaksi_Id="'+MstTransaksi.MstTransaksi.Id+'" class="button_lease_view '+
                                        'btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp;'+
                                    `<a href="{{asset('lease/delete/${MstTransaksi.MstTransaksi.Id}')}}"`+
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
        $(document).on('click','.button_lease_view',function(){
            var id = $(this).attr('MstTransaksi_Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/lease/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="updateLease_User_UserName"]').val(val.User_UserName);
                    $('[name="updateLease_MstTransaksi_Id"]').val(val.MstTransaksi.Id);
                    $('[name="updateLease_MstTransaksi_Brand"]').val(val.MstTransaksi.Brand);
                    $('[name="updateLease_MstTransaksi_KodeBrand"]').val(val.MstTransaksi.KodeBrand);
                    $('[name="updateLease_MstTransaksi_Type"]').val(val.MstTransaksi.Type);
                    $('[name="updateLease_MstTransaksi_KodeType"]').val(val.MstTransaksi.KodeType);
                    $('[name="updateLease_MstTransaksi_Model"]').val(val.MstTransaksi.Model);
                    $('[name="updateLease_MstTransaksi_KodeModel"]').val(val.MstTransaksi.KodeModel);
                    $('[name="updateLease_MstTransaksi_Tahun"]').val(val.MstTransaksi.Tahun);
                    $('[name="updateLease_MstTransaksi_Tenors"]').val(val.MstTransaksi.Tenors);
                    $('[name="updateLease_MstTransaksi_Area"]').val(val.MstTransaksi.Area);
                    $('[name="updateLease_MstTransaksi_Cabang"]').val(val.MstTransaksi.Cabang);
                    $('[name="updateLease_MstTransaksi_Tujuan"]').val(val.MstTransaksi.Tujuan);
                    $('[name="updateLease_MstTransaksi_TipeCustomer"]').val(val.MstTransaksi.TipeCustomer);
                    $('[name="updateLease_MstTransaksi_BidangUsaha"]').val(val.MstTransaksi.BidangUsaha);
                    $('[name="updateLease_MstTransaksi_Warna"]').val(val.MstTransaksi.Warna);

                    var TransactionDate = 
                        val.MstTransaksi.TransactionDate.substr(8,2) + "-" +
                        val.MstTransaksi.TransactionDate.substr(5,2) + "-" +
                        val.MstTransaksi.TransactionDate.substr(0,4);
                    $('[name="updateLease_MstTransaksi_TransactionDate"]').val(TransactionDate);

                    if(val.MstTransaksi.FlagNewUsed) {
                        $('[name="updateLease_MstTransaksi_FlagNewUsed"]').val('New');
                    } else {
                        $('[name="updateLease_MstTransaksi_FlagNewUsed"]').val('Used');
                    }

                    if(val.MstTransaksi.Status == 'Followed_Up') {
                        $('[name="updateLease_MstTransaksi_Status"]').val("Followed Up");
                        $('#button_leaseModalUpdate_save').hide();
                        document.getElementById("textarea_leaseModalUpdate_notes").setAttribute("readonly", "")
                        document.getElementById("textarea_leaseModalUpdate_notes").removeAttribute("required");
                        if(val.MstTransaksi.hasOwnProperty('Notes')) {
                            $('[name="updateLease_MstTransaksi_Notes"]').val(val.MstTransaksi.Notes);
                        } else {
                            $('[name="updateLease_MstTransaksi_Notes"]').val("");
                        }
                    } else {
                        $('[name="updateLease_MstTransaksi_Status"]').val(val.MstTransaksi.Status);
                        $('#button_leaseModalUpdate_save').show();
                        $('[name="updateLease_MstTransaksi_Notes"]').val("");
                        document.getElementById("textarea_leaseModalUpdate_notes").setAttribute("required", "")
                        document.getElementById("textarea_leaseModalUpdate_notes").removeAttribute("readonly");
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            $('#modal_lease_update').modal();
        });
    })
</script>

@include('modal.update_lease')
@endsection