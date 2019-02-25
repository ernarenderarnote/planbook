<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <div class="normalLesson pull-left">
                <p> Event</p>
            </div>
            <div class="actionright pull-right">
                <button id="save_event_button" class="actiondropbutton renew-button">Save</button>
                <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a>
            </div>
        </div>

        <div class="modal-body">
            <form method="post" action="#" class="editlessonform" id="eventaddform">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Start Date</label>
                        <input name="startdate" class="form-control input-fields datepicker" id="demo9" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Start Time</label>
                        <input name="starttime" id="basicExample5" class="time ui-timepicker-input input-fields timepicker" autocomplete="off" type="text">
                    </div>
                    <div class="col-md-4 form-group checkbox-field">
                        <label>
                            <input name="schoolday" type="hidden" value="N">
                            <input name="schoolday" class="noSchool" type="checkbox" value="Y"> No School Day</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>End Date</label>
                        <input name="enddate" class="form-control input-fields datepicker" id="demo10" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>End Time</label>
                        <input name="endtime" id="basicExample6" class="time ui-timepicker-input input-fields timepicker" autocomplete="off" type="text">
                    </div>
                    <div class="col-md-4 form-group checkbox-field">
                        <label>
                            <input name="privateevent" type="hidden" value="N">
                            <input name="privateevent" type="checkbox" value="Y"> Private Event</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Repeats</label>
                        <select name="repeats" id="repeats">
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
                                                <div id="titleShowCell">
                                                    <label class="checkbox-inline" style="display:none;">
                                                        <input value="Y" type="checkbox">Show title of lesson section in plan view</label>
                                                </div>
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
                    <textarea class="editorMce" name="description" placeholder="Write Somehting"> </textarea>
                </div>

                <div class="added-daysection">
                    <p>Added Days <a href="javascript:;" class="main-buton addday"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                </div>
                <div class="addDiv">

                </div>
                <div class="added-daysection ">
                    <p>Removed Days <a href="javascript:;" class="main-buton removeday"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                </div>
                <div class="removeDiv">
                    <div class="added-dayinner removeDays">

                    </div>
                </div>
                <div class="attachment-field">
                    <div class="form-group">
                        <label>Attachments</label>
                        <a class="main-buton attachment-button fileattachmentmain"> <img src="/images/paperclip.png"></a>
                        <a class="main-buton attachment-button"> <img src="/images/google-drive.png"></a>
                    </div>
                </div>
                <div class="filetable">
                    <table id="attachedFiles" class="attachedFiles">

                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="saveeventmodal" class="modal fade in movemodalcontent" style="display: none;">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">No School Event</h4>
        </div>
        <div class="modal-body">
          <p>Would you like your lessons shifted to accommodate for the new No School event? Note that if lessons are not shifted, any lessons on the No School day will be deleted.</p>
          <div class="button-group">
            <button class="renew-button saveshiftLessons" data-dismiss="modal"> Shift Lessons</button>
            <button class="renew-button dontshiftLessons" data-dismiss="modal"> Do not Shift Lessons</button>
            <button class="close-button" data-dismiss="modal"> Cancel</button>
          </div>
        </div>
      </div>
    </div>
</div>
<script>

 
   $('.datepicker').datepicker({format: 'dd/mm/yyyy',autoclose:true});
    $('.timepicker').timepicker({
    'timeFormat': 'h:i A',
    'scrollDefault' : '8:00am',
    'forceRoundTime' : false,
  });

$(document).on('click','.fa-close',function(){
$('.d-render-popoup').fadeOut();
});
/*editor script*/
   tinymce.init({
     selector: '.editorMce',
     height: 200,
     theme: 'modern',
setup: function (editor) {                  
editor.on('focus', function(e) {
editor.selection.select(editor.getBody(), true);
editor.selection.collapse(false);
});                                             
},
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