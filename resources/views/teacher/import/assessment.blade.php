<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> FROM Assessments
  </div>
</div>
<form id="AssessmentForm" action=''>
  {{csrf_field()}}
  <div class="copy-classtable unitscopytable">
    <table border="1">
       <tr class="unittable-headmain">
          <th class=""><input type="checkbox" id="checkAll"></th>
          <th class="unittable-first">Assessment</th>
          <th>Start</th>
          <th>End</th>
       </tr>

       @forelse($assessments as $assessment)
        <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$assessment['id']}}">
          <td><input type="checkbox" name="assessment_id[]" value='{{$assessment["id"]}}'></td>
          <td class="copyunits-maincolumn">
            {{ $assessment['title'] }} 
          </td>
          <td>{{ $assessment['starts_on'] }}</td>
          <td>{{ $assessment['ends_on'] }}</td>
       </tr> 
       @empty
       @endforelse    
    </table>
  </div>
</form>  