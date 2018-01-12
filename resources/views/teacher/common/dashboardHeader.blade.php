<style>
    .contact_cls .modal-backdrop.in {
    display: none;
}
</style>

@php 
  $check_data  = array();
  $check_class = array();
  $viewItems   = request()->user()->viewItems()->first(); 
  if($viewItems!=''){
    $data   = json_decode($viewItems->view_items);
    $class  = json_decode($viewItems->view_class);

    foreach($data as $value){
      $check_data[] =  $value;
    }
    foreach($class as $class_val){
      $check_class[] =  $class_val;
    }
  }  
@endphp
<div class="signup-pheader">
  <div class="container-fluid">
    <div class="text-center head-center">
      <div class="pull-left text-left col-sm-2">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ date('Y', strtotime('-1 year')) }}-{{ date("Y") }}<span class="caret"></span></button>
          <ul class="dropdown-menu selectedClassYear">

            <li><a href="#">{{ date('Y', strtotime('-1 year')) }}-{{ date("Y") }}</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-8">
      <a href="{{route('teacher.dashboard.index')}}"><img class="img-responsive mx-auto" src="/images/logonew.png" alt=""></a>
      </div>
      <div class="user-drop li-inline pull-right text-right col-sm-2">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            @if(auth()->user()->display_name)

              {{auth()->user()->display_name}}

            @else
                {{auth()->user()->email}}
            @endif
          <span class="caret"></span></button>
          <ul class="dropdown-menu pull-right">
            <li><a data-toggle="modal" data-target="#add-accountinfo"><span class="add-ico"><img src="/images/icon-account.png" width="36" height="35" alt="account"></span> <span class="add-text">Account</span></a></li>
            <li><a href="#"><span class="add-ico overview-open"><img src="/images/icon-overview.png" alt="overview"></span> <span class="add-text">Overview</span></a></li>
            <li><a href="#"><span class="add-ico"><img src="/images/icon-tutorials.png" alt="tutorial"></span> <span class="add-text">Tutorials</span></a></li>
            <li><a href="#"><span class="add-ico"><img src="/images/icon-knowledge.png" alt="knowledge"></span> <span class="add-text">Knowledge Base</span></a></li>
            <li><a data-toggle="modal" data-target="#Contact-usmodal" id="contact_us_icon"><span class="add-ico"><img src="/images/icon-mail.png" alt="contact"></span> <span class="add-text">Contact Us</span></a></li>
            <li><a href="#"><span class="add-ico"><img src="/images/icon-feedback.png" alt="feedback"></span> <span class="add-text">Chat Us</span></a></li>
            <li><a href="#"><span class="add-ico"><img src="/images/icon-idea.png" alt="idea"></span> <span class="add-text">Feedback</span></a></li>
            <li><a href="#"><span class="add-ico"><img src="/images/icon-refresh.png" alt="refresh"></span> <span class="add-text">Refresh</span></a></li>
            <li><a href="/logout"><span class="add-ico"><img src="/images/icon-signout.png" alt="sign out"></span> <span class="add-text">Sign out</span></a></li>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-6">
        <div class="h-l-menu header-t-menu text-left li-inline">
          <ul class="p-0 m-0">
            <li><a href="#" class="color-theme notesdropdownmain-relative"><img src="/images/icon-notes.png" alt="notes"></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2 todayBtn">Today</a></li>
            <li><a href="#" class="color-theme"><i class="fa fa-2x fa-calendar" aria-hidden="true"></i><span class="sr-only">calendar</span></a></li>
            <li>
              <a href="#" class="btn btn-primary px-3 py-2 get-calendar" id="pPrev"><i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sr-only"></span></a>
              <a href="#" class="btn btn-primary px-3 py-2 get-calendar" id="pNext"><i class="fa fa-chevron-right" aria-hidden="true"></i><span class="sr-only">goto right</span></a> 
            </li>
            <li><a href="#" class="color-theme "><i class="fa fa-2x fa-file-text-o" aria-hidden="true"></i><span class="sr-only">calendar</span></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2">Copy</a></li>
            <li class="dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle add-menus" type="button" data-toggle="dropdown">Add <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="{{route('teacher.assessments.index')}}"><span class="add-ico"><img src="/images/assessment-add.png" alt="add-assessment"></span> <span class="add-text">Add<br>
                  Assessment</span></a></li>
                <li><a href="{{route('teacher.assignments.index')}}"><span class="add-ico"><img src="/images/assignment-add.png" alt="add assignment"></span> <span class="add-text">Add<br>
                  Assignment</span></a></li>
                <li><a href="{{route('teacher.classes.index')}}"><span class="add-ico"><img src="/images/class-add.png"  alt="add class"></span> <span class="add-text">Add<br>
                  Class</span></a></li>
                <li><a href="{{route('teacher.events.index')}}"><span class="add-ico"><img src="/images/event-add.png" alt="add event"></span> <span class="add-text">Add<br>
                  Event</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="/images/extra-lesson-add.png" alt="add extra lesson"></span> <span class="add-text">Add<br>
                  Extra Lesson</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="/images/noschool.png" alt="add assignment"></span> <span class="add-text">Add No<br>
                  School Day</span></a></li>
                <li><a href="{{route('teacher.school_year.getAddSchoolYear')}}"><span class="add-ico"><img src="/images/addyear.png" alt="add school year"></span> <span class="add-text">Add<br>
                  School year</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="/images/template-add.png" alt="add template"></span> <span class="add-text">Add<br>
                  Template</span></a></li>
                <li><a href="{{route('teacher.units.index')}}"><span class="add-ico"><img src="/images/unit-add.png" alt="add unit"></span> <span class="add-text">Add<br>
                  Unit</span></a></li>
                <li><a href="#" data-toggle="modal" class="studentannouncementsmodal"><span class="add-ico"><i class="fa fa-bullhorn fa-3x" aria-hidden="true" style="color: #5DA500;"></i></span> <span class="add-text">Student <br> Announcements</span></a> </li>  
                <li><a href="#" data-toggle="modal" class="substitutenotesmodal "><span class="add-ico"><i class="fa fa-sticky-note fa-3x" aria-hidden="true" style="color: #FF7900;"></i></span> <span class="add-text">Substitute<br>Notes</span></a> </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="h-r-menu header-t-menu text-right li-inline">
          <ul class="p-0 m-0">
            <li><a href="#" class="color-theme"><i class="fa fa-2x fa-search" aria-hidden="true"></i><span class="sr-only">Search</span></a></li>
            <li><a href="#" class="color-theme"><i class="fa fa-2x fa-print" aria-hidden="true"></i><span class="sr-only">Print</span></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2" ><i class="fa fa-minus" aria-hidden="true"></i><span class="sr-only"></span></a> </li>
            <li><a href="#" class="color-theme "><i class="fa fa-2x fa-file-text-o" aria-hidden="true"></i><span class="sr-only">collepse</span></a></li>
            <li class="type-view-drop dropdown">
            <button class="btn btn-primary px-3 py-2 dropdown-toggle" type="button" data-toggle="dropdown">View <span class="caret"></span></button>
              <ul class="dropdown-menu view-dropdown">
  					<div class="viewnav-tabs">
  						<ul class="nav nav-pills">
  							<li><a href="{{route('teacher.dashboard.index',['view'=>'day'])}}" class="btn btn-primary calBtn">Day</a>
  							</li>
  							<li><a href="{{route('teacher.dashboard.index',['view'=>'week'])}}" class="btn btn-primary calBtn" >Week</a>
  							</li>
  							<li><a href="{{route('teacher.dashboard.index')}}" class="btn btn-primary calBtn">Month</a>
  							</li>
  							<li><a href="{{route('teacher.dashboard.index',['view'=>'list'])}}" class="btn btn-primary calBtn" data-toggle="tab">List</a>
  							</li>
  						</ul>
  					</div>
  					<div class="view-list">
              <form class='displayItems' method="" action=''>
                  {{ csrf_field() }}
    						<div class="col-md-6">
                @if($viewItems!='')
    							<div class="viewlistleft">
    								<div class="viewlist-header"> View Items </div>
    								<div class="viewlist-body">
    									<ul>
    										<li> All Items</li>
    										<li> No Items</li>
                            
    										<li>
                          <input type="hidden" name="view_items['unit_id']" value="N">
    											<input type="checkbox"  data-val="unit_id" class='viewDetails' name="view_items['unit_id']" value="Y" {{ $check_data[0] == 'Y' ? 'checked' : ''  }} > Unit Id</li>
    										<li>
                          <input type="hidden" name="view_items['lesson_title']" value="N">
    											<input type="checkbox" class='viewDetails' name="view_items['lesson_title']"  data-val="lesson_title" value="Y" {{  $check_data[1] == 'Y' ? 'checked' : ''  }}> Lesson Title</li>
    										<li>
                          <input type="hidden" name="view_items['lessons']" value="N">
    											<input type="checkbox"  data-val="lesson_main" class='viewDetails' name="view_items['lessons']" value="Y" {{  $check_data[2] == 'Y' ? 'checked' : ''  }}> Lesson
    										</li>
    										<li>
                          <input type="hidden" name="view_items['homework']" value="N">
    											<input type="checkbox"  data-val="lesson_homework" class='viewDetails' name="view_items['homework']" value="Y" {{  $check_data[3] == 'Y' ? 'checked' : ''  }}> Homework
    										</li>
    										<li>
                          <input type="hidden" name="view_items['notes']" value="N">
    											<input type="checkbox"  data-val="lesson_notes" class='viewDetails' name="view_items['notes']" value="Y" {{  $check_data[4] == 'Y' ? 'checked' : ''  }}> Notes
    										</li>
    										<li>
                          <input type="hidden" name="view_items['standard_id']" value="N">
    											<input type="checkbox"  data-val="lesson_standard_id" class='viewDetails' name="view_items['standard_id']" value="Y" {{  $check_data[5] == 'Y' ? 'checked' : ''  }}> Standard ID</li>
    										<li>
                          <input type="hidden" name="view_items['standard']" value="N">
    											<input type="checkbox" data-val="lesson_standard" class='viewDetails' name="view_items['standard']" value="Y" {{  $check_data[6] == 'Y' ? 'checked' : ''  }}> Standard Desc</li>
    										<li>
                          <input type="hidden" name="view_items['Attachments']" value="N">
    											<input type="checkbox" data-val="lesson_attachments" class='viewDetails' name="view_items['Attachments']" value="Y" {{  $check_data[7] == 'Y' ? 'checked' : ''  }}> Attachments
    										</li>
    										<li>
                          <input type="hidden" name="view_items['Assignments']" value="N">
    											<input type="checkbox" data-val="lesson_assignments" class='viewDetails' name="view_items['Assignments']" value="Y" {{  $check_data[8] == 'Y' ? 'checked' : ''  }}> Assignments
    										</li>
    										<li>
                          <input type="hidden" name="view_items['Assessments]" value="N">
    											<input type="checkbox" data-val='lesson_assessments' class='viewDetails' name="view_items['Assessments]" value="Y" {{  $check_data[9] == 'Y' ? 'checked' : '' }}> Assessments
    										</li>
    										<li>
                          <input type="hidden" name="view_items['templates']" value="N">
    											<input type="checkbox" data-val='lesson_templates' class='viewDetails' name="view_items['templates']" value="Y" {{  $check_data[10] == 'Y' ? 'checked' : '' }}> Templates
    										</li>
    										<li>
                          <input type="hidden" name="view_items['times']" value="N">
    											<input data-val='lesson_times' type="checkbox" class='viewDetails' name="view_items['times']" value="Y" {{  $check_data[11] == 'Y' ? 'checked' : ''  }}> Times
    										</li>
    										<li>
                          <input type="hidden" name="view_items['events']" value="N">
    											<input data-val='lesson_events' type="checkbox" class='viewDetails' name="view_items['events']" value="Y" {{$check_data[12] == 'Y' ? 'checked' : ''}}> Events
    										</li>
    									</ul>
    								</div>
    							</div>
    						</div>
    						<div class="col-md-6">
    							<div class="viewlistleft">
    								<div class="viewlist-header"> View Classes </div>
    								<div class="viewlist-body">
                    @php $user_classes = request()->user()->userClass()->get(); @endphp 
    									<ul>
    										<li> All Classes</li>
    										<li> No Classes</li>
                        @php $i= 0; @endphp
                        @forelse($user_classes as $classes)
                          <input type="hidden" name="user_class[{{$classes->id}}]" value="N">
    										  <li><input type="checkbox" name="user_class[{{$classes->id}}]" value="Y" @php echo $check_class[$i] == 'Y' ? 'checked' : ''  @endphp>{{$classes->class_name}}</li>
                        @php  $i++; @endphp
  									    @empty

                        @endforelse
                     </ul>
  								  </div>
  							  </div>
  						  </div>
                @else
                  <div class="viewlistleft">
                    <div class="viewlist-header"> View Items </div>
                    <div class="viewlist-body">
                      <ul>
                        <li> All Items</li>
                        <li> No Items</li>
                            
                        <li>
                          <input type="hidden" name="view_items['unit_id']" value="N">
                          <input type="checkbox"  data-val="unit_id" class='viewDetails' name="view_items['unit_id']" value="Y" checked> Unit Id</li>
                        <li>
                          <input type="hidden" name="view_items['lesson_title']" value="N">
                          <input type="checkbox" class='viewDetails' name="view_items['lesson_title']"  data-val="lesson_title" value="Y" checked> Lesson Title</li>
                        <li>
                          <input type="hidden" name="view_items['lessons']" value="N">
                          <input type="checkbox"  data-val="lesson_main" class='viewDetails' name="view_items['lessons']" value="Y" checked> Lesson
                        </li>
                        <li>
                          <input type="hidden" name="view_items['homework']" value="N">
                          <input type="checkbox"  data-val="lesson_homework" class='viewDetails' name="view_items['homework']" value="Y" checked> Homework
                        </li>
                        <li>
                          <input type="hidden" name="view_items['notes']" value="N">
                          <input type="checkbox"  data-val="lesson_notes" class='viewDetails' name="view_items['notes']" value="Y" checked> Notes
                        </li>
                        <li>
                          <input type="hidden" name="view_items['standard_id']" value="N">
                          <input type="checkbox"  data-val="lesson_standard_id" class='viewDetails' name="view_items['standard_id']" value="Y" checked> Standard ID</li>
                        <li>
                          <input type="hidden" name="view_items['standard']" value="N">
                          <input type="checkbox" data-val="lesson_standard" class='viewDetails' name="view_items['standard']" value="Y" checked> Standard Desc</li>
                        <li>
                          <input type="hidden" name="view_items['Attachments']" value="N">
                          <input type="checkbox" data-val="lesson_attachments" class='viewDetails' name="view_items['Attachments']" value="Y" checked> Attachments
                        </li>
                        <li>
                          <input type="hidden" name="view_items['Assignments']" value="N">
                          <input type="checkbox" data-val="lesson_assignments" class='viewDetails' name="view_items['Assignments']" value="Y" checked> Assignments
                        </li>
                        <li>
                          <input type="hidden" name="view_items['Assessments]" value="N">
                          <input type="checkbox" data-val='lesson_assessments' class='viewDetails' name="view_items['Assessments]" value="Y" checked> Assessments
                        </li>
                        <li>
                          <input type="hidden" name="view_items['templates']" value="N">
                          <input type="checkbox" data-val='lesson_templates' class='viewDetails' name="view_items['templates']" value="Y" checked> Templates
                        </li>
                        <li>
                          <input type="hidden" name="view_items['times']" value="N">
                          <input data-val='lesson_times' type="checkbox" class='viewDetails' name="view_items['times']" value="Y" checked> Times
                        </li>
                        <li>
                          <input type="hidden" name="view_items['events']" value="N">
                          <input data-val='lesson_events' type="checkbox" class='viewDetails' name="view_items['events']" value="Y" checked> Events
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="viewlistleft">
                    <div class="viewlist-header"> View Classes </div>
                    <div class="viewlist-body">
                    @php $user_classes = request()->user()->userClass()->get(); @endphp 
                      <ul>
                        <li> All Classes</li>
                        <li> No Classes</li>
                        @forelse($user_classes as $classes)
                          <input type="hidden" name="user_class[{{$classes->id}}]" value="N">
                          <li><input type="checkbox" name="user_class[{{$classes->id}}]" value="Y" checked>{{$classes->class_name}}</li>
                        @empty

                        @endforelse
                     </ul>
                    </div>
                  </div>
                </div>
                @endif
    						<div class="preferencebutton">
    							<button type="submit" class="btn btn-primary calBtn">Save Preferences</button>
    						</div>
              </form>  
  					</div>
  				</ul>
            </li>
            <li class="goto-drop dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle goto-menus" type="button" data-toggle="dropdown">Go to <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="{{route('teacher.dashboard.index')}}"><span class="add-ico"><img src="/images/plans.png" alt="plan"></span> <span class="add-text">Plan</span></a></li>
                <li><a href="{{route('teacher.assessments.index')}}"><span class="add-ico"><img src="/images/assessments.png" alt="assessment"></span> <span class="add-text">Assessments</span></a></li>
                <li><a href="{{route('teacher.assignments.index')}}"><span class="add-ico"><img src="/images/assignments.png" alt="assignment"></span> <span class="add-text">Assignments</span></a></li>
                <li><a href="{{route('teacher.classes.index')}}"><span class="add-ico"><img src="/images/classes.png" alt="classes"></span> <span class="add-text">Classes</span></a></li>
                <li><a href="{{route('teacher.display.index')}}"><span class="add-ico"><img src="/images/display.png" alt="display settings"></span> <span class="add-text">Display Settings</span></a></li>
                <li><a href="{{route('teacher.events.index')}}"><span class="add-ico"><img src="/images/icon-events.png" alt="event"></span> <span class="add-text">Events</span></a></li>
                <li><a href="{{route('teacher.grades.index')}}"><span class="add-ico"><img src="/images/icon-grades.png" alt="grade"></span> <span class="add-text">Grades</span></a></li>
                <li><a href="{{route('teacher.my_files.index')}}"><span class="add-ico"><img src="/images/icon-myfiles.png" alt="my files"></span> <span class="add-text">My Files</span></a></li>
                <li><a href="{{route('teacher.mylist.index')}}"><span class="add-ico"><img src="/images/icon-mylists.png" alt="my list"></span> <span class="add-text">My List</span></a></li>
                <li><a href="{{route('teacher.mystrategies.index')}}"><span class="add-ico"><img src="/images/icon-strategy.png" alt="strategies"></span> <span class="add-text">My Strategies</span></a></li>
                <li><a href="{{route('teacher.school_year.getAddSchoolYear')}}"><span class="add-ico"><img src="/images/icon-schoolyear.png"  alt="School Year"></span> <span class="add-text">School Year</span></a></li>
                <li><a href="{{route('teacher.sharingoption.index')}}"><span class="add-ico"><img src="/images/icon-sharing.png" alt="shearing"></span> <span class="add-text">Sharing Options</span></a></li>
                <li><a href="{{route('teacher.standards.index')}}"><span class="add-ico"><img src="/images/icon-standards2.png" alt="standard"></span> <span class="add-text">Standards Reporting</span></a></li>
                <li><a href="{{route('teacher.addstudents.index')}}"><span class="add-ico"><img src="/images/icon-students.png" alt="students"></span> <span class="add-text">Students</span></a></li>
                <li><a href="{{route('teacher.template.index')}}"><span class="add-ico"><img src="/images/icon-templates.png" alt="template"></span> <span class="add-text">Templates</span></a></li>
                <li><a href="{{route('teacher.units.index')}}"><span class="add-ico"><img src="/images/icon-units.png" alt="units"></span> <span class="add-text">Units</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!---Account Edit Popup ----->
