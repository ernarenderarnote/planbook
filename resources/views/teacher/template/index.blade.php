@extends('layouts.teacher')

@section('content')


<div class="events-section">
     <div class="copy-header"> Templates</div>
     <div class="list-contentbutton gradebutons">
        <div class="btn-group">
           <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All Classes<span class="caret"></span> </button>
           <ul class="dropdown-menu language-dropdown asignment-list">
            <li class="classSelected">
              <a href="#" class="language-dropbutons unitdropbuton" target_id="0">
                All Classes
              </a>
            </li>
            @forelse($classes as $className)
              <li class="classSelected">
                <a href="#" class="language-dropbutons unitdropbuton" style="background-color:{{ $className['class_color'] }}; color: #fff;" target_id = "{{$className['id']}}">
                  {{ $className['class_name'] }}
                </a>
              </li> 
              @empty
            @endforelse
          </ul>
        </div>
        <div class="btn-group">
           <div class="btn-group">
         <button type="button" id="addButton" class="btn unitsbutton"><img src="/images/add2.png" class="event-icon" > Add Template </button>
      </div>
        </div>
     </div>
     <div class="lessonsearch-contenttable assessement-table">
        <table class="templatesadd-table">
           <thead>
              <tr class="tHeader">
                 <th style="background-color:transparent; border:0;"></th>
                 <th class="tempaltes-classfield">Class</th>
                 <th>Day</th>
                 <th>Type</th>
                 <th>Start</th>
                 <th>End</th>
              </tr>
           </thead>
           <tbody>
            @forelse($templates as $template)
              <tr class="edit_template" data-assessment-id="{{ $template->id }}">
                 <td style="background-color:{{ $template->userClass->class_color }}"></td>
                 <td class="tempaltes-classfield">{{$template->userClass->class_name}}</td>
                 <td>{{ $template->day }}</td>
                 <td>{{ $template->type }}</td>
                 <td>{{ $template->starts_on }}</td>
                 <td>{{ $template->ends_on }}</td>
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
<div class="d-render-popoup t-data-popup modal fade editmodalcontent in" id="dynamicRenderDiv" role="dialog">
  

</div>
  
@endsection

@push('js')
  
  <script>
    $(document).ready(function(){
    $("#addButton").click(function(){


    $("#dynamicRenderDiv").show().load("/teacher/template/add",function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  //popup-custom  hide
  
  $("body").on('click','.d-popoup-close',function(){

    $(".d-render-popoup").fadeOut();

  });

/* Add assignment data*/

  $("body").on('click','#save_template_button',function(e){
  tinyMCE.triggerSave();
  e.preventDefault();

    var formData = $("#template_add_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/template/add',
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
            $('.errorMessage').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have Added Template successfully !</strong>';
          html += '</div>';

          $('.errorMessage').before(html);
          $('#template_add_form')[0].reset();
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



  /* Edit Unit */

  $(".edit_template").click(function(){

    var assessment_id = $(this).data("assessment-id");
    
    $("#dynamicRenderDiv").show().load("/teacher/template/edit/"+assessment_id,function(){

    });

  });

  /*Score Weighting*/

  /* Save edit assessment data*/

  $("body").on('click','#edit_template_button',function(e){
  tinyMCE.triggerSave();
  e.preventDefault();
    var assessment_id = $("#assessment_id").val();

    var formData = $("#template_edit_form").serialize();

    
    var obj = $(this);
    $.ajax({
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
      type:'POST',
      url: BASE_URL +'/teacher/template/edit/'+assessment_id,
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
            $('.errorMessage').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have updated Template successfully !</strong>';
          html += '</div>';

          $('.errorMessage').before(html);
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

/*Change the text of selected  button*/
$('.classSelected a').on('click',function(){  
  var class_id   = $(this).attr('target_id');
  var classVar   = $(this).text();
  var background = $(this).css('background-color');
  $('.classBtn').html(classVar +' <span class="caret"></span>');
  $('.classBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
   $('.classBtn').attr('target_id',class_id);
}); 
  </script> 
@endpush