@extends('layouts.teacher')

@section('content')

<div class="events-section">
   <div class="copy-header"> Add or change your display settings</div>
   <div class="sharingoptions-section">
      <form method="post" action="">
         <div class="sharingoptions-header">
            <div class="sharingoptions-left pull-left"> Display Settings </div>
            <div class="sharingoptions-right pull-right">
               <button class="renew-button save-button">Save</button>
               <a href="classes.html" class="closebutton"><i class="fa fa-close" aria-hidden="true"></i></a>
            </div>
         </div>
         <div class="sharingoptions-body displaysetting-section">
            <div class="displaysetting-heading">Lesson Sections <button class="renew-button" type="button" data-toggle="modal" data-target="#samplelayoutmodal">Sample Layouts</button></div>
            <div class="teachertable-main">
               <table border="1">
                  <thead>
                     <tr class="tHeader">
                        <th>Enable</th>
                        <th class="sectionname-field">Section Name</th>
                        <th class="sectiontype-field">Type</th>
                     </tr>
                  </thead>
               </table>
               <ul class="sortlistlessonsetting">
                  <li class="drophere">
                     <table class="draghere"s>
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 1</span></td>
                              <td>
                                 <div class="btn-formattoggle">
                                    <button type="button" class="renew-button lessonformat-button lessonformat-buttontop">Format</button>
                                    <div class="formatcolors-dropdown" id="formatmain-dropdownsetting">
                                       <table class="formatcolors-dropdowntable">
                                          <tbody>
                                             <tr>
                                                <td colspan="4">
                                                   <div id="titleShowCell"><label class="checkbox-inline"><input value="Y" type="checkbox">Show title of lesson section in plan view</label></div>
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
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Lesson
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 2</span></td>
                              <td>
                                 <div class="btn-formattoggle">
                                    <button type="button" class="renew-button lessonformat-button"  type="button">Format </button>
                                 </div>
                              </td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 3</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 4</span></td>
                              <td><button class="renew-button lessonformat-button" type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 5</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain ">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Text 6</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button">  Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">My List</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain ">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Standards</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain ">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">School List</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain ">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
                  <li class="drophere">
                     <table class="draghere">
                        <tbody>
                           <tr>
                              <td><i class="fa fa-arrows-v" aria-hidden="true"></i></td>
                              <td>
                                 <div class="sSStyle"><input id="lessonEnabled" value="Y" type="checkbox" class="lesson-checkboxmain"></div>
                              </td>
                              <td>
                                 <div class="sSStyle2"><input id="lessonLabel" class="lessonlabel-fields" type="text"></div>
                              </td>
                              <td><span class="lessonformat-textmain">Strategies</span></td>
                              <td><button class="renew-button lessonformat-button"  type="button"> Format</button></td>
                              <td>
                                 <div id="tab1Settings" class="tabSettings">
                                    <div class="lessontitledisplay-setting lessondisplaysettingsmain">
                                       Homework
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </li>
               </ul>
            </div>
            <div class="col-md-6">
               <p class="lessondisplay-text">Lessons</p>
               <ul class="lessonsettingdisplay-lists">
                  <li>
                     <div class="lessontitledisplay-setting"> Lesson Title</div>
                     <div class="btn-formattoggle">
                        <button type="button" class="renew-button lessonformat-button lessonformat-buttonmiddle">Format</button>
                        <div class=" formatcolors-dropdown formatcolors-dropdownlesson">
                           <table class="formatcolors-dropdowntable">
                              <tbody>
                                 <tr>
                                    <td colspan="4">
                                       <div id="titleShowCell" style="display:none;"><label class="checkbox-inline"><input value="Y" type="checkbox">Show title of lesson section in plan view</label></div>
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
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="lessontitledisplay-setting"> Attachments</div>
                     <button class="renew-button lessonformat-button"> Format</button>
                  </li>
                  <li>
                     <div class="lessontitledisplay-setting">Assignments</div>
                     <button class="renew-button lessonformat-button"> Format</button>
                  </li>
                  <li>
                     <div class="lessontitledisplay-setting">Assessments</div>
                     <button class="renew-button lessonformat-button"> Format</button>
                  </li>
               </ul>
            </div>
           <div class="col-md-6">
                  <p class="lessondisplay-text">Lesson Orientation</p>
                   <ul class="lessonsettingdisplay-lists">
                  <li>
                     <label class="radio-inline"><input type="radio" name="optradio3">Vertical </label>
                     <label class="radio-inline"><input type="radio" name="optradio3">Horizontal </label>
                  </li>
                  <li>
                     <label class="checkbox-inline"><input type="checkbox" value="Y" >Equal size lessons</label>
                  </li>
                  <li>
                     <label class="checkbox-inline"><input type="checkbox" value="Y" disabled="disabled">Adjust lesson size to fit content, or</label>
                  </li>
                  <li>
                     <label class="lesson-heightsection"><span>set lesson height in pixels:</span> <input id="boxSize" size="5" disabled="" type="text"></label>
                  </li>
               </ul>
            </div>
             <div class="col-md-6">
                 <p class="lessondisplay-text">Lesson Headings</p>
                 <ul class="lessonsettingdisplay-lists">
                  <li>
                     <label class="radio-inline"><input type="radio" name="optradio">Class name first</label>
                     <label class="radio-inline"><input type="radio" name="optradio">Class times first</label>
                  </li>
                  <li>
                     <label class="radio-inline"><input type="radio" name="optradio2">Center</label>
                     <label class="radio-inline"><input type="radio" name="optradio2">Left justify</label>
                  </li>
                 </ul>
            </div>
             <div class="col-md-6">
            <p class="lessondisplay-text">Events</p>
            <ul class="lessonsettingdisplay-lists">
               <li>
                  <div class="eventtitledisplay-setting"> Event</div>
                  <div class="btn-formattoggle">
                     <button type="button" class="renew-button lessonformat-button lessonformat-buttonbottom">Format</button>
                     <div class="formatcolors-dropdown" id="formateventmain-dropdownsetting">
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
               </li>
            </ul>
            </div>
            <div class="col-md-12">
            <p class="lessondisplay-text">Dates</p>
            <ul class="lessonsettingdisplay-lists">
               <li>
                  <label class="date-formatlabel">Date Format:</label>
                  <label class="radio-inline"><input type="radio" name="optradio4">MM/DD/YYYY  </label>
                  <label class="radio-inline"><input type="radio" name="optradio4">DD/MM/YYYY </label>
               </li>
               <li>
                  <label class="date-formatlabel">Date Delimiter:</label>
                  <select id="dateDelimiter" style="font-weight: normal;">
                     <option value="/">/ (Slash)</option>
                     <option value="-">- (Dash)</option>
                     <option value=".">. (Dot)</option>
                  </select>
               </li>
               <li>
                  <label class="date-formatlabel">Display Days: </label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Sunday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Monday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Tuesday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Wednesday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Thursday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Friday</label>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Saturday</label>
               </li>
               <li>
                  <label class="checkbox-inline"><input type="checkbox" value="Y">Show school day counter</label>
               </li>
            </ul>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Sample Layoutpopup Start Here -->