<!-- add account popup here-->
    <div id="add-accountinfo" class="modal fade editmodalcontent accountinfo-content in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                  <div class="modal-header">
                     <div class="normalLesson pull-left">
                        <p>Account Information</p>
                     </div>
                     <div class="actionright pull-right">
                        <button class="actiondropbutton renew-button" id="final_save_details" >Save</button>
                        <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                     </div>
                  </div>
           <div class="modal-body">
              <div class="acount-infoleft">
               <div class="form-group">
                <label>Email Address</label>
                  <div class="form-inputs">
                    <button class="btn btn-primary" id="change_email_btn" type="button"> Change Email</button>
                    <p class="sucess_msg_email" style="display:none;">Email Changed Sucessfully</p>
                  </div>
                </div>
                <form>
                {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-inputs" id="change_email_div" style="display:none;">
                                            <label>Enter New Email</label>
                        <input type="email" class="form-control" id="new_email" name="emailaddress" value="{{ auth()->user()->email }}">
                        <input type="submit" name="save_email" id="update_email" value="Save">
                        </div>
                    </div>
                    </form>
                <div class="form-group"> 
                    <label>Password </label> 
                    <div class="form-inputs">
                      <button class="btn btn-primary" type="button" id="change_pswd_btn"> Change passowrd</button>
                      <p  class="sucess_msg_pswd" style="display:none;">Password Changed Sucessfully</p>
                    </div>
                    </div>
              <div id="update_password_div" class="form-group" style="display:none;">
                   <form id="updatepassword_form">
                       {{ csrf_field() }}
                      <div class="form-group" >
                      <label>Current Password</label>
                        <div class="form-inputs">
                          <input type="password" name="old_password" id="old_pswd" class="form-control">
                        </div>
                     </div>
                     <div class="form-group">
                           <label>New Password</label>
                           <div class="form-inputs">
                            <input type="password" name="new_password" class="form-control" id="new_pswd">
                           </div>
                            </div>
                          <div class="form-group">
                             <label>Confirm Password</label>
                             <div class="form-inputs">
                              <input type="password" name="confirm_password" class="form-control" id="confirm_pswd">
                             </div>
                                </div>
                                <input type="submit" value="Save" id="change_pswd">
                        </form>
                    </div>
                    
                    <form method="post" id="edit_account_deatils_form" class="accountinfo-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label>First Name</label>
                           <div class="form-inputs">
                            <input type="text" class="form-control" name="first_name" value="{{ auth()->user()->first_name }}">
                           </div>
                                </div>
                          <div class="form-group">
                             <label>Last Name</label>
                             <div class="form-inputs">
                              <input type="text" class="form-control" name="last_name" value="{{ auth()->user()->last_name }}">
                             </div>
                                    </div>
                            <div class="form-group">
                               <label>Display Name</label>
                               <div class="form-inputs">
                                <input type="text" class="form-control" name="display_name" value="{{ auth()->user()->display_name }}">
                               </div>
                                        </div>
                              <div class="form-group">
                                 <label>School District</label>
                                 <div class="form-inputs">
                                  <input type="text" class="form-control" name="school_district" value="{{ auth()->user()->school_district }}">
                                 </div>
                                            </div>
                                <div class="form-group">
                                   <label>School Name</label>
                                   <div class="form-inputs">
                                    <input type="text" class="form-control" name="school_name" value="{{ auth()->user()->school_name }}">
                                   </div>
                                                </div>
                                  <div class="form-group">
                                     <label>School ID</label>
                                     <div class="form-inputs">
                                      <input type="text" class="form-control" name="school_id">
                                     </div>
                                                    </div>
                                    <div class="form-group">
                                      <label>Free Months</label>
                                      <div class="form-inputs">
                                        <button class="btn btn-primary" type="button"> Get Free Months</button>
                                      </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Member Since</label>
                                        <div class="form-inputs">
                                          <span class="account-date">03/10/2017</span>
                                        </div>
                                          </div> 
                                         <div class="form-group">
                                          <label>Subscription Expires</label>
                                          <div class="form-inputs">
                                            <span class="account-date">03/05/2018</span>
                                            <button class="btn btn-primary" type="button"> Renew Subscription</button>
                                          </div>
                                          </div> 
                                            <div class="form-group">
                                            <label>Autosave Interval</label>
                                            <div class="form-inputs">
                                               <select class="form-control">
                                                <option value="0">Autosave Off</option>
                                                <option value="15">15 seconds</option>
                                                <option value="30">30 seconds</option>
                                                <option value="45">45 seconds</option>
                                                <option value="60">60 seconds</option>
                                               </select>
                                            </div>
                                            </div> 
                                              <div class="form-group">
                                              <label>Receive Emails</label>
                                              <div class="form-inputs">
                                                 <input type="checkbox" value="Y">
                                              </div>
                                              </div>
                                                <div class="form-group">
                                                <label>Show Banner</label>
                                                <div class="form-inputs">
                                                   <input type="checkbox" value="Y">
                                                </div>
                                                </div> 
                                                  <div class="form-group">
                                                  <label>Student Gift Limit (years)</label>
                                                  <div class="form-inputs">
                                                     <input type="number" class="year-field form-control">
                                                     <button class="btn btn-primary" type="button"> Buy a Gift</button>
                                                  </div>
                                                  </div>
                                              <input type="submit" class="hidden" id="save_user_details" value="Save">
                                                </form>
                                                  <div class="accountnumber">
                                                   v5-20171019
                                                  </div>
                                           
            </div>
    <div class="account-inforight">
    <p>Google+ Connect:</p>
    <div class="btn-group">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="icon"></span>
    </button>
    <button type="button" class="btn btn-danger">Sign In</button>
    
    </div>
    </div>
    </div>
    
    </div>
</div>
</div>
      </div>
<!--- End of Account Edit Popup ----->
<!--Contact Us Popup Here-->
<div id="Contact-usmodal" class="modal fade contactus-sectioncontent" role="dialog">
   <div class="modal-dialog" id="main_contact_form">
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" id="contact_us_form">
             {{ csrf_field() }}
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Send us a message</h4>
            </div>
            <div class="modal-body">
               <div class="contact-usform">
                  <div class="contact-formarea">
                     <textarea placeholder="Give feedback or ask for help" class="form-control" name="contact_message"></textarea>
                  </div>
                  <div class="contact-formbutton">
                     <button type="button" data-toggle="modal" data-target="#attachcontactfile-modal"><i class="fa fa-camera" aria-hidden="true"></i> <span class="attach-filetext">Attach a screenshot or file</span>
                     </button>
                     <span id="selcted_yes" style="display:none;float: left;margin-top:5px;">You attached one image  <img id="blah-img" src="" alt="image" width="30" height="30" /></span>
                  </div>
                  <span id="screenshot_yes" style="display:none;float: left;margin-top:5px;">You Attached a screenshot <a id="see_screenshot" style="cursor:pointer;color:#0057c1;">View Screenhot</a></span>
                       <input type="file" id="con_image_att" name="file_name" class="hidden" onchange="readURLcover(this);">
                       <input type="file" class="hidden" id="screenshot">
                       <input type="hidden" name="img_val" id="img_val" value="" />
               </div>
               <div class="contact-nextbuton">
                  <input type="submit" id="send_message" class="hidden" value="send message">
                  <button type="button" id="contact_us_message" class="btn">Next</button>
               </div>
            </div>
            <div class="modal-footer">
            </div>
         </form>
      </div>
   </div>
   <div class="modal-dialog" id="submiting_msg" style="display:none;background-color: rgb(69, 79, 89);">
      <!-- Modal content-->
      <div class="modal-content" id="sending_msg">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <h1 class="alert-title"> 
                  Wait for a moment..
               </h1>
              <img src="/images/gip.gif" width="170" height="165" style="margin-left: 85px;">
              <br>
              <br>
              <br>
            </div>
      </div>
      <div class="modal-content" id="thank_you" style="display:none;">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <h1 class="alert-title"> 
                  Congrates..
               </h1>
              <h3 style="text-align:center;">Your form has been submitted sucessfully</h3>
              <h5 style="text-align:center;">We will contact you very shortly</h3>
              <br>
              <br>
              <br>
            </div>
      </div>
   </div>
</div>
<div id="attachcontactfile-modal" class="modal fade attach-filemodal" role="dialog">
   <div class="modal-dialog" id="attchment_btn_div">
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" action="">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <h1 class="alert-title">  
                  Attach a file
               </h1>
               <button type="button" class="button block-button primary" data-screenshot-button="" id="fake_screen">Snap screenshot</button> 
               <div class="button block-button primary attach-filebutton"><span class="file-choosebutton" id="fake_image_choose">Choose a file....</span></div>
               <button type="button" class="button cancel-button" data-screenshot-button="" data-toggle="modal" data-target="#Contact-usmodal">Cancel</button> 
            </div>
         </form>
      </div>
   </div>
   <div class="modal-dialog" id="taking_screenshot_div" style="display:none;">
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <h1 class="alert-title"> 
                  Taking Screenshot..
               </h1>
              <img src="/images/gip.gif" width="170" height="165">
              <br>
              <br>
              <br>
            </div>
      </div>
   </div>
</div>
<!--Contact Us Popup Here-->