
@extends('layouts.teacher-signup')

@section('content')
<div class="signup-modals"> 
<!--popup-4 class infomation-->
  <div class="" id="classInfo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Class Information</h4>
        </div>
        <div class="modal-body">
          <div class="sp-heading pb-4">Enter the subjects to teach. You can add and change subject any time on your <strong>classes</strong> page<!--If you are an elementry school teacher,  you can <a href="#"> click </a> to add a typical set of elementry subjects.--></div>
          <div class="clearfix"></div>
          <div class="modal-form">
            <form action="" method="post" class="form-horizontal">
              {{ csrf_field() }}
              <div class="class-info">
                <div class="clearfix py-4"><a href="#" class="btn btn-primary br-0"> Add another classes</a></div>
                <table class="table table-bordered table-condensed table-hover">
                  <thead>
                    <tr>
                      <th class="bg-theme">Class Name</th>
                      <th class="bg-theme text-center">Color</th>
                      <th class="bg-theme text-center" >Mon</th>
                      <th class="bg-theme text-center">Tue</th>
                      <th class="bg-theme text-center">Wed</th>
                      <th class="bg-theme text-center">Thu</th>
                      <th class="bg-theme text-center">Fri</th>
                      <th class="bg-theme text-center cls-delete"></th>
                    </tr>
                  </thead>
                  <tbody>

                  @if(count($userClasses) > 0)

                  @foreach($userClasses as $key => $userClass)
                    <tr>
                      <td><input type="text" name="classes[{{$key}}][class_name]" id="class_name" value="{{$userClass->class_name}}" class="form-control" placeholder=" e.g. Mathematics"/></td>
                      <td><input type="color" name="classes[{{$key}}][class_color]" id="class_color" value="{{$userClass->color}}" class="form-control p-0" /></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">mon</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">tue</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">wed</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">thu</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">fri</span></label>
                        </div></td>
                      <td class="text-center"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>

                  @endforeach
                  @else
                    <tr>
                      <td><input type="text" name="classes[0][class_name]" id="class_name" value="" class="form-control" placeholder=" e.g. Mathematics"/></td>
                      <td><input type="color" name="classes[0][class_color]" id="class_color" value="" class="form-control p-0" /></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">mon</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">tue</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">wed</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">thu</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">fri</span></label>
                        </div></td>
                      <td class="text-center"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    <tr>
                      <td><input type="text" name="classes[1][class_name]" class="form-control" placeholder=" e.g. Mathematics"/></td>
                      <td><input type="color" name="classes[1][class_color]" id="class_color" value="" class="form-control p-0" /></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">mon</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">tue</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">wed</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">thu</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">fri</span></label>
                        </div></td>
                      <td class="text-center"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    <tr>
                      <td><input type="text" name="classes[2][class_name]" class="form-control" placeholder=" e.g. Mathematics"/></td>
                      <td><input type="color" name="classes[2][class_color]" id="class_color" value="" class="form-control p-0" /></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">mon</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">tue</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">wed</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">thu</span></label>
                        </div></td>
                      <td class="text-center"><div class="checkbox">
                          <label>
                            <input type="checkbox">
                            <span class="sr-only">fri</span></label>
                        </div></td>
                      <td class="text-center"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>

                    @endif
                  </tbody>
                </table>
              </div>
            
            <div class="clearfix row">
	            <div class=" col-sm-12">
	              <button type="submit" class="btn button"  >Continue</button>
	             <a href="{{route('teacher.step3')}}" > <button type="button" class="btn greybutton" >Exit</button></a>
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