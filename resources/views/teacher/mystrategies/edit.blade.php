  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <form method="post" action="#" class="editlessonform addassessmentform">
        {{ csrf_field() }}
        <input type="hidden" id="mystratergy_id" name="mystratergy_id" value="{{ $data->id }}"/>
          <div class="modal-header">
             <div class="normalLesson pull-left">
                <p> Instructional Strategy  </p>
             </div>
             <div class="actionright pull-right">
                <button id="post_edit_data_button" class="actiondropbutton renew-button">Save</button>
                <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
             </div>
          </div>
          <div class="modal-body">
             <div class="row">
                <div class="col-md-8 form-group strategy-formgroup">
                   <label>Strategy ID</label>
                   <input type="text" class="strategytable-field" name="stratergy_id" value="{{$data->strategies_id}}">
                </div>
             </div>
             <div class="row">
                <div class="col-md-8 form-group strategy-formgroup">
                   <label>Title</label>
                   <input type="text" class="strategytable-field" name="title" value="{{ $data->title }}">
                </div>
             </div>
             <div class="Description-memorial">
                <p>Description</p>
                <textarea placeholder="Write Somehting" name="description">{{$data->description}}</textarea>
             </div>
          </div>
       </form>
    </div>
 </div>
      
  <script>
     tinymce.init({
       selector: 'textarea',
       height: 200,
       theme: 'modern',
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
