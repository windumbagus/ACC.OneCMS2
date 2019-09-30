@extends('admin.admin') 

@section('content-management', 'active')
@section('promo', 'active')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Promo</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#" class="button-promo-add btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name or Description" class="input-search form-control">
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="button-search btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="button-resetsearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="datatable_1" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Promo Code</th>
                    <th>Description</th>
                    <th>Is Active</th>
                    <th>Is Active Banner</th>
                    <th>Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Promos as $Promo)
                <tr>  
                    @if( strlen($Promo->Name)>= 20)
                        <td><span>{{substr($Promo->Name,0,20)."..."}}</span></td>
                    @else 
                        <td><span>{{$Promo->Name}}</span></td>
                    @endif
                    
                    @if (property_exists($Promo, 'PromoCode'))
                        <td><span>{{$Promo->PromoCode}}</span></td>
                    @else
                        <td></td>
                    @endif

                    @if( strlen($Promo->Description)>= 20)
                        <td><span>{{substr($Promo->Description,0,20)."..."}}</span></td>
                    @else 
                        <td><span>{{$Promo->Name}}</span></td>
                    @endif
                    
                    @if (property_exists($Promo, 'IsActivePromo'))
                        @if ($Promo->IsActivePromo=='1')
                            <td>&check;</td>
                        @else
                            <td><span>{{$Promo->IsActivePromo}}</span></td>
                        @endif
                    @else
                        <td>&times;</td>
                    @endif
                    
                    @if (property_exists($Promo, 'IsActiveBanner'))
                        @if ($Promo->IsActivePromo=='1')
                            <td>&check;</td>
                        @else
                            <td><span>{{$Promo->IsActiveBanner}}</span></td>
                        @endif
                    @else
                        <td>&times;</td>
                    @endif

                    <td>
                        <select class="form-control select2 dropdown-promo-ordername" style="width:100%;" data-id2="{{$Promo->Id}}" >
                            @for($promo_OrderName_dropdownVal=0; $promo_OrderName_dropdownVal<=5; $promo_OrderName_dropdownVal++)
                                @if (property_exists($Promo, 'OrderName'))
                                    @if ($promo_OrderName_dropdownVal==$Promo->OrderName)
                                        <option value="{{$promo_OrderName_dropdownVal}}" selected>{{$promo_OrderName_dropdownVal}}</option>
                                    @else
                                        @if ($promo_OrderName_dropdownVal==0)
                                            <option value="{{$promo_OrderName_dropdownVal}}">-</option>
                                        @else
                                            <option value="{{$promo_OrderName_dropdownVal}}">{{$promo_OrderName_dropdownVal}}</option>
                                        @endif 
                                    @endif
                                @else
                                    @if ($promo_OrderName_dropdownVal==0)
                                        <option value="{{$promo_OrderName_dropdownVal}}" selected>-</option>
                                    @else
                                        <option value="{{$promo_OrderName_dropdownVal}}">{{$promo_OrderName_dropdownVal}}</option>
                                    @endif                                   
                                @endif
                            @endfor
                        </select>
                    </td>

                    <td>
                        <span>
                            <a href="#" data-id="{{ $Promo->Id }}" class="button-promo-update 
                                btn btn-info btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                            <a href="{{asset('promo/delete/'.$Promo->Id)}}" 
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
            ]
        })

        //Button Search
        $('.button-search').on('click', function(){
            var searchData = $('.input-search').val()
            var dtable = $('#datatable_1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.button-resetsearch').on('click',function(){
            var tab = $('#datatable_1').DataTable()
            tab.search('').draw()
            $('.input-search').val('')
        })
        
        // OrderName Dropdown
        $(document).on('change','.dropdown-promo-ordername', function(){
            // $('.dropdown-promo-ordername').change(function(){
            var PromoId = $(this).attr('data-id2');
            var SelectedOrderName = $(this).find('option:selected').val();
            // console.log(PromoId);
            // console.log(SelectedOrderName);
            $.ajax({
                url:"{{asset('/promo/update-order')}}",
                data: {
                    "MstPromoId": PromoId,
                    "SelectedOrderName": SelectedOrderName,
                '_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'POST',
                success: function (result){
                    // console.log(result);
                    window.location = "{{asset('promo')}}";
                    if (result.Success==true){ 
                        alert("Update Order Successfully!");
                    } else {
                        alert(result.Error);
                    };
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        })

        // Jenis Promo Dropdown
        $('#checkbox_promoModalAdd_TampilPeriodePromo').hide()

        // Promo Amount Input Addon
        $('#inputaddon_promoModalAdd_PromoAmountRp').hide()
        $('#inputaddon_promoModalAdd_PromoAmountPr').hide()

        // Modal Add
        $(document).on('click','.button-promo-add',function(){
            $('#modal_promo_add').modal();
        });

        // Modal Update
        $(document).on('click','.button-promo-update',function(){
            var id = $(this).attr('data-id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/promo/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="updatePromo_MstPicture_Id"]').val(val.MstPicture.Id);
                    $('[name="updatePromo_MstPicture_DataId"]').val(val.MstPicture.DataId);
                    $('[name="updatePromo_MstPicture_Picture"]').val(val.MstPicture.Picture);
                    $('[name="updatePromo_MstPicture_FileName"]').val(val.MstPicture.FileName);
                    $('[name="updatePromo_MstPicture_FileType"]').val(val.MstPicture.FileType);
                    $('[name="updatePromo_MstPicture_Type"]').val(val.MstPicture.Type);

                    $('[name="updatePromo_MstPromo_Id"]').val(val.MstPromo.Id);
                    $('[name="updatePromo_MstPromo_Name"]').val(val.MstPromo.Name);
                    $('[name="updatePromo_MstPromo_PromoCode"]').val(val.MstPromo.PromoCode);
                    $('[name="updatePromo_MstPromo_Description"]').val(val.MstPromo.Description);
                    $('[name="updatePromo_MstPromo_AddedDate"]').val(val.MstPromo.AddedDate);
                    $('[name="updatePromo_MstPromo_UserAdded"]').val(val.MstPromo.UserAdded);
                    $('[name="updatePromo_MstPromo_UpdatedDate"]').val(val.MstPromo.UpdatedDate);
                    $('[name="updatePromo_MstPromo_UserUpdated"]').val(val.MstPromo.UserUpdated);
                    $('[name="updatePromo_MstPromo_SyaratDanKetentuan"]').val(val.MstPromo.SyaratDanKetentuan);
                    $('[name="updatePromo_MstPromo_PromoType"]').val(val.MstPromo.PromoType);
                    $('[name="updatePromo_MstPromo_PromoAmount"]').val(val.MstPromo.PromoAmount);
                    $('[name="updatePromo_MstPromo_ProductOwner"]').val(val.MstPromo.ProductOwner);
                    $('[name="updatePromo_MstPromo_OrderName"]').val(val.MstPromo.OrderName);
                    $('[name="updatePromo_MstPromo_JenisPromo"]').val(val.MstPromo.JenisPromo);
                    $('[name="updatePromo_MstPromo_URL"]').val(val.MstPromo.URL);

                    if (val.MstPromo.hasOwnProperty('IsActivePromo')) {
                        $('[name="updatePromo_MstPromo_IsActivePromo"]').val(val.MstPromo.IsActivePromo); 
                        if (val.MstPromo.IsActivePromo=="true") {
                            document.getElementById('checkbox_promoModalUpdate_IsActivePromo').setAttribute('checked',''); 
                        }
                    } else {
                        $('[name="updatePromo_MstPromo_IsActivePromo"]').val("false");
                        document.getElementById('checkbox_promoModalUpdate_IsActivePromo').removeAttribute('checked');
                    }

                    if (val.MstPromo.hasOwnProperty('IsActiveBanner')) {
                        $('[name="updatePromo_MstPromo_IsActiveBanner"]').val(val.MstPromo.IsActiveBanner);
                        if (val.MstPromo.IsActiveBanner=="true") {
                            document.getElementById('checkbox_promoModalUpdate_IsActiveBanner').setAttribute('checked','');
                        } 
                    } else {
                        $('[name="updatePromo_MstPromo_IsActiveBanner"]').val("false");
                        document.getElementById('checkbox_promoModalUpdate_IsActiveBanner').removeAttribute('checked');
                    }
                    
                    $('[name="updatePromo_MstPromo_TampilPeriodePromo"]').val(val.MstPromo_TampilPeriodePromo);
                    $('[name="updatePromo_MstPromo_StartDate"]').val(val.MstPromo_StartDate);
                    $('[name="updatePromo_MstPromo_EndDate"]').val(val.MstPromo_EndDate);
                    document.getElementById('datepicker_promoModalUpdate_StartDate').setAttribute('value',val.MstPromo_StartDate);
                    document.getElementById('datepicker_promoModalUpdate_EndDate').setAttribute('value',val.MstPromo_EndDate);

                    // Jenis Promo Dropdown
                    if (val.MstPromo.JenisPromo==="2") {
                    //     if (val.MstPromo.TampilPeriodePromo=="true") {
                    //         document.getElementById('checkbox_promoModalUpdate_TampilPeriodePromo')
                    //             .setAttribute('checked','');
                    //         // document.getElementById('checkbox_promoModalUpdate_TampilPeriodePromo')
                    //         //     .setAttribute('Value','True');
                    //     }
                    } else {
                        $('#checkbox_promoModalUpdate_TampilPeriodePromo').hide()
                    }

                    // Promo Amount Input Addon
                    // $('#inputaddon_promoModalAdd_PromoAmountRp').hide()
                    // $('#inputaddon_promoModalAdd_PromoAmountPr').hide()
                    // $('#inputaddon_promoModalUpdate_PromoAmountRp').hide()
                    // $('#inputaddon_promoModalUpdate_PromoAmountPr').hide()
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log(jqXhr);
                    console.log( errorThrown );
                    console.log(textStatus);
                },
            });
            $('#modal_promo_update').modal();
        });
    })
</script>

@include('modal.add_promo')
@include('modal.update_promo')
@endsection