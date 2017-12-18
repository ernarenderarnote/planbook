@extends('layouts.teacher')

@section('content')

<div id="main-loader" class="pageLoader" style="display:none">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
</div>
<div class="clearfix"></div>
<div class=" class-page events-section assessment-section">
	<div class="container-fluid">
		<div class="col-sm-12">
			<div class="teacher-dash-action pt-5 list-contentbutton gradebutons">
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
					<button type="button" class="btn unitBtn unitsbutton list-contentmainbuton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target_id=''> All Units<span class="caret"></span> </button>
				    <ul class="dropdown-menu language-dropdown">
						<li class="unitSelected">
							<a href="#" class="language-dropbutons unitdropbuton">
								All Units 
							</a>
						</li>
						@forelse($units as $unit)
							<li class='unitSelected'>
								<a href="#" class="unit-dropbutons language-dropbutons" style="background-color:{{ $unit->class_color }}; color: #fff;">
									{{ $unit->unit_title}}
								</a>
							</li>  
							@empty
				        @endforelse
				    </ul> 
			    </div>
				<div class="btn-group">
					<button type="button" class="btn btn-primary bg-white border-2 border-theme add-comments popup-custom-show unitsbutton list-contentmainbuton" id="addAssessmentButton" ><i class="fa fa-plus" aria-hidden="true"></i><span class="">Add Assessment</span></button>
				</div>
				<div class="btn-group">
				  <button type="button" class="btn btn-primary bg-white border-2 border-theme add-comments popup-custom-show unitsbutton list-contentmainbuton scoreButton" id="scoreButton" ><span class="">Score Weighting</span></button>	
				</div>
				<!--<button type="button" class="btn btn-primary bg-white border-2 return-toplan "><span class="">Copy/Import Lessons</span></button> -->
			</div>
		</div>
		<div class="table-responsive col-sm-12 pt-5">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center bg-theme color-column"></th>
						<th class="text-left bg-theme class-column">Class</th>
						<th class="text-left bg-theme class-column">Unit</th>
						<th class="text-center bg-theme start-date">Start</th>
						<th class="text-center bg-theme end-date">End</th>
						<th class="text-center bg-theme">Title</th>
					</tr>
				</thead>
				<tbody>
					@forelse($assessments as $assessment)
						<tr class="edit_assessment" data-assessment-id="{{ $assessment->id }}" >
							<td class="text-center color-column"><a class="class-colors" style="background-color:{{ $assessment->userClass->class_color }};"></a></td>
							<td class="text-left class-column"><a href="#">{{ $assessment->userClass->class_name }}</a></td>
							<td class="text-left class-column"><a href="#">{{ $assessment->unit->unit_id."-".$assessment->unit->unit_title }}</a></td>
							<td class="text-center class-column"><a href="#">{{ $assessment->starts_on }}</a></td>
							<td class="text-center class-column"><a href="#">{{ $assessment->ends_on }}</a></td>
							<td class="text-center class-column"><a href="#">{{ $assessment->title }}</a></td>		  
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
<div class="d-render-popoup t-data-popup modal fade editmodalcontent in" id="dynamicRenderDiv" role="dialog">
  

</div>

<!-- Add class popup end here ! -->


@endsection

@push('js')
<script type="text/javascript">

