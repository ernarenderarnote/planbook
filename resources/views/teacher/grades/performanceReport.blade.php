<!-- performancereport Section Start Here -->                         
      <div class="modal-dialog">
            <!-- Modal content-->
          <form method="post" action="#" class="addteacher-form performanceform">
            <div class="modal-content">
               <div class="modal-header addperiodheder">
                  <div class="normalLesson pull-left">
                     <p>Performance Reports</p>
                  </div>
                  <div class="actionright pull-right">
                     <input type="submit" class="actiondropbutton renew-button" value="Create Reports">
                     <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
                  </div>
               </div>
               <div class="modal-body">
                  <input type="hidden" data-url="{{ route('teacher.grades.pdfview',['download'=>'pdf'],[]) }}" id="pdfDownload">
                     <div class="col-md-6">
                        <div class="form-group col-md-12">
                           <label>Grade Period</label>
                           <select>
                              <option value="0">All Periods</option>
                              @forelse($periods as $period)
      							   <option value="{{$period->id}}">{{$period->title}}</option>
      							   @empty
                              @endforelse
                           </select>
                        </div>
                        <div class="form-group col-md-12">
                           <label>Student </label>
                           <select>
                                 <option value="A">Students - All ({{count($studentsAssigned)}})</option>
                                 @forelse(json_decode($eachstudent) as $stu)
                                  
                                    <option value="{{$stu->id}}">Students -{{$stu->name}} ({{$stu->count}})</option>
                                 @empty
                                 @endforelse
                           </select>
                        </div>
                        <div class="form-group col-md-12">
                           <label>Report Type </label>
                           <select name="gradeReportType">
											<option value="0" selected="selected">Grades and Standards</option>
											<option value="1">Grades Only</option>
											<option value="2">Standards Only</option>
										</select>
                        </div>
						<div class="form-group col-md-12">
                           <label>Report Items </label>
                           <a href="javascript:void(0)" class="performance-itemlink">All Items</a>
						   <div class="performance-itemdropdown">
						       <div class="reportItem" id="reportAllItems"><input type="checkbox" checked="checked"><span>Items</span></div>
							   <div class="reportItem selectedItem">
								    <input type="checkbox" name="includeEntered" value="Y" checked="checked"><span>Entered</span>
							   </div>
							   <div class="reportItem selectedItem">
							      <input type="checkbox" name="includeEmpty" value="Y" checked="checked"><span>Empty</span>
							 </div>
							   
							     <div class="reportItem selectedItem">
									  <input type="checkbox" name="includeCodes" value="E" checked="checked"><span>Excused</span>
								 </div>
								 <div class="reportItem selectedItem">
									 <input type="checkbox" name="includeCodes" value="I" checked="checked"><span>Incomplete</span>
								 </div>
								   <div class="reportItem selectedItem">
								     <input type="checkbox" name="includeCodes" value="M" checked="checked"><span>Missing</span>
								   </div>
								   <div class="reportItem selectedItem"><input type="checkbox" name="includeNotes" value="Y" checked="checked"><span>Score Notes</span></div>
								   <div class="reportItem report-doneitems" id="doneReportItems">Done</div>
							 </div>
							   
						 </div>
                       
                     </div>
                     
                  
               </div>
            </div>
            </form>
         </div>