@extends('admin.admin') 

@section('service', 'active')
@section('registered-contract', 'active')

@section('content')
<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Registered Contract</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                @if ((property_exists($Role,'IsDownload')) && ($Role->IsDownload == True))
                    <a href="{{asset('/registered-contract/download')}}" class="btn btn-block btn-primary">Download</a>
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
                <div class="col-sm-8">
                    <input type="text" placeholder="Search by No Contract or Username" class="InputSearch form-control">
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
            <th>Username</th>
            <th>Contract</th>
            <th>V Account</th>
            <th>Date</th>
            <th>Police No</th>
            <th>Car Type</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Contracts as $Contract)

            <tr>  
                <td><span>{{$Contract->User->Username}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->CONTRACT_NO}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->V_ACCOUNT}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->BILL_DATE}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->POLICE_NO}}</span></td>
                <td><span>{{$Contract->MstRegisteredContract->CAR_TYPE}}</span></td>
                
                {{-- @if (property_exists($Bug->MstKritikSaranBug, 'Report')) --}}
                {{-- @if( strlen($Contract->MstKritikSaranBug->Report)>= 100)
                    <td><span>{{substr($Contract->MstKritikSaranBug->Report,0,100)."..."}}</span></td>
                @else 
                    <td><span>{{$Contract->MstKritikSaranBug->Report}}</span></td>
                @endif --}}
                <td>
                <span>
                    <a href="#" data-id="{{ $Contract->MstRegisteredContract->Id}}" class="view-registered-contract-detail btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                    @if ((property_exists($Role,'IsDelete')) && ($Role->IsDelete == True))
                        <a  href="{{asset('registered-contract/delete/'.$Contract->MstRegisteredContract->Id)}}" 
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
    $(document).ready(function () {
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
                {"searchable":false},                
                {"searchable":false},
                {"searchable":false},                
                {"searchable":false},
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

        // VIEW Registered contract detail
        $(document).on('click','.view-registered-contract-detail',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/registered-contract/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    
                    $('[name="registered_contract_IdMstRegisteredContract_detail"]').val(val.MstRegisteredContract.Id);
                    $('[name="registered_contract_Name_detail"]').val(val.User.Name);
                    $('[name="registered_contract_Username_detail"]').val(val.User.Username);
                    $('[name="registered_contract_Email_detail"]').val(val.User.Email);
                    $('[name="registered_contract_MobilePhone_detail"]').val(val.User.MobilePhone);
                    $('[name="registered_contract_ContractNo_detail"]').val(val.MstRegisteredContract.CONTRACT_NO);
                    $('[name="registered_contract_VAccount_detail"]').val(val.MstRegisteredContract.V_ACCOUNT);
                    $('[name="registered_contract_PoliceNo_detail"]').val(val.MstRegisteredContract.POLICE_NO);
                    $('[name="registered_contract_TotalPayment_detail"]').val(val.MstRegisteredContract.TOTAL_PAYMENT);
                    $('[name="registered_contract_AmountOfAR_detail"]').val(val.MstRegisteredContract.AMOUNT_OF_AR);
                    $('[name="registered_contract_PolisInsurance_detail"]').val(val.MstRegisteredContract.POLIS_INSURANCE);
                    $('[name="registered_contract_AmountInstallmentOVD_detail"]').val(val.MstRegisteredContract.AMOUNT_INSTALLMENT_OVD);
                    $('[name="registered_contract_InfoPlafon_detail"]').val(val.MstRegisteredContract.INFO_PLAFON);
                    $('[name="registered_contract_AMT_APC_detail"]').val(val.MstRegisteredContract.AMT_ACP);
                    $('[name="registered_contract_NameInsuCO_detail"]').val(val.MstRegisteredContract.NAME_INSU_CO);
                    $('[name="registered_contract_AMTInstallmentPaid_detail"]').val(val.MstRegisteredContract.AMT_INSTALLMENT_PAID);
                    $('[name="registered_contract_FlagBayar_detail"]').val(val.MstRegisteredContract.FLAG_BAYAR);
                    $('[name="registered_contract_BillNo_detail"]').val(val.MstRegisteredContract.BILL_NO);
                    $('[name="registered_contract_BillDate_detail"]').val(val.MstRegisteredContract.BILL_DATE);
                    $('[name="registered_contract_BillExp_detail"]').val(val.MstRegisteredContract.BILL_EXP);
                    $('[name="registered_contract_BillDesc_detail"]').val(val.MstRegisteredContract.BILL_DESC);
                    $('[name="registered_contract_BillAmount_detail"]').val(val.MstRegisteredContract.BILL_AMOUNT);
                    $('[name="registered_contract_Tenor_detail"]').val(val.MstRegisteredContract.TENOR);
                    $('[name="registered_contract_Currency_detail"]').val(val.MstRegisteredContract.CURRENCY_ID);
                    $('[name="registered_contract_PaymenType_detail"]').val(val.MstRegisteredContract.PAYMENT_TYPE);
                    $('[name="registered_contract_PaymenPlan_detail"]').val(val.MstRegisteredContract.PAYMENT_PLAN);
                    $('[name="registered_contract_PaymenMethod_detail"]').val(val.MstRegisteredContract.PAYMENT_METHOD);
                    $('[name="registered_contract_PaymenDetail_detail"]').val(val.MstRegisteredContract.PAYMENT_DETAIL);
                    $('[name="registered_contract_SignatureDebit_detail"]').val(val.MstRegisteredContract.SIGNATUREDEBIT);
                    $('[name="registered_contract_SignatureDebit2_detail"]').val(val.MstRegisteredContract.SIGNATUREDEBIT2);
                    $('[name="registered_contract_SignatureCredit_detail"]').val(val.MstRegisteredContract.SIGNATURECREDIT);
                    $('[name="registered_contract_MerchantId_detail"]').val(val.MstRegisteredContract.MERCHANTID);
                    $('[name="registered_contract_MerchantName_detail"]').val(val.MstRegisteredContract.MERCHANTNAME);
                    $('[name="registered_contract_FlagSyariah_detail"]').val(val.MstRegisteredContract.FLAG_SYARIAH);
                    $('[name="registered_contract_UserID_detail"]').val(val.MstRegisteredContract.UserID);
                    
                    //set atribut untuk view transaction history
                    document.getElementById('view-transaction-history').setAttribute('data-IdMstRegisteredContract',val.MstRegisteredContract.Id)
                    document.getElementById('view-transaction-history').setAttribute('data-ContractNo',val.MstRegisteredContract.CONTRACT_NO)
                    document.getElementById('view-transaction-history').setAttribute('data-Username',val.User.Username)
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-registered-contract-detail').modal();
        });
        
    })
</script>

@include('modal.view_registered_contract_detail')
@include('modal.view_transaction_history')
@include('modal.view_transaction_history_detail')
@endsection