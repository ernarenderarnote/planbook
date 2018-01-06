
@extends('layouts.teacher-signup')

@section('content')

<div class="signup-modals"> 
  <!--popup-1-->
  <div class="" id="signupFirst" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Account Information</h4>
        </div>
        <div class="modal-body">
          @include('common.errors')
          <div class="sp-heading pb-4">To get started, enter your account information below. You can change this information at any time on your <strong>account</strong> page</div>
          <div class="modal-form">
            <form action="" method="POST" id="signup-step1-form" class="form-horizontal">
            	{{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm-2" for="">First Name </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name',auth()->user()->first_name)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Last Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name',auth()->user()->last_name)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Display Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="display_name" placeholder="e.g. Mrs. Abc" name="display_name" value="{{old('display_name',auth()->user()->display_name)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">School District</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="school_district" placeholder="" name="school_district" value="{{old('school_district',auth()->user()->school_district)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">School Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="school_name" name="school_name" value="{{old('school_name',auth()->user()->school_name)}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Promotional Code</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="promotional_code" name="promotional_code" value="{{old('promotional_code',auth()->user()->promotional_code)}}">
                </div>
              </div>
              <div class="form-group  py-4">
                <div class=" col-sm-7">
                  <button type="submit" class="btn button"  >Continue</button>
                  <a href="{{route('logout')}}"><button type="button" class="btn greybutton" >Exit</button></a>
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