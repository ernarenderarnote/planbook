<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> To Assignments
  </div>
</div>
<div class="copy-classtable unitscopytable">
  <table border="1">
     <tr class="unittable-headmain">
        <th class="unittable-first">Assignments</th>
        <th>Start</th>
        <th>End</th>
     </tr>

     @forelse($assignments as $assignment)
      <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$assignment['id']}}">
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