// A $( document ).ready() block.
$(document).ready(function() {

  /* send AJAX REQUEST TO ADD NEW CLASS DATA*/

  function formToJson(formArray) {
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
      returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
  }


  $("#addAssessmentButton").click(function(){


    $("#dynamicRenderDiv").show().load("/teacher/assessments/add",function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  //popup-custom  hide
  
  $("body").on('click','.d-popoup-close',function(){

    $(".d-render-popoup").fadeOut();

  });

/* Add assignment data*/

  $("body").on('click','#save_assessment_data_button',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();

    var formData = $("#assessment_add_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/assessments/add',
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        //obj.html('Sending... <i class="fa fa-send"></i>');
      },
      complete: function () {
        //obj.html('Sent <i class="fa fa-send"></i>');
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
          html += '<strong>You Have created Assignment successfully !</strong>';
          html += '</div>';

          $('.errorMessage').before(html);
          $('#assessment_add_form')[0].reset();
         $(".d-render-popoup").fadeOut();


          window.location.reload();
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
      



  }); 



  /* Edit Unit */

  $(".edit_assessment").click(function(){

    var assessment_id = $(this).data("assessment-id");
    
    $("#dynamicRenderDiv").show().load("/teacher/assessments/edit/"+assessment_id,function(){

    });

  });

  /*Score Weighting*/


  $(".scoreButton").click(function(){
	var assessment_id = $(".classBtn").attr('target_id');  
    $("#dynamicRenderDiv").show().load("/teacher/assessments/score/"+assessment_id,function(){
    });

  });



  /* Save edit classs datra*/

  $("body").on('click','#save_edit_assessment_data_button',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();
    var assessment_id = $("#assessment_id").val();

    var formData = $(this).closest('form').serialize();
    
    var obj = $(this);
    $.ajax({
	  contentType: "application/x-www-form-urlencoded; charset=UTF-8", 	
      type:'POST',
      url: BASE_URL +'/teacher/assessments/edit/'+assessment_id,
      data: formData,
      dataType: 'json',

      beforeSend: function () {
        //obj.html('Sending... <i class="fa fa-send"></i>');
      },
      complete: function () {
        //obj.html('Sent <i class="fa fa-send"></i>');
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
          html += '<strong>You Have updated Unit successfully !</strong>';
          html += '</div>';

          $('.errorMessage').before(html);
          //$('#class_add_form')[0].reset();
         $(".d-render-popoup").fadeOut();


        window.location.reload();
        }


        },


      error: function(data){
        console.log("error");
        console.log(data);
      }

    });
      



  }); 





});

/*Change the text of selected  button*/
$('.classSelected a').on('click',function(){	
  var class_id   = $(this).attr('target_id');
  var classVar   = $(this).text();
  var background = $(this).css('background-color');
  $('.classBtn').html(classVar +' <span class="caret"></span>');
  $('.classBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
   $('.classBtn').attr('target_id',class_id);
});

$('.unitSelected a').on('click',function(){
  var unitVar = $(this).text();
  var background = $(this).css('background-color');
  $('.unitBtn').html(unitVar +' <span class="caret"></span>');
  $('.unitBtn').css({'background-color':background,'border-color':background, 'color':'#fff'});
});

/*Get selected class assessment type*/
$('body').on('change','.classChange',function(){
	var class_id = $(this).val();
	$.ajax({
		type:'get',
		contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
		dataType : "json",
		data:{"_token": "{{ csrf_token() }}",'class_id':class_id},
		url: 'seletedAssessment',
		success:function(response){
			var units = response.units;
			var types = response.type;
			if(units!=''){
				$('#unit').html('');
				$('#unit').append('<option value="" >Select Unit</option>');
				$.each(units, function(i, field){
					$('#unit').append('<option value="'+field.id+'" >'+field.unit_title+'</option>');
					console.log(field.unit_title);
				});
			}	
			var assessments = '';
			if(types!=''){
				$('#assessmentType').html('');
				$.each(types, function(i, field){
					assessments = field.assessment;	
				});
				
			}
			$('#assessmentType').append('<option value="" >Select Type</option>');
			$.each($.parseJSON(assessments), function(i, field){
				$('#assessmentType').append('<option value="'+field.title+'" >'+field.title+'</option>');
			});
		},
		error: function(response){
			console.log("error");
			console.log(response);
		}

	});	
})	
</script>
<script>
   var num = 0;
   $(document).on('click','.assignmentAdd',function(){
	  num++;
      var html = '';
      html += '<tr>';
      html += '<td><input id="nameAssignmentWeight0" name="assignment['+num+'][title]" size="45" value="" type="text"></td>';
      html += '<td><input id="percentAssignmentWeight0" name="assignment['+num+'][marks]" size="6" value="" type="text" class="perchantage-input perMarks"></td>';
      html += '<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>';
      html += '</tr>';
      $('.addedassignment tbody').append(html);
   });
    var count = 0;
   $(document).on('click','.assessmentAdd',function(){
	  count++;
      var html = '';
      html += '<tr>';
      html += '<td><input id="nameAssignmentWeight0" name="assessment['+count+'][title]" size="45" value="" type="text"></td>';
      html += '<td><input id="percentAssignmentWeight0" name="assessment['+count+'][marks] size="6" value="" type="text" class="perchantage-input perMarks"></td>';
      html += '<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>';
      html += '</tr>';
      $('.addedassessment tbody').append(html);
   });
   var inc = 0;
   $(document).on('click','.standardAdd',function(){
	   inc++;
      var html = '';
      html += '<tr>';
      html += '<td><input size="6" name="standard['+inc+'][id]" value="" type="text"></td>';
      html += '<td><input size="45" name="standard['+inc+'][title]" value="" type="text" class="perchantage-input"></td>';
      html += '<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>';
      html += '</tr>';
      $('.addedStandards tbody').append(html);
   });

   $(document).on('click','.closeicon-assessment',function(){
      $(this).closest("tr").fadeOut(300);

   })
   
   function calculateScore(){
	
   }
   
   /*Submit scores*/
    $('body').on('submit','.editscore-form',function(e){
		var totalSum = 0;
		$('.perMarks').each(function () {
			totalSum += parseFloat(this.value);
		});
		console.log(totalSum);
		if(totalSum == 100){
			var formData = $(this).closest('form').serialize();
			var url  = "/teacher/assessments/scoreAdd";
			$.ajax({
			  type:'POST',
			  url: BASE_URL +'/teacher/assessments/scoreAdd',
			  data: formData,
			  dataType: 'json',

			  beforeSend: function () {
				$('.pageLoader').show();
			  },
			  complete: function () {
				//obj.html('Sent <i class="fa fa-send"></i>');
			  },

			  success: function (response) {
				  $('.pageLoader').hide();
				  window.location.reload();	

				},


			  error: function(data){
				console.log("error");
				console.log(data);
			  }

			});
		}else{
			$('.alert-danger.message').show();
		}	
	e.preventDefault(); 	
		
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
			
			
		/*   $(".embedfilebutton").click(function(){
          $("#embedfilemodal").show();
		  $('#applyfilemodal').hide();
         }); */
		  $(".closeembedfile-button").click(function(){
          $("#embedfilemodal").hide();
         });	
		  
		 
		
</script>

@endpush