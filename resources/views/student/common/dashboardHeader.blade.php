<div class="signup-pheader">
  <div class="container-fluid">
    <div class="text-center head-center">
      <div class="pull-left text-left col-sm-2">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> {{$teachers->teacher['first_name']}}<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">{{$teachers->teacher['first_name']}}</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-8"><img class="img-responsive mx-auto" src="/images/planbook.png" alt=""></div>
      <div class="user-drop li-inline pull-right text-right col-sm-2">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> 
          {{ $user = auth()->guard('students')->user()->name }}
          
          
<span class="caret"></span></button>
          <ul class="dropdown-menu pull-right">
            <li><a href="/student/logout"><span class="add-ico"><img src="/images/icon-signout.png" alt="sign out"></span> <span class="add-text">Sign out</span></a></li>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-6">
        <div class="h-l-menu header-t-menu text-left li-inline">
          <ul class="p-0 m-0">
            <li><a href="#" class="btn btn-primary px-3 py-2">Today</a></li>
            <li><a href="#" class="color-theme"><i class="fa fa-2x fa-calendar" aria-hidden="true"></i><span class="sr-only">calendar</span></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2"><i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sr-only">goto left</span></a> <a href="#" class="btn btn-primary px-3 py-2"><i class="fa fa-chevron-right" aria-hidden="true"></i><span class="sr-only">goto right</span></a> </li>
            <li><a href="#" class="color-theme "><i class="fa fa-2x fa-file-text-o" aria-hidden="true"></i><span class="sr-only">calendar</span></a></li>
            <!--<li><a href="#" class="btn btn-primary px-3 py-2">Copy</a></li>
            <li class="dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle" type="button" data-toggle="dropdown">Add <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="add-ico"><img src="../images/assessment-add.png" alt="add-assessment"></span> <span class="add-text">Add<br>
                  Assessment</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/assignment-add.png" alt="add assignment"></span> <span class="add-text">Add<br>
                  Assignment</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/class-add.png"  alt="add class"></span> <span class="add-text">Add<br>
                  Class</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/event-add.png" alt="add event"></span> <span class="add-text">Add<br>
                  Event</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/extra-lesson-add.png" alt="add extra lesson"></span> <span class="add-text">Add<br>
                  Extra Lesson</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/noschool.png" alt="add assignment"></span> <span class="add-text">Add No<br>
                  School Day</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/addyear.png" alt="add school year"></span> <span class="add-text">Add<br>
                  School year</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/template-add.png" alt="add template"></span> <span class="add-text">Add<br>
                  Template</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/unit-add.png" alt="add unit"></span> <span class="add-text">Add<br>
                  Unit</span></a></li>
              </ul>
            </li>-->
          </ul>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="h-r-menu header-t-menu text-right li-inline">
          <ul class="p-0 m-0">
            <li><a href="#" class="btn btn-primary px-3 py-2 show-comment"><i class="fa fa fa-commenting-o" aria-hidden="true"></i><span class="sr-only">comments</span></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2 "><span class="">A<sup>+</sup></span></a></li>
            <!--<li><a href="#" class="color-theme"><i class="fa fa-2x fa-print" aria-hidden="true"></i><span class="sr-only">Print</span></a></li>-->
            <li><a href="#" class="collepse-minus btn btn-primary px-3 py-2"><i class="fa fa-minus" aria-hidden="true"></i><span class="sr-only"></span></a> </li>
            <!--<li><a href="#" class="color-theme "><i class="fa fa-2x fa-file-text-o" aria-hidden="true"></i><span class="sr-only">collepse</span></a></li>-->
            <li class="type-view-drop dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle" type="button" data-toggle="dropdown">View <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#">2017</a></li>
                <li><a href="#">Add a year</a></li>
              </ul>
            </li>
            <!--<li class="goto-drop dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle" type="button" data-toggle="dropdown">Go to <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="add-ico"><img src="../images/plans.png" alt="plan"></span> <span class="add-text">Plan</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/assessments.png" alt="assessment"></span> <span class="add-text">Assessments</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/assignments.png" alt="assignment"></span> <span class="add-text">Assignments</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/classes.png" alt="classes"></span> <span class="add-text">Classes</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/display.png" alt="display settings"></span> <span class="add-text">Display Settings</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-events.png" alt="event"></span> <span class="add-text">Events</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-grades.png" alt="grade"></span> <span class="add-text">Grades</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-myfiles.png" alt="my files"></span> <span class="add-text">My Files</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-mylists.png" alt="my list"></span> <span class="add-text">My List</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-strategy.png" alt="strategies"></span> <span class="add-text">My Strategies</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-schoolyear.png"  alt="School Year"></span> <span class="add-text">School Year</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-sharing.png" alt="shearing"></span> <span class="add-text">Sharing Options</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-standards2.png" alt="standard"></span> <span class="add-text">Standards Reporting</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-students.png" alt="students"></span> <span class="add-text">Students</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-templates.png" alt="template"></span> <span class="add-text">Templates</span></a></li>
                <li><a href="#"><span class="add-ico"><img src="../images/icon-units.png" alt="units"></span> <span class="add-text">Units</span></a></li>
              </ul>
            </li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- student comment box -->

<div id="listCommentBox" class="dashboard-comment-box student-dash">
  <div class="container-fluid">
    <div class="col-sm-12">
      <div class="student-dash-action pt-5">
        <button class="btn btn-primary bg-white border-2 border-theme add-comments popup-custom-show"><i class="fa fa-plus" aria-hidden="true"></i><span class="">Add Comments</span></button>
        <button class="btn btn-primary bg-white border-2 return-toplan "><span class="">Return to Plans</span></button>
      </div>
    </div>
    <div class="table-responsive col-sm-12 pt-5">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center bg-theme date-column">Date</th>
            <th class="text-center bg-theme comment-for">Name</th>
            <th class="text-left bg-theme student-comment">Comment</th>
            <th class="delete-column bg-theme"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center date-column">04/11/2017</td>
            <td class="text-center comment-for"><span class="commentTo">To</span>Jeetu</td>
            <td class="text-left student-comment">sd</td>
            <td class="text-center delete-column"><a href="#" class="btn btn-primary py-0 px-2"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          </tr>
          <tr>
            <td class="text-center date-column">04/11/2017</td>
            <td class="text-center comment-for"><span class="commentTo">To</span>Jeetu</td>
            <td class="text-left student-comment">sd</td>
            <td class="text-center delete-column"><a href="#" class="btn btn-primary py-0 px-2"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          </tr>
          <tr>
            <td class="text-center date-column">04/11/2017</td>
            <td class="text-center comment-for"><span class="commentTo">To</span>Jeetu</td>
            <td class="text-left student-comment">sd</td>
            <td class="text-center delete-column"><a href="#" class="btn btn-primary py-0 px-2"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="popup-custom">
      <div class="popup-content">
        <div class="popup-header text-center"><span class="header-title">Comments</span></div>
        <div class="popup-body">
          <form action="" method="">
            <div class="form-group clearfix">
              <label class=""> Sent to</label>
              <select class="form-control col-sm-10">
                <option value="1"> Lorem</option>
                <option value="2"> Lorem</option>
                <option value="3"> Lorem</option>
              </select>
            </div>
            <div class="form-group clearfix">
              <textarea class="form-control" placeholder="Enter Comment"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-lg btn-primary popup-custom-hide">Send</button>
              <button type="button" class="btn btn-lg btn-primary popup-custom-hide">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>