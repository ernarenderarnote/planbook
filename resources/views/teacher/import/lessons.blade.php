<div class="copy-classtable">
    <table border="1" id="droppable" class="lessonCalendar"> 
    @php $count='1'; @endphp 
      @forelse($user_lessons as $key=>$values)
            <tr class="ui-widget-content" data-lesson="">
              <td>{{$count}}</td>
              <td data-lesson=''>{{$key}}</td>
              @forelse($values as $value)
              <td class="copy-descriptionfield copy-descriptiontext">
                <span class='lessonClass' data-id="{{$value['id']}}"></span>  
                    <h5>{{$value['lesson_title']}}</h5>
                    @if($value['lesson_txt'])
                     {!! $value['lesson_txt'] !!}
                    @endif
                    @if($value['homework'])
                      <h5>Homework</h5>
                     {!! $value['homework'] !!}
                    @endif  
                    @if($value['notes'])
                      <h5>Notes</h5>
                      {!! $value['notes'] !!}
                    @endif                             
              </td>
              @empty
              <td class="copy-descriptionfield copy-descriptiontext"></td>
              @endforelse
            </tr>
        @php $count++; @endphp    
        @empty    
      @endforelse
     </table>
</div>