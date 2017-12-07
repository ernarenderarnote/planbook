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
            <td class="show-assessmentrowbackground assignment-data"></td>
            @endforelse

            @forelse($assessments as $assessment)
            @php
            $enddate = $assessment->ends_on;
            $ends_on = date("m/d", strtotime($enddate)); 
            @endphp
            <td class="assessment-data">{{$ends_on}}</td>
            @empty
            <td class="show-assessmentrowbackground assessment-data"></td>
            @endforelse
           
         </tr>
         <tr id="avgClass">
            <td>Class Average</td>
            <td> </td>
            <td> </td>
            @forelse($assignments as $assignment)
            <td class="assignment-data"> 10/02</td>
            @empty
            <td class="assignment-data"></td>
            @endforelse
            @forelse($assessments as $assessment)
            <td class="assessment-data">10/02</td>
            @empty
            <td class="assessment-data"></td>
            @endforelse
         </tr>
         @forelse($students as $student=>$value)
         <tr id="studentValue">  
            
            <td>{{$value->student['last_name']}} , {{$value->student['name']}}</td>
            <td> </td>
            <td> </td>
            @forelse($assignments as $assignment)
            <td class='assignment-data'><input type="text" class="grade-assigned"></td>
            @empty
            <td></td>
            @endforelse
            @forelse($assessments as $assessment)
            <td class="assessment-data"><input type="text" class="grade-assigned"></td>
            @empty
            <td></td>
            @endforelse
           
         </tr> 
          @empty
            @endforelse
      </tbody>
   </table>
</div>

