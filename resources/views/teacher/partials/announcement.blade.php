<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Student Announcements</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="#" > 
            {{csrf_field()}}
      	   <div class="form-group">
      		   <textarea placeholder="Write Somehting" name="detailed_txt" class="main editorMce">
               @if($announcement!='' )
                  {{ $announcement->detailed_txt }}
               @endif   
               </textarea>
      		</div>
		      <div class="button-group">
               @if($announcement!='')
                  <a href="javascript:;" class="renew-button announcement-edit">Edit</a>
                  <a href="javascript:;" class="renew-button announcement-delete" delete_id = "{{ $announcement->id }}">Delete</a>
               @else
                  <a href="javascript:;" class="renew-button announcement-save">Save</a>
               @endif
               
               <button class="close-button" type="button" data-dismiss="modal">Close</button>
            </div>
	      </form>
      </div>
   </div>
</div>
<script>
tinymce.init({
  selector: '.editorMce',
  height: 400,
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
