  
  @php $count='1'; 
  use App\Unit;
  @endphp 
  @forelse($user_lessons as $key=>$values)
  @php $date = explode(' ',$key);@endphp
  <tr>
  @forelse($values as $value)
    <td class="list-tablecolumn1 list-column" style="border:1px solid {{$class_color}} ; background-color:{{$class_color}}">
      <span class="caret downarrowtoggle list-tablecaret1"></span>
      <div class="lesondropdown leson-tablelist">
      <div class="lessondropdown-header"> Lesson Actions 
        <span class="cross-icon copydropcrossicons"> 
          <i class="fa fa-close" aria-hidden="true"></i>
        </span>
      </div>
      <div class="lesondropdown-body lessondrop-bodymain">
        <ul>
          <li class="editBtn" id="editBtn" targetID = "{{$class_id}}" targetDay = "{{$date[0]}}"  targetDate="{{$key}}"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Lesson</li>
          <li data-toggle="modal" id="moveBtn" targetID = "{{$class_id}}" targetClass = "{{$class_id}}"  targetDate="{{$key}}"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
          <li class="copy-field"> <i class="fa fa-copy" aria-hidden="true"></i> Copy
            <div class="dropdown copy-dropdown">
              <button class="btn btn-copy dropdown-toggle" type="button" data-toggle="dropdown"> All
                <div class="caret-button"><span class="caret"></span></div>
              </button>
              <ul class="dropdown-menu copydropdown-inner">
                 <li>All Selection</li>
                 <li>
                  <input type="checkbox">
                  Lesson </li>
                 <li>
                  <input type="checkbox">
                  Homework </li>
                 <li>
                  <input type="checkbox">
                  Notes </li>
                 <li>
                  <input type="checkbox">
                  Standards </li>
                 <li>
                  <input type="checkbox">
                  Attachments </li>
                 <li>Done</li>
              </ul>
            </div>
          </li>
          <li data-toggle="modal" data-target="#pastemodal"> <i class="fa fa-paste" aria-hidden="true"></i> Paste</li>
          <li> 
            <i class="fa fa-arrow-right" aria-hidden="true"></i> 
            <span class="weekBump" token="{{ csrf_token() }}" targetID = "{{$class_id}}" targetDate="{{$date[1]}}">Bump</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li>
            <i class="fa fa-arrow-left" aria-hidden="true"></i> 
            <span class="weekBack" token="{{ csrf_token() }}" targetID = "{{$class_id}}" targetDate="{{$date[1]}}">Back</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li> 
            <i class="fa fa-forward" aria-hidden="true"></i>
            <span class="weekExtend" token="{{ csrf_token() }}" targetID = "{{$class_id}}" targetDate="{{$date[1]}}">Extend Lesson</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li>
            <i class="fa fa-forward" aria-hidden="true"></i>
            <span class="weekStandardsExtend" token="{{ csrf_token() }}" targetID = "{{$class_id}}" targetDate="{{$date[1]}}"> Extend Standards</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li class="deleteLessons" data-toggle="modal" token="{{ csrf_token() }}" targetID = "{{$class_id}}" targetDate="{{$date[1]}}" ><i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
          <li data-toggle="modal" token="{{ csrf_token() }}" data-target="#movemodal"><i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
        </ul>
      </div>
    </div>  
    </td>
    @empty
      <td class="list-tablecolumn1 list-column" style="border:1px solid {{$class_color}} ; background-color:{{$class_color}}" >
      <span class="caret downarrowtoggle list-tablecaret1"></span>
      <div class="lesondropdown leson-tablelist">
      <div class="lessondropdown-header"> Lesson Actions 
        <span class="cross-icon copydropcrossicons"> 
          <i class="fa fa-close" aria-hidden="true"></i>
        </span>
      </div>
      <div class="lesondropdown-body lessondrop-bodymain">
        <ul>
          <li class="editBtn" id="editBtn" targetID = "{{$class_id}}" targetDay = "{{$date[0]}}"  targetDate="{{$key}}"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Lesson</li>
          <li data-toggle="modal" id="moveBtn" targetID = "{{$class_id}}" targetClass = "{{$class_id}}"  targetDate="{{$key}}"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
          <li class="copy-field"> <i class="fa fa-copy" aria-hidden="true"></i> Copy
            <div class="dropdown copy-dropdown">
              <button class="btn btn-copy dropdown-toggle" type="button" data-toggle="dropdown"> All
                <div class="caret-button"><span class="caret"></span></div>
              </button>
              <ul class="dropdown-menu copydropdown-inner">
                 <li>All Selection</li>
                 <li>
                  <input type="checkbox">
                  Lesson </li>
                 <li>
                  <input type="checkbox">
                  Homework </li>
                 <li>
                  <input type="checkbox">
                  Notes </li>
                 <li>
                  <input type="checkbox">
                  Standards </li>
                 <li>
                  <input type="checkbox">
                  Attachments </li>
                 <li>Done</li>
              </ul>
            </div>
          </li>
          <li data-toggle="modal" data-target="#pastemodal"> <i class="fa fa-paste" aria-hidden="true"></i> Paste</li>
          <li> 
            <i class="fa fa-arrow-right" aria-hidden="true"></i> 
            <span class="weekBump" token="{{ csrf_token() }}" targetID = "" targetDate="">Bump</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li>
            <i class="fa fa-arrow-left" aria-hidden="true"></i> 
            <span class="weekBack" token="{{ csrf_token() }}" targetID = "" targetDate="">Back</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li> 
            <i class="fa fa-forward" aria-hidden="true"></i>
            <span class="weekExtend" token="{{ csrf_token() }}" targetID = "" targetDate="">Extend Lesson</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li>
            <i class="fa fa-forward" aria-hidden="true"></i>
            <span class="weekStandardsExtend" token="{{ csrf_token() }}" targetID = "" targetDate=""> Extend Standards</span>
            <div class="copy-incrementfunction">
              <input type="button" class="decrementBtn" value="-" >
              <input type="text" value="1" class="copydropdown-value">
              <input type="button" class="incrementBtn" value="+" >
            </div>
          </li>
          <li class="deleteLessons" data-toggle="modal" token="{{ csrf_token() }}" targetID = "" targetDate="" ><i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
          <li data-toggle="modal" token="{{ csrf_token() }}" data-target="#movemodal"><i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
        </ul>
      </div>
    </div>  
    </td>
    @endforelse
    <td class="list-tablecoloumn2 list-column2">-</td>
    <td>{{$count}}</td>
    @forelse($values as $value)
      @if($value->units!='')    
      <td><span style="background-color:{{$class_color}}; padding:5px; color:#fff;">{{$value->units->unit_id}}</span>{{ $value->units->unit_title }} </td>
      @else
      <td></td>
      @endif

    @empty
      <td></td>
    @endforelse
    <td>{{$date[1]}}</td>
    <td>{{$date[0]}}</td>
    @forelse($values as $value)
    <td class="details-lessons">
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
    <td></td>
    @endforelse
  </tr>
  @php $count++; @endphp
  @empty

  @endforelse
  <script src="{{ asset('/js/common_action.js') }}"></script>