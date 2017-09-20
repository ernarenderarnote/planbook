<div class="popup-content">
    <div class="popup-header">
      <div class="row">
        <div class="col-sm-6 header-title">Class</div>
        <div class="col-sm-6 header-action-btn text-right">
          <button type="button" id="save_class_data_button" class="btn btn-primary"><span class="">Save</span></button>
         <!--  <button class="btn btn-primary" data-dismiss="modal"><span class="">Cancel</span></button> -->
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

        @php
            $var = $user_selected_school_year->first_day;
            $date1 = str_replace('-', '/', $var);
            $start_date =  date('d/m/Y', strtotime($date1));

            $var = $user_selected_school_year->last_day;
            $date = str_replace('-', '/', $var);
            $end_date =  date('d/m/Y', strtotime($date));
          @endphp

        <div class="row">
          <label class="control-label col-sm-2 text-right">Start Day</label>
          <div class="form-group col-sm-8 ">
            <input type="text" id="start_date" name="start_date" value="{{ old('start_date',$start_date) }}" class="form-control datepicker"/>
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
            <input type="text" id="end_date" name="end_date" value="{{ old('end_date',$end_date) }}" class="form-control datepicker"/>
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
            <input type="color" id="class_color" name="class_color" value="#008000" class="form-control"/>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-sm-2 text-right">Collaborate</label>
          <div class="form-group col-sm-8 ">
            <div class="radio ">
              <input type="radio" name="collaborate" id="nocollab" value="1" checked >
              <strong>None</strong> - Do not allow collaboration for this class<br>
              <input type="radio" name="collaborate" id="viewonly" value="2">
              <strong>View/Import</strong> - Allow teachers to view/import, but NOT edit, my lessons<br>
              <input type="radio" name="collaborate" id="viewedit" value="3">
              <strong>View/Edit</strong> - Allow teachers to view AND edit my lessons<br>
              <input type="radio" name="collaborate" id="seelessons" value="4">
              <strong>Replica</strong> - This class will show lessons from another class<br>
            </div>
          </div>
        </div>
        <div class="p-2"></div>
        <!-- <div class="text-center"> <a id="copyMonday" href="" class="text-bold">Copy</a> <span id="firstDayName">Day 1</span> times to all days </div> -->
        <div class="p-2"></div>
        <div class="row py-3">
          <div class="col-sm-offset-5 col-sm-3">Start Time</div>
          <div class="col-sm-3 ">End Time</div>
        </div>


        <div class="row pb-3">
          <label class="control-label col-sm-2 text-right">Class Days</label>
          <div class="form-group col-sm-9 ">

            @if(count($user_selected_school_year) > 0)

            @php

              $classesSchedules = json_decode($user_selected_school_year->class_schedule);


            @endphp
              @foreach ($classesSchedules as $key => $classesSchedule)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                <div class="row pb-3">
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label>
                        <input type="hidden" name="class_schedule[{{$key}}][text]" value="{{ $classesSchedule->text }}"/>
                        <input type="hidden" name="class_schedule[{{$key}}][name]" value="{{ $classesSchedule->name }}"/>
                        <input type="hidden" name="class_schedule[{{$key}}][day_no]" value="{{ $classesSchedule->day_no }}"/>
                        <input type="hidden" name="class_schedule[{{$key}}][is_class]" value="0"/>
                        <input type="checkbox" name="class_schedule[{{$key}}][is_class]" value="1" @if($classesSchedule->is_class == 1) checked @endif/>
                          {{ $classesSchedule->text }}
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="class_schedule[{{$key}}][start_time]" value="{{ $classesSchedule->start_time }}" class="form-control timepicker"/>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="class_schedule[{{$key}}][end_time]" value="{{ $classesSchedule->end_time }}" class="form-control timepicker"/>
                  </div>
                </div>

               
              @endforeach
           
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
  
  $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
  $('.timepicker').timepicker({
    'timeFormat': 'h:i A',
    'scrollDefault' : '8:00am',
    'forceRoundTime' : false,
  });

</script>

