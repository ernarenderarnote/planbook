@extends('layouts.teacher')

@section('content')
@php $url = request()->view ; @endphp
<div class="events-section">
         <div class="copy-header"> Events </div>
         <div class="list-contentbutton">
            <div class="btn-group">
               <button type="button" class="btn unitsbutton"> Today</button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton" data-toggle="modal" data-target="#addevent"><img src="/images/add2.png" class="event-icon" > Add Event </button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton" data-toggle="modal" data-target="#importevents"><img src="/images/import.png" class="event-icon"> Import Events </button>
            </div>
            <div class="btn-group">
               <button type="button" class="btn unitsbutton" data-toggle="modal" data-target="#exportevents"><img src="/images/export.png" class="event-icon"> Export Events </button>
            </div>
         </div>
         <div class="events-table">
            <p> Events</p>
            <div class="event-tableinner">
               <table border="1">
                  <tbody>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent" >
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                     <tr data-toggle="modal" data-target="#addevent">
                        <td>03/06/2017</td>
                        <td class="event-tablesecondfield"> Winter Break</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--add event popup start-->
      <div id="addevent" class="modal fade editmodalcontent listmodalcontent" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <div class="normalLesson pull-left">
                     <p> Event</p>
                  </div>
                  <div class="actionright pull-right">
                     <button class="actiondropbutton renew-button">Save</button>
                     <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                  </div>
               </div>

               <div class="modal-body">
                  <form method="post" action="#" class="editlessonform">
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Start Date</label>
                           <input class="form-control input-fields datepicker" id="demo9" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Start Time</label>
                           <input id="basicExample5" class="time ui-timepicker-input input-fields timepicker" autocomplete="off" type="text">
                        </div>
                        <div class="col-md-4 form-group checkbox-field">
                           <label>
                           <input type="checkbox" value="">
                           No School Day</label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>End Date</label>
                           <input class="form-control input-fields datepicker" id="demo10" type="text">
                        </div>
                        <div class="col-md-4 form-group">
                           <label>End Time</label>
                           <input id="basicExample6" class="time ui-timepicker-input input-fields timepicker" autocomplete="off" type="text">
                        </div>
                        <div class="col-md-4 form-group checkbox-field">
                           <label>
                           <input type="checkbox" value="">
                           Private Event</label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                           <label>Repeats</label>
                           <select  name="repeats" id="repeats">
                              <option value="daily">Daily</option>
                              <option value="weekly">Weekly</option>
                              <option value="biweekly">Biweekly</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 titlefield">
                           <label>Event Title</label>
                           <input type="text" name="title" class="memorialtitlefied">
                           
						   <div class="btn-formattoggle">
 <button class="formatevent-button renew-button eventmain-format" type="button">Format</button>
   <div class="formatcolors-dropdown formateventdropdown-main" id="formateventmain-dropdownsetting">
  
   <table class="formatcolors-dropdowntable">
       <tbody>
         <tr>
            <td colspan="4">
              <div id="titleShowCell"><label class="checkbox-inline" style="display:none;"><input value="Y" type="checkbox">Show title of lesson section in plan view</label></div>
            </td>
             <td>
             <label class="formatcolorlabel-heading">Text</label>
            </td>
            <td>
             <label class="formatcolorlabel-heading">Fill</label>
            </td>
         </tr>
         <tr>
             <td>
             <label style="text-align:right; width:45px; padding-top:4px;">Title:</label>
            </td>
             <td>
            <select id="formatTitleFont">
						<option style="font-family: andale mono, times;" value="1">Andale Mono</option>
						<option style="font-family: arial, helvetica, sans-serif;" value="2">Arial</option>
						<option style="font-family: arial black, avant garde;" value="3">Arial Black</option>
						<option style="font-family: book antiqua, palatino;" value="4">Book Antiqua</option>
						<option style="font-family: comic sans ms, sans-serif;" value="5">Comic Sans MS</option>
						<option style="font-family: courier new, courier;" value="6">Courier New</option>
						<option style="font-family: georgia, palatino;" value="7">Georgia</option>
						<option style="font-family: helvetica;" value="8">Helvetica</option>
						<option style="font-family: impact, chicago;" value="9">Impact</option>
						<option style="font-family: tahoma, arial, helvetica, sans-serif;" value="10">Tahoma</option>
						<option style="font-family: terminal, monaco;" value="11">Terminal</option>
						<option style="font-family: times new roman, times;" value="12">Times New Roman</option>
						<option style="font-family: trebuchet ms, geneva;" value="13">Trebuchet MS</option>
						<option style="font-family: verdana, geneva;" value="14">Verdana</option>
					</select>
            </td>
           
            <td>
					<select class="format-displayfonts" id="formatTitleSize">
						<option value="8">8pt</option>
						<option value="9">9pt</option> 
						<option value="10">10pt</option>
						<option value="11">11pt</option> 
						<option value="12">12pt</option>
						<option value="13">13pt</option> 
						<option value="14">14pt</option>
					</select>
				</td>
                
       
         <td>
					<div class="dButtons">
						<div id="formatTitleB" class="dButton bbutton" title="Bold">B</div>
						<div id="formatTitleI" class="dButton ibutton" title="Italic" style="font-style: italic; background-color: rgb(238, 238, 238);">I</div>
						<div id="formatTitleU" class="dButton ubutton" title="Underline" style="text-decoration: underline; margin: 0px; background-color: rgb(238, 238, 238);">U</div>
					</div>
				</td>
                 <td>
					<input class="form-control" type="color">
				</td>
                <td>
					<input class="form-control" type="color">
				</td>
         
         </tr>
          <tr>
             <td>
             <label style="text-align:right; width:45px; padding-top:4px;">Body:</label>
            </td>
             <td>
            <select id="formatTitleFont">
						<option style="font-family: andale mono, times;" value="1">Andale Mono</option>
						<option style="font-family: arial, helvetica, sans-serif;" value="2">Arial</option>
						<option style="font-family: arial black, avant garde;" value="3">Arial Black</option>
						<option style="font-family: book antiqua, palatino;" value="4">Book Antiqua</option>
						<option style="font-family: comic sans ms, sans-serif;" value="5">Comic Sans MS</option>
						<option style="font-family: courier new, courier;" value="6">Courier New</option>
						<option style="font-family: georgia, palatino;" value="7">Georgia</option>
						<option style="font-family: helvetica;" value="8">Helvetica</option>
						<option style="font-family: impact, chicago;" value="9">Impact</option>
						<option style="font-family: tahoma, arial, helvetica, sans-serif;" value="10">Tahoma</option>
						<option style="font-family: terminal, monaco;" value="11">Terminal</option>
						<option style="font-family: times new roman, times;" value="12">Times New Roman</option>
						<option style="font-family: trebuchet ms, geneva;" value="13">Trebuchet MS</option>
						<option style="font-family: verdana, geneva;" value="14">Verdana</option>
					</select>
            </td>
           
            <td>
					<select class="format-displayfonts" id="formatTitleSize">
						<option value="8">8pt</option>
						<option value="9">9pt</option> 
						<option value="10">10pt</option>
						<option value="11">11pt</option> 
						<option value="12">12pt</option>
						<option value="13">13pt</option> 
						<option value="14">14pt</option>
					</select>
				</td>
                
       
         <td>
					<div class="dButtons">
						<div id="formatTitleB" class="dButton bbutton" title="Bold">B</div>
						<div id="formatTitleI" class="dButton ibutton" title="Italic" style="font-style: italic; background-color: rgb(238, 238, 238);">I</div>
						<div id="formatTitleU" class="dButton ubutton" title="Underline" style="text-decoration: underline; margin: 0px; background-color: rgb(238, 238, 238);">U</div>
					</div>
				</td>
                 <td>
					<input class="form-control" type="color">
				</td>
                <td>
					<input class="form-control" type="color">
				</td>
         
         </tr>
       </tbody>
   </table>
  </div>
 
