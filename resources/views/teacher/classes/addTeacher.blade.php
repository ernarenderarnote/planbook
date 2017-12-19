<div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Collaborate Teacher
         </h4>
      </div>
      <div class="modal-body">
         <form method="post" action="#" class="addteacher-form">
            {{csrf_field()}}
            <div class="form-group col-md-12">
               <label>Teacher Email
               </label>
               <input type="email" name="email" class="addteacherfield">
            </div>
            <div class="form-group col-md-12">
               <label>Teacher Key
               </label>
               <input type="text" name="teacher_key" class="addteacherfield">
            </div>
            <div class="button-group">
               <input type="submit" class="main-buton save-teacherdata" value="Save">
               <button class="close-button save-teacherdata" data-dismiss="modal"> Close
               </button>
            </div>
         </form>
      </div>
   </div>
</div>