<div class="modal-dialog">
            <!-- Modal content-->
    <div class="modal-content">
       <form method="post" action="#" id="assessment_edit_form" class="editlessonform addassessmentform class-form">
        {{ csrf_field() }}
        <input type="hidden" id="assessment_id" name="unit_id" value="{{ $assessment->id }}"/>
          <div class="modal-header">
             <div class="normalLesson pull-left">
                <p> Assessment </p>
             </div>
             <div class="actionright pull-right">
                <button type="button" id="save_edit_assessment_data_button" class="actiondropbutton renew-button">Save</button>
                <a class="closebutton" data-dismiss="modal"><i class="fa fa-close d-popoup-close" aria-hidden="true"></i></a> 
             </div>
          </div>
          <div class="modal-body">
             <div class="row">
                <div class="col-md-4 form-group">
                   <label>Class</label>
                   <select id="class" name="class" class="form-control">
                      <option value="" >Select Class</option>
                      @forelse($userClasses as $userClass)
                      <option value="{{$userClass->id}}" 
                      @if($userClass->id == $assessment->class_id)  selected="selected"; @endif >{{$userClass->class_name}}</option>
           
                    @empty
                     
                    @endforelse
                   </select>
                </div>
                <div class="col-md-4 form-group">
                   <label>Start On</label>
                    @php
                      $var = $assessment->starts_on;
                      $date1 = str_replace('-', '/', $var);
                      $starts_on =  date('d/m/Y', strtotime($date1));

                      $var = $assessment->ends_on;
                      $date = str_replace('-', '/', $var);
                      $ends_on =  date('d/m/Y', strtotime($date));
                    @endphp
                   <input class="form-control input-fields datepicker" id="starts_on" name="starts_on" value="{{ old('starts_on',$starts_on) }}" type="text">
                </div>
             </div>
             <div class="row">
                <div class="col-md-4 form-group">
                   <label>Unit</label>
                   <select id="unit" name="unit"  class=" input-fields" >
                    <option value="" >Select unit</option>
                    @forelse($units as $unit)

                    <option value="{{$unit->id}}" @if($unit->id == $assessment->unit_id)  selected="selected"; @endif  >{{$unit->unit_id."-".$unit->unit_title}}</option>
                   
                    @empty
                     
                    @endforelse
                  </select>
                </div>
                <div class="col-md-4 form-group">
                   <label>End On</label>
                   <input class="form-control input-fields datepicker" id="ends_on" name="ends_on" value="{{ old('ends_on',$ends_on) }}" type="text">
                </div>
             </div>
             <div class="row">
                <div class="col-md-4 form-group">
                   <label>Type</label>
                   <select id="assessmentType" class=" input-fields" >
                      <option value="0">Select Type</option>
                   </select>
                </div>
                <div class="col-md-4 form-group">
                   <label>Total Points</label>
                   <input id="total_points" name="total_points" class=" input-fields" value="{{ $assessment->total_points }}" type="text">
                </div>
             </div>
             <div class="row">
                <div class="form-group col-md-12 titlefield">
                   <label> Title</label>
                   <input type="text" id="title" name="title" value="{{ $assessment->title }}" class="memorialtitlefied">
                </div>
             </div>
             <div class="Description-memorial ">
                <p>Description</p>
                <textarea class="editorMce" name="description" placeholder="Write Somehting">{{ $assessment->description }}</textarea>
             </div>
             <div class="added-daysection">
                <p>Standards <a href="#" class="main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
             </div>
             <div class="attachment-field">
                <div class="form-group">
                   <label>Attachments</label>
                   <a class="main-buton attachment-button fileattachmentmain"> <img src="/images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="/images/google-drive.png"></a> 
                </div>
             </div>
          </div>
       </form>
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