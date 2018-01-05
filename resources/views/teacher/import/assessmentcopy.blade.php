<div class="copy-contentbottom unitbottoomsection">
  <div class="copy-botomtext"> To Assessments
  </div>
</div>

<div class="copy-classtable unitscopytable">
  <table border="1">
     <tr class="unittable-headmain">
        <th class="unittable-first">Assessment</th>
        <th>Start</th>
        <th>End</th>
     </tr>
     <input type="hidden" id="copyClassID" name="class_id" value="">
     @forelse($assessments as $assessment) 
      <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$assessment['id']}}">
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