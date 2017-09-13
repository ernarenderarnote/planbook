@extends('layouts.teacher')

@section('content')

<div class="clearfix"></div>
<div class="events-section">
	<div class="copy-header"> Standards Report - Select criteria to view standards taught </div>
	<div class="standard-reportinginner">
		<form method="post" action="">
		  <div class="standard-reportingform">
			<div class="standardform-row">
			  <div class="col-md-3 pl-0">
				<label>Class</label>
				<select id="reportClass" class="input-fileds ">
				  <option value="0">View All</option>
				  <option value="7081104">Language Arts</option>
				  <option value="7081076">Mathematics</option>
				  <option value="7081105">Reading</option>
				  <option value="7081112">Science</option>
				  <option value="7081113">Social Studies</option>
				  <option value="7081114">Writing</option>
				</select>
			  </div>
			  <div class="col-md-4 pl-0">
				<label>State/Local:</label>
				<select id="reportState" class="input-fileds">
				  <option value="A2">Australia - New South Wales</option>
				</select>
			  </div>
			  <div class="col-md-2 pl-0">
				<label>Grade:</label>
				<select id="reportGrade" class="input-fileds">
				  <option value="-1">Pre-K</option>
				  <option value="0">Kindergarten</option>
				  <option value="1">Grade 1</option>
				  <option value="2">Grade 2</option>
				  <option value="3">Grade 3</option>
				  <option value="4">Grade 4</option>
				  <option value="5">Grade 5</option>
				  <option value="6">Grade 6</option>
				  <option value="7">Grade 7</option>
				  <option value="8">Grade 8</option>
				  <option value="9">Grade 9</option>
				  <option value="10">Grade 10</option>
				  <option value="11">Grade 11</option>
				  <option value="12">Grade 12</option>
				</select>
			  </div>
			</div>
			<div class="standardform-row">
			  <div class="col-md-3 pl-0">
				<label>Standard Subject:</label>
				<select id="reportSubject"  class="input-fileds">
				  <option value="VA2">View All</option>
				  <option value="MA">Mathematics</option>
				</select>
			  </div>
			  <div class="col-md-4 pl-0">
				<label>Category:</label>
				<select id="reportCategory" class="input-fileds">
				  <option value="VA">View All</option>
				  <option value="A">Working Mathematically</option>
				  <option value="B">Number &amp; Algebra</option>
				  <option value="C">Measurement &amp; Geometry</option>
				  <option value="D">Statistics &amp; Probability</option>
				</select>
			  </div>
			  <div class="col-md-2 pl-0">
				<label>Start Date:</label>
				<input class="input-fileds" id="demo6" type="text">
			  </div>
			  <div class="col-md-3 pl-0">
				<label>End Date:</label>
				<input class="input-fileds" id="demo8" type="text">
			  </div>
			</div>
		  </div>
		  <div class="standardreport-button">
			<button class="main-buton" type="button">Print</button>
			<button class="main-buton" type="button">Export</button>
		  </div>
		</form>
	</div>
	<div class="standard-reporttable">
		<table id="example" class="table   table-bordered display">
			<thead>
				<tr>
				  <th>ID</th>
				  <th class="description-field">Description</th>
				  <th>Times Taught</th>
				  <th>Dates</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td>MA1-10MG</td>
				  <td class="description-field">A student measures, records, compares and estimates areas using uniform informal units compares areas using everyday language</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-8NA</td>
				  <td class="description-field">A student creates, represents and continues a variety of patterns with numbers and objects</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-7NA</td>
				  <td class="description-field">A student represents and models halves, quarters and eighths equal parts as halves</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-6NA</td>
				  <td class="description-field">A student uses a range of mental strategies and concrete materials for multiplication and division counts collections of objects, describes using everyday language, and records using informal methods</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-5NA</td>
				  <td class="description-field">A student uses a range of strategies and informal recording methods for addition and subtraction involving one- and two-digit numbers separates and compares collections of objects, describes using everyday language, and records using informal methods</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-4NA</td>
				  <td class="description-field">A student applies place value, informally, to count, order, read and represent two- and three-digit numbers orders, reads and represents numbers in the range 0 to 20</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-3WM</td>
				  <td class="description-field">A student supports conclusions by explaining or demonstrating how answers were obtained materials and/or pictorial representations to support conclusions</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-2WM</td>
				  <td class="description-field">A student uses objects, diagrams and technology to explore mathematical problems actions, technology and/or trial and error to explore mathematical problems</td>
				  <td>0</td>
				  <td></td>
				</tr>
				<tr>
				  <td>MA1-1WM</td>
				  <td class="description-field">A student describes mathematical situations and methods using everyday and some mathematical language, actions, materials, diagrams and symbols mathematical situations using everyday language, actions, materials and informal recordings</td>
				  <td>1</td>
				  <td><a href="lesson-search.html">16-6-2017</a></td>
				</tr>
				<tr>
				  <td>MA1-0WM</td>
				  <td class="description-field">A student describes mathematical situations and methods using everyday and some mathematical language, actions, materials, diagrams and symbols mathematical situations using everyday language, actions, materials and informal recordings</td>
				  <td>1</td>
				  <td><a href="{{route('teacher.standards.explore')}}">16-6-2017</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection

@push('js')
	<!--data table script here--> 
	<script>
	    $(document).ready(function(){
			$('#example').DataTable({  
				"ordering": true,
			} );	
		});
</script>
@endpush