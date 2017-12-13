@if(isset($students) && count($students)>0)
@foreach($students as $student=>$value)
@endforeach
@php $count_student = count($students); @endphp
<div class="show-assignmentstop">
   <p>Show Assignments</p>
   <div class="show-gradeassignmentsbuttons assignment-filter">
      <button class="btn active all" type="button">All</button>
      <button class="btn none" type="button">None</button>
      <button class="btn prior" type="button">Prior</button>
      <button class="btn next" type="button">Next</button>
   </div>
   <p>Show Assessments</p>
   <div class="show-gradeassignmentsbuttons assessment-filter">
      <button class="btn active all" type="button">All</button>
      <button class="btn none" type="button">None</button>
      <button class="btn prior" type="button">Prior</button>
      <button class="btn next" type="button">Next</button>
   </div>
</div>
<div class="show-assignmentstable">
<form class="gradeForm" method="post" action="">
   <table>
      <thead>
         <tr id="heading-data">
            <th class="show-assignmentstablerow1"></th>
            <th class="show-assignmentstablerow2"><div class="showassesmenttable-innerrow">Overall</div></th>
            <th class="show-assignmentstablerow2"><div class="showassesmenttable-innerrow">Period</div></th>
            @forelse($assignments as $assignment)
               <th class="show-assignmentstablerow2 assignment-data"><div class="showassesmenttable-innerrow">{{$assignment->title}}<br><span style="font-size: 9px;">No Category</span></div></th>
            @empty
            @endforelse
            @forelse($assessments as $assessment)
               <th class="show-assignmentstablerow2 assessment-data"><div class="showassesmenttable-innerrow">{{$assessment->title}}<br><span style="font-size: 9px;">No Category</span></div></th>
            @empty
            @endforelse
         </tr>
      </thead>
      <tbody>
       
         <tr id="sortdata">
            <td> <div class="show-assesmentsorting pull-right">Due Date &nbsp; Sort<i class="fa fa-caret-left" aria-hidden="true"></i></div></td>
            <td> </td>
            <td> </td>
            @forelse($assignments as $assignment)
            @php
            $enddate = $assignment->ends_on;
            $ends_on = date("m/d", strtotime($enddate)); 
            @endphp
            <td class="assignment-data">{{$ends_on}}</td>
            @empty
            <!--td class="show-assessmentrowbackground assignment-data"></td-->
            @endforelse

            @forelse($assessments as $assessment)
            @php
            $enddate = $assessment->ends_on;
            $ends_on = date("m/d", strtotime($enddate)); 
            @endphp
            <td class="assessment-data">{{$ends_on}}</td>
            @empty
            <!--td class="show-assessmentrowbackground assessment-data"></td-->
            @endforelse
           
         </tr>
         <tr id="avgClass">
            <td>Class Average</td>
            <td> </td>
            <td> </td>
            @php 
               $selected_class_id = '';
               $students_id = '';   
               $count  =  0; 
               $countass = 0;  
               $a = array();
               $b = array();
            @endphp

            @forelse($assignments as $assignment=>$avg)
            
               @php $arr = array(); @endphp
               @foreach($avg->avgAssignmentPoints as $avgMarks=>$val)
                  @php $arr[] = $val->points; @endphp
               @endforeach
               @php
               $a[] = array_sum($arr);  
               $selected_class_id = $avg['class_id'];@endphp
               <td class="assignment-data">@php echo floor($a[$count]/$count_student); @endphp /{{$avg['total_points']}}</td>
               @php $count++; @endphp
               @empty
               <!--td class="assignment-data"></td-->
            @endforelse
            @forelse($assessments as $assessment=>$avgpoints)
               @php $asse = array(); @endphp
               @foreach($avgpoints->avgAssessmentPoints as $avgMarks=>$val)
                  @php $asse[] = $val->points; @endphp
               @endforeach
               @php $b[] = array_sum($asse);  
               @endphp
            <td class="assessment-data">@php echo floor($b[$countass]/$count_student); @endphp/{{$avgpoints['total_points']}}</td>
            @php $countass++; @endphp
            @empty
            <!--td class="assessment-data"></td-->
            @endforelse
         </tr>
        
         {{ csrf_field() }}
         @forelse($students as $student=>$value)
         <tr class="studentValue">  
            <input type="hidden" name="class_id" value="{{$selected_class_id}}">
           
            <td>{{$value->student['last_name']}} , {{$value->student['name']}}</td>
            <td> </td>
            <td> </td>

            @forelse($value->assignpoints as $assipoint)
            <td class='assignment-data'>
               <input type="hidden" name="student_id[]" value="{{$value->student['id']}}">
               <input type="hidden" name='assignment_id[]' value="{{$assipoint->assignment_id}}">
               <input type="text"  value="{{$assipoint->points}}" name="assignment_points[]" class="grade-assigned">
            </td>
            @empty
            @foreach($assignments as $assignment)
            <td class='assignment-data'>
               <input type="hidden" name="student_id[]" value="{{$value->student['id']}}">
               <input type="hidden" name='assignment_id[]' value="{{$assignment->id}}">
               <input type="text"   name="assignment_points[]" class="grade-assigned">
            </td>
            @endforeach
            @endforelse
            @forelse($value->assesspoints as $assipoints)
            <td class='assignment-data'>
               <input type="hidden" name="ass_student_id[]" value="{{$value->student['id']}}">
               <input type="hidden" name='assessment_id[]' value="{{$assipoints->assessment_id}}">
               <input type="text"   value="{{$assipoints->points}}" name="assessment_points[]" class="grade-assigned">
            </td>
            @empty
            @foreach($assessments as $assessment)
            <td class='assessment-data'>
               <input type="hidden" name="ass_student_id[]" value="{{$value->student['id']}}">
               <input type="hidden" name='assessment_id[]' value="{{$assessment->id}}">
               <input type="text"   name="assessment_points[]" class="grade-assigned">
            </td>
            @endforeach
            @endforelse       
         </tr> 
          @empty
            @endforelse
            
      </tbody>
   </table>
   </form>
</div>
@endif
