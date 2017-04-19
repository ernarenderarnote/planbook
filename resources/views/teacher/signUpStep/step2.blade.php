
@extends('layouts.teacher-signup')

@section('content')

@include('common.errors')

<div class="signup-modals"> 
<!--popup-2-->
  <div class="" id="signupSecond" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Select Year Information</h4>
        </div>
        <div class="modal-body">
          <div class="sp-heading pb-4">Enter your school information below. You can change this information at any time on your <strong>school year</strong> page</div>
          <div class="modal-form">
            <form action="" method="POST" id="signup-step2-form" class="form-horizontal">
             {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Year Name </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="year_name" name="year_name" value="{{old('year_name',$userSchoolYear->year_name)}}"  placeholder="e.g. 2016-2017">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">First Day</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control" name="first_day" value="{{old('first_day',$userSchoolYear->first_day)}}" id="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Last Day</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control"  name="last_day" value="{{old('first_day',$userSchoolYear->first_day)}}" id="">
                </div>
              </div>
              <div class="form-group class-schedule">
                <label class="control-label col-sm-2" for="">Class Schedule</label>
                <div class="col-sm-5">
                  <label>
                    <input type="radio" name="class_schedule" id="oneWeek" value="one" @if(old('class_schedule',$userSchoolYear->class_schedule) == "one") checked @endif >
                    One Week<br>
                    <input type="radio" name="class_schedule" id="twoWeeks" value="two" @if(old('class_schedule',$userSchoolYear->class_schedule) == "two") checked @endif >
                    Two Weeks<br>
                    <input type="radio" name="class_schedule" id="dayCycle" value="cycle" @if(old('class_schedule',$userSchoolYear->class_schedule) == "cycle") checked @endif >
                    Cycle of
                    <input type="text" id="cycleDays" name="cycle_days" value="{{old('cycle_days',$userSchoolYear->class_schedule == 'cycle' ? $userSchoolYear->cycle_days:'2')}}">
                    days 
                  </label>
                </div>
              </div>
              <div class="form-group  py-4">
                <div class=" col-sm-7">
                  <button type="submit" class="btn button"   >Continue</button>
                  <a href="{{route('teacher.step')}}" ><button type="button" class="btn greybutton">Cancel</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection