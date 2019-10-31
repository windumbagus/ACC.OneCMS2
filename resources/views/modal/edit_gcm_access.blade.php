@extends('admin.admin') 

@section('master-management', 'active')
@section('master-gcm', 'active')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Edit GCM Access"</h4> 
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Condition</th>
                    <th>AccWorld</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($GcmAccesss); --}}
                @foreach ($GcmAccesss as $GcmAccess)
                    <tr>  
                        <td><span>{{$GcmAccess->Condition}}</span></td>                        
                        
                        <td><span>
                            @if (property_exists($GcmAccess, 'AccWorld'))
                                @if($GcmAccess->AccWorld == true)
                                    <input class="OnChangeAccWorld" data-id="{{ $GcmAccess->Id}}" data-Condition="{{ $GcmAccess->Condition}}" data-AccWorld="{{ $GcmAccess->AccWorld}}" type="checkbox" name="AccWorld" checked="checked">
                                @else
                                    <input class="OnChangeAccWorld" data-id="{{ $GcmAccess->Id}}" data-Condition="{{ $GcmAccess->Condition}}" data-AccWorld="{{ $GcmAccess->AccWorld}}" type="checkbox" name="AccWorld" >
                                @endif
                            @else
                                <input class="OnChangeAccWorld" data-id="{{ $GcmAccess->Id}}" data-Condition="{{ $GcmAccess->Condition}}" data-AccWorld="{{ false }}" type="checkbox" name="AccWorld" >
                            @endif
                        </span></td>  
                    </tr>                  
                @endforeach     
            </tbody>
        </table>  

        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="col-sm-4">
                    <a  class="btn btn-block btn-primary" href="{{asset('/master-gcm')}}">Back</a>
                </div>
                <div class="col-sm-8"></div>
            </div>
            <div class="col-sm-8"></div>
        </div>    
    </div>
</div>

<Script>
    $(document).ready(function () {
        $('#example1').DataTable({
            'deferRender': true,
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
        })
    })

    $('.OnChangeAccWorld').change(function(){
        var Id = $(this).attr('data-id');
        var Condition = $(this).attr('data-Condition');
        var AccWorld = $(this).attr('data-AccWorld');
        
        $.ajax({
            url: '/master-gcm/edit-gcm-access/OnChangeAccWorld/'+Id+'&'+Condition+'&'+AccWorld,
            dataType: 'json',
            success: function(val){
                console.log(val);
            }
        })
    })
</Script>
@endsection
