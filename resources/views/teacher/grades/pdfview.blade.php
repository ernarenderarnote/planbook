<style>
	 body{background-color:#000;width:100%; font-family: 'Open Sans',Helvetica,Arial,Lucida,sans-serif;margin:0;padding:0; 	  }
	  *{ box-sizing:border-box; 	  }
	  .report-page {     width: 100%;     height: 842px;     background-color: #fff;     margin: 0 auto;     margin-top: 20px;     padding: 0px 40px; box-shadow:1px 1px 1px 1px #ddd; position:relative; }
	 .student-report-heading {     width: 100%;     text-align: center;     font-size: 19px;     color: #000;     margin: 20px 0px;     display: inline-block;     font-weight: bold; }
	.report-page  p {     font-size: 14px;     margin: 0px 0px 13px 0px;     font-weight: 600;     color: #000; }
	.report-page table{width:80%; float:left;     border-collapse: collapse;     border: 1px solid #ddd; margin-top:11px;}
	.report-page table thead{ background-color:#dbdfe8; width:100%;}
	.report-page table thead th {     padding: 8px;     font-size: 16px;     font-weight: bold;     color: #000;     border-right: 1px solid #fff;     text-align: left; }
	.report-page table thead th:first-child {     width: 47%; }
	.report-page table tbody td{ font-size:8px; border:1px solid #ddd; padding: 8px;     font-size: 14px; color:#000;  }
	.report-page table tbody tr:nth-child(odd) {     background-color: #f4f4f6; }
	.report-page table tbody td:last-child{border-right:0px;}
	.report-page table thead th:last-child{border-right:0px;}
	.report-data{ background-color:#dbdfe8; width:100%; padding:8px; font-size:17px; font-weight:bold; margin-top:11px;}
	.repports-pagenumber {     position: absolute;     bottom: 20px;     text-align: center;     width: 100%;     font-size: 17px;     left: 0;     right: 0;     font-weight: 500; }
	  </style>


	<br/>
	<a href="{{ route('teacher.grades.pdfview',['download'=>'pdf'],[]) }}">Download PDF</a>
	@forelse($students as $student)
	<div class="report-page">
  		<div class="student-report-heading">
   			Student Performance Report
   		</div>
	   <p>Student: {{$student->last_name}} {{$student->name}}</p>
	   <p>Teacher: {{Auth::user()->name}}</p>
	   <p>Grade Period: All</p>
	   <p>Date: 12/15/2017</p>
		  <table border="1">
		       <thead>
			           <tr>
						    <th>Subject</th>
							<th>Period</th>
							<th>New</th>
							<th>Overall</th>
					   </tr>
			   </thead>
			   <tbody>
			   		@forelse($classes as $class)

			           <tr>
						    <td>{{$class->class_name}}</td>
							<td></td>
							<td></td>
							<td></td>
					   </tr>
					@empty
					@endforelse   
			   </tbody>
		  </table>
		  
      </div>
    @empty
    @endforelse  
