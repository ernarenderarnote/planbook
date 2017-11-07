@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <!-- Event Section Start Here -->
<div class="events-section">
  <div class="copy-header"> Students</div>
  <div class="list-contentbutton gradebutons">
    <div class="btn-group">
      <button type="button" class="btn unitsbutton"  id="addstudent"><img src="/images/add2.png" class="event-icon"> Add Students </button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton"  data-toggle="modal" data-target="#importstudents"><img src="/images/import.png" class="event-icon"> Import Students </button>
    </div>
    <div class="btn-group">
      <a type="button" class="btn unitsbutton" href=" {{route('teacher.assignstudents.index')}}"><img src="/images/import.png" class="event-icon"> Assign Students </a>
    </div>
  </div>
  <div class="student-added"><span class="tstudent student-addedbutton">T</span> Students added by Teacher<br>
    <span class="sstudent student-addedbutton">S</span> Students assigned by School </div>
  <div class="list-contentbutton gradebutons pull-right">
    <div class="btn-group studentlevel-button">
      <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> All Levels<span class="caret"></span> </button>
      <ul class="dropdown-menu language-dropdown">
        <li><a href="#" class="language-dropbutons unitdropbuton">All levels </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Pre-K </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Kindergarten </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 1</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 2 </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 3</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 4</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 5</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 6</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 7 </a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 8</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 9</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 10</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 11</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Grade 12</a></li>
        <li><a href="#" class="language-dropbutons unitdropbuton">Inactive</a></li>
      </ul>
    </div>
  </div>
  <div class="assign-studentlistssection">
          <div class="col-md-12">
          <div class="studentsin-class">
                <div class="studentsclass-header">Students in Class</div>
                <div class="studentsclass-body">
                @forelse($students as $student)
                <span class="student-results" data-id="{{ $student->id}}" >
                <span class="tStudent">T</span>
                {{ $student->name }} , {{$student->last_name}}  
                </span>
                @empty
                @endforelse 
                <!--span class="student-results">
                <span class="tStudent sStudent">S</span>
                narender,arnote 
                </span--> 

                </div>
           </div>     
          </div>
        
   </div>
</div>
 <!-- Add class Popup Starts Here -->
      <div class="d-render-popoup t-data-popup modal fade editmodalcontent in" id="dynamicRenderDiv" role="dialog">
        

      </div>

      <!-- Add class popup end here ! -->

<!--Import Students popup start-->
<div id="importstudents" class="modal fade movemodalcontent importstudentcontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Import Students</h4>
      </div>
      <div class="modal-body">
        <p>To ensure a valid import, please make sure that your CSV file is formatted correctly.</p>
        <p>To view a sample CSV file, <a href="../help/students.csv" download="students">click here</a></p>
        <form method="post" action="#" class="importstudent-form" id="csvImportForm" enctype="multipart/form-data">
         {{ csrf_field() }}
            <div class="form-group">
            <label for="importStudentsFile">Filename</label>
            <input type="file" name="import_file" size="45" >
            </div>
       
            <div class="button-group">
              <input class="renew-button importFile" type="submit" vlaue="Import File">
             
              <button class="close-button" data-dismiss="modal"> Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
  
@push('js')
<script>

  $('#addstudent').on('click',function(){
    $("#dynamicRenderDiv").show().load("/teacher/addstudents/add",function(){

    });
  })
/*Add Student*/
  $("body").on('click','#save_student_button',function(e){
      e.preventDefault();

    var formData = $("#studentaddform").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/addstudents/add',
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        var html = '';
        console.log(response);
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
            $('#eventaddform').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have Added Student successfully !</strong>';
          html += '</div>';

          $('#studentaddform').before(html);
          $('#studentaddform')[0].reset();
          setTimeout(function(){ 
            $(".d-render-popoup").fadeOut();
             window.location.reload();
           }, 5000);


         
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });

  }); 

  /*Edit student*/

  $('.student-results').on('click',function(e){
    var studentID = $(this).attr('data-id');
    $("#dynamicRenderDiv").show().load("/teacher/addstudents/edit/"+studentID,function(){

    });
  });

  /*Add Student*/
  $("body").on('click','#edit_student_button',function(e){
      e.preventDefault();
    var id = $("#editStudet_id").val();
    var formData = $("#studenteditform").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/addstudents/edit/'+id,
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        var html = '';
        console.log(response);
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
            $('#eventaddform').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have Edit Student successfully !</strong>';
          html += '</div>';

          $('#studenteditform').before(html);
          $('#studenteditform')[0].reset();
          setTimeout(function(){ 
            $(".d-render-popoup").fadeOut();
             window.location.reload();
           }, 5000);


         
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });

  }); 
   $(document).on('click','.closebutton',function(){
    $('#dynamicRenderDiv').hide();
  });

  /*Import events*/        
  
    $(document).on('click','.importFile',function(e){
        var formData = $('#csvImportForm').serialize()

        var obj = $(this);
        $.ajax({
          type:'POST',
          url: BASE_URL +'/teacher/addstudents/importExcel',
          data: formData,
         

          beforeSend: function () {
            $('#main-loader').show();
          },
          complete: function () {
            $('#main-loader').hide();
          },

          success: function (response) {
              console.log(response);
            },


          error: function(data){
            console.log("error");
            console.log(data);
          }

        });
        e.preventDefault();
    }); 
  </script> 
@endpush  