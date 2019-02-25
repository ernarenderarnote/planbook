  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="modal-header">
          <div class="normalLesson pull-left">
             <p> Template</p>
          </div>
          <div class="actionright pull-right">
             <button id="save_template_button" class="actiondropbutton renew-button">Save</button>
             <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
          </div>
       </div>
       <div class="modal-body">
          <form method="post" id ="template_add_form" action="#" class="addtemplateform">
            {{csrf_field()}}
             <div class="row">
                <div class="col-md-4 form-group">
                   <label>Class</label>
                   <select id="class" name="class">
                      <option value="">Select Class</option>
                      @forelse($userClasses as $userClass)
                       <option value="{{$userClass->id}}" > 
                        {{$userClass->class_name}}
                      </option>
           
                    @empty
                     
                    @endforelse
                   </select>
                </div>
                <div class="col-md-4 form-group">
                   <label>Start On</label>
                   <input class="form-control input-fields datepicker" id="starts_on" name="starts_on" value="{{ old('starts_on') }}" type="text">
                </div>
                <div class="col-md-4 form-group checkbox-field">
                   <label>
                   <input type="checkbox" value="1" name="use_start">
                   Use class start</label>
                </div>
             </div>
             <div class="row">
                <div class="col-md-4 form-group">
                   <label>Day</label>
                   <select name="day">
                      <option value="Everyday">Everyday</option>
                      <option value="Sunday">Sunday</option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                   </select>
                </div>
                <div class="col-md-4 form-group">
                   <label>End On</label>
                   <input class="form-control input-fields datepicker" id="ends_on" name="ends_on" value="{{ old('ends_on') }}" type="text">
                </div>
                <div class="col-md-4 form-group checkbox-field">
                   <label>
                   <input type="checkbox" value="1" name="use_end">
                   Use class end</label>
                </div>
             </div>
             <div class="row">
                <div class="form-group col-md-12 titlefield">
                   <label>Type</label>
                   <select name="type">
                      <option id="templateLessonOption" value="Lesson">Lesson</option>
                      <option id="templateHomeworkOption" value="Homework">Homework</option>
                      <option id="templateNotesOption" value="Notes">Notes</option>
                      <option id="templateMyStandardOption" value="My List" style="display: none;">My List</option>
                      <option id="templateSchoolStandardOption" value="School List" style="display: none;">School List</option>
                      <option id="templateStandardOption" value="Standards">Standards</option>
                   </select>
                </div>
             </div>
             <div class="Description-memorial ">
                <p>Template</p>
                <textarea class="editorMce" name="description" placeholder="Write Somehting">    </textarea>
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
  /*editor script*/
   tinymce.init({
     selector: '.editorMce',
     height: 200,
     theme: 'modern',
setup: function (editor) {                  
editor.on('focus', function(e) {
editor.selection.select(editor.getBody(), true);
editor.selection.collapse(false);
});                                             
},
     plugins: [
       'advlist autolink lists link image charmap print preview hr anchor pagebreak',
       'searchreplace wordcount visualblocks visualchars code fullscreen',
       'insertdatetime media nonbreaking save table contextmenu directionality',
       'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
     ],
     toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
     toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
     image_advtab: true,
     templates: [
       { title: 'Test template 1', content: 'Test 1' },
       { title: 'Test template 2', content: 'Test 2' }
     ],
     content_css: [
       
      
     ]
    });
</script> 