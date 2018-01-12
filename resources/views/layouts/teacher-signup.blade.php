<!DOCTYPE html>
<html lang="en">
  @include('teacher.common.head')
  <body>
		<div class="signup-pheader">
		  <div class="container-fluid">
		    <div class="text-center head-center">
		      <div class="pull-left text-left col-sm-2">
		        
		      </div>
		      <div class="col-sm-8"><img class="img-responsive mx-auto" src="/images/logonew.png" alt=""></div>
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
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-account.png" width="36" height="35" alt="account"></span> <span class="add-text">Account</span></a></li>
			            <li><a href="#"><span class="add-ico overview-open"><img src="/images/icon-overview.png" alt="overview"></span> <span class="add-text">Overview</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-tutorials.png" alt="tutorial"></span> <span class="add-text">Tutorials</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-knowledge.png" alt="knowledge"></span> <span class="add-text">Knowledge Base</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-mail.png" alt="contact"></span> <span class="add-text">Contact Us</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-feedback.png" alt="feedback"></span> <span class="add-text">Chat Us</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-idea.png" alt="idea"></span> <span class="add-text">Feedback</span></a></li>
			            <li><a href="#"><span class="add-ico"><img src="/images/icon-refresh.png" alt="refresh"></span> <span class="add-text">Refresh</span></a></li>
			            <li><a href="{{route('logout')}}"><span class="add-ico"><img src="/images/icon-signout.png" alt="sign out"></span> <span class="add-text">Sign out</span></a></li>
			          </ul>
			        </div>
			    </div>
		    </div>
		  </div>
		</div>

		@yield('content')

		@include('teacher.common.footer')
  </body>
</html>
