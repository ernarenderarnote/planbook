<!-- Addperiod Section Start Here -->
   
      <div class="modal-dialog">
         <!-- Modal content-->
         <form method="post" action="#" class="addteacher-form editperiodform">
         <div class="modal-content">
            <div class="modal-header addperiodheder">
               <div class="normalLesson pull-left">
                  <p> Grading Period</p>
               </div>
               <div class="actionright pull-right">
                  <button class="actiondropbutton delete-periods renew-button">Delete</button>
                  <input type="submit" class="actiondropbutton saveEdit renew-button" value="Save">
                  <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
               </div>
            </div>

            <div class="modal-body">
              
                  {{csrf_field()}}
                  <input type="hidden" name="period_id" value="{{$periods->id}}">
                  <input type="hidden" name="class_id" value="{{$periods->class_id}}" id="periodClassID">
                  <div class="form-group col-md-12">
                     <label>Period Name</label>
                     <input type="text" value="{{$periods->title}}" name="periodname" class="addteacherfield">
                  </div>
                  <div class="form-group col-md-12">
                     <label>Start Date</label>
                        @php
                         $var = $periods->starts_on;
                         $date1 = str_replace('-', '/', $var);
                         $starts_on =  date('d/m/Y', strtotime($date1));

                         $var = $periods->ends_on;
                         $date = str_replace('-', '/', $var);
                         $ends_on =  date('d/m/Y', strtotime($date));
                       @endphp
                     <input class="addteacherfield datepicker" value="{{$starts_on}}" name="start_date" type="text">
                  </div>
                  <div class="form-group col-md-12">
                     <label>End Date</label>
                     <input class="addteacherfield datepicker" value="{{$ends_on}}" name="end_date" type="text">
                  </div>
              
            </div>
         </div>
          </form>
      </div>
      <script>
      $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
      </script>