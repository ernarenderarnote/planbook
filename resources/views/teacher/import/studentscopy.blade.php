<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> To Students
  </div>
</div>
<div class="copy-classtable unitscopytable">
  <table border="1">
     <tr class="unittable-headmain">
        <th class="unittable-first">Students</th>
        <th>Name</th>
        <th>Email</th>
     </tr>

     @forelse($students as $student)
      <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$student['id']}}">
        <td class="copyunits-maincolumn">
          {{ $student['studentID'] }}
        </td>
        <td> {{ $student['last_name'] }} , {{$student['name']}} </td>
        <td>{{ $student['email'] }}</td>
     </tr> 
     @empty
     @endforelse    
  </table>
</div>