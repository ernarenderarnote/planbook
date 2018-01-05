<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> FROM Students
  </div>
</div>
<form id="StudentsForm" action=''>
{{csrf_field()}}
  <div class="copy-classtable unitscopytable">
    <table border="1">
       <tr class="unittable-headmain">
          <th class=""><input type="checkbox" id="checkAll"></th>
          <th class="unittable-first">Students ID</th>
          <th>Name</th>
          <th>Email</th>
       </tr>

       @forelse($students as $student)
        <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$student['id']}}">
          <td><input type="checkbox" name="student_id[]" value='{{$student["id"]}}'></td>
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
</form>  