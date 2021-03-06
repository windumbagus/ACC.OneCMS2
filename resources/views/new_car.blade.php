@extends('admin.admin') 

@section('car', 'active')
@section('new-car', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="box-title">New Car</h3>
            </div>
            <div class="col-sm-3">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))    
                        <a href="{{asset('new-car/download/null&amp;null&amp;null')}}" class="btn btn-block btn-primary" 
                            id="button_newCar_download">Download</a>  
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" style="width:100%;" id="dropdown_newCar_statusTransaksi">
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
                    <a href="#" class="button_newCar_search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button_newCar_resetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">Start Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_newCar_startDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_newCar_resetStartDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        <div class="row">
                <div class="col-sm-1">End Date:</div>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <input type="text" id="datepicker_newCar_endDate" class="form-control" placeholder="dd/mm/yyyy">
                        <div class="input-group-addon" id="button_newCar_resetEndDate">
                            <i class="fa fa-repeat"></i>
                        </div>
                    </div>
                </div>
        </div><br>
        
        <table id="datatable_newCar_newCarData" class="table table-bordered display nowrap" style="width:100%">
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
                        @if (property_exists($MstTransaksi->User, 'Name'))
                            <td><span>{{$MstTransaksi->User->Name}}</span></td>
                        @else
                            <td></td>
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
                                @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                                    <a href="#" MstTransaksi_Id="{{$MstTransaksi->MstTransaksi->Id}}" class="button_newCar_view 
                                        btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                @else
                                    <a href="#" MstTransaksi_Id="{{$MstTransaksi->MstTransaksi->Id}}" class="button_newCar_view 
                                        btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                                @endif

                                @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                                    <a href="{{asset('new-car/delete/'.$MstTransaksi->MstTransaksi->Id)}}" 
                                    class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')" >
                                    <i class="fa fa-trash"></i>
                                    </a> 
                                @endif
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
        $('#datatable_newCar_newCarData').DataTable({
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
        $('.button_newCar_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dataTable = $('#datatable_newCar_newCarData').DataTable()
            dataTable.search(searchData).draw()
        })

        // Reset-Search Button 
        $('.button_newCar_resetSearch').on('click',function(){
            var dataTable = $('#datatable_newCar_newCarData').DataTable()
            dataTable.search('').draw()
            $('.input-search').val('')
            $('#dropdown_newCar_statusTransaksi').val('');
            $('#datepicker_newCar_startDate').datepicker('setDate', null);
            $('#datepicker_newCar_endDate').datepicker('setDate', null);
            startEndDateCondition();
        })

        // StatusTransaksi Dropdown
        $('#dropdown_newCar_statusTransaksi').on('change',function(){
            getByCondition();
        });

        // Start-End Datepicker
        $('#datepicker_newCar_startDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_newCar_startDate').datepicker('getDate') != null) {
                if (($('#datepicker_newCar_endDate').datepicker('getDate') != null) && 
                    ($('#datepicker_newCar_startDate').datepicker('getDate') > $('#datepicker_newCar_endDate').datepicker('getDate'))) {
                    $('#datepicker_newCar_endDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });
        $('#datepicker_newCar_endDate').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(selected){
            if ($('#datepicker_newCar_endDate').datepicker('getDate') != null) {
                if (($('#datepicker_newCar_startDate').datepicker('getDate') != null) &&
                    ($('#datepicker_newCar_endDate').datepicker('getDate') < $('#datepicker_newCar_startDate').datepicker('getDate'))) {
                    $('#datepicker_newCar_startDate').datepicker('setDate', null);
                }
                startEndDateCondition();
            }
        });

        // ResetDatePicker Button
        $('#button_newCar_resetStartDate').on('click',function(){
            if ($('#datepicker_newCar_startDate').datepicker('getDate') != null) {
                $('#datepicker_newCar_startDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })
        $('#button_newCar_resetEndDate').on('click',function(){
            if ($('#datepicker_newCar_endDate').datepicker('getDate') != null) {
                $('#datepicker_newCar_endDate').datepicker('setDate', null);
                startEndDateCondition();
            }
        })

        // StartEndDateCondition Function
        window.startEndDateCondition = function(){
            var StartDate_Date = $('#datepicker_newCar_startDate').datepicker('getDate')
            var EndDate_Date = $('#datepicker_newCar_endDate').datepicker('getDate')
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
            var Status = $('#dropdown_newCar_statusTransaksi').val();
            var StartDate_DateFormat = $('#datepicker_newCar_startDate').val();
            var EndDate_DateFormat = $('#datepicker_newCar_endDate').val();
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
            var Role = {!! json_encode($Role) !!}
             // console.log(Role);
             if (Role.IsDownload){
                var tempStatus_Donwload = Status;
                var tempStartDate_Donwload = StartDate;
                var tempEndDate_Donwload = EndDate;
                if (Status == "")
                    tempStatus_Donwload = "null";
                if (StartDate == "")
                    tempStartDate_Donwload = "null";
                if (EndDate == "")
                    tempEndDate_Donwload = "null";
                document.getElementById('button_newCar_download').setAttribute("href", "");
                document.getElementById('button_newCar_download')
                    .setAttribute("href", `{{asset('new-car/download/${tempStatus_Donwload}&${tempStartDate_Donwload}&${tempEndDate_Donwload}')}}`);
             }

            $.ajax({
                url:'new-car/get-by-condition',
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

                    var table = $('#datatable_newCar_newCarData').DataTable()
                    var MstTransaksiList = output.MstTransaksiList;
                    table.clear().draw();
                    if (typeof MstTransaksiList !== 'undefined') {
                        MstTransaksiList.map(MstTransaksi=>{
                            if (typeof MstTransaksi.User.Name === 'undefined') {
                                MstTransaksi.User.Name = "";
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

                            var ElementUpdate = "";
                            var ElementDelete = "";

                            if (Role.IsUpdate){
                              ElementUpdate = 'btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp;';
                            }else{
                              ElementUpdate = 'btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp;';
                            }

                            if (Role.IsDelete){
                              ElementDelete =   `<a href="{{asset('new-car/delete/${MstTransaksi.MstTransaksi.Id}')}}"`+
                                                `class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this ?')">`+
                                                '<i class="fa fa-trash"></i>'+
                                                '</a>';
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
                                    '<a href="#" MstTransaksi_Id="'+MstTransaksi.MstTransaksi.Id+'" class="button_newCar_view '+ ElementUpdate +
                                    ElementDelete +
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
        $(document).on('click','.button_newCar_view',function(){
            var id = $(this).attr('MstTransaksi_Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/new-car/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    // console.log(val);
                    
                    $('[name="updateNewCar_User_UserName"]').val(val.User_UserName);
                    $('[name="updateNewCar_MstTransaksi_Id"]').val(val.MstTransaksi.Id);
                    $('[name="updateNewCar_MstTransaksi_Brand"]').val(val.MstTransaksi.Brand);
                    $('[name="updateNewCar_MstTransaksi_KodeBrand"]').val(val.MstTransaksi.KodeBrand);
                    $('[name="updateNewCar_MstTransaksi_Type"]').val(val.MstTransaksi.Type);
                    $('[name="updateNewCar_MstTransaksi_KodeType"]').val(val.MstTransaksi.KodeType);
                    $('[name="updateNewCar_MstTransaksi_Model"]').val(val.MstTransaksi.Model);
                    $('[name="updateNewCar_MstTransaksi_KodeModel"]').val(val.MstTransaksi.KodeModel);
                    $('[name="updateNewCar_MstTransaksi_Tahun"]').val(val.MstTransaksi.Tahun);
                    $('[name="updateNewCar_MstTransaksi_Tenors"]').val(val.MstTransaksi.Tenors);
                    $('[name="updateNewCar_MstTransaksi_DP"]').val(val.MstTransaksi.DP);
                    $('[name="updateNewCar_MstTransaksi_Area"]').val(val.MstTransaksi.Area);
                    $('[name="updateNewCar_MstTransaksi_Cabang"]').val(val.MstTransaksi.Cabang);
                    $('[name="updateNewCar_MstTransaksi_Installment"]').val(currencyFormat(val.MstTransaksi.Installment));
                    $('[name="updateNewCar_MstTransaksi_OTR"]').val(currencyFormat(val.MstTransaksi.OTR));
                    $('[name="updateNewCar_MstTransaksi_AmountDP"]').val(currencyFormat(val.MstTransaksi.AmountDP.toString()));
                    $('[name="updateNewCar_MstTransaksi_TDP"]').val(currencyFormat(val.MstTransaksi.TDP));

                    var TransactionDate = 
                        val.MstTransaksi.TransactionDate.substr(8,2) + "-" +
                        val.MstTransaksi.TransactionDate.substr(5,2) + "-" +
                        val.MstTransaksi.TransactionDate.substr(0,4);
                    $('[name="updateNewCar_MstTransaksi_TransactionDate"]').val(TransactionDate);

                    if(val.MstTransaksi.FlagACP) {
                        $('[name="updateNewCar_MstTransaksi_FlagACP"]').val('Ya');
                    } else {
                        $('[name="updateNewCar_MstTransaksi_FlagACP"]').val('Tidak');
                    }
                    if(val.MstTransaksi.FlagAsuransi) {
                        $('[name="updateNewCar_MstTransaksi_FlagAsuransi"]').val('Tunai');
                    } else {
                        $('[name="updateNewCar_MstTransaksi_FlagAsuransi"]').val('Kredit');
                    }

                    if(val.MstTransaksi.Status == 'Followed_Up') {
                        $('[name="updateNewCar_MstTransaksi_Status"]').val("Followed Up");
                        $('#button_newCarModalUpdate_save').hide();
                        document.getElementById("textarea_newCarModalUpdate_notes").setAttribute("readonly", "")
                        document.getElementById("textarea_newCarModalUpdate_notes").removeAttribute("required");
                        if(val.MstTransaksi.hasOwnProperty('Notes')) {
                            $('[name="updateNewCar_MstTransaksi_Notes"]').val(val.MstTransaksi.Notes);
                        } else {
                            $('[name="updateNewCar_MstTransaksi_Notes"]').val("");
                        }
                    } else {
                        $('[name="updateNewCar_MstTransaksi_Status"]').val(val.MstTransaksi.Status);
                        $('#button_newCarModalUpdate_save').show();
                        $('[name="updateNewCar_MstTransaksi_Notes"]').val("");
                        document.getElementById("textarea_newCarModalUpdate_notes").setAttribute("required", "")
                        document.getElementById("textarea_newCarModalUpdate_notes").removeAttribute("readonly");
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            $('#modal_newCar_update').modal();
        });

        window.currencyFormat = function(n) {
            return n.replace(/./g, function(c, i, a) {
                return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
            });
        }
    })
</script>

@include('modal.update_new_car')
@endsection