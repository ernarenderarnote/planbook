@extends('layouts.teacher')

@section('content')
@php $url = request()->view ; @endphp
<div id="main-loader" class="pageLoader" style="display:none">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
</div>


<div class="events-section">
   <div class="copy-header"> Events </div>
   <div class="list-contentbutton">
      <div class="btn-group">
         <button type="button" class="btn unitsbutton"> Today</button>
      </div>
      <div class="btn-group">
         <button type="button" id="addEventButton" class="btn unitsbutton"><img src="/images/add2.png" class="event-icon" > Add Event </button>
      </div>
      <div class="btn-group">
         <button type="button" id="importBtn" class="btn unitsbutton"><img src="/images/import.png" class="event-icon"> Import Events </button>
      </div>
      <div class="btn-group">
         <button type="button" id="exportBtn" class="btn unitsbutton"><img src="/images/export.png" class="event-icon"> Export Events </button>
      </div>
   </div>
   <div class="events-table">
      <p> Events</p>
      @if (\Session::has('success'))
          <div class="alert alert-success">
              <ul>
                  <li>{!! \Session::get('success') !!}</li>
              </ul>
          </div>
      @endif
      <div class="event-tableinner">
         <table border="1">
            <tbody>
               @forelse($events as $event)
               <tr class="edit_events" data-event-id="{{ $event->id }}">
                  <td>{{$event->start_date}}</td>
                  <td class="event-tablesecondfield">{{$event->event_title}}
                   <br/>
                    @php $attachments = json_decode($event->attachment); 
                    @endphp
                    @if(!empty($attachments))
                    @forelse($attachments as $attach) 
                      <a href="../../uploads/myfiles/{{ $attach }}" target='_blank'>{{ $attach }}</a><br/>
                    @empty
                    @endforelse
                   @endif   

                  </td>
               </tr> 
               @empty
                  <tr>
              <td colspan="8">No Record Found ! </td>
            </tr>
               @endforelse

            </tbody>
         </table>
      </div>
   </div>
</div>
<!--add event popup start-->
<div id="dynamicRenderDiv" class="d-render-popoup t-data-popup modal fade editmodalcontent listmodalcontent in" role="dialog">

</div>
<!--fileattachment modal start here-->
<div class="fileattachment-modal">
    <div class="fileattachment-header">My Files</div>
    <div class="fileattachment-body">
      <form name="fileattachment" id="fileAttachment" action="" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div>
            <input type="text" id="myInput" placeholder="Search File(s)" class="form-control">
         </div>
         <div class="file-attchedtext">
            <ul class="list-group checked-list-box" id="myUL">
               <div class="file-attchedmain">
                  
                  
               </div>
            </ul>
         </div>
         <div class="file-attchedbutton">
            <button Type="button" class="main-buton applyfilebuton filebuttons">Apply</button>
            <button type="button" class="main-buton  filebuttons">Clear all</button>
            <div class="main-buton file-attchment">
               <input type="file" id="uploadFile" name="fileuploaddata">
               <span class="upload-text">Upload New File</span> </div>
            <a href="#" class="close-filebutton filebuttons">Cancel</a>
         </div>
      </form>  
   </div>
   <div class="popupProgress" style="display:none;">
      <div class='progress' id="progress_div">
         <div class='bar' id='bar1'></div>
         <div class='percent' id='Imgpercent'>0%</div>
      </div>
    </div>     
</div>
<!--File apply and embed modal here-->
<div class="applyfilemodalcontent" id="applyfilemodal" >
  <div class="fileattachment-header">Image Actions</div>
  <div class="fileattachment-body applycontentbody ">
    <form method="post" action="#" class="applyImgForm">
      <div class="attachOrEmbedBody" id="attachOrEmbedBody"><span></span></div>
      <div class="button-group">
        <button type="button" class="main-buton fileAttach">Attach</button>
        <button type="button" class="main-buton embedfilebutton" type="button">Embed</button>
        <button type="button" class="close-button closefile-button">Cancel</button>
      </div>
    </form>
  </div>
