<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> FROM Classes 
  </div>
</div>
<form id="ClassForm" action=''>
<div class="copy-classtable unitscopytable">

  <table border="1">
    
    {{  csrf_field() }}
     <tr class="unittable-headmain">
        <th class=""><input type="checkbox" id="checkAll" ></th>
        <th class="unittable-first">Class</th>
        <th> Start</th>
        <th>End</th>
     </tr>

     @forelse($classes as $class)
      <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$class['id']}}">
        <td><input type="checkbox" name="class_id[]" value='{{$class["id"]}}'></td>
        <td class="copyunits-maincolumn">
          {{ $class['class_name'] }} 
        </td>
        <td>{{ $class['start_date'] }}</td>
        <td>{{ $class['end_date'] }}</td>
     </tr> 
     @empty
     @endforelse  
     
   
  </table>
</div>
</form> 
