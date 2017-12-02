@extends('layouts.teacher')

@section('content')


<div class="events-section">
     <div class="copy-header"> Templates</div>
     <div class="list-contentbutton gradebutons">
        <div class="btn-group">
           <button type="button" class="btn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All Classes<span class="caret"></span> </button>
           <ul class="dropdown-menu language-dropdown">
              <li><a href="#" class="language-dropbutons unitdropbuton"> All Classes</a></li>
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
           <button type="button" class="btn unitsbutton"  data-toggle="modal" data-target="#addtemplatemain"> <img src="/images/add2.png" class="event-icon">Add Template</button>
        </div>
     </div>
     <div class="lessonsearch-contenttable assessement-table">
        <table class="templatesadd-table">
           <thead>
              <tr class="tHeader">
                 <th style="background-color:transparent; border:0;"></th>
                 <th class="tempaltes-classfield">Class</th>
                 <th>Day</th>
                 <th>Type</th>
                 <th>Start</th>
                 <th>End</th>
              </tr>
           </thead>
           <tbody>
              <tr>
                 <td style="background-color:rgb(194, 68, 171); border:1px solid rgb(194, 68, 171); border-top-width:0; border-bottom-color:white; cursor:pointer;" data-toggle="modal" data-target="#addtemplatemain"></td>
                 <td class="tempaltes-classfield">Language Arts</td>
                 <td>Sunday</td>
                 <td>Homework</td>
                 <td>07/01/2017</td>
                 <td>07/01/2018</td>
              </tr>
           </tbody>
        </table>
     </div>
  </div>
  <!--add template popup start-->
  <div id="addtemplatemain" class="modal fade editmodalcontent" role="dialog">
     <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-header">
              <div class="normalLesson pull-left">
                 <p> Template</p>
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
                       <select >
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
                       <label>Starts on</label>
                       <input class="form-control input-fields" id="demo14" type="text">
                    </div>
                    <div class="col-md-4 form-group checkbox-field">
                       <label>
                       <input type="checkbox" value="">
                       Use class start</label>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-4 form-group">
                       <label>Day</label>
                       <select>
                          <option value="E">Everyday</option>
                          <option value="U">Sunday</option>
                          <option value="M">Monday</option>
                          <option value="T">Tuesday</option>
                          <option value="W">Wednesday</option>
                          <option value="R">Thursday</option>
                          <option value="F">Friday</option>
                          <option value="S">Saturday</option>
                       </select>
                    </div>
                    <div class="col-md-4 form-group">
                       <label>Ends on</label>
                       <input class="form-control input-fields" id="demo15" type="text">
                    </div>
                    <div class="col-md-4 form-group checkbox-field">
                       <label>
                       <input type="checkbox" value="">
                       Use class end</label>
                    </div>
                 </div>
                 <div class="row">
                    <div class="form-group col-md-12 titlefield">
                       <label>Type</label>
                       <select>
                          <option id="templateLessonOption" value="L">Lesson</option>
                          <option id="templateHomeworkOption" value="H">Homework</option>
                          <option id="templateNotesOption" value="N">Notes</option>
                          <option id="templateTab4Option" value="4" style="display: none;">Section 4</option>
                          <option id="templateTab5Option" value="5" style="display: none;">Section 5</option>
                          <option id="templateTab6Option" value="6" style="display: none;">Section 6</option>
                          <option id="templateMyStandardOption" value="MS" style="display: none;">My List</option>
                          <option id="templateSchoolStandardOption" value="SS" style="display: none;">School List</option>
                          <option id="templateStandardOption" value="S">Standards</option>
                       </select>
                    </div>
                 </div>
                 <div class="Description-memorial">
                    <p>Template</p>
                    <textarea placeholder="Write Somehting">    </textarea>
                 </div>
              </form>
           </div>
        </div>
     </div>
  </div>
  
@endsection

@push('js')
  <script>
     $('#demo14').dcalendarpicker();
     $('#calendar-demo').dcalendar(); //creates the calendar
     $('#demo15').dcalendarpicker();
     $('#calendar-demo').dcalendar(); //creates the calendar
  </script>
  <script>
     tinymce.init({
       selector: 'textarea',
       height: 200,
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