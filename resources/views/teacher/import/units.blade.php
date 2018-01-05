<div class="copy-contentbottom unitbottoomsection">
        <div class="copy-botomtext"> FROM Units 
        </div>
     </div>
     <div class="copy-classtable unitscopytable">
        <table border="1">
          <thead>
           <tr class="unittable-headmain">
              <th class="unittable-first">Unit
              </th>
              <th> Start
              </th>
              <th>End
              </th>
           </tr>
          </thead> 
            <tbody id='importUnitsFromBody'> 
             @forelse($unitsGet as $unit)
              @php $countLessons = count($unit->lessons); @endphp

              <tr class="unittable-relativemain copy-descriptionfield" data-id="{{$unit['id']}}">
                <td class="copyunits-maincolumn">
                   <i class="fa fa-arrow-right copyunits-arrowright" aria-hidden="true" id="copyunits-arrowmain">
                   </i> 
                   <i class="fa fa-arrow-down" aria-hidden="true">
                   </i>{{$unit['unit_id']}} {{ $unit['unit_title'] }}({{$countLessons}} lessons) 
                </td>
                <td>{{ $unit['starts_on'] }}</td>
                <td>{{ $unit['ends_on'] }}</td>
             </tr> 
           
           <tr>
            <td colspan="3" class="copyunitsinner-data">
                 <div class="copyunits-tableinner" id="copyunits-tableinner1">
                    <table id="unitDrags">
                       <tr>
                          <th>Date</th>
                          <th class="copyunitsinner-column">Lesson</th>
                       </tr>
                       
                         @foreach($unit->lessons as $lesson )
                          @php $date_get = $lesson['lesson_date'];
                          $newDate = date("l d-m-Y", strtotime($date_get));
                          @endphp
                          <tr>
                            <td>{{ $newDate }}</td>
                            <td>{{ $lesson['lesson_title'] }}</td>
                         </tr>
                         @endforeach
                       </tbody>  
                    </table>
                 </div>
              </td> 
           </tr>
          
           @empty
           @endforelse    
        </table>
     </div>