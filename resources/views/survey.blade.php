@extends('admin.admin') 

@section('survey', 'active')
@section('feedback', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Survey</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                <a href="{{asset('/survey/download')}}" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Star or User" class="InputSearch form-control">
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
                <th>User</th>
                <th>Star</th>
                <th>Comment</th>
                <th>Last Survey Date</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($Surveys as $Survey)

                    <tr>  
                        @if (property_exists($Survey->User, 'Name'))
                        <td><span>{{$Survey->User->Name}}</span></td>
                        @else
                        <td><span></span></td>
                        @endif

                        <td><span>{{$Survey->MstSurveyRating->Bintang}}</span></td>

                        @if (property_exists($Survey->MstSurveyRating, 'Komentar'))
                            @if( strlen($Survey->MstSurveyRating->Komentar)>= 70)
                                <td><span>{{substr($Survey->MstSurveyRating->Komentar,0,70)."..."}}</span></td>
                            @else 
                                <td><span>{{$Survey->MstSurveyRating->Komentar}}</span></td>
                            @endif
                        @else
                            <td></td>
                        @endif

                        <td><span>{{$Survey->MstSurveyRating->LastSurveyDate}}</span></td>
                        
                        <td>
                            <span>
                                <a href="#" data-id="{{ $Survey->MstSurveyRating->Id}}" class="view-survey btn btn-info btn-sm"><i class="fa fa-eye"></i></a> &nbsp; 
                                <a href="{{asset('survey/delete/'.$Survey->MstSurveyRating->Id)}}" class=" btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure want to delete this data?')" ><i class="fa fa-trash"></i>
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

        //VIEW
        $(document).on('click','.view-survey',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/survey/show')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);

                    $('[name="survey_User_view"]').val(val.User.Name);
                    $('[name="survey_Star_view"]').val(val.MstSurveyRating.Bintang);
                    $('[name="survey_Comment_view"]').val(val.MstSurveyRating.Komentar);
                    $('[name="survey_LastSurveyDate_view"]').val(val.MstSurveyRating.LastSurveyDate);
                    $('[name="survey_Pilihan_view"]').val(val.MstSurveyRating.Pilihan);
                    
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log(errorThrown);
                console.log(textStatus);
                },
            });
            $('#view-survey').modal();
        });
        
    })
</script>
@include('modal.view_survey')
@endsection