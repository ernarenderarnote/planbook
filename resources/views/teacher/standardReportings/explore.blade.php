@extends('layouts.teacher')

@section('content')

<div class="clearfix"></div>
	<div class="events-section">
	    <div class="copy-header"> Lesson Search </div>
		<div class="lessonsearch-content">
			<form method="post" action="#" class="lesson-searchform">
			  <input id="searchText"  size="50" placeholder="Enter Search Text" type="text" class="search-field">
			  <button class="main-buton">Search</button>
			  <button class="main-buton">Clear</button>
			</form>
			<div class="lessonsearch-contenttable">
				<table>
					<thead>
					  <tr class="tHeader">
						<td class="arrow-box"></th>
						<th>Class</th>
						<th>Year</th>
						<th>Date</th>
						<th>Day</th>
						<th class="lesson-box">Lesson</th>
					  </tr>
					</thead>
					<tbody>
						<tr>
							<td class="arrow-box arrow-relative"><a class="arrowdropdown-link"><i class="fa fa-sort-down" aria-hidden="true"></i></a>
								<div class="lesondropdown  lesonsearch-dropdown">
									<div class="lessondropdown-header"> Lesson Actions <span class="cross-icon copydropcrossicons closesearch-icon"> <i class="fa fa-close" aria-hidden="true"></i></span></div>
									<div class="lesondropdown-body lessondrop-bodymain">
									  <ul>
										<li data-toggle="modal" data-target="#editmodal"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Lesson</li>
										<li data-toggle="modal" data-target="#movemodal"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
										<li class="copy-field"> <i class="fa fa-copy" aria-hidden="true"></i> Copy
										  <div class="dropdown copy-dropdown">
											<button class="btn btn-copy dropdown-toggle" type="button" data-toggle="dropdown"> All
											<div class="caret-button"><span class="caret"></span></div>
											</button>
											<ul class="dropdown-menu copydropdown-inner">
											  <li>All Selection</li>
											  <li>
												<input type="checkbox">
												Lesson </li>
											  <li>
												<input type="checkbox">
												Homework </li>
											  <li>
												<input type="checkbox">
												Notes </li>
											  <li>
												<input type="checkbox">
												Standards </li>
											  <li>
												<input type="checkbox">
												Attachments </li>
											  <li>Done</li>
											</ul>
										  </div>
										</li>
										<li data-toggle="modal" data-target="#pastemodal"> <i class="fa fa-paste" aria-hidden="true"></i> Paste</li>
										<li> <i class="fa fa-arrow-right" aria-hidden="true"></i> Bump
										  <div class="copy-incrementfunction">
											<input type="button" onclick="incrementValue()" value="-">
											<input type="text" placeholder="2" class="copydropdown-value">
											<input type="button" onclick="decrementValue()" value="+">
										  </div>
										</li>
										<li> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
										  <div class="copy-incrementfunction">
											<input type="button" onclick="incrementValue()" value="-">
											<input type="text" placeholder="2" class="copydropdown-value">
											<input type="button" onclick="decrementValue()" value="+">
										  </div>
										</li>
										<li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Lesson
										  <div class="copy-incrementfunction">
											<input type="button" onclick="incrementValue()" value="-">
											<input type="text" placeholder="2" class="copydropdown-value">
											<input type="button" onclick="decrementValue()" value="+">
										  </div>
										</li>
										<li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Standards
										  <div class="copy-incrementfunction">
											<input type="button" onclick="incrementValue()" value="-">
											<input type="text" placeholder="2" class="copydropdown-value">
											<input type="button" onclick="decrementValue()" value="+">
										  </div>
										</li>
										<li data-toggle="modal" data-target="#deletemodal"> <i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
										<li data-toggle="modal" data-target="#renewmodal"> <i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
									  </ul>
									</div>
								</div>
							</td>
							<td>Mathematics</td>
							<td>2017-2018</td>
							<td>06/25/2018</td>
							<td>Monday</td>
							<td class="lesson-box">fdsfdsfasfsda</td>
						</tr>
						<tr>
							<td class="arrow-box"><a><i class="fa fa-sort-down" aria-hidden="true"></i></a></td>
							<td>Mathematics</td>
							<td>2017-2018</td>
							<td>06/25/2018</td>
							<td>Monday</td>
							<td class="lesson-box">fdsfdsfasfsda</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('js')
	<script>
		$(".arrowdropdown-link").click(function(){
			$(".lesonsearch-dropdown").show();
        });
		$(".closesearch-icon").click(function(){
			$(".lesonsearch-dropdown").hide();
        });
	</script>	 
@endpush