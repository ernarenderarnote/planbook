@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section">
         <div class="copy-header"> Student Grades</div>
         <div class="list-contentbutton gradebutons">
            <div class="btn-group">
               <button type="button" class="btn classBtn unitsbutton list-contentmainbuton dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target_id="0"> All Classes<span class="caret"></span> </button>
               <ul class="dropdown-menu language-dropdown">
                  <li class="classSelected">
                     <a href="#" class="language-dropbutons unitdropbuton">
                        All Classes
                     </a>
                  </li>
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
               <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> All Periods<span class="caret"></span> </button>
               <ul class="dropdown-menu language-dropdown gradedropdown">
                  <li><a href="#" class="language-dropbutons unitdropbuton">All Periods </a></li>
                  <li><a href="#" class="language-dropbutons unitdropbuton" data-toggle="modal" data-target="#addperiod">Add Periods </a></li>
               </ul>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#addassessment"> Add Assessment</button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#assignmentmodal"> Add Assignments</button>
            </div>
            <div class="btn-group">
               <div type="button" class="btn unitsbutton list-contentmainbuton  standardmainbuttons"> <span class="show-standard">Show Standards</span> <span class="hide-standard">Hide Standards</span></div>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#lettergrade">Letter Grades</button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#performancereport">Performance Reports</button>
            </div>
            <div class="studentGradesMsg">
               <p>No <a href="addstudents">students</a> have been assigned to this class</p>
            </div>
         </div>
      </div>

      <!-----grades-->
      <div class="show-assignmentsgrades">

      </div>
      <!-- Add class Popup Starts Here -->
      <div class="d-render-popoup t-data-popup modal fade editmodalcontent in" id="dynamicRenderDiv" role="dialog">
        

      </div>

      <!-- Add class popup end here ! -->



@endsection
  
