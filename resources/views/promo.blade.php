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
                    <a href="#" class="add-promo btn btn-block btn-primary">Create</a>  
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Name or Description" class="InputSearch form-control">
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="ButtonResetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
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
                        <select class="form-control select2 OrderNameDropdownElement" style="width:100%;" data-id2="{{$Promo->Id}}" >
                            @for($OrderNameDropdownVal=0; $OrderNameDropdownVal<=5; $OrderNameDropdownVal++)
                                @if (property_exists($Promo, 'OrderName'))
                                    @if ($OrderNameDropdownVal==$Promo->OrderName)
                                        <option value="{{$OrderNameDropdownVal}}" selected>{{$OrderNameDropdownVal}}</option>
                                    @else
                                        @if ($OrderNameDropdownVal==0)
                                            <option value="{{$OrderNameDropdownVal}}">-</option>
                                        @else
                                            <option value="{{$OrderNameDropdownVal}}">{{$OrderNameDropdownVal}}</option>
                                        @endif 
                                    @endif
                                @else
                                    @if ($OrderNameDropdownVal==0)
                                        <option value="{{$OrderNameDropdownVal}}" selected>-</option>
                                    @else
                                        <option value="{{$OrderNameDropdownVal}}">{{$OrderNameDropdownVal}}</option>
                                    @endif                                   
                                @endif
                            @endfor
                        </select>
                    </td>

                    <td>
                        <span>
                            <a href="#" data-id="{{ $Promo->Id }}" class="update-promo 
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
        $('#example1').DataTable({
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
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ButtonResetSearch').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })
        
        // OrderName Dropdown
        $(document).on('change','.OrderNameDropdownElement', function(){
            // $('.OrderNameDropdownElement').change(function(){
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
        $('#checkbox_TampilPeriodePromo_Add').hide()
        // $('#checkbox_TampilPeriodePromo_Update').hide()

        // Promo Amount Input Addon
        $('#currencymask_PromoAmountRp_Add').hide()
        $('#currencymask_PromoAmountPr_Add').hide()
        $('#inputaddon_PromoAmountRp_Add').hide()
        $('#inputaddon_PromoAmountPr_Add').hide()
        // $('#currencymask_PromoAmountRp_Update').hide()
        // $('#currencymask_PromoAmountPr_Update').hide()
        // $('#inputaddon_PromoAmountRp_Update').hide()
        // $('#inputaddon_PromoAmountPr_Update').hide()

        // Add
        $(document).on('click','.add-promo',function(){
            $('#add-promo').modal();
        });

        // Update
        $(document).on('click','.update-promo',function(){
            var id = $(this).attr('data-id');
            // console.log(id);
            $.ajax({
                url:"{{asset('/promo/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}'},
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    // console.log(val);

                    $('[name="promo_MstPicture_Id"]').val(val.MstPicture.Id);
                    $('[name="promo_MstPicture_DataId"]').val(val.MstPicture.DataId);
                    $('[name="promo_MstPicture_Picture"]').val(val.MstPicture.Picture);
                    $('[name="promo_MstPicture_FileName"]').val(val.MstPicture.FileName);
                    $('[name="promo_MstPicture_FileType"]').val(val.MstPicture.FileType);
                    $('[name="promo_MstPicture_Type"]').val(val.MstPicture.Type);

                    $('[name="promo_MstPromo_Id"]').val(val.MstPromo.Id);
                    $('[name="promo_MstPromo_Name"]').val(val.MstPromo.Name);
                    $('[name="promo_MstPromo_PromoCode"]').val(val.MstPromo.PromoCode);
                    $('[name="promo_MstPromo_Description"]').val(val.MstPromo.Description);
                    $('[name="promo_MstPromo_IsActivePromo"]').val(val.MstPromo.IsActivePromo);
                    $('[name="promo_MstPromo_AddedDate"]').val(val.MstPromo.AddedDate);
                    $('[name="promo_MstPromo_UserAdded"]').val(val.MstPromo.UserAdded);
                    $('[name="promo_MstPromo_UpdatedDate"]').val(val.MstPromo.UpdatedDate);
                    $('[name="promo_MstPromo_UserUpdated"]').val(val.MstPromo.UserUpdated);
                    $('[name="promo_MstPromo_StartDate"]').val(val.MstPromo.StartDate);
                    $('[name="promo_MstPromo_EndDate"]').val(val.MstPromo.EndDate);
                    $('[name="promo_MstPromo_SyaratDanKetentuan"]').val(val.MstPromo.SyaratDanKetentuan);
                    $('[name="promo_MstPromo_PromoType"]').val(val.MstPromo.PromoType);
                    $('[name="promo_MstPromo_PromoAmount"]').val(val.MstPromo.PromoAmount);
                    $('[name="promo_MstPromo_ProductOwner"]').val(val.MstPromo.ProductOwner);
                    $('[name="promo_MstPromo_OrderName"]').val(val.MstPromo.OrderName);
                    $('[name="promo_MstPromo_JenisPromo"]').val(val.MstPromo.JenisPromo);
                    $('[name="promo_MstPromo_TampilPeriodePromo"]').val(val.MstPromo.TampilPeriodePromo);
                    $('[name="promo_MstPromo_URL"]').val(val.MstPromo.URL);
                    $('[name="promo_MstPromo_IsActiveBanner"]').val(val.MstPromo.IsActiveBanner);

                    // document.getElementById('view-status-data').setAttribute('data-id2',val.MstStatusPengajuan.Id);

                    // if (val.MstStatusPengajuan.hasOwnProperty('Brand')) {
                    //     $('[name="status_pengajuan_Brand_data"]').val(val.MstStatusPengajuan.Brand);   
                    // }else{
                    //     $('[name="status_pengajuan_Brand_data"]').val("");        
                    // }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log(jqXhr);
                    console.log( errorThrown );
                    console.log(textStatus);
                },
            });
            $('#update-promo').modal();
        });
    })
</script>

@include('modal.add_promo')
@include('modal.update_promo')
@endsection