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
            <input id="studentCode" type="text" name="studentID" class="addstudent-field">
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
            <input name="phonenumber" id="phonenumber" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Last Name</label>
            <input name="lastname" id="lastname" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Birthdate</label>
            <input name="birthdate" class="addstudent-field datepicker" id="demo" type="text">
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
            <input name="password" class="addstudent-field password-field" type="text">
            <input type="button" class="main-buton generate-button" value="Generate">
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
  
  $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
  $('.timepicker').timepicker({
    'timeFormat': 'h:i A',
    'scrollDefault' : '8:00am',
    'forceRoundTime' : false,
  });
 </script> 