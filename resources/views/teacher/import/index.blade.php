@extends('layouts.teacher')

@section('content')
<div class="lesson-copiedmain" style="display:none;">
<span>Lessons copied</span>
</div>
<div id="main-loader" class="pageLoader" style="display:none">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
</div>
<div class="clearfix"></div>
<div class="copy-header"> Copy Lessons </div>
<div class="copy-content">
    <div class="row">
        <input type="hidden" value="{{auth()->user()->id}}" id="user_id">
        <div class="col-md-6">
            <div class="copy-contentheader"> Copy From </div>
            <div class="list-contentbutton">
                <div class="btn-group">
                    <button id="lessonBtn" type="button" class="lessonbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" btn-type="Lessons">Lessons<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown lselected">
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='1'>Classes</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='2'>Assessment</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='3'>Assignment</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='4'>Lessons</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='5'>Students</a></li>
                        <li class="selectedlessons"><a href="#" class="language-dropbutons unitdropbuton" data-type='6'>Units</a></li>

                    </ul>
                </div>
                <div class="btn-group">
                    <button id="teacherBtn" type="button" class="teacherbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id>Select Teacher<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown tselected">
                        <li class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton" data-val='{{Auth::user()->id}}'>My Classes </a></li>
                        <li id="copyCsv" class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton" data-toggle="modal" data-target="#importcsv">Import CSV </a></li>
                        @forelse($teachers as $meta)

                          <li class=""><a href="#" class="language-dropbutons unitdropbuton"  id="" data-val='{{$meta->teacher_id}}'>{{$meta->usermeta->email}}</a></li>
       
                        @empty
                        @endforelse
                       
                        <li class="tacherselected"><a href="#" class="language-dropbutons unitdropbuton"  id="addteacher">Add Teacher </a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" id="yearbtn" class="yearbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select Year<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown yselected">
                      
                        <li class="yearselected"><a href="#" class="language-dropbutons unitdropbuton" target_date=""></a></li>
                     
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" id="classbtn" class="classbtn btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select Class<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown uselected"> 
                       
                        <li><a href="#" class="language-dropbutons unitdropbuton" target_id = ""></a></li>
                       
                    </ul>
                </div>
            </div>
            <div class="copy-textcontent copy-contentleft">
                <p> Date range to copy (leave empty for ALL lessons)</p>
                <input class="form-control copy-inputs filter-start-date" value='' type="text">
                <span class="date-rangetext">to</span>
                <input class="form-control copy-inputs filter-end-date"  value='' type="text">
                <button class="btn  btn-primary showlessonbutton">Show Lesson</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="copy-contentheader"> Copy To </div>
            <div class="list-contentbutton">
                <div class="btn-group">
                    <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" id="copyTo" aria-expanded="false"> Select Class<span class="caret"></span> </button>
                    <ul class="dropdown-menu language-dropdown dropTableClass">
                      @forelse($classes as $class)  
                        <li><a href="#" class="language-dropbutons unitdropbuton" target_id="{{$class['id']}}">{{$class['class_name']}}</a></li>
                      @empty
                      @endforelse  
                    </ul>
                </div>
                <div class="btn-group">
                    @forelse($years as $year)
                      <input type ='hidden' value="{{$year['id']}}" id="copyYear">
                    @empty
                    @endforelse 
                  <button style="display:none" type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" id="copyToYear" aria-expanded="false">Year<span class="caret"></span> </button>
                   <ul class="dropdown-menu language-dropdown dropYear">
                    @forelse($years as $year)  
                      <li><a href="#" class="language-dropbutons unitdropbuton" target_id="{{$year['id']}}">{{$year['year_name']}}</a></li>
                    @empty
                    @endforelse  
                  </ul>
                </div>
            </div>
            <div class="copy-textcontent">
                <div class="copy-textcontent-left">
                     <p> Where to place copied lessons</p>
                     <p>
                        <input  name="importOptions" id="append" value="A" type="radio" checked>
                        AFTER existing lessons
                     </p>
                     <p>
                        <input  name="importOptions" id="replace" value="I" type="radio">
                        INSERT starting at
                        <input class="form-control copy-inputs datepicker" id="demo7" type="text" disabled="disabled">
                </div>
                <div class="copy-textcontent-right">
                    <button class="btn copybutton btn-primary" id="copyImportLessons"> Copy Lesson</button>
                    <button class="btn  btn-primary" id="copyImportUnits" style='display:none'> Copy Units</button>
                    <button type="button" class="btn  btn-primary" id="copyImportClass" style='display:none'> Copy Classes</button>
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
<div class="d-render-popoup t-data-popup modal fade movemodalcontent addteachercontent in" id="dynamicRenderDiv" role="dialog">
  

