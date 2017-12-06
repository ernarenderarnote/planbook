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
      <div class="col-sm-8"><img class="img-responsive mx-auto" src="/images/logonew.png" alt=""></div>
      <div class="user-drop li-inline pull-right text-right col-sm-2">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> 
          {{ $user = auth()->guard('students')->user()->name }}
          
          
<span class="caret"></span></button>
          <ul class="dropdown-menu pull-right student-signout">
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
            <li><a href="#" class="btn btn-primary px-3 py-2 get-calendar" id="pPrev"><i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sr-only">goto left</span></a> <a href="#" class="btn btn-primary px-3 py-2 get-calendar" id="pNext"><i class="fa fa-chevron-right" aria-hidden="true"></i><span class="sr-only">goto right</span></a> </li>
            <li><a href="#" class="color-theme "><i class="fa fa-2x fa-file-text-o" aria-hidden="true"></i><span class="sr-only">calendar</span></a></li>
            
          </ul>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="h-r-menu header-t-menu text-right li-inline">
          <ul class="p-0 m-0">
            <li><a href="#" class="btn btn-primary px-3 py-2 show-comment"><i class="fa fa fa-commenting-o" aria-hidden="true"></i><span class="sr-only">comments</span></a></li>
            <li><a href="#" class="btn btn-primary px-3 py-2 "><span class="">A<sup>+</sup></span></a></li>
            
            <li><a href="#" class="collepse-minus btn btn-primary px-3 py-2"><i class="fa fa-minus" aria-hidden="true"></i><span class="sr-only"></span></a> </li>
            
            <li class="type-view-drop dropdown">
              <button class="btn btn-primary px-3 py-2 dropdown-toggle" type="button" data-toggle="dropdown">View <span class="caret"></span></button>
              <ul class="dropdown-menu view-dropdown studentview-dropdown">
              <div class="viewnav-tabs">
                <ul class="nav nav-pills">
              <li><a href="{{route('student.dashboard.index',['view'=>'day'])}}" class="btn btn-primary calBtn">Day</a>
              </li>
              <li><a href="{{route('student.dashboard.index',['view'=>'week'])}}" class="btn btn-primary calBtn" >Week</a>
              </li>
              <li><a href="{{route('student.dashboard.index')}}" class="btn btn-primary calBtn">Month</a>
              </li>
              
            </ul>
           </div> 
              </ul>
            </li>
            
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