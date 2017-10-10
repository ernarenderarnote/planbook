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
      <button type="button" class="btn unitsbutton"  data-toggle="modal" data-target="#addstudent"><img src="../images/add2.png" class="event-icon"> Add Students </button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn unitsbutton"  data-toggle="modal" data-target="#importstudents"><img src="../images/import.png" class="event-icon"> Import Students </button>
    </div>
    <div class="btn-group">
      <a type="button" class="btn unitsbutton" href="#"><img src="../images/import.png" class="event-icon"> Assign Students </a>
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
                <div class="studentsclass-body"></div>
           </div>     
          </div>
        
   </div>
</div>

<!-- Addstudent Section Start Here -->
<div id="addstudent" class="modal fade movemodalcontent editmodalcontent  addteachercontent in" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header addperiodheder">
        <div class="normalLesson pull-left">
          <p>Student</p>
        </div>
        <div class="actionright pull-right">
          <button type="submit" class="actiondropbutton renew-button" id="save_student_button">Save</button>
          <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> </div>
      </div>
      <div class="modal-body">
        <form method="post" id="studentaddform" action="#" class="addstudent-form">
         {{ csrf_field() }}
         <input id="user_role" name="user_role" type="hidden" value="3">
          <div class="form-group col-md-6">
            <label>Student ID</label>
            <input id="studentCode" type="text" name="sudentID" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Email Address</label>
            <input name="email" id="emailaddress" type="email" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>First Name</label>
            <input name="firstName" id="firstname" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Parent Email</label>
            <input name="parentemail" id="parentemail" type="email" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Middle Name</label>
            <input name="middlename" id="middlename" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Phone Number</label>
            <input name="phonenumber" id="phonenumber" type="email" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Last Name</label>
            <input name="lastname" id="lastname" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Birthdate</label>
            <input name="birthdate" class="addstudent-field" id="demo" type="text">
          </div>
          <div class="form-group col-md-6">
            <label>Grade Level</label>
            <select name="gradeLevel" id="gradeLevel" class="addstudent-field">
              <option value=""></option>
              <option value="-1">Pre-K</option>
              <option value="0">Kindergarten</option>
              <option value="1">Grade 1</option>
              <option value="2">Grade 2</option>
              <option value="3">Grade 3</option>
              <option value="4">Grade 4</option>
              <option value="5">Grade 5</option>
              <option value="6">Grade 6</option>
              <option value="7">Grade 7</option>
              <option value="8">Grade 8</option>
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
              <option value="11">Grade 11</option>
              <option value="12">Grade 12</option>
              <option value="99">Inactive</option>
            </select>
          </div>  
          <div class="form-group col-md-6">
            <label>Student Key</label>
            <input name="password" class="addstudent-field"  type="text">
            <button class="main-buton generate-button"> Generate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
        <form method="post" action="#" class="importstudent-form">
             <div class="form-group">
             <label for="importStudentsFile">Filename</label>
             <input type="file"  name="importStudentsFile" size="45" >
             </div>
     
        <div class="button-group">
          <button class="renew-button"  data-dismiss="modal"> Import File</button>
         
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
           </form>
      </div>
    </div>
  </div>
</div>

@endsection
  <script type="text/javascript" src="../js/jquery.min.js"></script> 
<script type="text/javascript" src="../js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="../js/custom.js" ></script> 
<script type="text/javascript" src="../tinymce_4.6.3_dev/tinymce/js/tinymce/tinymce.js"></script> 
<script src="../js/dcalendar.picker.js"></script> 
<script src="../js/jquery.timepicker.js"></script> 
<script>
$('#demo').dcalendarpicker();
$('#calendar-demo').dcalendar(); //creates the calendar
</script>
@push('js')
<script>
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
          html += '<strong>You Have created Event successfully !</strong>';
          html += '</div>';

          $('#eventaddform').before(html);
          $('#eventaddform')[0].reset();
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
  </script> 
@endpush  