@push('js')
   
      <script>
         $(".standardmainbuttons").click(function(){
                 $(".standardmainbuttons").toggleClass("standardshowbutton");
             });
         /*$('#demo9').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar
         $('#demo10').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar
         $('#demo13').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar
         $('#demo14').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar
         $('#demo15').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar
         $('#demo16').dcalendarpicker();
         $('#calendar-demo').dcalendar(); //creates the calendar*/
         $(".fileattachmentmain").click(function(){
              $(".fileattachment-modal").show();
             });
         $(".close-filebutton").click(function(){
              $(".fileattachment-modal").hide();
             });  
      </script> 
      <script>
         tinymce.init({
           selector: 'textarea',
           height: 400,
           theme: 'modern',
           plugins: [
             'advlist autolink lists link image charmap print preview hr anchor pagebreak',
             'searchreplace wordcount visualblocks visualchars code fullscreen',
             'insertdatetime media nonbreaking save table contextmenu directionality',
             'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
           ],
           toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
           toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
           image_advtab: true,
           templates: [
             { title: 'Test template 1', content: 'Test 1' },
             { title: 'Test template 2', content: 'Test 2' }
           ],
           content_css: [
            ]
          });
         
      </script>
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
            url: BASE_URL +'/teacher/grades/getData/'+class_id,

            beforeSend: function () {
              //obj.html('Sending... <i class="fa fa-send"></i>');
            },
            complete: function () {
              //obj.html('Sent <i class="fa fa-send"></i>');
            },

            success: function (response) {
               $('.show-assignmentsgrades').html(response);
              /*var html = '';

              $('#warning-box').remove();
              $('#success-box').remove();

              if(response['error']){
                  html += '<div id="warning-box" class="alert alert-danger fade in">';
                  html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                  html += '<strong>Error!</strong>';

                  for (var i = 0; i < response['error'].length; i++) {
                      html += '<p>' + response['error'][i] + '</p>';
                  }

                  html += '</div>';
                  $('.errorMessage').before(html);
                  
              }

              if(response['success']){
                     
                console.log(response['success']);

                html += '<div id="success-box" class="alert alert-success fade in">';
                html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                html += '<strong>You Have created Assignment successfully !</strong>';
                html += '</div>';

                $('.errorMessage').before(html);
                $('#assessment_add_form')[0].reset();
               $(".d-render-popoup").fadeOut();


                window.location.reload();
              }
*/

              },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
      });

      /*Display Filter*/
       var click = -1;
      $(document).on('click','.assignment-filter .btn',function(){
         var txt = $(this).text();
         var arr = $('#heading-data .assignment-data').length;
         $(this).parent().find('.btn').removeClass('active');
         $(this).addClass('active');
         if(txt == 'None'){
            $('.assignment-data').hide();
         } 
         if(txt =='All'){
            $('.assignment-data').show();
         }
         if(txt =='Prior'){
            $('.assignment-data').show();
            $('.assessment-data').hide();
            $('.assessment-filter').find('.btn').removeClass('active');
            $('.assessment-filter').find('.none').addClass('active');
         }

         if(txt == 'Next'){
            $('.assessment-data').hide();
            click++;
            $("#heading-data .assignment-data:eq("+click+")").prevAll('.assignment-data').hide();
            $("#heading-data .assignment-data:eq("+click+")").show();
            $("#heading-data .assignment-data:eq("+click+")").nextAll('.assignment-data').hide();
            $("#sortdata .assignment-data:eq("+click+")").prevAll('.assignment-data').hide();
            $("#sortdata .assignment-data:eq("+click+")").show();
            $("#sortdata .assignment-data:eq("+click+")").nextAll('.assignment-data').hide();
            $("#avgClass .assignment-data:eq("+click+")").prevAll('.assignment-data').hide();
            $("#avgClass .assignment-data:eq("+click+")").show();
            $("#avgClass .assignment-data:eq("+click+")").nextAll('.assignment-data').hide();
            $("#studentValue .assignment-data:eq("+click+")").prevAll('.assignment-data').hide();
            $("#studentValue .assignment-data:eq("+click+")").show();
            $("#studentValue .assignment-data:eq("+click+")").nextAll('.assignment-data').hide();
            if(click>=arr){
              var newclick = click%arr; 
              $("#heading-data .assignment-data:eq("+newclick+")").show(); 
              $("#heading-data .assignment-data:eq("+newclick+")").prevAll('.assignment-data').hide();
              $("#heading-data .assignment-data:eq("+newclick+")").nextAll('.assignment-data').hide(); 
              $("#sortdata .assignment-data:eq("+newclick+")").show(); 
              $("#sortdata .assignment-data:eq("+newclick+")").prevAll('.assignment-data').hide();
              $("#sortdata .assignment-data:eq("+newclick+")").nextAll('.assignment-data').hide(); 
              $("#avgClass .assignment-data:eq("+newclick+")").show(); 
              $("#avgClass .assignment-data:eq("+newclick+")").prevAll('.assignment-data').hide();
              $("#avgClass .assignment-data:eq("+newclick+")").nextAll('.assignment-data').hide(); 
              $("#studentValue .assignment-data:eq("+newclick+")").show(); 
              $("#studentValue .assignment-data:eq("+newclick+")").prevAll('.assignment-data').hide();
              $("#studentValue .assignment-data:eq("+newclick+")").nextAll('.assignment-data').hide(); 
            }
            
            $('.assessment-filter').find('.btn').removeClass('active');
            $('.assessment-filter').find('.none').addClass('active');
         }  
      });
       var click = -1;
       $(document).on('click','.assessment-filter .btn',function(){
         var txt     = $(this).text();
         var arr = $('#heading-data .assessment-data').length;
         $(this).parent().find('.btn').removeClass('active');
         $(this).addClass('active');
         if(txt == 'None'){
            $('.assessment-data').hide();
         } 
         if(txt =='All'){
            $('.assessment-data').show();
         }
         if(txt =='Prior'){
            $('.assessment-data').show();
            $('.assignment-data').hide();
            $('.assignment-filter').find('.btn').removeClass('active');
            $('.assignment-filter').find('.none').addClass('active');
         }
         if(txt == 'Next'){
            click++;
            $("#heading-data .assessment-data:eq("+click+")").prevAll('.assessment-data').hide();
            $("#heading-data .assessment-data:eq("+click+")").show();
            $("#heading-data .assessment-data:eq("+click+")").nextAll('.assessment-data').hide();
            $("#sortdata .assessment-data:eq("+click+")").prevAll('.assessment-data').hide();
            $("#sortdata .assessment-data:eq("+click+")").show();
            $("#sortdata .assessment-data:eq("+click+")").nextAll('.assessment-data').hide();
            $("#avgClass .assessment-data:eq("+click+")").prevAll('.assessment-data').hide();
            $("#avgClass .assessment-data:eq("+click+")").show();
            $("#avgClass .assessment-data:eq("+click+")").nextAll('.assessment-data').hide();
            $("#studentValue .assessment-data:eq("+click+")").prevAll('.assessment-data').hide();
            $("#studentValue .assessment-data:eq("+click+")").show();
            $("#studentValue .assessment-data:eq("+click+")").nextAll('.assessment-data').hide();
            if(click>=arr){
               var newclick = click%arr; 
               console.log(newclick);
              $("#heading-data .assessment-data:eq("+newclick+")").show(); 
              $("#heading-data .assessment-data:eq("+newclick+")").prevAll('.assessment-data').hide();
              $("#heading-data .assessment-data:eq("+newclick+")").nextAll('.assessment-data').hide();
              $("#sortdata .assessment-data:eq("+newclick+")").show(); 
              $("#sortdata .assessment-data:eq("+newclick+")").prevAll('.assessment-data').hide();
              $("#sortdata .assessment-data:eq("+newclick+")").nextAll('.assessment-data').hide(); 
              $("#avgClass .assessment-data:eq("+newclick+")").show(); 
              $("#avgClass .assessment-data:eq("+newclick+")").prevAll('.assessment-data').hide();
              $("#avgClass .assessment-data:eq("+newclick+")").nextAll('.assessment-data').hide(); 
              $("#studentValue .assessment-data:eq("+newclick+")").show(); 
              $("#studentValue .assessment-data:eq("+newclick+")").prevAll('.assessment-data').hide();
              $("#studentValue .assessment-data:eq("+newclick+")").nextAll('.assessment-data').hide();  
            }
            $('.assignment-data').hide();
            $('.assignment-filter').find('.btn').removeClass('active');
            $('.assignment-filter').find('.none').addClass('active');
            
         }
         
        
      });

      </script>

@endpush  