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
     