</div>
<div class="applyfilemodalcontent embedfilecontent" id="embedfilemodal">
  <div class="fileattachment-header">Embed Image</div>
  <div class="fileattachment-body applycontentbody">
    <form method="post" action="">
      <p>Select lesson section for image</p>
      <div class="button-group">
        <button type="button" class="main-buton ebdLesson">Lesson</button>
        <button type="button" class="main-buton ebdhomework">Homework</button>
        <button type="button" class="main-buton ebdnotes">Notes</button>
        <button class="close-button closeembedfile-button" type="button">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Add class Popup Starts Here -->
     
      <!--export eventtable popup start-->
      <div id="exportevents" class="modal fade movemodalcontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Export Events</h4>
               </div>
               <div class="modal-body">
                  <p>Yellow Bus.com uses HTML code to format lesson and event text (bold, italics, etc.) If you plan to import this file back into planbook.com, you should include this HTML. If you plan to use the file in another application (such as Microsoft Word) that does not recognize HTML formatting, you should not include the HTML.</p>
                  <p>Do you want to include HTML formatting in your export file?</p>
                  <div class="button-group">
                     <button class="renew-button csvDownloads" type="button"> Include HTML</button>
                     <button class="renew-button csvDownloads" type="button"> Do not include HTML</button>
                     <button class="close-button" data-dismiss="modal" type="button"> Cancel Export</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--import eventtable popup start-->
      <div id="importevents" class="modal fade movemodalcontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Import Events</h4>
               </div>
               <div class="modal-body">
                  <p>Select a tab to import from:</p>
                  <div class="editsectiontabs editeventtabs">
                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#teacher"> Teacher</a></li>
                        <li><a data-toggle="tab" href="#csvfiles">CSV File</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="teacher" class="tab-pane fade in active">
                           <div class="teachertabcontent">
                            <form method="post" action="" action="/teacher/events/importExcel" enctype="multipart/form-data" class="teachertab-form" id="">
                              {{ csrf_field() }}
                                 <p>To import events from another teacher, enter teacher's email address and teacher key</p>
                                 <div class="form-group">
                                    <label>Teacher Email</label>
                                    <input id="shareEmailEvent" name="email" size="40" title="Enter teacher's email address" type="text" required>
                                 </div>
                                 <div class="form-group">
                                    <label>Teacher Key</label>
                                    <input id="shareKeyEvent" name="shareKey" size="40" title="Enter teacher's security key" type="text" required>
                                 </div>
                                 <!--div class="form-group return-year">
                                    <label class="col-md-12 selectyear-label">Select a school year to import.</label>
                                    <label>School Year</label>
                                    <select id="school-yearevent">
                                         <option value="2016-2017">2016-2017</option>
                                         <option value="2016-2017">2016-2017</option>
                                         <option value="2016-2017">2016-2017</option>
                                         <option value="2016-2017">2016-2017</option>
                                    </select>
                                 </div-->
                                 <div class="button-group submit-import">
                                    <button class="renew-button import-continue" type="button"> Continue</button>
                                    <button class="close-button" data-dismiss="modal" type="button"> Cancel</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div id="csvfiles" class="tab-pane fade">
                           <div class="teachertabcontent">
                              <form method="post" action="{{ URL::to('/teacher/events/importExcel') }}" class="teachertab-form" enctype="multipart/form-data" id="csvImportForm">
                                {{ csrf_field() }}
                                 <p>To ensure a valid import, please make sure that your CSV file is formatted correctly.</p>
                                 <p>To view a sample CSV file, <a href="#">click here</a></p>
                                 <div class="form-group">
                                    <label>Filename</label>
                                    <input name="import_file" size="45" type="file">
                                 </div>
                                 <div class="button-group">
                                    <input class="renew-button importFile" type="submit" vlaue="Import File">
                                    <button class="close-button" data-dismiss="modal" type="button"> Cancel</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    
	  @endsection

     @push('js')
      <!--script type="text/javascript" src="../js/custom.js" ></script--> 
     
      <script>
          /*Import events*/ 
          
          $("#importBtn").click(function(){
             $("#importevents").modal();
         });
          $(document).on('click','.importFile',function(){
              var formData = $('#csvImportForm').serialize()

              var obj = $(this);
              $.ajax({
                type:'POST',
                url: BASE_URL +'/teacher/events/importExcel',
                data: formData,
               

                beforeSend: function () {
                  $('#main-loader').show();
                },
                complete: function () {
                  $('#main-loader').hide();
                },

                success: function (response) {
                  

                    console.log(response);
                  },


                error: function(data){
                  console.log("error");
                  console.log(data);
                }

              });
          });

          /*Import using Teacher's Sharing Key*/
          $(document).on('click','.import-continue',function(){
            var formData = $(this).closest('form').serialize();
            alert(formData);
            var url = BASE_URL +'/teacher/events/getyear';
            $.ajax({
              type:'get',
              url: url,
              data:formData,
              dataType : "json",
              beforeSend: function () {
                $('#main-loader').show();
              },
              complete: function () {
                $('#main-loader').hide();
              },

              success: function (response) {
                console.log(response);
                  var html = '';

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
                      $('.modal-body').before(html);
                      
                  }

                  if(response['success']){
                         
                    console.log(response['success']);

                    html += '<div id="success-box" class="alert alert-success fade in">';
                    html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                    html += '<strong> Events imported successfully !</strong>';
                    html += '</div>';

                    $('.editeventtabs').before(html);
                    //$('.editeventtabs')[0].reset();
                    setTimeout(function(){ 
                      $(".d-render-popoup").fadeOut();
                       window.location.reload();
                     }, 5000);


                   
                  }
                },


              error: function(data){
                console.log("error");
                console.log(data);
              }

            });
          });

      </script>
      <script>
         $(".fileattachmentmain").click(function(){
             $(".fileattachment-modal").show();
         });
         $(".close-filebutton").click(function(){
            $(".fileattachment-modal").hide();
         });	
         $(".actiondropdownbuttonmain").click(function(){
             $(".actiondropdown").toggle();
         });
         $(document).on('click','.eventmain-format',function(){
            $("#formateventmain-dropdownsetting").toggle();
         });	
        $('#exportBtn').on('click',function(){
          $('#exportevents').modal();
        });
        $(document).on('click','.csvDownloads',function(){
          var url = BASE_URL +'/teacher/events/downloadExcel/xls';
            $.ajax({
              type:'get',
              url: BASE_URL +'/teacher/events/downloadExcel/xls',
              beforeSend: function () {
                $('#main-loader').show();
              },
              complete: function () {
                $('#main-loader').hide();
              },

              success: function (data) {
                  document.location.href = url;
                  $('#exportevents').modal('hide');
                },


              error: function(data){
                console.log("error");
                console.log(data);
              }

            });

        });
         	  
      </script> 
      <script>
         var num = 0;
         $(document).on('click','.addday',function(){
            var html = '';
            html +='<div class="added-dayinner addDays">';
            html += '<input name="addday[]" class="form-control datepicker input-fields" id="demo8" type="text" size="10">';
            html += '<i class="fa fa-close" aria-hidden="true"></i>';
            html +='</div>';
            $('.addDiv').append(html);
            $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
         });
         $(document).on('click','.removeday',function(){
            var html = '';
            html +='<div class="added-dayinner addDays">';
            html += '<input name="removeday[]" class="form-control datepicker input-fields" id="demo8" type="text" size="10">';
            html += '<i class="fa fa-close" aria-hidden="true"></i>';
            html +='</div>';
            $('.removeDiv').append(html);
            $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
         });      
         $(document).on('click','.fa-close',function(){
            $(this).closest(".addDays").fadeOut(300);

          });
         $(".closefile-button").click(function(){
          $("#dynamicRenderDiv").hide();
         });

      </script>

      <script type="text/javascript">
      $("#addEventButton").click(function(){


         $("#dynamicRenderDiv").show().load("/teacher/events/add",function(){

            //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
            

          });

        });    
  
        /*Show user upload files*/
      $("body").on('click','.fileattachmentmain',function(e){
         e.preventDefault();
         $.ajax({
           type:'get',
           contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
           dataType : "html",
           data:{"_token": "{{ csrf_token() }}"},
           url: 'authUploads',
           success:function(response){
            $('.file-attchedmain').append(response);  
            $(".fileattachment-modal").show();
           },
           error: function(response){
            console.log("error");
            console.log(response);
           }

         });   
      }) ; 
      /*End Show user upload files*/
       <!--Apply images and embed script-->

       $(".closefile-button").click(function(){
          $("#applyfilemodal").hide();
         });
         $("body").on('click','.applyfilebuton',function(){
         $('.fileattachment-modal').css('display','none');
         $("#applyfilemodal").show();
         
         });
         $('body').on('click','.fileAttach',function(){
            $('.attachedFiles tr').css('display','block');
            $('#applyfilemodal').hide();
         });
         $('body').on('click','.embedfilebutton',function(){
            $("#applyfilemodal").hide();
            var id = tinymce.activeEditor.selection.getNode().id;
            $('.lessonTab').addClass('active').siblings().removeClass('active');
            if($('#homework').hasClass('active') || $('#notes').hasClass('active')){
            $('#homework').removeClass('active');
            $('#notes').removeClass('active');
            $('#description').addClass('active in'); 
            }
               var val = tinymce.get('description').getContent();
               tinymce.execCommand('mceFocus',false,'description');
               $("form.applyImgForm :input[name = embID]").each(function(index, elm){
                  var imgVal = $(this).val();
                  tinymce.get('description').execCommand("mceInsertContent", false, "<br/><img style='width:200px; max-width: 100%; height: 200px;' src='/uploads/myfiles/"+imgVal+"'/><br/>");
               });
               $("#embedfilemodal").hide();
               });
        $(".closeembedfile-button").click(function(){
          $("#embedfilemodal").hide();
         });    

        $('body').on('change','#uploadFile',function(e){
            var validExts = "*.pdf; *.jpg; *.png".replace(/\s+|\*/g, '').split(";");
            for(var i=0; i<e.target.files.length; i++){
               fileExt = e.target.files[i].name.substring(e.target.files[i].name.lastIndexOf('.'));
               if (validExts.indexOf(fileExt) < 0) {
                  alert("Invalid file selected, valid files are of " + validExts.toString() + " types.");
                  return false;
               }

               if(e.target.files[i].size > 300*1024*1024){
                  alert("File too large, we only accept 300MB");
                  return false;
               }
               $('#main-loader').css('display','block');
            }
            console.log(e.target.files);
            var $this = $(this);
            var formData = new FormData();
            formData.append("file", e.target.files[0]);
            formData.append("uploadSize", ((e.target.files[0].size)/1024).toFixed(2));
            formData.append("_token", $this.closest('form').find("[name='_token']").val());
            
            $.ajax({
               xhr: function() {
               var xhr = new window.XMLHttpRequest();
               xhr.upload.addEventListener("progress", function(evt) {
                 if (evt.lengthComputable) {
                  $('.popupProgress').css("display","block");  
                  var percentComplete = evt.loaded / evt.total;
                  percentComplete = parseInt(percentComplete * 100);
                  console.log(percentComplete);
                  var percentVal = percentComplete + '%';
                   $('#bar1').width(percentVal);
                   $('#Imgpercent').html(percentVal);
                  if (percentComplete === 100) {

                  }

                 }
               }, false);

               return xhr;
              },     
              type:'POST',
              url: 'attachFiles',
              data: formData,
              cache:false,
              contentType: false,
              processData: false,

              success:function(data){
               $(".file-attchedmain").load("authUploads"); 
               //$('#main-loader').css('display','none');
               setTimeout(function(){
                  $('.popupProgress').css("display","none"); 
                  
               }, 1000);   
               },
               error: function(data){
               console.log("error");
               console.log(data);
              }

            });
         }); 
        /* Add class dtatt*/
  var saveevent = [];      
  $(document).on('click','#save_event_button',function(e){
      var check = $(".noSchool").prop('checked');
      saveevent = $("#eventaddform").serializeArray();
      if(check==true){
        $('#saveeventmodal').css('display','block');
      }
      else{
          saveEvents(saveevent);
      }

  }); 
  $(document).on('click','.saveshiftLessons',function(){
      saveevent.push({name:'shiftlesson', value:'yes'});
      saveEvents(saveevent);
      $('#saveeventmodal').css('display','none');
  });

  $(document).on('click','.dontshiftLessons',function(){
      saveevent.push({name:'shiftlesson', value:'No'});
      saveEvents(saveevent);
      $('#saveeventmodal').css('display','none');
  });
  /*save event function*/
  function saveEvents(formData){
    tinyMCE.triggerSave();
    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/events/add',
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        var html = '';

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
            $('#eventaddform').before(html);
            
        }

        if(response['success']=='TRUE'){
          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have created Event successfully !</strong>';
          html += '</div>';

          $('#eventaddform').before(html);
          $('#eventaddform')[0].reset();
          setTimeout(function(){ 
            $(".d-render-popoup").fadeOut();
             window.location.reload();
           }, 5000);


         
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
  }
  

  $(".edit_events").click(function(){

    var event_id = $(this).data("event-id");
    
    $("#dynamicRenderDiv").show().load("/teacher/events/edit/"+event_id,function(){
      

    });
  });  
  /* Save edit classs datra*/
  var saveevent = []; 
  var event_id  = '';      
  $(document).on('click','#save_edit_event_data_button',function(e){
      event_id = $("#geteventid").val();
      var check = $(".noSchool").prop('checked');
      saveevent = $("#eventaddform").serializeArray();
      if(check==true){
        $('#editeventmodal').css('display','block');
      }
      else{
          editEvents(saveevent,event_id);
      }

  }); 
  $(document).on('click','.editshiftLessons',function(){
      saveevent.push({name:'shiftlesson', value:'yes'});
      editEvents(saveevent,event_id);
      $('#editeventmodal').css('display','none');
  });

  $(document).on('click','.dontedittLessons',function(){
      saveevent.push({name:'shiftlesson', value:'No'});
      editEvents(saveevent,event_id);
      $('#editeventmodal').css('display','none');
  });
  function editEvents(formData,event_id){
  tinyMCE.triggerSave();
    var obj = $(this);
    $.ajax({
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
      type:'POST',
      url: BASE_URL +'/teacher/events/edit/'+event_id,
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        $('#main-loader').show();
      },
      complete: function () {
        $('#main-loader').hide();
      },

      success: function (response) {
        var html = '';

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
          html += '<strong>You Have Edit Event successfully !</strong>';
          html += '</div>';

          $('#eventaddform').before(html);
          $('#eventaddform')[0].reset();
          setTimeout(function(){ 
            $(".d-render-popoup").fadeOut();
             window.location.reload();
           }, 5000);
         
        }

        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
      
  } 
  $(document).on('click','.closebutton',function(){
    $(this).closest('#dynamicRenderDiv').hide();
  });
  /*csv Downloads*/
  

 
</script>
	@endpush  