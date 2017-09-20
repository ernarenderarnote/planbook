  @if($code == 1 || $code==3)
    @php
    $end = '2018-02-28';
    $start = '2017-03-01';
    $visibleDay = array();
    $lesson_title = array();
    $lesson_date = array();
  @endphp    
  @forelse($classes as $user_data)
         @php
         $working_days = $user_data->class_schedule;
         $visibleDay = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
         @endphp
  @empty

  @endforelse

  @php
    $datediff = strtotime($end) - strtotime($start);
    $datediff = floor($datediff/(60*60*24));
  @endphp
   @forelse($user_lessons as $lessons)
        @php $lesson_date[]  = $lessons->lesson_date ;
             $lesson_title[] = $lessons->lesson_title;
         @endphp
        @empty

      @endforelse  
     @php  
         $k = '1';
         @endphp
    
            <div class="copy-classtable">
                @if($code==1)
                
                  <table border="1" id="draggable" class="lessonCalendar">  
                @else
                  <table border="1" id="droppable" class="lessonCalendar">  
                 @endif   
    @for($i = 0; $i < $datediff + 1; $i++)
       @php
        
       $all_dates = date("l Y-m-d", strtotime($start . ' + ' . $i . 'day'));
        $dates = explode(' ',$all_dates);
        @endphp
         @if(in_array($dates[0],$visibleDay))
          
            <tr class="ui-widget-content">
              <td>{{ $k }}</td>
              <td>{{ $all_dates }}</td>
              <td class="copy-descriptionfield">
              @for($j=0;$j<=1;$j++ )
              @if(in_array($lesson_date[$j],$dates))
              {{ $lesson_title[$j] }}

              @endif
              @endfor
               @php $k++ @endphp
              </td>
              
            </tr>
            
        @endif
       
    @endfor 
   </table>
                </div>  
  @endif
   @if($code == 2)
  @php 

  @endphp
     <div class="copy-contentbottom unitbottoomsection">
                  <div class="copy-botomtext"> FROM Units 
                  </div>
               </div>
               <div class="copy-classtable unitscopytable">
                  <table border="1">
                     <tr class="unittable-headmain">
                        <th class="unittable-first">Unit
                        </th>
                        <th> Start
                        </th>
                        <th>End
                        </th>
                     </tr>
                     @forelse($unitCount as $unit=>$val)
                      
                      
                      <tr class="unittable-relativemain">
                        <td class="copyunits-maincolumn">
                           <i class="fa fa-arrow-right copyunits-arrowright" aria-hidden="true" id="copyunits-arrowmain">
                           </i> 
                           <i class="fa fa-arrow-down" aria-hidden="true">
                           </i>{{ $unit }} (lessons) 
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                     </tr> 
                     <tr>
                      <td colspan="3" class="copyunitsinner-data">
                           <div class="copyunits-tableinner" id="copyunits-tableinner1">
                              <table>
                                 <tr>
                                    <th>Date</th>
                                    <th class="copyunitsinner-column">Lesson</th>
                                 </tr>
                                 @foreach($val as $v)
                                  @php $date_get = $v->lesson_date;
                                  $newDate = date("l d-m-Y", strtotime($date_get));
                                  @endphp
                                 <tr>
                                    <td>{{ $newDate }}</td>
                                    <td>{{ $v->lesson_title }}</td>
                                 </tr>
                                  @endforeach
                              </table>
                           </div>
                        </td> 
                     </tr>
                     
                      


                    
                     @empty
                     @endforelse
                     
                     
                  </table>
               </div>

                    
  @endif


  
      
     