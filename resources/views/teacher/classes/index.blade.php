
@extends('layouts.teacher')

@section('content')

<div class="clearfix"></div>
<div class=" class-page">
  <div class="container-fluid">
    <div class="col-sm-12">
      <div class="teacher-dash-action pt-5">
        <button type="button" class="btn btn-primary bg-white border-2 border-theme add-comments popup-custom-show" id="addClassButton" ><img src="/images/add2.png">&nbsp;&nbsp;<span class="">Add Class</span></button>
        <a href="/teacher/import/index" class="btn btn-primary bg-white border-2 return-toplan" id="addImportButton"><span class="">Copy/Import Lessons</span></a>
      </div>
    </div>
    <div class="table-responsive col-sm-12 pt-5">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center bg-theme color-column"></th>
            <th class="text-left bg-theme class-column">Class Name</th>
            <th class="text-center bg-theme start-date">Start Date</th>
            <th class="text-center bg-theme end-date">End Date</th>

            @if(count($user_selected_school_year) > 0)

              @if($user_selected_school_year->class_schedule_type == "one_week")
                <th class="text-center bg-theme class-numbering">S</th>
                <th class="text-center bg-theme class-numbering">M</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">W</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">F</th>
                <th class="text-center bg-theme class-numbering">S</th>

              @elseif($user_selected_school_year->class_schedule_type == "two_week")

                <th class="text-center bg-theme class-numbering">S</th>
                <th class="text-center bg-theme class-numbering">M</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">W</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">F</th>
                <th class="text-center bg-theme class-numbering">S</th>

                <th class="text-center bg-theme class-numbering">S</th>
                <th class="text-center bg-theme class-numbering">M</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">W</th>
                <th class="text-center bg-theme class-numbering">T</th>
                <th class="text-center bg-theme class-numbering">F</th>
                <th class="text-center bg-theme class-numbering">S</th>

              @elseif($user_selected_school_year->class_schedule_type == "cycle")

                @for ($i = 0; $i < $user_selected_school_year->cycle_days; $i++)
                  <th class="text-center bg-theme class-numbering" >{{ $i+1 }}</th>
                @endfor

              @endif
              
            @else
              <tr>
                  <td colspan="5">No Record Found ! </td>
              </tr>

            @endif
          </tr>
        </thead>
        <tbody>

          @forelse($user_classes as $user_class)

            <tr class="edit_class" data-class-id="{{ $user_class->id }}" >
              <td class="text-center color-column"><a class="class-colors" style="background-color:{{$user_class->class_color}};"></a></td>
              <td class="text-left class-column"><a href="#">{{ $user_class->class_name }}</a></td>
              <td class="text-center class-column"><a href="#">{{ $user_class->start_date }}</a></td>
              <td class="text-center class-column"><a href="#">{{ $user_class->end_date }}</a></td>


              @php

                $classesSchedules = json_decode($user_class->class_schedule);



              @endphp

              @forelse($classesSchedules as $class_schedule)

                <td class="text-center class-column class-numbering"><a href="#"><i class="fa @if($class_schedule->is_class == 1) fa-check @endif" aria-hidden="true"></i></a></td>

              @empty
                <tr>
                  <td colspan="8">No Record Found ! </td>
                </tr>
              @endforelse
              
              
            </tr>

          @empty
            <tr>
              <td colspan="8">No Record Found ! </td>
            </tr>
          @endforelse

        </tbody>
      </table>
    </div>

   


  </div>
</div>


<!-- Add class Popup Starts Here -->
<div class="d-render-popoup t-data-popup" id="dynamicRenderDiv" style="display:none;">
  


</div>

<!-- Add class popup end here ! -->


@endsection

@push('js')
<script type="text/javascript">

// A $( document ).ready() block.
$(document).ready(function() {

  /* send AJAX REQUEST TO ADD NEW CLASS DATA*/

  function formToJson(formArray) {
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
      returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
  }


  $("#addClassButton").click(function(){


    $("#dynamicRenderDiv").show().load("/teacher/classes/add",function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  }); 
	
  //popup-custom  hide
  
  $("body").on('click','.d-popoup-close',function(){

    $(".d-render-popoup").fadeOut();

  });

/* Add class dtatt*/

  $("body").on('click','#save_class_data_button',function(){


    var formData = $("#class_add_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/classes/add',
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        //obj.html('Sending... <i class="fa fa-send"></i>');
      },
      complete: function () {
        //obj.html('Sent <i class="fa fa-send"></i>');
      },

      success: function (response) {
        var html = '';

        $('#warning-box').remove();
        $('#success-box').remove();

        if(response['error']){
            html += '<div id="warning-box" class="alert alert-danger fade in">';
            html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
            html += '<strong>Error!</strong>';

            for (var i = 0; i < response['error'].length; i++) {
                html += '<p>' + response['error'][i] + '</p>';
            }

            html += '</div>';
            $('#class_add_form').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have created Class successfully !</strong>';
          html += '</div>';

          $('#class_add_form').before(html);
          $('#class_add_form')[0].reset();
          $(".d-render-popoup").fadeOut();


          window.location.reload();
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
      



  }); 



  /* Edit class */

  $(".edit_class").click(function(){

    var class_id = $(this).data("class-id");

    $("#dynamicRenderDiv").show().load("/teacher/classes/edit/"+class_id,function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  /* Save edit classs datra*/

  $("body").on('click','#save_edit_class_data_button',function(){

    var class_id = $("#class_id").val();

    var formData = $("#class_edit_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/classes/edit/'+class_id,
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        //obj.html('Sending... <i class="fa fa-send"></i>');
      },
      complete: function () {
        //obj.html('Sent <i class="fa fa-send"></i>');
      },

      success: function (response) {
        var html = '';

        $('#warning-box').remove();
        $('#success-box').remove();

        if(response['error']){
            html += '<div id="warning-box" class="alert alert-danger fade in">';
            html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
            html += '<strong>Error!</strong>';

            for (var i = 0; i < response['error'].length; i++) {
                html += '<p>' + response['error'][i] + '</p>';
            }

            html += '</div>';
            $('#class_add_form').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have updated class successfully !</strong>';
          html += '</div>';

          $('#class_add_form').before(html);
          //$('#class_add_form')[0].reset();
          $(".d-render-popoup").fadeOut();


          window.location.reload();
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
      



  }); 





});


</script>
@endpush