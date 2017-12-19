@extends('layouts.teacher')

@section('content')

<div id="main-loader" class="pageLoader" style="display:none">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
</div>
<div class="events-section">
@if(isset($sharingoption) && $sharingoption!='')
  <form method="post" action="#" class="editsharingoptions-form">
  {{csrf_field()}}
    <input type="hidden" name="optionID" value="{{$sharingoption->id}}" id="optionID">
    <div class="copy-header"> Add or change how you share your plans</div>
    <div class="sharingoptions-section">
      <div class="sharingoptions-header">
        <div class="sharingoptions-left pull-left"> Sharing Options </div>
        <div class="sharingoptions-right pull-right">
          <input type="submit" class="renew-button save-button" value="Save">
          <a href="classes.html" class="closebutton"><i class="fa fa-close" aria-hidden="true"></i></a></div>
      </div>
      <div class="sharingoptions-body">
        
          <p>Enter a Teacher Key to allow other teachers to import your lessons into their planbooks.</p>
          <div class="form-group">
            <label>Teacher Key</label>
            <input type="text" name="teacherkey" value="{{$sharingoption->teacher_key}}" class="sharing-inputs" size="30">
          </div>
          <p>Enter a Student Key to allow administrators, students, parents, etc. to view your plans online.</p>
          <div class="form-group">
            <label>Student Key</label>
            <input type="text" name="studentkey" value="{{$sharingoption->student_key}}" class="sharing-inputs" size="30">
          </div>
          <p>Select information to include in Student View:</p>
          <div class="form-group">
           @php $data = json_decode($sharingoption->information);
            @endphp
            @foreach($data as $keys=>$val)
            @foreach($val as $key=>$value)
            
            <label class="sharingoptionscheck-labels">
            <input  name="information[{{$keys}}][{{$key}}]"  type="hidden" id="viewLessons"   value="N" type="checkbox"> 
              <input  name="information[{{$keys}}][{{$key}}]" id="viewLessons" value="Y" type="checkbox" @php echo $value == 'Y' ? 'checked' : ''  @endphp >    
            @php $label  = preg_replace('/[^a-zA-Z0-9-_\.]/','', $key); 
                 echo ucfirst($label) ;
            @endphp
            </label>
            @endforeach
           @endforeach
          </div>
          <div class=" future-worksgroup">
            <label>Future weeks in Student View: </label>
            <select id="viewLength" name="future_weeks">
              <option value="0"  @php echo $sharingoption->future_weeks == 0 ? 'selected' : ''  @endphp>Current Week Only</option>
              <option value="1"  @php echo $sharingoption->future_weeks == 1 ? 'selected' : ''  @endphp>Current plus 1</option>
              <option value="2"  @php echo $sharingoption->future_weeks == 2 ? 'selected' : ''  @endphp>Current plus 2</option>
              <option value="3"  @php echo $sharingoption->future_weeks == 3 ? 'selected' : ''  @endphp>Current plus 3</option>
              <option value="4"  @php echo $sharingoption->future_weeks == 4 ? 'selected' : ''  @endphp>Current plus 4</option>
              <option value="5"  @php echo $sharingoption->future_weeks == 5 ? 'selected' : ''  @endphp>Current plus 5</option>
              <option value="100"@php echo $sharingoption->future_weeks == 100 ? 'selected' : ''  @endphp>All Weeks</option>
            </select>
          </div>
          <p class="link-plans"><b>Link to view plans:</b></p>
         <div class=" future-worksgroup">
            <label>Default View:</label>
            <select id="viewLength" name="default_view">
              <option value="D" @php echo $sharingoption->default_view == 'D' ? 'selected' : ''  @endphp>Day</option>
              <option value="W" @php echo $sharingoption->default_view == 'W' ? 'selected' : ''  @endphp>Week</option>
              <option value="M" @php echo $sharingoption->default_view == 'M' ? 'selected' : ''  @endphp>Month</option>
            </select>
          </div>
          <div class="form-group"> 
            <input class="studentLink sharingoption-buttons" name="mailLink" id="mailLink" value="Email Student Links" type="button">
            <input class="studentLink sharingoption-buttons" id="downloadLinks" value="Download Student Links" type="button">
          </div>
       
      </div>
    </div>
  </form>
