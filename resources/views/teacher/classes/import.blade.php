@extends('layouts.teacher')

@section('content')
<div id="main-loader" class="pageLoader" style="display:none">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
</div>
<div class="clearfix"></div>
<div class="copy-header"> Copy Lessons </div>
<div class="copy-content">
    <div class="row">
        <div class="col-md-6">
            <div class="copy-contentheader"> Copy From </div>
            <div class="list-contentbutton">
                <div class="btn-group">
                    <button id="lessonBtn" type="button" class="lessonbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lessons<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown lselected">
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-toggle="modal" data-target="#importcsv">Lessons</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton"  data-toggle="modal" data-target="#addteacher">Units</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button id="teacherBtn" type="button" class="teacherbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Teacher<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown tselected">
                        <li class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton">My Classes </a></li>
                        <li id="copyCsv" class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton" data-toggle="modal" data-target="#importcsv">Import CSV </a></li>
                        <li class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton"  data-toggle="modal" data-target="#addteacher">Add Teacher </a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" id="yearbtn" class="yearbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select Year<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown yselected">
                        @php //print_r($user_selected_school_year); @endphp
                        @forelse($user_selected_school_year as $year=>$value)
                        <li class="yearselected"><a href="#" class="language-dropbutons unitdropbuton" target_date="{{ $value['year_name'] }}">{{ $value['year_name'] }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" id="classbtn" class="classbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select Class<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown uselected">
                       
                        @forelse($user_classes as $class)
                        <li><a href="#" class="language-dropbutons unitdropbuton" target_id = "{{ $class->id }}">{{ $class->class_name }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
           </div>
            <div class="copy-textcontent copy-contentleft">
                <p> Date range to copy (leave empty for ALL lessons)</p>
                <input class="form-control copy-inputs datepicker" type="text">
                <span class="date-rangetext">to</span>
                <input class="form-control copy-inputs datepicker" type="text">
                <button class="btn  btn-primary showlessonbutton">Show Lesson</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="copy-contentheader"> Copy To </div>
            <div class="list-contentbutton">
                <div class="btn-group">
                    <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select Class<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown dropTableClass">
                        @forelse($user_classes as $class)
                        <li><a href="#" class="language-dropbutons unitdropbuton" target_id="{{$class->id}}">{{ $class->class_name }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="copy-textcontent">
                <div class="copy-textcontent-left">
                     <p> Where to place copied lessons</p>
                     <p>
                        <input  name="importOptions" id="append" value="A" type="radio">
                        AFTER existing lessons
                     </p>
                     <p>
                        <input  name="importOptions" id="replace" value="I" type="radio">
                        INSERT starting at
                        <input class="form-control copy-inputs datepicker" id="demo7" type="text" disabled="disabled">
                </div>
                <div class="copy-textcontent-right">
                    <button class="btn  btn-primary"> Copy Lesson</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 " >
           <div class="copy-contentbottom">
                <div class="copy-botomtext"> FROM Lessons </div>
                <div class="copy-botombuttons">
                     <button class="btn btn-primary">Today </button>
                     <div class="btn  btn-primary copytablemain-button"> <span class="copyhide-button">Hide Details</span> <span class="copyshow-button">Show Details</span> </div>
                </div>
            </div> 
            <div class="lessonCopyCalendar">

            </div>        
                 
        </div>
        <div class="col-md-6">
            <div class="copy-contentbottom">
                <div class="copy-botomtext"> TO Lessons </div>
                <div class="copy-botombuttons">
                    <button class="btn btn-primary">Today </button>
                    <div class="btn  btn-primary copytablemain-button"> <span class="copyhide-button">Hide Details</span> <span class="copyshow-button">Show Details</span> </div>
                </div>
            </div>
          <div class="lessonPasteCalendar">

          </div>    
            
        </div>
    </div>
</div>
<div id="pastemodal" class="modal fade movemodalcontent pastemodalcontent" role="dialog" style="display: none;">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p></p>
        <div class="button-group">
          <button class="renew-button return-button" data-dismiss="modal"> Return</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Import Students popup start-->
<div id="importstudents" class="modal fade movemodalcontent importstudentcontent" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Import Students</h4>
      </div>
      <div class="modal-body">
        <p>To ensure a valid import, please make sure that your CSV file is formatted correctly.</p>
        <p>To view a sample CSV file, <a href="../help/students.csv" download="students">click here</a></p>
        <form method="post" action="#" class="importstudent-form">
             <div class="form-group">
             <label for="importStudentsFile">Filename</label>
             <input type="file"  name="importStudentsFile" size="45" >
             </div>
     
        <div class="button-group">
          <button class="renew-button"  data-dismiss="modal"> Import File</button>
         
          <button class="close-button" data-dismiss="modal"> Cancel</button>
        </div>
           </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
    <script>
        $(".copytablemain-button").click(function(){
             $(".copytablemain-button").toggleClass("copyshowmain");
        });
        
        $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
        $('.timepicker').timepicker({
            'timeFormat': 'h:i A',
            'scrollDefault' : '8:00am',
            'forceRoundTime' : false,
        });
    </script>

    <script>
        function draganddrop(){
          $( "#draggable tr .copy-descriptionfield" ).draggable({
            start: function( event, ui ) { 
               $(ui.item).css("background",'yellow');
            },
            stop:function( event, ui ) { 
               $(ui.item).removeClass("yellow");
            },
                    
            containment : 'document',
            helper:"clone",
            zIndex: 999990,
            appendTo: 'body',
            cursor: 'move',
            live: true,
            color:'blue'
          });
          $( "#droppable .copy-descriptionfield" ).droppable({
            drop: function( event, ui ) {
              $(this)
                .addClass( "ui-state-highlight" )
                .html(ui.draggable.html());
                console.log($(this).prev('td').text());
               }
          });
        } 
        var lselected;
        var tselected;
        var yselected;
        var uselected;
        var class_id;
        $('.lselected li a').on('click',function(e){ 

            lselected        = $(this).text();
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(lselected +' <span class="caret"></span>');
            if(typeof tselected != 'undefined' && typeof lselected != 'undefined' &&typeof yselected != 'undefined' && typeof uselected != 'undefined'){
              console.log(lselected+''+tselected+''+yselected+''+uselected);
                ajaxCall();
            }

         });
        $('.tselected li a').on('click',function(e){ 
             tselected        = $(this).text();
            if(typeof tselected != 'undefined' && typeof lselected != 'undefined' &&typeof yselected != 'undefined' && typeof uselected != 'undefined'){
              console.log(lselected+''+tselected+''+yselected+''+uselected);
                ajaxCall();
            }
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(tselected +' <span class="caret"></span>');
         });
        $('.yselected li a').on('click',function(e){
           
            if(typeof tselected != 'undefined' && typeof lselected != 'undefined' &&typeof yselected != 'undefined' && typeof uselected != 'undefined'){
              console.log(lselected+''+tselected+''+yselected+''+uselected);
                ajaxCall();
            }
            if(typeof tselected != 'undefined'){ 
              yselected     = $(this).text();
              var background   = $(this).css('background-color');
              $(this).parents('.btn-group').find('.btn').html(yselected +' <span class="caret"></span>');
            }
            else{
              var text = 'Please select a Teacher'; 
              $('#pastemodal .modal-body p').text(text);
              $('#pastemodal').modal();
            }
           
         });
        $('.uselected li a').on('click',function(e){
           class_id = $(this).attr('target_id');
           if(typeof yselected != 'undefined'){  
            uselected     = $(this).text();
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(uselected +' <span class="caret"></span>');
          }
          else{
              var text = 'Please select School Year'; 
              $('#pastemodal .modal-body p').text(text);
              $('#pastemodal').modal();
          }
          if(typeof tselected != 'undefined' && typeof lselected != 'undefined' &&typeof yselected != 'undefined' && typeof uselected != 'undefined'){
            ajaxCall();
            }

         });

        function ajaxCall(){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/classes/importcalendar',
            data:{type:lselected,teacher:tselected,year:yselected,class_id:class_id},

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              var html = '';
              //console.log(response);
              $('.lessonCopyCalendar').html(response);
              draganddrop();
              },


            error: function(data){
              console.log("error");
              console.log(data);
            }

          });

        };
    </script>
    <script>
    $('.dropTableClass li a').on('click',function(e){ 
            
            lselected        = $(this).text();
            var background   = $(this).css('background-color');
            var id = $(this).attr('target_id');
            $(this).parents('.btn-group').find('.btn').html(lselected +' <span class="caret"></span>');
            $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/classes/importcalendar/'+id,
            //dataType: 'json',
            
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
              var html = '';
              //console.log(response);
              $('.lessonPasteCalendar').html(response);
              draganddrop();
              
              },


            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
          e.preventDefault();
         });
    </script>
     <script>
         $(document).on('click',".copyunits-arrowright",function(){
          $(this).parents().next('tr').find(".copyunits-tableinner ").toggle();
         }); 
         $('#copyCsv').click(function(){
            $('#importstudents').modal();
         });  
      </script>


@endpush

