<div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header addperiodheder">
        <div class="normalLesson pull-left">
          <p>Student</p>
        </div>
        <div class="actionright pull-right">
          <button type="submit" class="actiondropbutton renew-button" id="edit_student_button">Save</button>
          <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> </div>
      </div>
      <div class="modal-body">
        <form method="post" id="studenteditform" action="#" class="addstudent-form">
         {{ csrf_field() }}
         <input type="hidden" id="editStudet_id" name="id" value="{{$students->id}}">
         <input id="user_role" name="user_role" type="hidden" value="3">
          <div class="form-group col-md-6">
            <label>Student ID</label>
            <input id="studentCode" type="text" name="studentID" class="addstudent-field" value="{{$students->studentID}}">
          </div>
          <div class="form-group col-md-6">
            <label>Email Address</label>
            <input name="email" id="emailaddress" type="email" value="{{$students->email}}" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>First Name</label>
            <input name="firstName" id="firstname" value="{{$students->name}}" type="text" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Parent Email</label>
            <input name="parentemail" id="parentemail" type="email" value="{{$students->parent_email}}"" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Middle Name</label>
            <input name="middlename" id="middlename" type="text" value="{{$students->middle_name}}" class="addstudent-field">
          </div>
          <div class="form-group col-md-6">
            <label>Phone Number</label>
            <input name="phonenumber" id="phonenumber" type="email" class="addstudent-field" value="{{$students->phone_number}}">
          </div>
          <div class="form-group col-md-6">
            <label>Last Name</label>
            <input name="lastname" id="lastname" type="text" class="addstudent-field" value="{{$students->last_name}}">
          </div>
          <div class="form-group col-md-6">
            <label>Birthdate</label>
            <input name="birthdate" class="addstudent-field" id="demo" type="text" value="{{$students->birthdate}}">
          </div>
          @php $grade_level = $students->grade_level @endphp
          <div class="form-group col-md-6">
            <label>Grade Level</label>
            <select name="gradeLevel" id="gradeLevel" class="addstudent-field">
              <option value=""></option>
              <option value="-1" {{ $grade_level == -1 ? "selected" : "" }} >Pre-K</option>
              <option value="0" {{ $grade_level == 0 ? "selected" : "" }} >Kindergarten</option>
              <option value="1" {{ $grade_level == 1 ? "selected" : "" }}>Grade 1</option>
              <option value="2" {{ $grade_level == 2 ? "selected" : "" }}>Grade 2</option>
              <option value="3" {{ $grade_level == 3 ? "selected" : "" }}>Grade 3</option>
              <option value="4" {{ $grade_level == 4 ? "selected" : "" }}>Grade 4</option>
              <option value="5" {{ $grade_level == 5 ? "selected" : "" }}>Grade 5</option>
              <option value="6" {{ $grade_level == 6 ? "selected" : "" }}>Grade 6</option>
              <option value="7" {{ $grade_level == 7 ? "selected" : "" }}>Grade 7</option>
              <option value="8" {{ $grade_level == 8 ? "selected" : "" }}>Grade 8</option>
              <option value="9" {{ $grade_level == 9 ? "selected" : "" }}>Grade 9</option>
              <option value="10" {{ $grade_level == 10 ? "selected" : "" }}>Grade 10</option>
              <option value="11" {{ $grade_level == 11 ? "selected" : "" }}>Grade 11</option>
              <option value="12" {{ $grade_level == 12 ? "selected" : "" }}>Grade 12</option>
              <option value="99" {{ $grade_level == 99 ? "selected" : "" }}>Inactive</option>
            </select>
          </div>  
          <div class="form-group col-md-6">
            <label>Student Key</label>
            <input name="password" class="addstudent-field"  type="text" value="">
            <button class="main-buton generate-button"> Generate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
