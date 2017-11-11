@extends('layouts.teacher')

@section('content')


<div class="events-section">
  <div class="copy-header"> Add or change how you share your plans</div>
  <div class="sharingoptions-section">
    <div class="sharingoptions-header">
      <div class="sharingoptions-left pull-left"> Sharing Options </div>
      <div class="sharingoptions-right pull-right">
        <button class="renew-button save-button">Save</button>
        <a href="classes.html" class="closebutton"><i class="fa fa-close" aria-hidden="true"></i></a></div>
    </div>
    <div class="sharingoptions-body">
      <form method="post" action="#" class="sharingoptions-form">
        <p>Enter a Teacher Key to allow other teachers to import your lessons into their planbooks.</p>
        <div class="form-group">
          <label>Teacher Key</label>
          <input type="text" name="teacherkey" class="sharing-inputs" size="30">
        </div>
        <p>Enter a Student Key to allow administrators, students, parents, etc. to view your plans online.</p>
        <div class="form-group">
          <label>Student Key</label>
          <input type="text" name="studentkey" class="sharing-inputs" size="30">
        </div>
        <p>Select information to include in Student View:</p>
        <div class="form-group">
          <label class="sharingoptionscheck-labels">
            <input  name="viewLessons" id="viewLessons" value="Y" type="checkbox">
            Lesson</label>
          <label class="sharingoptionscheck-labels">
            <input  name="viewHomework" id="viewHomework" value="Y" type="checkbox">
            Homework</label>
          <label class="sharingoptionscheck-labels">
            <input name="viewNotes" id="viewNotes" value="Y" type="checkbox">
            Notes</label>
          <label class="sharingoptionscheck-labels">
            <input name="viewStandards" id="viewStandards" value="Y" type="checkbox">
            Standards</label>
          <label class="sharingoptionscheck-labels">
            <input name="viewEvents" id="viewEvents" value="Y" type="checkbox">
            Events</label>
          <label class="sharingoptionscheck-labels">
            <input  id="viewMyList" value="Y" type="checkbox">
            My List</label>
          <label class="sharingoptionscheck-labels">
            <input id="viewAssessments" value="Y" type="checkbox">
            Assessments</label>
          <label class="sharingoptionscheck-labels">
            <input id="viewAssignments" value="Y" type="checkbox">
            Assignments</label>
          <label class="sharingoptionscheck-labels">
            <input id="viewGrades" value="Y" type="checkbox">
            Grades (via student accounts)</label>
        </div>
        <div class=" future-worksgroup">
          <label>Future weeks in Student View: </label>
          <select id="viewLength">
            <option value="0">Current Week Only</option>
            <option value="1">Current plus 1</option>
            <option value="2">Current plus 2</option>
            <option value="3">Current plus 3</option>
            <option value="4">Current plus 4</option>
            <option value="5">Current plus 5</option>
            <option value="100">All Weeks</option>
          </select>
        </div>
        <p class="link-plans"><b>Link to view plans:</b></p>
       <div class=" future-worksgroup">
          <label>Default View:  </label>
          <select id="viewLength">
            <option value="D">Day</option>
            <option value="W">Week</option>
            <option value="M">Month</option>
          </select>
        </div>
        <div class="form-group"> 
          <input class="studentLink sharingoption-buttons" name="mailLink" id="mailLink" value="Email Student Links" type="button">
          <input class="studentLink sharingoption-buttons" id="downloadLinks" value="Download Student Links" type="button">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')

@endpush