</div>
@endsection

@push('js')
    <script>
        $(".copytablemain-button").click(function(){
             $(".copytablemain-button").toggleClass("copyshowmain");
        });
        
        $('.datepicker').datepicker();
        $('.timepicker').timepicker({
            'timeFormat': 'h:i A',
            'scrollDefault' : '8:00am',
            'forceRoundTime' : false,
        });
    $(document).ready(function(){ 
        var type       = '';
        var teacher_id = '';
        var year       = '';
        var class_id   = '';   
        var d1  =  $.Deferred();
        var d2  =  $.Deferred();
        var d3  =  $.Deferred();
        var d4  =  $.Deferred();
        
        /*Type selected to copy*/
        
        $('.lselected li a').on('click',function(e){ 
            $('.lessonCopyCalendar').html('');
            $('#yearbtn').html('Select Year<span class="caret"></span> ');
            type = $(this).attr('data-type');
            lselected        = $(this).text();
            var textData = '';
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(lselected +' <span class="caret"></span>');
            $(this).parents('.btn-group').find('.btn').attr('btn-type',lselected);
            switch(type) {
                case '1':
                  
                  textData = '<p>Select items and one or more classes to copy FROM below.</p>';
                  $('#classbtn').hide();
                  $('#teacherBtn').show();
                  $('#copyToYear').show();
                  $('#copyTo').hide();
                  $('.copybutton').attr('id','copyImportClass');
                  $('.copybutton').text('Copy Classes');
                  $('.copy-contentleft').html(textData);
                  $('.copy-textcontent-left').hide();
                break;
                case '2':
                  textData = '<p>Select items and one or more Assessments to copy FROM below.</p>';
                  $('#classbtn').show();
                  $('#teacherBtn').show();
                  $('#copyToYear').hide();
                  $('#copyTo').show();
                  $('.copy-contentleft').html(textData);
                  $('.copy-textcontent-left').hide();
                  $('.copybutton').attr('id','copyImportAssessment');
                  $('.copybutton').text('Copy Assessments');
                break;
                 case '3':
                  textData = '<p>Select items and one or more Assignments to copy FROM below.</p>';
                  $('#classbtn').show();
                  $('#teacherBtn').show();
                  $('#copyToYear').hide();
                  $('#copyTo').show();
                  $('.copybutton').attr('id','copyImportAssignment');
                  $('.copybutton').text('Copy Assignment');
                  $('.copy-contentleft').html(textData);
                  $('.copy-textcontent-left').hide();
                break;
                 case '4':
                  $('#classbtn').show();
                  $('#teacherBtn').show();
                  $('#copyToYear').hide();
                  $('#copyTo').show();
                  $('.copybutton').attr('id','copyImportLessons');
                  $('.copybutton').text('Copy Lessons');
                  $('.copy-textcontent-left').show();
                break;
                 case '5':
                  textData = '<p>Select one or more students to copy FROM below.</p>';
                  $('#classbtn').hide();
                  $('#teacherBtn').hide();
                  $('#copyToYear').show();
                  $('#copyTo').hide();
                  $('.copybutton').attr('id','copyImportStudents');
                  $('.copybutton').text('Copy Students');
                  $('.copy-contentleft').html(textData);
                  $('.copy-textcontent-left').hide();
                break;
                 case '6':
                  textData = '<p>Select items and a unit to copy FROM below.</p>';
                  $('#classbtn').show();
                  $('#teacherBtn').show();
                  $('#copyToYear').hide();
                  $('#copyTo').show();
                  $('.copybutton').attr('id','copyImportUnits');
                  $('.copybutton').text('Copy Units');
                  $('.copy-contentleft').html(textData);
                  $('.copy-textcontent-left').show();

                break;
                default:
                console.log('something went wrong');
            }
            triggerAjax();
            
        });

        /*Select Teacher */
        $('.tselected li a').on('click',function(e){ 
            $('.lessonCopyCalendar').html('');
            $('#yearbtn').html('Select Year<span class="caret"></span> ');
            tselected        = $(this).text();
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(tselected +' <span class="caret"></span>');
            $(this).parents('.btn-group').find('.btn').attr('btn-type',tselected);
            
            if(tselected!=='Import CSV ' && tselected!=='Add Teacher'){
              teacher_id = $(this).attr('data-val');
              $(this).parents('.btn-group').find('.btn').attr('data-val',teacher_id);
               console.log(teacher_id);
              if(type!='5'){
                getUserData(teacher_id);
                triggerAjax();
              }
              triggerAjax();
              
            }
         }); 

        /*Select Year*/

          $(document).on('click','.yselected li a',function(e){ 
              $('.lessonCopyCalendar').html('');
              tselected        = $(this).text();
              var background   = $(this).css('background-color');
              $(this).parents('.btn-group').find('.btn').html(tselected +' <span class="caret"></span>');
              $(this).parents('.btn-group').find('.btn').attr('btn-type',tselected);
                year = $(this).attr('target_id');
                if(type!='1'){
                  getUserClass(teacher_id,year); 
                  triggerAjax();
                }
                triggerAjax();
                
          });
        
        
        

        /*Select Class To Copy*/
        
          $(document).on('click','.uselected li a',function(e){ 
              $('.lessonCopyCalendar').html('');
              uselected        = $(this).text();
              class_id         = $(this).attr('target_id');
              $('#classbtn').attr('class_data',class_id);
              var background   = $(this).css('background-color');
              $(this).parents('.btn-group').find('.btn').html(uselected +' <span class="caret"></span>');
              $(this).parents('.btn-group').find('.btn').attr('btn-type',uselected);
              triggerAjax();
          });
          
          /*function to display copy to tables*/
         $('.dropTableClass li a').on('click',function(e){ 
            $(this).addClass('active');
            lselected        = $(this).text();
            var background   = $(this).css('background-color');
            var id = $(this).attr('target_id');

            $(this).parents('.btn-group').find('.btn').html(lselected +' <span class="caret"></span>');
            $(this).parents('.btn-group').find('.btn').attr('class_id',id);
            var year = $('#copyYear').val();
            var url = '';
            if(type==1){
              url = BASE_URL +'/teacher/import/copyCalendar/'+id+'/'+year;
            }
            else if(type==2){
              url = BASE_URL +'/teacher/import/getassessmenttable/'+id+'/';
            }
            else if(type==3){
              url = BASE_URL +'/teacher/import/getassignmenttable/'+id+'/';
            }
            else if(type==5){
              url = BASE_URL +'/teacher/import/getstudenttable/'+id+'/';
            }
            else{
              url = BASE_URL +'/teacher/import/copyCalendar/'+id+'/'+year;
            }
            $.ajax({

            type:'GET',

            url:url,

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


        /*Function to call ajax funtions*/
        function triggerAjax(){

          if(type!='' && type=='1' && teacher_id!='' && year!=''){
            UserClassesData(teacher_id,year); 
          }

          if(type!='' && type=='2' && teacher_id!='' && year!='' && class_id!=''){
              UserAssessments(teacher_id,class_id,year);
          }

          if(type!='' && type=='3' && teacher_id!='' && year!='' && class_id!=''){
            UserAssignments(teacher_id,class_id,year);
          }

          if(type!='' && type=='4' && teacher_id!='' && year!='' && class_id!=''){
            UserLessons(teacher_id,class_id,year);
          }

          if(type=='5'){
            var user_id = $('#user_id').val();
            getUserData(user_id);
          }
          if(type!='' && type=='5' && year!='' ){
            UserStudents(year);
          }

          if(type!='' && type=='6' && teacher_id!='' && year!='' && class_id!=''){
            getUnits(teacher_id,class_id,year);
          }

        }
       /*****************************************/ 
        function getUserData(user_id){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/userYear/'+user_id,
            dataType: 'json',
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              var html = '';
              $.each(response.year, function(key, value){
                html += '<li>';
                html += '<a href="#" class="language-dropbutons unitdropbuton" target_id="'+value["id"]+'">'+value["year_name"]+'</a>';
                html += '</li>'
              });
              $('.yselected').html(html);
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }
        /*Get classes to copy*/
        function UserClassesData(teacher_id,year){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/classData',
            data:{'user_id':teacher_id,'year_id':year},
            //dataType: 'json',
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              $('.lessonCopyCalendar').html(response);
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        function getUserClass(user_id,year_id){
            $.ajax({
              type:'GET',
              url: BASE_URL +'/teacher/import/userClass',
              data:{'user_id':user_id,'year_id':year_id},
              dataType: 'json',
              beforeSend: function () {
                $('#main-loader').show();
              },
              complete: function () {
                 $('#main-loader').hide();
              },

              success: function (response) {
                var html = '';
                $.each(response.user_classes, function(key, value){
                  html += '<li>';
                  html += '<a href="#" class="language-dropbutons unitdropbuton" target_id="'+value["id"]+'">'+value["class_name"]+'</a>';
                  html += '</li>';
                });
                $('.uselected').html(html);
                
              },
              error: function(data){
                console.log("error");
                console.log(data);
              }

            });
        }

        function UserAssessments(teacher_id,class_id,year_id){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getAssessment',
            //dataType: 'json',
            data:{'teacher_id':teacher_id,'year_id':year_id,'class_id':class_id},
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              $('.lessonCopyCalendar').html('');
              $('.lessonCopyCalendar').html(response);
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        
        }  

        /*get assignments*/
        function UserAssignments(teacher_id,class_id,year_id){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getAssignment',
            //dataType: 'json',
            data:{'teacher_id':teacher_id,'year_id':year_id,'class_id':class_id},
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              $('.lessonCopyCalendar').html('');
              $('.lessonCopyCalendar').html(response);
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        /*get lessons*/
        function UserLessons(teacher_id,class_id,year_id){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getLessons',
            //dataType: 'json',
            data:{'teacher_id':teacher_id,'year_id':year_id,'class_id':class_id},
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              $('.lessonCopyCalendar').html('');
              $('.lessonCopyCalendar').html(response);
              draganddrop()
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        
        /*Function to get students*/

        function UserStudents(year_id){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getStudents/'+year_id,
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              $('.lessonCopyCalendar').html('');
              $('.lessonCopyCalendar').html(response);
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        /*Function to get units*/
          function getUnits(teacher_id,class_id,year_id){
            $.ajax({
              type:'GET',
              url: BASE_URL +'/teacher/import/getUnits/',
              //dataType: 'json',
              data:{'teacher_id':teacher_id,'year_id':year_id,'class_id':class_id},
              beforeSend: function () {
                $('#main-loader').show();
              },
              complete: function () {
                 $('#main-loader').hide();
              },

              success: function (response) {
                $('.lessonCopyCalendar').html('');
                $('.lessonCopyCalendar').html(response);
                draganddrop();
              },
              error: function(data){
                console.log("error");
                console.log(data);
              }

            });
          }
        
        /*function to display classes of units*/
        $(document).on('click',".copyunits-arrowright",function(){
          $(this).parents().next('tr').find(".copyunits-tableinner ").toggle();
        }); 


        function draganddrop(){
          var unit_id ;
          $( ".copy-descriptionfield" ).draggable({
            start: function(event, ui){ 
              ui.helper.css({"background-color":"blue","color":"#fff",'padding':'10px'});
              var type = $('#lessonBtn').attr('btn-type');
              switch(type) {
                case 'Lessons':
                  var txt  = $('#classbtn').text();
                  var date = $(this).prev('td').text();
                  ui.helper.html('<div>'+txt+'<br/>'+date+'</div>');
                break;
                case 'Units':
                  unit_id  = $(this).attr('data-id');
                  var txt  = $(this).text();
                  ui.helper.html('<div>'+txt+'</div>');
                break;
                default:
                console.log('something went wrong');
              }
              
            },
            stop: function(event, ui) {
             
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
                var type = $('#lessonBtn').attr('btn-type');
                switch(type) {
                  case 'Lessons':
                    $(this).addClass( "ui-state-highlight" ).html(ui.draggable.html());
                    var lesson_id     = $(this).find('span').attr('data-id');
                    var to_date       = $(this).prev('td').attr('data-lesson');
                    var copy_to_class = $('#copyTo').attr('class_id'); 
                    var next_lessons  = $(this).parent('tr').nextAll('tr').find('.copy-descriptiontext').prev('td');
                    var blank_dates   = [];
                    var teacher_id = $('#teacherBtn').attr('data-val');
                    $(next_lessons).each(function( index ) {
                      blank_dates.push($( this ).attr('data-lesson'));
                    });

                    copyDroppedLessons(lesson_id,to_date,copy_to_class,blank_dates,type,teacher_id);
                    $(this).addClass( "ui-state-highlight").html(ui.draggable.html());
                  break;
                  case 'Units':
                    var to_date       = $(this).prev('td').attr('data-lesson');
                    var copy_to_class = $('#copyTo').attr('class_id'); 
                    var next_lessons  = $(this).parent('tr').nextAll('tr').find('.copy-descriptiontext').prev('td');
                    var blank_dates   = [];
                    var teacher_id    = $('#teacherBtn').attr('data-val');
                    var from_class    = $('#classbtn').attr('class_data');
                    $(next_lessons).each(function( index ) {
                      blank_dates.push($( this ).attr('data-lesson'));
                    });
                    copyDroppedUnits(from_class,unit_id,to_date,copy_to_class,blank_dates,type,teacher_id);
                  break;
                  default:
                  console.log('something went wrong');
                }
                     
              }
          });
        } 

        /*Post Droped lessons*/
        function copyDroppedLessons(lesson_id,to_date,copy_to_class,blank_dates,type,teacher_id){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/copylessons',
            data:{"_token": "{{ csrf_token() }}",'type':type,'lesson_id':lesson_id, 'date':to_date,'to_class':copy_to_class,'blanks_date':blank_dates,'teacher_id':teacher_id},

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
             if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
                
              }
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        /*function to copy units*/

        function copyDroppedUnits(from_class,unit_id,to_date,copy_to_class,blank_dates,type,teacher_id){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/copyunits',
            data:{"_token": "{{ csrf_token() }}",'type':type,'unit_id':unit_id, 'date':to_date,'to_class':copy_to_class,'blanks_date':blank_dates,'teacher_id':teacher_id,'from_class':from_class},

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
             if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
                
              }
            },
            error: function(data){
              console.log("error");
              console.log(data);
            }

          });
        }

        /*radio checked script*/
        $('input:radio[name=importOptions]').change(function() {
          if (this.value == 'I') {
              $('#demo7').prop("disabled",false);
              //$('#copyImportLessons').prop('disabled',false);
          }
          else{
              $('#demo7').val('');
              $('#demo7').prop("disabled",true);
             // $('#copyImportLessons').prop('disabled',true);
          }
        });

        /*After before copy Lesssons function*/

        $(document).on('click','#copyImportLessons',function(){
          var type      = $('#lessonBtn').attr('btn-type');
          var year      = $('#yearbtn').attr('btn-type');
          var class_id  = $('#classbtn').attr('class_data'); 
          var insert    = $('input:radio[name=importOptions]:checked').val();
          var copyTo    = $('#copyTo').attr('class_id');
          var beforeDate= $('#demo7').val();
          var teacher_id= $('#teacherBtn').attr('data-val');
          if(insert=='A'){
            afterbeforecopy(type,year,class_id,insert,copyTo,beforeDate,teacher_id);

          }
          else{
            if(confirm("This action will cause lesson(s) to be shifted outside of your class date range. Or Existing lessons from the following dates will be deleted: Would you like to continue?")) {
                afterbeforecopy(type,year,class_id,insert,copyTo,beforeDate,teacher_id);
              }
              else{
                console.log('cancel');
              }
          }
          //afterbeforecopy(type,year,class_id,insert,copyTo,beforeDate);
        });

        /*function to copy lessons after and before*/
        function afterbeforecopy(type,year,class_id,insert,copyTo,beforeDate,teacher_id){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/copyafterbefore',
            data:{"_token": "{{ csrf_token() }}",'type':type,'year':year, 'from_class':class_id,'insert':insert,'class_id':copyTo,'beforeDate':beforeDate,'teacher_id':teacher_id },
            dataType: 'json',
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              console.log(response);
             var html = '';
              if(response['error']){
                  html += '<div id="warning-box" class="alert alert-danger fade in">';
                  html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                  html += '<strong>Error!</strong>';

                  for (var i = 0; i < response['error'].length; i++) {
                      html += '<p>' + response['error'][i] + '</p>';
                  }

                  html += '</div>';
                  $('#droppable').before(html);
                  
              }  
              if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
                
              }
            },
            error: function(data){
              //console.log("error");
              //console.log(data);
            }

          });
        }  

        /*After before copy Lesssons function*/

        $('#copyImportUnits').on('click',function(){
          var type      = $('#lessonBtn').attr('btn-type');
          var year      = $('#yearbtn').attr('btn-type');
          var class_id  = $('#classbtn').attr('class_data'); 
          var insert    = $('input:radio[name=importOptions]:checked').val();
          var copyTo    = $('#copyTo').attr('class_id');
          var beforeDate= $('#demo7').val();
          var teacher_id= $('#teacherBtn').attr('data-val');
          var unit_id   = $("#importUnitsFromBody tr.unitSelected").attr('data-id');
          var html ='';
          if(unit_id){
            if(insert=='A'){
              afterbeforeunits(type,year,class_id,insert,copyTo,beforeDate,teacher_id,unit_id);

            }
            else{
              if(confirm("This action will cause lesson(s) to be shifted outside of your class date range. Or Existing lessons from the following dates will be deleted: Would you like to continue?")) {
                  afterbeforeunits(type,year,class_id,insert,copyTo,beforeDate,teacher_id,unit_id);
                }
                else{
                  console.log('cancel');
                }
            }
          }
          else{
              html += '<div id="warning-box" class="alert alert-danger fade in">';
              html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
              html += '<strong>Error!</strong>';
              html += '<p>Select a unit to copy</p>';
              html += '</div>';
            $('.lessonPasteCalendar').before(html);
          }
          //afterbeforecopy(type,year,class_id,insert,copyTo,beforeDate);
        });

        /*function to copy units after and before*/
        function afterbeforeunits(type,year,class_id,insert,copyTo,beforeDate,teacher_id,unit_id){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/copyafterunits',
            data:{"_token": "{{ csrf_token() }}",'type':type,'year':year, 'from_class':class_id,'insert':insert,'class_id':copyTo,'beforeDate':beforeDate,'teacher_id':teacher_id,'unit_id':unit_id },
            dataType: 'json',
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              var html = '';
              if(response['error']){
                  html += '<div id="warning-box" class="alert alert-danger fade in">';
                  html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                  html += '<strong>Error!</strong>';

                  for (var i = 0; i < response['error'].length; i++) {
                      html += '<p>' + response['error'][i] + '</p>';
                  }

                  html += '</div>';
                  $('#droppable').before(html);
                  
              }  
              if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
                
              }
            },
            error: function(data){
              //console.log("error");
              //console.log(data);
            }

          });
        }  

        /*Add active class to unit selected*/
        $(document).on('click','#importUnitsFromBody tr',function(){
          $('#importUnitsFromBody tr.unitSelected').removeClass('unitSelected');
          $(this).addClass('unitSelected');
        });
        
        /*Function to copy classes*/
        $('.dropYear li a').on('click',function(e){ 
            $('.copy-textcontent-left').hide();
            var target_id    = $(this).attr('target_id'); 
            yearselected     = $(this).text();
            var background   = $(this).css('background-color');
            $(this).parents('.btn-group').find('.btn').html(yearselected +' <span class="caret"></span>');
            $(this).parents('.btn-group').find('.btn').attr('btn-type',yearselected);
            $(this).parents('.btn-group').find('.btn').attr('target_id',target_id);
            if(type==1){
              getClassTable(year);
            }
            if(type==5){
              getStudentsTable(year);
            }
         }); 

        /*Function to show the classes in copy calendar*/
        function getClassTable(year){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getclasstable',
            data:{'year':year},
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
               var html = '';
               $('.lessonPasteCalendar').html(response); 
             
            },
            error: function(data){
              //console.log("error");
              //console.log(data);
            }

          });
        }

        /*function to check all the checkboxes*/
        $(document).on('click','#checkAll',function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        
        /*Function to copy classes*/
        $('#copyImportClass').on('click',function(e){
          e.preventDefault();
            var mydata = $('#ClassForm').serialize();
             postCopyClass(mydata);
        });

        /*Function to copy classes*/
        function postCopyClass(mydata){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/postclasscopy',
            data:mydata,
            

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
                if(response.success=='TRUE'){
                  $('.dropYear li a').trigger('click');
                }
             
            },
            error: function(data){
              //console.log("error");
              //console.log(data);
            }

          });
        }

         /*Function to copy Assessments*/ 
        $(document).on('click','#copyImportAssessment',function(e){
          e.preventDefault();
            var mydata = $('#AssessmentForm').serialize();
             postCopyAssessment(mydata);
        });

        /*Function to copy classes*/
        function postCopyAssessment(mydata){
          var class_id = $('#copyTo').attr('class_id');
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/postassessmentcopy/'+class_id,
            data:mydata,
            

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
                
              }
             
            },
            error: function(data){
              
            }

          });
        }

        /*Function to copy Assignment*/ 
        $(document).on('click','#copyImportAssignment',function(e){
          e.preventDefault();
            var mydata = $('#AssignmentForm').serialize();
             postCopyAssignment(mydata);
        });

        /*Function to copy Assignment*/
        function postCopyAssignment(mydata){
          var class_id = $('#copyTo').attr('class_id');
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/postassignmentcopy/'+class_id,
            data:mydata,
            

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
              if(response['success']=='TRUE'){
                var trigger_id = $('#copyTo').attr('class_id');
                var trigger_id1 = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").trigger('click');
                var txt  = $('#copyTo').parent('.btn-group').find("ul li .unitdropbuton[target_id='"+trigger_id+"']").text();
                $(this).parents('.btn-group').find('.btn').html(txt +' <span class="caret"></span>');
              
              }
             
            },
            error: function(data){
              
            }

          });
        }

        /*Function to copy Students*/
        $(document).on('click','#copyImportStudents',function(e){
          e.preventDefault();
            var mydata = $('#StudentsForm').serialize();
             postCopyStudents(mydata);
        });

        /*Function to copy Assignment*/
        function postCopyStudents(mydata){
          $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/import/poststudentcopy',
            data:mydata,
            

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
                if(response.success=='TRUE'){
                  $('.dropYear li a').trigger('click');
                }
             
            },
            error: function(data){
              
            }

          });
        }

        /*Function to get the student copy table*/
        function getStudentsTable(year){
          $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/import/getstudentcopytable/'+year,
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
               $('#main-loader').hide();
            },

            success: function (response) {
               var html = '';
               $('.lessonPasteCalendar').html(response); 
             
            },
            error: function(data){
              //console.log("error");
              //console.log(data);
            }

          });
        }

        /*Function to add a teacher*/
        /*Add Teachers*/
          $("#addteacher").click(function(){


            $("#dynamicRenderDiv").show().load("/teacher/import/addteacher",function(){
              

            });

          });

          $(document).on('submit','.addteacher-form',function(e){
              var formData = $(this).serialize();
              $.ajax({
                type:'POST',
                url: BASE_URL +'/teacher/import/postAddteacher',
                data:formData,
                dataType: 'json',
                beforeSend: function () {
                  $('#main-loader').show();
                },
                complete: function () {
                   $('#main-loader').hide();
                },

                success: function (response) {
                  var html = '';
                  if(response['error']){
                      html += '<div id="warning-box" class="alert alert-danger fade in">';
                      html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                      html += '<strong>Error!</strong>';

                      for (var i = 0; i < response['error'].length; i++) {
                          html += '<p>' + response['error'][i] + '</p>';
                      }

                      html += '</div>';
                      $('.modal-header').after(html);
                      
                  }  
                  if(response['success']=='TRUE'){
                    
                    html += '<div id="success-box" class="alert alert-success fade in">';
                    html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    html += '<strong>Teacher Added !</strong>';
                    html += '</div>';

                    $('.modal-header').after(html);
                    $('.addteacher-form')[0].reset();
                    $(".d-render-popoup").fadeOut();


                    window.location.reload();
                            }
                },
                error: function(data){
                  //console.log("error");
                  //console.log(data);
                }

              });
              e.preventDefault();
          });

          /*Function to disable modal box*/
          $(document).on('click','.close-button',function(){
              $('.d-render-popoup').hide();
          });
           /*Validations*/ 
          /*$('#classbtn').on('click',function(e){
            var check = $('.uselected li a').val();
            if(check=='' || check=='undefined'){
              var text = 'Please select a Year'; 
              $('#pastemodal .modal-body p').text(text);
              $('#pastemodal').modal();
              e.stopPropagation();
            }
            
          });

          $('#yearbtn').on('click',function(e){
            var check = $('.yselected li a').val();
            if(type!=1 && check=='' || check=='undefined'){
              var text = 'Please select a Teacher'; 
              $('#pastemodal .modal-body p').text(text);
              $('#pastemodal').modal();
              //e.stopPropagation();
            }
            
          });*/

      });
      
</script> 
        
  



@endpush

