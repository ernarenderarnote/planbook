<!DOCTYPE html>
<html lang="en">
  @include('student.common.head')
  <body>

	@if(request()->route()->getName() == "student.dashboard.index")
	 @include('student.common.dashboardHeader')

	  	@else

	  	@include('student.common.header')

	  @endif


		

		@yield('content')

		@include('student.common.footer')
		{{ debug("user") }}
  </body>
</html>
