  @if($code == 1 || $code==3)
    @php
    $firstDay     = auth()->user()->selectedYear()->first();
    $end          = '';
    $start        = '';
    $visibleDay   = array();
    $lesson_title = array();
    $lesson_date  = array();
    $homework     = array();
    $notes        = array();
    $standard     = array();
    $lesson_txt   = array();
    $lessons_id   = array();
    $arr_length   = count($user_lessons);
  @endphp  
   
  @forelse($classes as $user_data)
    @php
      $end          = $user_data['end_date'];
      $start        = $user_data['start_date'];
      $working_days = $user_data->class_schedule;
      $visibleDay   = collect(json_decode($user_data->class_schedule))->where("is_class", "1")->pluck("text")->all();
    @endphp
    @empty
  @endforelse
   @if(isset($date_filter))
    @php $datesget = explode('+',$date_filter);
         $end_filter_date   =  $datesget[1];
         $start_filter_date =  $datesget[0];  
         $datediff = strtotime($end_filter_date) - strtotime($start_filter_date);
         $datediff = $datediff/(60*60*24);     
    @endphp
    @else
    @php
    $datediff = strtotime($end) - strtotime($start);
    $datediff = floor($datediff/(60*60*24));
  @endphp
   @endif
  

  @forelse($user_lessons as $lessons)
    @php
      $lesson_date[]  = $lessons->lesson_date ;
      $lesson_title[] = $lessons->lesson_title;
      $homework[]     = $lessons->homework;
      $notes[]        = $lessons->notes;
      $standard[]     = $lessons->standards;
      $lesson_txt[]   = $lessons->lesson_text;
      $lesson_id[]    = $lessons->id; 
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
          
            <tr class="ui-widget-content" data-lesson="">
              <td>{{ $k }}</td>
              <td data-lesson='{{$dates[1]}}'>{{ $all_dates }}</td>
              <td class="copy-descriptionfield copy-descriptiontext">
              @if (count($lesson_date)>=1)
                @for($j=0;$j < $arr_length;$j++ )
                  @if(in_array($lesson_date[$j],$dates))
                    @if($lesson_id[$j]) 
                     <span class='lessonClass' data-id="{{$lesson_id[$j]}}"></span> 
                    @endif 
                     <h5>{{ $lesson_title[$j] }}</h5>
                    @if($lesson_txt[$j])
                     {!! $lesson_txt[$j] !!}
                    @endif
                    @if($homework[$j])
                      <h5>Homework</h5>
                     {!! $homework[$j] !!}
                    @endif  
                    @if($notes[$j])
                      <h5>Notes</h5>
                      {!! $notes[$j] !!}
                    @endif    

                  @endif
                @endfor
              @endif  
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
  $response = 'units';
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
                    </table>
                 </div>
              </td> 
           </tr>
          
           @empty
           @endforelse    
        </table>
     </div>

                    
  @endif


  
      
     