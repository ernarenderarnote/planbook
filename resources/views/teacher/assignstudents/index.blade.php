@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section">
  <div class="copy-header"> Select class, then drag and drop students to add or remove from class</div>
  <div class="list-contentbutton gradebutons">
    <div class="btn-group">
      <button type="button" id ="classBtn" data-id='' class="btn languagebuton list-contentmainbuton  dropdown-toggle classBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select Class<span class="caret"></span> </button>
      <ul class="dropdown-menu language-dropdown">
      @forelse($classes as $class)
        <li class="classSelected"><a href="#" class="language-dropbutons languagebuton" style="background-color:{{ $class->class_color }}; color: #fff;" data-id = "{{$class->id}}">{{$class->class_name}}</a></li>
      @empty
      @endforelse  
      </ul>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton list-contentmainbuton"  data-toggle="modal" data-target="#assignstudents"> Assign all students to class</button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#removestudents">Remove all students from class</button>
    </div>
  </div>
  <div class="student-added"><span class="tstudent student-addedbutton">T</span> Students added by Teacher<br>
    <span class="sstudent student-addedbutton">S</span> Students assigned by School </div>
  <div class="list-contentbutton gradebutons pull-right">
    <div class="btn-group studentlevel-button">
      <button type="button" id="filterGradeLevel" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-level> All Levels<span class="caret"></span> </button>
      <ul class="dropdown-menu language-dropdown">
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level=''>All levels </a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='-1'>Pre-K </a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='0'>Kindergarten </a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='1'>Grade 1</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='2'>Grade 2 </a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='3'>Grade 3</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='4'>Grade 4</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='5'>Grade 5</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='6'>Grade 6</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='7'>Grade 7 </a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='8'>Grade 8</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='9'>Grade 9</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='10'>Grade 10</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='11'>Grade 11</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='12'>Grade 12</a></li>
        <li class="gradeLevelPicker"><a href="#" class="language-dropbutons unitdropbuton" data-level='99'>Inactive</a></li>
      </ul>
    </div>
  </div>
  <div class="assign-studentlistssection">
    <div class="col-md-6">
      <div class="studentsin-class">
        <div class="studentsclass-header">Students in Class</div>
        <div class="studentsclass-body " id="studentsinClass"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="studentsin-class">
        <div class="studentsclass-header">Students not in Class</div>
        <div class="studentsclass-body fbox" id="notstudentsinClass"></div>
      </div>
    </div>
  </div>
</div>
<!--assign students popup start-->
<div id="assignstudents" class="modal fade movemodalcontent assignstudentscontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign all students to class</h4>
      </div>
      <div class="modal-body">
        <p>This will assign all of your students to your Language Arts class. Would you like to continue?</p>
        <div class="button-group">
          <a href="javascript:;" data-id='' class="renew-button" id="assignAll"> Continue</a>
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--remove students popup start-->
<div id="removestudents" class="modal fade movemodalcontent assignstudentscontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove all students from class</h4>
      </div>
      <div class="modal-body">
        <p>This will remove all of your students from your Language Arts class. Would you like to continue?</p>
        <div class="button-group">
          <button class="renew-button" id="removeAll"  data-dismiss="modal"> Continue</button>
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
  
