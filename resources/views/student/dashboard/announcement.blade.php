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
               <button class="close-button" type="button" data-dismiss="modal">Close</button>
            </div>
	      </form>
      </div>
   </div>
</div>