</div>
                        </div>
                     </div>
                     <div class="Description-memorial">
                        <p>Description</p>
                        <textarea placeholder="Write Somehting">    </textarea>
                     </div>
                     <div class="added-daysection">
                        <p>Added Days <a href="" class="main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                     </div>
                     <div class="added-dayinner">
                        <input class="form-control input-fields" id="demo8" type="text" size="10">
                        <i class="fa fa-close" aria-hidden="true"></i> 
                     </div>
                     <div class="added-daysection">
                        <p>Removed Days <a href="" class="main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                     </div>
                     <div class="added-dayinner">
                        <input class="form-control input-fields" id="demo11" type="text" size="10">
                        <i class="fa fa-close" aria-hidden="true"></i> 
                     </div>
                     <div class="attachment-field">
                        <div class="form-group">
                           <label>Attachments</label>
                           <a class="main-buton attachment-button fileattachmentmain"> <img src="/images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="/images/google-drive.png"></a> 
                        </div>
                     </div>
                     <div class="filetable">
                        <table>
                           <tbody>
                              <tr>
                                 <td class="filename"><a href="#"> site.jpg </a></td>
                                 <td><label>
                                    <input type="checkbox">
                                    Private</label>
                                 </td>
                                 <td>
                                    <div class="main-buton trash-button"><i class="fa fa-trash" aria-hidden="true"></i></div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!--file attachment popup start-->
      <div class="fileattachment-modal">
         <div class="fileattachment-header">My Files</div>
         <div class="fileattachment-body">
            <div>
               <input placeholder="Search File(s)" id="filterFilePickerFiles" type="text" class="file-attchedinput">
            </div>
            <div class="file-attchedtext"> </div>
            <div class="file-attchedbutton">
               <button class="main-buton filebuttons">Apply</button>
               <button class="main-buton  filebuttons">Clear all</button>
               <div class="main-buton file-attchment">
                  <input type="file">
                  <span class="upload-text">Upload New File</span> 
               </div>
               <button class="close-filebutton filebuttons">Cancel</button>
            </div>
         </div>
      </div>
     
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
                     <button class="renew-button" type="button"> Include HTML</button>
                     <button class="renew-button" type="button"> Do not include HTML</button>
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
                              <form method="post" action="" class="teachertab-form">
                                 <p>To import events from another teacher, enter teacher's email address and teacher key</p>
                                 <div class="form-group">
                                    <label>Teacher Email</label>
                                    <input id="shareEmailEvent" name="shareEmailEvent" size="40" title="Enter teacher's email address" type="text">
                                 </div>
                                 <div class="form-group">
                                    <label>Teacher Key</label>
                                    <input id="shareKeyEvent" name="shareKeyEvent" size="40" title="Enter teacher's security key" type="text">
                                 </div>
                                 <div class="button-group">
                                    <button class="renew-button" type="button"> Continue</button>
                                    <button class="close-button" data-dismiss="modal" type="button"> Cancel</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div id="csvfiles" class="tab-pane fade">
                           <div class="teachertabcontent">
                              <form method="post" action="" class="teachertab-form">
                                 <p>To ensure a valid import, please make sure that your CSV file is formatted correctly.</p>
                                 <p>To view a sample CSV file, <a href="#">click here</a></p>
                                 <div class="form-group">
                                    <label>Filename</label>
                                    <input name="importFile" size="45" type="file">
                                 </div>
                                 <div class="button-group">
                                    <button class="renew-button" type="button"> Import File</button>
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
      <!--script type="text/javascript" src="../js/jquery.min.js"></script> 
      <script type="text/javascript" src="../js/bootstrap.min.js" ></script> 
      <script type="text/javascript" src="../js/custom.js" ></script> 
      <script type="text/javascript" src="../tinymce_4.6.3_dev/tinymce/js/tinymce/tinymce.js"></script> 
      <!--script src="../js/dcalendar.picker.js"></script> 
      <script src="../js/jquery.timepicker.js"></script--> 
      <script>
         
         $('#calendar-demo').dcalendar(); //creates the calendar
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
             'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc Start Datehelp'
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

      <script type="text/javascript">
  
  $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
  $('.timepicker').timepicker({
    'timeFormat': 'h:i A',
    'scrollDefault' : '8:00am',
    'forceRoundTime' : false,
  });

</script>
	@endpush  