<div id="samplelayoutmodal" class="modal fade movemodalcontent samoplelayout-content in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Lesson Section Layout</h4>
         </div>
         <div class="modal-body">
            <form method="post" action="" class="lessonsectionlayout-form">
               <p>Select a layout below to serve as a starting point for your lesson sections. You'll then be able to customize the lesson sections to meet your specific needs.</p>
               <div class="samplelistlayoutmain">
                  <div class="col-md-3 pl-0">
                     <div class="samplelistinner">
                        <div class="samplelistlayout-header">Basic</div>
                        <div class="samplelistlayout-body">
                           <ul>
                              <li>Lesson</li>
                              <li>Homework</li>
                              <li>Notes</li>
                              <li>Standards</li>
                              <li></li>
                              <li></li>
                              <li></li>
                           </ul>
                           <div class="samplelayout-selectbutton">
                              <button  class="renew-button" type="button">Select</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 pl-0">
                     <div class="samplelistinner">
                        <div class="samplelistlayout-header">Instructional</div>
                        <div class="samplelistlayout-body">
                           <ul>
                              <li>Objective</li>
                              <li>Direct Instruction</li>
                              <li>Guided Practice</li>
                              <li>Independent Practice</li>
                              <li>Homework</li>
                              <li>Notes</li>
                              <li>Standards</li>
                              <li></li>
                           </ul>
                           <div class="samplelayout-selectbutton">
                              <button  class="renew-button" type="button">Select</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 pl-0">
                     <div class="samplelistinner">
                        <div class="samplelistlayout-header">Detailed</div>
                        <div class="samplelistlayout-body">
                           <ul>
                              <li>Standards</li>
                              <li>Objective / Essential Question</li>
                              <li>Lesson / Instruction</li>
                              <li>Differentiation / Accommodations</li>
                              <li>Homework / Evidence of Learning</li>
                              <li>Instructional Strategies</li>
                              <li>Materials / Resources / Technology</li>
                              <li>Notes / Reflection</li>
                           </ul>
                           <div class="samplelayout-selectbutton">
                              <button  class="renew-button" type="button">Select</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="samplelayout-cancelbutton">
                  <button class="close-button" data-dismiss="modal" type="button">Cancel</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection

@push('js')
<script>
   $(".lessonformat-buttontop").click(function(){
       $("#formatmain-dropdownsetting").toggle();
   });
   $(".lessonformat-buttonmiddle").click(function(){
       $(".formatcolors-dropdownlesson").toggle();
   });
   $(".lessonformat-buttonbottom").click(function(){
       $("#formateventmain-dropdownsetting").toggle();
   });

   /*drag drop*/
   $(document).ready(function () {
      window.startPos = window.endPos = {};

      makeDraggable(); 

      $('.drophere').droppable({
        hoverClass: 'hoverClass',
        drop: function(event, ui) {
          var $from = $(ui.draggable),
              $fromParent = $from.parent(),
              $to = $(this).children(),
              $toParent = $(this);

          window.endPos = $to.offset();

          swap($from, $from.offset(), window.endPos, 0);
          swap($to, window.endPos, window.startPos, 100, function() {
            $toParent.html($from.css({position: 'relative', left: '', top: '', 'z-index': ''}));
            $fromParent.html($to.css({position: 'relative', left: '', top: '', 'z-index': ''}));
            makeDraggable();
          });
        }
      });

      function makeDraggable() {
        $('.draghere').draggable({
          zIndex: 99999,
          revert: 'invalid',
          start: function(event, ui) {
            window.startPos = $(this).offset();
          }
        });
      }

      function swap($el, fromPos, toPos, duration, callback) {
        $el.css('position', 'absolute')
          .css(fromPos)
          .animate(toPos, duration, function() {
            if (callback) callback();
          });
      }
    });
</script>
@endpush