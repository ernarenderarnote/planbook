
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" action="#" id="mylist_edit_form" class="editlessonform addassessmentform">
         {{ csrf_field() }}
         <input type="hidden" id="mylist_id" name="mylist_id" value="{{ $mylists->id }}"/>
            <div class="modal-header">
               <div class="normalLesson pull-left">
                  <p>My List</p>
               </div>
               <div class="actionright pull-right">
                  <button id="edit_mylist_data_button" class="actiondropbutton renew-button">Save</button>
                  <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
               </div>
            </div>
            
            <div class="modal-body">
                           <div class="row">
                  <div class="col-md-8 form-group strategy-formgroup">
                     <label>My List ID</label>
                     <input type="text" class="strategytable-field" value="{{ $mylists->list_id}}" name="listId" >
                  </div>
               </div>
               
               <div class="Description-memorial">
                  <p>Description</p>
                  <textarea name="description" placeholder="Write Somehting">{{$mylists->description}}</textarea>
               </div>
               
            </div>
         </form>
      </div>
   </div>
     <script>
      tinymce.init({
        selector: 'textarea',
        height: 400,
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
   