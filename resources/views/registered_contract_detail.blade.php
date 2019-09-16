@extends('admin.admin') 

@section('service', 'active')
@section('registered-contract', 'active')

@section('content')
<div class="box box-primary">
    <form id="form-view-survey" action="#" method="post"> 
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <textarea type="text" class="form-control" name="registered_contract__detail" readonly></textarea>
            </div>
            <div class="form-group">
                <label>Mobile Phone</label>
                <Input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Contract No</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>V Account</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Police No</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Total Payment</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Amount of AR</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Polis Insurance</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Amount Installment OVD</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Info Plavon</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>AMT ACP</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Name INSU CO</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>AMT Installment Paid</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Flag Bayar</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Bill No</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Bill Date</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Bill Exp</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Bill Desc</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Bill Amount</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Tenor</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Currancy</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Payment Type</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Payment Type</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Payment Detail</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Signature Debit</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Signature Debit 2</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Signature Credit</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Merchant Id</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Merchant Name</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>Flag Syariah</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
            <div class="form-group">
                <label>User</label>
                <input type="text" class="form-control" name="registered_contract__detail" readonly>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="close-modal">Close</button>		
        </div>	
    </form>
</div>
@endsection