<div class="popup-content">
    <div class="popup-header">
      <div class="row">
        <div class="col-sm-6 header-title">Class</div>
        <div class="col-sm-6 header-action-btn text-right">
          <button type="button" id="save_class_data_button" class="btn btn-primary"><span class="">Save</span></button>
          <button class="btn btn-primary" data-dismiss="modal"><span class="">Cancel</span></button>
          <a href="#" class="d-popoup-close btn px-3 text-white"><i class="fa fa-2x fa-times" aria-hidden="true"></i><span class="sr-only">Close</span></a> </div>
      </div>
    </div>
    <div class="popup-body">
      <form id="class_add_form" method="post" class="form-horizontal class-form">

        {{ csrf_field() }}

        <div class="row">
          <label class="control-label col-sm-2 text-right">Class Name</label>
          <div class="form-group col-sm-5 ">
            <input type="text" id="class_name" name="class_name" value="" class="form-control"/>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-2 text-right">Start Day</label>
          <div class="form-group col-sm-8 ">
            <input type="text" id="start_date" name="start_date" value="" class="form-control datepicker"/>
            <div class="checkbox">
              <label>
                <input type="checkbox">
                Use first day of school</label>
            </div>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-2 text-right">End Day</label>
          <div class="form-group col-sm-8 ">
            <input type="text" id="end_date" name="end_date" value="" class="form-control datepicker"/>
            <div class="checkbox">
              <label>
                <input type="checkbox">
                Use last day of school</label>
            </div>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-2 text-right">Class color</label>
          <div class="form-group col-sm-5 ">
            <input type="color" id="class_color" name="class_color" class="form-control"/>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-2 text-right">Collaborate</label>
          <div class="form-group col-sm-8 ">
            <div class="radio ">
              <input type="radio" name="class collaboration" value="" >
              <strong>None</strong> - Do not allow collaboration for this class<br>
              <input type="radio" name="class collaboration" value="">
              <strong>View/Import</strong> - Allow teachers to view/import, but NOT edit, my lessons<br>
              <input type="radio" name="class collaboration" value="">
              <strong>View/Edit</strong> - Allow teachers to view AND edit my lessons<br>
              <input type="radio" name="class collaboration" value="">
              <strong>Replica</strong> - This class will show lessons from another class<br>
            </div>
          </div>
        </div>
        <div class="p-2"></div>
        <div class="text-center"> <a id="copyMonday" href="" class="text-bold">Copy</a> <span id="firstDayName">Day 1</span> times to all days </div>
        <div class="p-2"></div>
        <div class="row py-3">
          <div class="col-sm-offset-5 col-sm-3">Start Time</div>
          <div class="col-sm-3 ">End Time</div>
        </div>


        <div class="row pb-3">
          <label class="control-label col-sm-2 text-right">Class Days</label>
          <div class="form-group col-sm-9 ">

            @if(count($user_selected_school_year) > 0)


              @if($user_selected_school_year->class_schedule == "one")

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[0][day_name]" value="1">
                      Sunday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[0][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[0][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" checked>
                      Monday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" checked >
                      Tuesday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" checked >
                      Wednesday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" checked >
                      Thursday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

               <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" checked >
                      Friday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>

              <div class="row pb-3">
                <div class="col-sm-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="class_schedule[][day_name]" value="" >
                      Saturday
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][start_time]" value="" class="form-control timepicker"/>
                </div>
                <div class="col-sm-4">
                  <input type="text" name="class_schedule[][end_time]" value="" class="form-control timepicker"/>
                </div>
              </div>



              @elseif($user_selected_school_year->class_schedule == "two")


              @elseif(  )

                <div class="row pb-3">
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox">
                        Day 1</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <input type="date" class="form-control"/>
                  </div>
                  <div class="col-sm-4">
                    <input type="date" class="form-control"/>
                  </div>
                </div>

              @endif

            @else
              <tr>
                  <td colspan="5">No Record Found ! </td>
              </tr>

            @endif

          </div>
        </div>
      </form>
    </div>
</div>

<script type="text/javascript">
  
  $('.datepicker').datepicker({format: 'dd/mm/yyyy',});
  $('.timepicker').timepicker({'timeFormat': 'h:i A'});

</script>