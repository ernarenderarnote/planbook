<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> FROM Assignments
  </div>
</div>
<form id="AssignmentForm" action=''>
{{csrf_field()}}
  <div class="copy-classtable unitscopytable">
    <table border="1">
       <tr class="unittable-headmain">
          <th class=""><input type="checkbox" id="checkAll"></th>
          <th class="unittable-first">Assignments</th>
          <th>Start</th>
          <th>End</th>
       </tr>

       @forelse($assignments as $assignment)
        <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$assignment['id']}}">
          <td><input type="checkbox" name="assignment_id[]" value='{{$assignment["id"]}}'></td>
          <td class="copyunits-maincolumn">
            {{ $assignment['title'] }} 
          </td>
          <td>{{ $assignment['starts_on'] }}</td>
          <td>{{ $assignment['ends_on'] }}</td>
       </tr> 
       @empty
       @endforelse    
    </table>
  </div>
</form>