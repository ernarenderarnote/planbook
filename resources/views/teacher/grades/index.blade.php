@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section">
         <div class="copy-header"> Student Grades</div>
         <div class="list-contentbutton gradebutons">
            <div class="btn-group">
               <button type="button" class="btn languagebuton list-contentmainbuton  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Language Arts <span class="caret"></span> </button>
               <ul class="dropdown-menu language-dropdown">
                  <li><a href="#" class="language-dropbutons languagebuton">Language Arts </a></li>
                  <li><a href="#" class="language-dropbutons mathematics">Mathematics</a></li>
                  <li><a href="#" class="language-dropbutons reading">Reading</a></li>
                  <li><a href="#" class="language-dropbutons sciencebuton">Science</a></li>
                  <li><a href="#" class="language-dropbutons socialstudybuton">Social Studies</a></li>
                  <li><a href="#" class="language-dropbutons supermarketbutton">Supermarket</a></li>
                  <li><a href="#" class="language-dropbutons writingbutton">Writing</a></li>
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
               <p>No <a href="addstudent.html" target="_blank">students</a> have been assigned to this class</p>
            </div>
         </div>
      </div>

      <!-----grades-->

      <div class="show-assignmentsgrades">
         <div class="show-assignmentstop">
            <p>Show Assignments</p>
            <div class="show-gradeassignmentsbuttons">
               <button class="btn active" type="button">All</button>
               <button class="btn" type="button">None</button>
               <button class="btn" type="button">Prior</button>
               <button class="btn" type="button">Next</button>
            </div>
            <p>Show Assessments</p>
            <div class="show-gradeassignmentsbuttons">
               <button class="btn active" type="button">All</button>
               <button class="btn" type="button">None</button>
               <button class="btn" type="button">Prior</button>
               <button class="btn" type="button">Next</button>
            </div>
         </div>
         <div class="show-assignmentstable">
            <table>
               <thead>
                  <tr>
                     <th class="show-assignmentstablerow1"></th>
                     <th class="show-assignmentstablerow2"><span class="showassesmenttable-innerrow">Overall</span></th>
                     <th class="show-assignmentstablerow2"><span class="showassesmenttable-innerrow">Period</span></th>
                     <th class="show-assignmentstablerow2"><span class="showassesmenttable-innerrow">liuh<br><span style="font-size: 9px;">No Category</span></span></th>
                     <th class="show-assignmentstablerow2"><span class="showassesmenttable-innerrow">tuis<br><span style="font-size: 9px;">No Category</span></span></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td> Due Date <span class="show-assesmentsorting pull-right">Sort<i class="fa fa-caret-left" aria-hidden="true"></i></span></td>
                     <td> </td>
                     <td> </td>
                     <td> 10/02</td>
                     <td class="show-assessmentrowbackground"></td>
                  </tr>
                  <tr>
                     <td>Class Average</td>
                     <td> </td>
                     <td> </td>
                     <td> 10/02</td>
                     <td>10/50</td>
                  </tr>
                  <tr>
                     <td>arnote, narender</td>
                     <td> </td>
                     <td> </td>
                     <td> 10/02</td>
                     <td>10</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="individualStudentGradesBox">
         <div class="nav">
            <table>
               <tbody>
                  <tr>
                     <td id="studentName">arnote, narender</td>
                     <td>
                        <button  class="navButton" type="button">All</button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="percentage">
            <table>
               <tbody>
                  <tr>
                     <th>Percentage:</th>
                     <td><input id="individualStudentOverrideScore" value="100"   type="text"></td>
                     <th style="padding-left: 25px;">Letter Grade:</th>
                     <td id="individualStudentLetterGrade"></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="individualStudentGradesContainer">
            <table style="border-collapse:collapse;">
               <thead>
                  <th colspan="5">Assignments</th>
               </thead>
               <tbody>
                  <tr class="data dataheader">
                     <td>Title</td>
                     <td>Type</td>
                     <td>  Due Date</td>
                     <td>Points</td>
                     <td>Notes</td>
                  </tr>
                  <tr class="data">
                     <td>liuh</td>
                     <td></td>
                     <td>10/02/2017</td>
                     <td><input class="individualStudentGrade" id="isgASG347389" tabindex="1" type="text" value="10"><span> / 50</span></td>
                     <td><input class="studentGradeNote" tabindex="3"></td>
                  </tr>
                  <tr class="data">
                     <td>liuh</td>
                     <td></td>
                     <td>10/02/2017</td>
                     <td><input class="individualStudentGrade" id="isgASG347389" tabindex="1" type="text" value="10"><span> / 50</span></td>
                     <td><input class="studentGradeNote" tabindex="3"></td>
                  </tr>
               </tbody>
            </table>
            <table style="border-collapse:collapse;">
               <thead>
                  <th colspan="5">Assessments</th>
               </thead>
               <tbody>
                  <tr class="data dataheader">
                     <td>Title</td>
                     <td>Type</td>
                     <td>  Due Date</td>
                     <td>Points</td>
                     <td>Notes</td>
                  </tr>
                  <tr class="data">
                     <td>liuh</td>
                     <td></td>
                     <td></td>
                     <td><input class="individualStudentGrade" id="isgASG347389" tabindex="1" type="text" value="10"><span> / 50</span></td>
                     <td><input class="studentGradeNote" tabindex="3"></td>
                  </tr>
                  <tr class="data">
                     <td>liuh</td>
                     <td></td>
                     <td></td>
                     <td><input class="individualStudentGrade" id="isgASG347389" tabindex="1" type="text" value="10"><span> / 50</span></td>
                     <td><input class="studentGradeNote" tabindex="3"></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>


      <!--grades-->



      <!-- Addperiod Section Start Here -->
      <div id="addperiod" class="modal fade movemodalcontent editmodalcontent  addteachercontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header addperiodheder">
                  <div class="normalLesson pull-left">
                     <p> Grading Period</p>
                  </div>
                  <div class="actionright pull-right">
                     <button class="actiondropbutton renew-button">Save</button>
                     <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                  </div>
               </div>
               <div class="modal-body">
                  <form method="post" action="#" class="addteacher-form addperiodform">
                     <div class="form-group col-md-12">
                        <label>Period Name</label>
                        <input type="text" class="addteacherfield">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Start Date</label>
                        <input class="addteacherfield" id="demo9" type="text">
                     </div>
                     <div class="form-group col-md-12">
                        <label>End Date</label>
                        <input class="addteacherfield" id="demo10" type="text">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!--asessment lesson popup start-->
      <div id="addassessment" class="modal fade editmodalcontent assesment-content" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <div class="normalLesson pull-left">
                     <p> Assessment</p>
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
                           <label>Class</label>
                           <select id="assessmentClass">
                              <option value="0">Select Class</option>
                              <option value="6902022">Language Arts</option>
                              <option value="6902023">Mathematics</option>
                              <option value="6902024">Reading</option>
                              <option value="6902025">Science</option>
                              <option value="6902026">Social Studies</option>
                              <option value="6902028">Supermarket</option>
                              <option value="6902027">Writing</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Starts On</label>
                           <input class="input-fields" id="demo13" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Unit</label>
                           <select id="assessmentUnit">
                              <option value="0">Select Unit</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Ends On</label>
                           <input class="input-fields" id="demo14" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Type</label>
                           <select id="assessmentType">
                              <option value="0">Select Type</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Total Points</label>
                           <input id="assessmentPoints" class="input-fields" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 titlefield">
                           <label> Title</label>
                           <input type="text" name="title" class="memorialtitlefied">
                        </div>
                     </div>
                     <div class="Description-memorial">
                        <p>Description</p>
                        <textarea placeholder="Write Somehting">    </textarea>
                     </div>
                     <div class="standard-section">
                        <label>Standards</label>
                        <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                     </div>
                     <div class="attachment-field">
                        <div class="form-group">
                           <label>Attachments</label>
                           <a class="main-buton attachment-button fileattachmentmain"> <img src="../images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="../images/google-drive.png"></a> 
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
      <!--assignment lesson popup start-->
      <div id="assignmentmodal" class="modal fade editmodalcontent assesment-content" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <div class="normalLesson pull-left">
                     <p> Assignment</p>
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
                           <label>Class</label>
                           <select id="assessmentClass">
                              <option value="0">Select Class</option>
                              <option value="6902022">Language Arts</option>
                              <option value="6902023">Mathematics</option>
                              <option value="6902024">Reading</option>
                              <option value="6902025">Science</option>
                              <option value="6902026">Social Studies</option>
                              <option value="6902028">Supermarket</option>
                              <option value="6902027">Writing</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Starts On</label>
                           <input class="input-fields" id="demo15" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Unit</label>
                           <select id="assessmentUnit">
                              <option value="0">Select Unit</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Ends On</label>
                           <input class="input-fields" id="demo16" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 form-group">
                           <label>Type</label>
                           <select id="assessmentType">
                              <option value="0">Select Type</option>
                           </select>
                        </div>
                        <div class="col-md-4 form-group">
                           <label>Total Points</label>
                           <input id="assessmentPoints" class="input-fields" type="text">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12 titlefield">
                           <label> Title</label>
                           <input type="text" name="title" class="memorialtitlefied">
                        </div>
                     </div>
                     <div class="Description-memorial">
                        <p>Description</p>
                        <textarea placeholder="Write Somehting">    </textarea>
                     </div>
                     <div class="standard-section">
                        <label>Standards</label>
                        <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                     </div>
                     <div class="attachment-field">
                        <div class="form-group">
                           <label>Attachments</label>
                           <a class="main-buton attachment-button fileattachmentmain"> <img src="../images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="../images/google-drive.png"></a> 
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
      <!--fileattachment modal start here-->
      <div class="fileattachment-modal">
         <div class="fileattachment-header">My Files</div>
         <div class="fileattachment-body">
            <div>
               <input  placeholder="Search File(s)" id="filterFilePickerFiles" type="text" class="file-attchedinput">
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
      <!-- performancereport Section Start Here -->
      <div id="performancereport" class="modal fade movemodalcontent editmodalcontent  addteachercontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header addperiodheder">
                  <div class="normalLesson pull-left">
                     <p> Student Performance Reports</p>
                  </div>
                  <div class="actionright pull-right">
                     <button class="actiondropbutton renew-button">Create Reports</button>
                     <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                  </div>
               </div>
               <div class="modal-body">
                  <form method="post" action="#" class="addteacher-form performanceform">
                     <div class="col-md-6">
                        <div class="form-group col-md-12">
                           <label>Grade Period</label>
                           <select>
                              <option value="0">All Periods</option>
                           </select>
                        </div>
                        <div class="form-group col-md-12">
                           <label>Student </label>
                           <select>
                              <option value="A">A</option>
                              <option value="B">B</option>
                           </select>
                        </div>
                        <div class="form-group col-md-12 reporttyperadio">
                           <label>Report Type </label>
                           <input name="gradeReportType" value="0" checked="checked" type="radio">
                           Grades and Standards<br>
                           <input name="gradeReportType" value="1" type="radio">
                           Grades Only<br>
                           <input name="gradeReportType" value="2" type="radio">
                           Standards Only 
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="performancegradegroup">
                           <label> <b>Grade Report Options</b></label>
                           <label>
                           <input name="gradeReportClassDetail" id="gradeReportClassDetail" value="Y" checked="checked" type="checkbox">
                           Include all assignment and assessment grades</label>
                           <label>
                           <input id="gradeReportIncludeNotes" name="gradeReportIncludeNotes" value="Y" type="checkbox">
                           Include grade notes</label>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- letter grade Section Start  -->
      <div id="lettergrade" class="modal fade editmodalcontent in" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" action="#" class="editlessonform editscore-form">
                  <div class="modal-header">
                     <div class="normalLesson pull-left">
                        <p>Letter Grades</p>
                     </div>
                     <div class="actionright pull-right">
                        <button class="actiondropbutton renew-button">Save</button>
                        <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                     </div>
                  </div>
                  <div class="modal-body editscore-body">
                     <p>To add sample grades, <a href="#">click here</a></p>
                     <div class="added-daysection added-assessmentbox">
                        <p>Letter Grades <a href="javascript:void(0)" class="main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
                     </div>
                     <div class="assignment-table">
                        <table>
                           <thead>
                              <tr class="tHeader">
                                 <th>Letter Grade</th>
                                 <th>Minimum Percent</th>
                                 <th style="background-color:#dbdfe8; border:none;"></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><input id="nameAssignmentWeight0" size="11" value="" type="text"></td>
                                 <td><input id="percentAssignmentWeight0" size="11" value="" class="perchantage-input" type="text"></td>
                                 <td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
                              </tr>
                              <tr>
                                 <td><input id="nameAssignmentWeight0" size="11" value="" type="text"></td>
                                 <td><input id="percentAssignmentWeight0" size="11" value="" class="perchantage-input" type="text"></td>
                                 <td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>


@endsection
  
@push('js')
   <script type="text/javascript" src="../js/jquery.min.js"></script> 
      <script type="text/javascript" src="../js/bootstrap.min.js" ></script> 
      <script type="text/javascript" src="../js/custom.js" ></script> 
      <script type="text/javascript" src="../tinymce_4.6.3_dev/tinymce/js/tinymce/tinymce.js"></script> 
      <script src="../js/dcalendar.picker.js"></script> 
      <script src="../js/jquery.timepicker.js"></script> 
      <script>
         $(".standardmainbuttons").click(function(){
                 $(".standardmainbuttons").toggleClass("standardshowbutton");
             });
         $('#demo9').dcalendarpicker();
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
         $('#calendar-demo').dcalendar(); //creates the calendar
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
@endpush  