@else
<form method="post" action="#" class="sharingoptions-form">
{{csrf_field()}}
  <div class="copy-header"> Add or change how you share your plans</div>
  <div class="sharingoptions-section">
    <div class="sharingoptions-header">
      <div class="sharingoptions-left pull-left"> Sharing Options </div>
      <div class="sharingoptions-right pull-right">
        <input type="submit" class="renew-button save-button" value="Save">
        <a href="classes.html" class="closebutton"><i class="fa fa-close" aria-hidden="true"></i></a></div>
    </div>
    <div class="sharingoptions-body">
      
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
            <input  name="information[0]['lessons']" id="viewLessons" value="N" type="hidden">
            <input  name="information[0]['lessons']" id="viewLessons" value="Y" type="checkbox">
            Lesson</label>
          <label class="sharingoptionscheck-labels">
            <input  name="information[1]['homework']" id="viewHomework" value="N" type="hidden">
            <input  name="information[1]['homework']" id="viewHomework" value="Y" type="checkbox">
            Homework</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[2]['notes']" id="viewNotes" value="N" type="hidden">
            <input name="information[2]['notes']" id="viewNotes" value="Y" type="checkbox">
            Notes</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[3]['standards']" id="viewStandards" value="N" type="hidden">
            <input name="information[3]['standards']" id="viewStandards" value="Y" type="checkbox">
            Standards</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[4]['events']" id="viewEvents" value="N" type="hidden">
            <input name="information[4]['events']" id="viewEvents" value="Y" type="checkbox">
            Events</label>
          <label class="sharingoptionscheck-labels">
            <input  name="information[5]['my_list']" id="viewMyList" value="N" type="hidden">
            <input  name="information[5]['my_list']" id="viewMyList" value="Y" type="checkbox">
            My List</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[6]['assessments']" id="viewAssessments" value="N" type="hidden">
            <input name="information[6]['assessments']" id="viewAssessments" value="Y" type="checkbox">
            Assessments</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[7]['assignments']" id="viewAssignments" value="N" type="hidden">
            <input name="information[7]['assignments']" id="viewAssignments" value="Y" type="checkbox">
            Assignments</label>
          <label class="sharingoptionscheck-labels">
            <input name="information[8]['grades']" id="6" value="N" type="hidden">
            <input name="information[8]['grades']" id="6" value="Y" type="checkbox">
            Grades (via student accounts)</label>
        </div>
        <div class=" future-worksgroup">
          <label>Future weeks in Student View: </label>
          <select id="viewLength" name="future_weeks">
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
          <label>Default View:</label>
          <select id="viewLength" name="default_view">
            <option value="D">Day</option>
            <option value="W">Week</option>
            <option value="M">Month</option>
          </select>
        </div>
        <div class="form-group"> 
          <input class="studentLink sharingoption-buttons" name="mailLink" id="mailLink" value="Email Student Links" type="button">
          <input class="studentLink sharingoption-buttons" id="downloadLinks" value="Download Student Links" type="button">
        </div>
     
    </div>
  </div>
  </form>
  @endif
</div>
@endsection

@push('js')
<script>
  $('.sharingoptions-form').on('submit',function(e){
    var formData = $(this).serialize();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/sharingoption/postOptions',
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
        if(response['error']){
              html += '<div id="warning-box" class="alert alert-danger fade in">';
              html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
              html += '<strong>Error!</strong>';

              for (var i = 0; i < response['error'].length; i++) {
                  html += '<p>' + response['error'][i] + '</p>';
              }

              html += '</div>';
              $('.sharingoptions-header').after(html);
              
          }

          if(response['success']){
                 
            console.log(response['success']);

            html += '<div id="success-box" class="alert alert-success fade in">';
            html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
            html += '<strong>Data Added</strong>';
            html += '</div>';

            $('.sharingoptions-header').before(html);
            window.location.reload();
          }


      },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
    e.preventDefault();
  }); 
  
   $('.editsharingoptions-form').on('submit',function(e){
    var formData = $(this).serialize();
    var edit_id  = $('#optionID').val();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/sharingoption/posteditOptions/'+edit_id,
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
       if(response['error']){
            html += '<div id="warning-box" class="alert alert-danger fade in">';
            html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
            html += '<strong>Error!</strong>';

            for (var i = 0; i < response['error'].length; i++) {
                html += '<p>' + response['error'][i] + '</p>';
            }

            html += '</div>';
            $('.sharingoptions-header').after(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>Data Updated</strong>';
          html += '</div>';

          $('.sharingoptions-header').before(html);
          window.location.reload();
        }
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