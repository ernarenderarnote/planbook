<div class="listtab-content tab-content" id="ActiveCalendar">
  <div class="listcontent tab-pane active in" id="list">
      <div class="date list-header"> List View </div>
      <div class="list-contentbutton">
        <div class="btn-group">
          <button type="button" class="btn classBtn unitsbutton list-contentmainbuton dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target_id="0"> All Classes<span class="caret"></span> </button>
          <ul class="dropdown-menu language-dropdown">
            @forelse($classes as $className)
              <li class="classSelected">
                <a href="#" class="language-dropbutons  unitdropbuton" style="background-color:{{ $className['class_color'] }}; color: #fff;" target_id = "{{$className['id']}}">
                  {{ $className['class_name'] }}
                </a>
              </li> 
              @empty
            @endforelse
          </ul>
        </div>  
        <div class="btn-group">
          <button type="button" class="btn unitBtn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target_id=''> All Units<span class="caret"></span> </button>
            <ul class="dropdown-menu language-dropdown">
            <li class="unitSelected">
              <a href="#" class="language-dropbutons unitdropbuton">
                All Units 
              </a>
            </li>
            @forelse($units as $unit)
              <li class='unitSelected'>
                <a href="#" class="unit-dropbutons language-dropbutons" style="background-color:{{ $unit->class_color }}; color: #fff;">
                  {{ $unit->unit_title}}
                </a>
              </li>  
              @empty
                @endforelse
            </ul> 
        </div>
        <div class="btn-group">
          <button type="button" class="btn unitsbutton list-contentmainbuton"> Today </button>
        </div>
        <div class="btn-group">
          <div type="button" class="btn unitsbutton list-contentmainbuton listcontenthide"> <span class="hide-detailslist"> Hide Detail</span> <span class="show-detailslist">Show Detail</span></div>
        </div>
        <div class="btn-group">
          <a href="{{route('teacher.dashboard.index',['view'=>'week'])}}" class="btn unitsbutton list-contentmainbuton"> Return to Week</a>
        </div>
      </div>
      <div class="lesson-text"> Lesson </div>
      <div class="list-contenttable">
        <table class="table">
          <thead>
            <tr class="table-header">
              <th class="first-feild" colspan="3"></th>
              <th class="midle-fields"> Unit</th>
              <th class="midle-fields">Date</th>
              <th class="midle-fields">Day</th>
              <th class="last-field">Lesson</th>
            </tr>
          </thead>
          <tbody class="listResponse">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>  
  <div class="d-render-popoup t-data-popup" id="dynamicRenderDiv" style="display:none;">
  </div>
  <div id="deletemodal" class="modal fade movemodalcontent" role="dialog" style="display: none;">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Lesson</h4>
        </div>
        <div class="modal-body">
          <p>Would you like your lessons shifted back to accommodate for the deleted lesson?</p>
          <div class="button-group">
            <button class="renew-button wshiftLessons" data-dismiss="modal"> Shift Lessons</button>
            <button class="renew-button wnshiftLessons" data-dismiss="modal"> Do not Shift Lessons</button>
            <button class="close-button" data-dismiss="modal"> Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  /*Change the text of selected  button*/
  $('.classSelected a').on('click',function(){  
    var class_id   = $(this).attr('target_id');
    var classVar   = $(this).text();
    var background = $(this).css('background-color');
      $('.classBtn').html(classVar +' <span class="caret"></span>');
      $('.classBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
      $('.classBtn').attr('target_id',class_id);
      $.ajax({
        type:'GET',
        url: BASE_URL +'/teacher/dashboard/listClasses/'+class_id,
        beforeSend: function () {
        $('.pageLoader').show();
        },
        complete: function () {
        //obj.html('Sent <i class="fa fa-send"></i>');
        },

        success: function (response) {
          $('.listResponse').html(''); 
          $('.pageLoader').hide();
          $('.listResponse').append(response);
          
        },


        error: function(data){
        console.log("error");
        console.log(data);
        }

      });

  });
  </script>