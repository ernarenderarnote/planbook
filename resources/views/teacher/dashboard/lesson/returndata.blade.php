   @if(!empty($response))
		<h2>{{ $response['lessonTitle'] }}</h2><hr>
		<li>{{ $response['starttime'] }}</li>
		<li>{{ $response['endtime'] }}</li>
		<li>{{ $response['units'] }}</li>
		<li>{!! $response['lessonTxt'] !!}</li>
		<li>{!! $response['notesTxt'] !!}</li>
		<li>{!! $response['homeworkTxt'] !!}</li>
	@endif


			