@push('js')
  <script>
  /*http://jsfiddle.net/39khs/82/*/
      $("document").ready(function() {
        $('.classSelected:first-child a').trigger('click');
      });
     $('.classSelected a').on('click',function(){
        var classVar   = $(this).text();
        var classId    = $(this).data('id'); 
        var background = $(this).css('background-color');
        $('#assignAll').attr('data-id',classId);
        $('.classBtn').html(classVar +' <span class="caret"></span>');
        $('.classBtn').attr('data-id',classId);
        $('.classBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
         $.ajax({
            type:'get',
            url: BASE_URL +'/teacher/assignstudents/getStudents/'+classId,
            dataType: 'json',

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
              //console.log(response);
              $("#studentsinClass").html("");
              $("#notstudentsinClass").html("");
              var students = response.inclass;
              if(students.length > 0){
                for(var i in students){
                $('#studentsinClass').append('<span class="student-results draggable" data-id='+students[i]['id']+'><span class="tStudent">T</span>'+students[i]['name']+','+students[i]['last_name']+'</span>'); 
               
                }
              }
              
              var studentsN = response.notInClass;
              if(studentsN.length > 0){
                for(var i in studentsN){
                  $('#notstudentsinClass').append('<span class="student-results draggable" data-id='+studentsN[i]['id']+'><span class="tStudent">T</span>'+studentsN[i]['name']+','+studentsN[i]['last_name']+'</span>'); 
                 
                }
              }
              draganddrop();
            },
            error: function(data){
              console.log("data");
              //console.log(data);
            }

         });
      });

     $('#assignAll').on('click',function(e){
        var classID = $(this).attr('data-id');
        $.ajax({
            type:'post',
            url: BASE_URL +'/teacher/assignstudents/assignAllStudents/'+classID,
            dataType: 'json',
            data: {
              "_token": "{{ csrf_token() }}",
              },  

            beforeSend: function () {
              $('#assignstudents').modal('hide');
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
              // console.log(response);
             
              //$("#studentsinClass").html("");
              $("#notstudentsinClass").html("");
              var students = response.inclass;
              for(var i in students){
                $('#studentsinClass').append('<span class="student-results draggable" data-id='+students[i]['id']+'><span class="tStudent">T</span>'+students[i]['name']+','+students[i]['last_name']+'</span>'); 
               
              }
              draganddrop();
            },
            error: function(data){
              console.log(data);
            }

         });
        e.preventDefault();
      });
  </script> 
  <!--Drag and Drop assign classes-->
  <script>
  function draganddrop(){
    $(".draggable").draggable({ 
      cursor: "crosshair", 
      revert: "invalid"
    });
    $("#notstudentsinClass").droppable({ 
      accept: ".draggable", 
      drop: function(event, ui) {
        var dropped    = ui.draggable;
        var droppedOn  = $(this);
        var student_id = dropped.attr('data-id');
        var class_id   = $('#classBtn').attr('data-id');
        removeStudents(class_id,student_id);
        $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
      }, 
      over: function(event, elem) {
            $(this).addClass("over");
             //console.log("over");
      },
      out: function(event, elem) {
        $(this).removeClass("over");
      }
    });
    $("#notstudentsinClass").sortable();

    $("#studentsinClass").droppable({
      accept: ".draggable", 
      drop: function(event, ui) {
        //console.log("drop");             
        var dropped    = ui.draggable;
        var student_id = dropped.attr('data-id');
        var class_id   = $('#classBtn').attr('data-id');
        assignStudents(class_id,student_id);
        var droppedOn = $(this);
        $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
      }
    });
  }     

  /*function to assign single student drop drag*/ 
  function assignStudents(class_id,student_id) {
    $.ajax({
      type:'post',
      url: BASE_URL +'/teacher/assignstudents/assignSingle/',
      dataType: 'json',
      data: {
        "_token"     : "{{ csrf_token() }}",
        "class_id"   : class_id,
        "student_id" : student_id
        },  

      beforeSend: function () {
        $('#assignstudents').modal('hide');
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        console.log(response);  
      },
      error: function(data){
        console.log(data);
      }
    });
  } 

  function removeStudents(class_id,student_id) {
    $.ajax({
      type:'post',
      url: BASE_URL +'/teacher/assignstudents/removeSingle/',
      dataType: 'json',
      data: {
        "_token"     : "{{ csrf_token() }}",
        "class_id"   : class_id,
        "student_id" : student_id
        },  

      beforeSend: function () {
        $('#assignstudents').modal('hide');
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        console.log(response);
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  /*level Filter*/
    $('.gradeLevelPicker a').on('click',function(){
      var classVar   = $(this).text();
      var datalevel  = $(this).data('level'); 
      var background = $(this).css('background-color');
      var classId    = $('#classBtn').attr('data-id');
      $('#filterGradeLevel').html(classVar +' <span class="caret"></span>');
      $('#filterGradeLevel').attr('data-level',datalevel);
      $('#filterGradeLevel').css({'background-color':background,'border-color':background, 'color':'#fff'}); 
      $.ajax({
        type:'post',
        data:{
          "_token"     : "{{ csrf_token() }}",
          'gradelevel':datalevel

        },
        url: BASE_URL +'/teacher/assignstudents/filterStudents/'+classId,
        dataType: 'json',

        beforeSend: function () {
          $('#main-loader').show();
        },
        complete: function () {
          $('#main-loader').hide();
        },

        success: function (response) {
          $("#notstudentsinClass").html("");
          var studentsN = response.notInClass;
          if(studentsN.length > 0){
            for(var i in studentsN){
              $('#notstudentsinClass').append('<span class="student-results draggable" data-id='+studentsN[i]['id']+'><span class="tStudent">T</span>'+studentsN[i]['name']+','+studentsN[i]['last_name']+'</span>'); 
             
            }
          }
          draganddrop();
        },
        error: function(data){
          console.log("data");
        }

      });
    });  
    /*Remove all assigned Students*/

    $('#removeAll').on('click',function(e){
        var classID = $('#classBtn').attr('data-id');
        $.ajax({
            type:'post',
            url: BASE_URL +'/teacher/assignstudents/removeAllStudents/'+classID,
            dataType: 'json',
            data: {
              "_token": "{{ csrf_token() }}",
              },  

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
              console.log(response);
              if(response.success=='TRUE'){
                  $("#notstudentsinClass").html("");
                var students = response.notInClass;
                for(var i in students){
                  $('#notstudentsinClass').append('<span class="student-results draggable" data-id='+students[i]['id']+'><span class="tStudent">T</span>'+students[i]['name']+','+students[i]['last_name']+'</span>'); 
                }  
                $("#studentsinClass").html("");
                
              } 
              draganddrop();
            },
            error: function(data){
              console.log(data);
            }

         });
        e.preventDefault();
      });
  </script>
   

@endpush  