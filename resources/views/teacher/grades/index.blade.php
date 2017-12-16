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
                  @forelse($periods as $period)
                     <li><a href="#" class="language-dropbutons unitdropbuton">{{$period['title']}}  <i class="fa fa-pencil" period_id = "{{$period['id']}}"aria-hidden="true"></i></a>
</li>
                  @empty
                  @endforelse
                  <li><a href="#" class="language-dropbutons unitdropbuton" id="addperiod">Add Periods </a></li>
               </ul>
            </div>
            <div class="btn-group">
               <a href="{{route('teacher.assessments.index')}}" target='_blank' class="btn unitsbutton list-contentmainbuton"> Add Assessment</a>
            </div>
            <div class="btn-group">
               <a href="{{route('teacher.assignments.index')}}" target='_blank' class="btn unitsbutton list-contentmainbuton"> Add Assignments</a>
            </div>
            <div class="btn-group">
               <div type="button" class="btn unitsbutton list-contentmainbuton  standardmainbuttons"> <span class="show-standard">Show Standards</span> <span class="hide-standard">Hide Standards</span></div>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" data-toggle="modal" data-target="#lettergrade">Letter Grades</button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton list-contentmainbuton" id="performancereport">Performance Reports</button>
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
      <div class="d-render-popoup movemodalcontent t-data-popup modal fade editmodalcontent addteachercontent in" id="dynamicRenderDiv" role="dialog">
        

      </div>

      <!-- Add class popup end here ! -->
      <div id="lettergrade" class="modal fade editmodalcontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" action="#" class="editlessonform gradeScoreForm editscore-form">
                  {{ csrf_field() }}
                  <div class="modal-header">
                     <div class="normalLesson pull-left">
                        <p>Letter Grades</p>
                     </div>
                     <div class="actionright pull-right">
                        <input type="submit" class="actiondropbutton renew-button gradesSave" value="Save">
                        <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                     </div>
                  </div>
                  <div class="modal-body editscore-body">
                     <p>To add sample grades, <a href="#" id="gradeLetters">click here</a></p>
                     <div class="added-daysection added-assessmentbox">
                        <p>Letter Grades <a href="javascript:void(0)" class="main-buton appendGrade"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                     </div>
                     <div class="assignment-table">
                      @php $letters = array();@endphp
                      
                      
                        <table>
                           <thead>
                           @if(isset($gradeletters))
                              <tr class="tHeader">
                                 <th>Letter Grade</th>
                                 <th>Minimum Percent</th>
                                 <th style="background-color:#dbdfe8; border:none;"></th>
                              </tr>
                           @endif
                           </thead>
                           <tbody>
                            @forelse($gradeletters as $data=>$val)
                              @php $letters = (json_decode($val->grade_letters_data));@endphp
                       
                              @foreach($letters as $letter=>$value)
                                 @php $count=0; @endphp

                                 <tr>
                                    <td><input id="nameAssignmentWeight{{$count}}" value="{{$value->title}}" name="grade[{{$count}}][title]" size="11" type="text"></td>
                                    <td><input id="percentAssignmentWeight{{$count}}" value="{{$value->marks}}" name="grade[{{$count}}][marks] size="11"  class="perchantage-input" type="text"></td>
                                    <td><i class="fa fa-close closebtn closeicon-assessment{{$count}}" aria-hidden="true"></i></td>
                                 </tr>
                                 @php $count++; @endphp
                              @endforeach
                              @empty
                           @endforelse  
                           </tbody>
                        </table>
                     </div>
                  </div>
               </form>
            </div>
         </div>
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
        $('#periodClassID').val(class_id);
         $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/grades/getData/'+class_id,

            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
               $('.show-assignmentsgrades').html('');
               if(response){
                  $('.studentGradesMsg').hide();
                  $('.show-assignmentsgrades').html(response);
               }
               else{
                  $('.studentGradesMsg').show();
               }  
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
         console.log(arr);
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
            $(".studentValue .assignment-data:eq("+click+")").prevAll('.assignment-data').hide();
            $(".studentValue .assignment-data:eq("+click+")").show();
            $(".studentValue .assignment-data:eq("+click+")").nextAll('.assignment-data').hide();
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
              $(".studentValue .assignment-data:eq("+newclick+")").show(); 
              $(".studentValue .assignment-data:eq("+newclick+")").prevAll('.assignment-data').hide();
              $(".studentValue .assignment-data:eq("+newclick+")").nextAll('.assignment-data').hide(); 
            }
            
            $('.assessment-filter').find('.btn').removeClass('active');
            $('.assessment-filter').find('.none').addClass('active');
         }  
      });
       var clickass = -1;
       $(document).on('click','.assessment-filter .btn',function(){
         var txt     = $(this).text();
         var arr = $('#heading-data .assessment-data').length;
         console.log(clickass);
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
            clickass++;
            $("#heading-data .assessment-data:eq("+clickass+")").prevAll('.assessment-data').hide();
            $("#heading-data .assessment-data:eq("+clickass+")").show();
            $("#heading-data .assessment-data:eq("+clickass+")").nextAll('.assessment-data').hide();
            $("#sortdata .assessment-data:eq("+clickass+")").prevAll('.assessment-data').hide();
            $("#sortdata .assessment-data:eq("+clickass+")").show();
            $("#sortdata .assessment-data:eq("+clickass+")").nextAll('.assessment-data').hide();
            $("#avgClass .assessment-data:eq("+clickass+")").prevAll('.assessment-data').hide();
            $("#avgClass .assessment-data:eq("+clickass+")").show();
            $("#avgClass .assessment-data:eq("+clickass+")").nextAll('.assessment-data').hide();
            $("#studentValue .assessment-data:eq("+clickass+")").prevAll('.assessment-data').hide();
            $("#studentValue .assessment-data:eq("+clickass+")").show();
            $("#studentValue .assessment-data:eq("+clickass+")").nextAll('.assessment-data').hide();
            if(clickass>=arr){
               var newclickass = clickass%arr; 
              $("#heading-data .assessment-data:eq("+newclickass+")").show(); 
              $("#heading-data .assessment-data:eq("+newclickass+")").prevAll('.assessment-data').hide();
              $("#heading-data .assessment-data:eq("+newclickass+")").nextAll('.assessment-data').hide();
              $("#sortdata .assessment-data:eq("+newclickass+")").show(); 
              $("#sortdata .assessment-data:eq("+newclickass+")").prevAll('.assessment-data').hide();
              $("#sortdata .assessment-data:eq("+newclickass+")").nextAll('.assessment-data').hide(); 
              $("#avgClass .assessment-data:eq("+newclickass+")").show(); 
              $("#avgClass .assessment-data:eq("+newclickass+")").prevAll('.assessment-data').hide();
              $("#avgClass .assessment-data:eq("+newclickass+")").nextAll('.assessment-data').hide(); 
              $("#studentValue .assessment-data:eq("+newclickass+")").show(); 
              $("#studentValue .assessment-data:eq("+newclickass+")").prevAll('.assessment-data').hide();
              $("#studentValue .assessment-data:eq("+newclickass+")").nextAll('.assessment-data').hide();  
            }
            $('.assignment-data').hide();
            $('.assignment-filter').find('.btn').removeClass('active');
            $('.assignment-filter').find('.none').addClass('active');
            
         }
         
        
      });

       /*submit data on focus out of grade marks*/
       $(document).on('change','.grade-assigned',function(){
         var data = $('.gradeForm').serialize();

         $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/grades/postData',
            data:data,
            beforeSend: function () {
              //obj.html('Sending... <i class="fa fa-send"></i>');
            },
            complete: function () {
              //obj.html('Sent <i class="fa fa-send"></i>');
            },

            success: function (response) {
               

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
      })

      /*append grade letters on click*/ 
      
      var num = 0;
      
      $(document).on('click','#gradeLetters',function(index){
         var countnum = $(".assignment-table tbody tr:last" ).index();
         if(countnum!='' && countnum >= 0){
            num = countnum+1;
         }
         appendIndexElement(num);
      });
      function appendIndexElement(num){
         var thead = '';
             thead += '<tr class="tHeader">';
             thead += '<th>Letter Grade</th>';
             thead += '<th>Minimum Percent</th>';
             thead += '<th style="background-color:#dbdfe8; border:none;"></th>';
             thead += '</tr>';

         var tbody = '';
             tbody +='<tr>';
             tbody +='<td><input id="nameAssignmentWeight'+ parseInt(0 + num)+'" size="11" value="A" type="text"></td>';
             tbody +='<td><input id="percentAssignmentWeight'+ parseInt(0 + num)+'" size="11" value="90" class="perchantage-input" type="text"></td>';
             tbody +='<td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(0 + num)+'" aria-hidden="true"></i></td>';
             tbody +='</tr>';
             tbody +='<tr>';
             tbody +=' <td><input id="nameAssignmentWeight'+ parseInt(1 + num)+'" size="11" value="B" type="text"></td>';
             tbody +=' <td><input id="percentAssignmentWeight'+ parseInt(1 + num)+'" size="11" value="80" class="perchantage-input" type="text"></td>';
             tbody +=' <td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(1 + num)+'" aria-hidden="true"></i></td>';
             tbody +='</tr>';
             tbody +='<tr>';
             tbody +=' <td><input id="nameAssignmentWeight'+ parseInt(2 + num)+'" size="11" value="C" type="text"></td>';
             tbody +=' <td><input id="percentAssignmentWeight'+ parseInt(2 + num)+'" size="11" value="70" class="perchantage-input" type="text"></td>';
             tbody +=' <td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(2 + num)+'" aria-hidden="true"></i></td>';
             tbody +='</tr>';
             tbody +='<tr>';
             tbody +=' <td><input id="nameAssignmentWeight'+ parseInt(3 + num)+'" size="11" value="D" type="text"></td>';
             tbody +=' <td><input id="percentAssignmentWeight'+ parseInt(3 + num)+'" size="11" value="60" class="perchantage-input" type="text"></td>';
             tbody +=' <td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(3 + num)+'" aria-hidden="true"></i></td>';
             tbody +='</tr>';
             tbody +='<tr>';
             tbody +=' <td><input id="nameAssignmentWeight'+ parseInt(4 + num)+'" size="11" value="F" type="text"></td>';
             tbody +=' <td><input id="percentAssignmentWeight'+ parseInt(4 + num)+'" size="11" value="0" class="perchantage-input" type="text"></td>';
             tbody +=' <td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(4 + num)+'" aria-hidden="true"></i></td>';
             tbody +='</tr>';    
         $('.assignment-table table thead').html(thead);
         $('.assignment-table table tbody').append(tbody);
         num++;

      }
      $('.appendGrade').on('click',function(){
         console.log(num);
         var countnum = $(".assignment-table tbody tr:last" ).index();
            num = countnum+1;
            appendSingle(num);
      });


      function appendSingle(num){
         var thead = '';
             thead += '<tr class="tHeader">';
             thead += '<th>Letter Grade</th>';
             thead += '<th>Minimum Percent</th>';
             thead += '<th style="background-color:#dbdfe8; border:none;"></th>';
             thead += '</tr>';
         var tbody = '';   
            tbody +='<tr>';
            tbody +=' <td><input id="nameAssignmentWeight'+ parseInt(num) +'" name="grade['+num+'][title]" size="11" type="text"></td>';
            tbody +=' <td><input id="percentAssignmentWeight'+ parseInt(num)+'" name="grade['+num+'][marks] size="11"  class="perchantage-input" type="text"></td>';
            tbody +=' <td><i class="fa fa-close closebtn closeicon-assessment'+ parseInt(num)+'" aria-hidden="true"></i></td>';
            tbody +='</tr>';
            $('.assignment-table table thead').html(thead);
            $('.assignment-table table tbody').append(tbody);
      }
      $(document).on('click','.closebtn',function(){
         var deletedNode = $(this).parent('td').prev('td').find('input').attr('id');
         console.log(deletedNode);
         $(this).parents('tr').remove();
      });

      $('.gradeScoreForm').on('submit',function(e){
         var data = $(this).serialize();
         $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/grades/postGradeLetters',
            data:data,
            beforeSend: function () {
              $('#main-loader').show();
            },
            complete: function () {
              $('#main-loader').hide();
            },

            success: function (response) {
               

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
         e.preventDefault();
      });

      /*Add period Script*/
      $("#addperiod").click(function(){


         $("#dynamicRenderDiv").show().load("/teacher/grades/add",function(){    

         });

      });

      
      
      $(document).on('submit','.addperiodform',function(e){
         var data = $(this).serialize();
         $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/grades/postPeriod',
            data:data,
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
                  $('.modal-body').before(html);
                  
              }

              if(response['success']){
                     
                console.log(response['success']);

                html += '<div id="success-box" class="alert alert-success fade in">';
                html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                html += '<strong>Period Added !..</strong>';
                html += '</div>';

                $('.modal-body').before(html);
               // $('#assessment_add_form')[0].reset();
               $("#addperiod").fadeOut();


                window.location.reload();
              } 

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
         e.preventDefault();
      });

      /*Edit period*/

      $(".fa-pencil").click(function(){

          var period_id  = $(this).attr('period_id');
         $("#dynamicRenderDiv").show().load("/teacher/grades/geteditPeriod/"+period_id,function(){    

         });

      });

      $(document).on('submit','.editperiodform',function(e){
        
         var data = $(this).serialize();
         var period_id = $("input[name='period_id']").val();
         $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/grades/posteditPeriod/'+period_id,
            data:data,
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
                  $('.modal-body').before(html);
                  
              }

              if(response['success']){
                     
                console.log(response['success']);

                html += '<div id="success-box" class="alert alert-success fade in">';
                html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                html += '<strong>Period updated !..</strong>';
                html += '</div>';

                $('.modal-body').before(html);
               // $('#assessment_add_form')[0].reset();
               $("#addperiod").fadeOut();


               window.location.reload();
              } 

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
          e.preventDefault();
      });
      
      /*Delete periods*/
      $(document).on('click','.delete-periods',function(e){
         var period_id = $("input[name='period_id']").val();
         $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/grades/deletePeriod/'+period_id,
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
                  $('.modal-body').before(html);
                  
              }

              if(response['success']){
                     
                console.log(response['success']);

                html += '<div id="success-box" class="alert alert-success fade in">';
                html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                html += '<strong>Period Deleted !..</strong>';
                html += '</div>';

                $('.modal-body').before(html);
               // $('#assessment_add_form')[0].reset();
               $("#addperiod").fadeOut();


              window.location.reload();
              } 

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
          e.preventDefault();
      });

      /*performance Report*/
      $(document).on('click','#performancereport',function(){
         $("#dynamicRenderDiv").show().load("/teacher/grades/performanceReport",function(){    

         }); 
      });

      /*generate pdf file*/
      $(document).on('submit','.performanceform',function(e){
         var data = $(this).serialize();
         e.preventDefault();
         $.ajax({
            type:'GET',
            url: BASE_URL +'/teacher/grades/pdfview',
            data:data,
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
                  $('.modal-body').before(html);
                  
              }

              if(response['success']){
                     
                console.log(response['success']);

                html += '<div id="success-box" class="alert alert-success fade in">';
                html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                html += '<strong>Period Deleted !..</strong>';
                html += '</div>';

                $('.modal-body').before(html);
               // $('#assessment_add_form')[0].reset();
               $("#addperiod").fadeOut();


              window.location.reload();
              } 

            },


            error: function(data){
              console.log("error");
              console.log(data);
            }

         });
          

      });

      /*Close tab*/
      $(document).on('click','.fa-close',function(){
         $('#dynamicRenderDiv').hide();
      });
      </script>

@endpush  