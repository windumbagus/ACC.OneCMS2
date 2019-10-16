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
                    <a href="#" class="button_newCar_download btn btn-block btn-primary">Download</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="form-control select2" id="dropdown_newCar_statusTransaksi" style="width:100%;">
                    <option value="0" selected>-- Choose Condition --</option>
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
        
        <table id="datatable_1" class="table table-bordered display nowrap" style="width:100%">
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
                                substr($MstTransaksi->MstTransaksi->TransactionDate, 8, 2) . "-" .
                                substr($MstTransaksi->MstTransaksi->TransactionDate, 5, 2) . "-" .
                                substr($MstTransaksi->MstTransaksi->TransactionDate, 0, 4)
                            }}</span></td>
                        @else
                            <td></td>
                        @endif

                        <td><span>
                            @if (property_exists($MstTransaksi->MstTransaksi, 'Brand'))
                                {{$MstTransaksi->MstTransaksi->Brand}}
                            @endif
                            @if ((property_exists($MstTransaksi->MstTransaksi, 'Brand')) && 
                                (property_exists($MstTransaksi->MstTransaksi, 'Type')))
                                {{" "}}
                            @endif
                            @if (property_exists($MstTransaksi->MstTransaksi, 'Type'))
                                {{$MstTransaksi->MstTransaksi->Type}}
                            @endif

                            @if ((property_exists($MstTransaksi->MstTransaksi, 'Model')) || 
                                (property_exists($MstTransaksi->MstTransaksi, 'Tahun')))
                                <br>
                            @endif

                            @if (property_exists($MstTransaksi->MstTransaksi, 'Model'))
                                {{$MstTransaksi->MstTransaksi->Model}}
                            @endif
                            @if ((property_exists($MstTransaksi->MstTransaksi, 'Model')) && 
                                (property_exists($MstTransaksi->MstTransaksi, 'Tahun')))
                                {{" "}}
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
                                    @if(strlen($MstTransaksi->MstTransaksi->Notes) >= 20)
                                        <td><span>{{substr($MstTransaksi->MstTransaksi->Notes,0,20)."..."}}</span></td>
                                    @else 
                                        <td><span>{{$MstTransaksi->MstTransaksi->Notes}}</span></td>
                                    @endif
                                @else
                                    <td></td>
                                @endif
                            @else
                                <td>
                                    <form id="form_newCar_followUp" action="{{asset('new-car/follow-up')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="followUpNewCar_MstTransaksi_Id" 
                                                value="{{$MstTransaksi->MstTransaksi->Id}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="col-xs-6" name="followUpNewCar_MstTransaksi_Notes">
                                            &nbsp;
                                            <button type="submit" class="btn btn-primary"
                                                onclick="return confirm('Are you sure want to Follow Up this data?')">
                                                Followed Up
                                            </button>
                                        </div>
                                    </form>
                                </td>
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
                                <a href="#" MstTransaksi_Id="{{$MstTransaksi->MstTransaksi->Id}}" class="button_newCar_view 
                                    btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                                <a href="{{asset('new-car/delete/'.$MstTransaksi->MstTransaksi->Id)}}" 
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
    $(document).ready(function () {
        $('#datatable_1').DataTable({
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
                null,        
                {"searchable":false},
                {"searchable":false},
                {"searchable":false},
                {"searchable":false},        
                {"searchable":false},
            ]
        })

        //Button Search
        $('.button_newCar_search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable_1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button_newCar_resetSearch').on('click',function(){
            var tab = $('#datatable_1').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })

        // Modal Download
        // $(document).on('click','.button_newCar_download',function(){
        //     $('#modal_newCar_download').modal();
        // });
        
        // Modal View
        $(document).on('click','.button_newCar_view',function(){
            var id = $(this).attr('MstTransaksi_Id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/new-car/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="viewNewCar_User_Name"]').val(val.User_Name);

                    $('[name="viewNewCar_MstTransaksi_Id"]').val(val.MstTransaksi.Id);
                    $('[name="viewNewCar_MstTransaksi_UserId"]').val(val.MstTransaksi.UserId);
                    $('[name="viewNewCar_MstTransaksi_TransactionDate"]').val(val.MstTransaksi.TransactionDate);
                    $('[name="viewNewCar_MstTransaksi_Brand"]').val(val.MstTransaksi.Brand);
                    $('[name="viewNewCar_MstTransaksi_KodeBrand"]').val(val.MstTransaksi.KodeBrand);
                    $('[name="viewNewCar_MstTransaksi_Type"]').val(val.MstTransaksi.Type);
                    $('[name="viewNewCar_MstTransaksi_KodeType"]').val(val.MstTransaksi.KodeType);
                    $('[name="viewNewCar_MstTransaksi_Model"]').val(val.MstTransaksi.Model);
                    $('[name="viewNewCar_MstTransaksi_KodeModel"]').val(val.MstTransaksi.KodeModel);
                    $('[name="viewNewCar_MstTransaksi_Tahun"]').val(val.MstTransaksi.Tahun);
                    $('[name="viewNewCar_MstTransaksi_Installment"]').val(val.MstTransaksi.Installment);
                    $('[name="viewNewCar_MstTransaksi_OTR"]').val(val.MstTransaksi.OTR);
                    $('[name="viewNewCar_MstTransaksi_DP"]').val(val.MstTransaksi.DP);
                    $('[name="viewNewCar_MstTransaksi_AmountDP"]').val(val.MstTransaksi.AmountDP);
                    $('[name="viewNewCar_MstTransaksi_Area"]').val(val.MstTransaksi.Area);
                    $('[name="viewNewCar_MstTransaksi_Cabang"]').val(val.MstTransaksi.Cabang);
                    $('[name="viewNewCar_MstTransaksi_TDP"]').val(val.MstTransaksi.TDP);
                    $('[name="viewNewCar_MstTransaksi_FlagACP"]').val(val.MstTransaksi.FlagACP);
                    $('[name="viewNewCar_MstTransaksi_FlagNewExist"]').val(val.MstTransaksi.FlagNewExist);
                    $('[name="viewNewCar_MstTransaksi_FlagAsuransi"]').val(val.MstTransaksi.FlagAsuransi);
                    $('[name="viewNewCar_MstTransaksi_FlagTransaksi"]').val(val.MstTransaksi.FlagTransaksi);
                    $('[name="viewNewCar_MstTransaksi_Status"]').val(val.MstTransaksi.Status);
                    $('[name="viewNewCar_MstTransaksi_Tenors"]').val(val.MstTransaksi.Tenors);
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
            // $('#modal_newCar_view').modal();
        });
    })
</script>

@endsection