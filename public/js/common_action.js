/*Common action js for lessons*/

$(document).ready(function(){
	$(".downarrowtoggle").click(function(){
		$(".lesondropdown").hide();
		$(this).next(".lesondropdown").show();
		
    });
	
	$('body').click(function(e) {
	 if($(e.target).is('.downarrowtoggle'))	
		 return false;
		if (!$(e.target).closest('.lesondropdown').length){
			$(".lesondropdown").hide();
		}
	});
	
	$(".copydropcrossicons").click(function(){
         $(this).parents(".lesondropdown").hide();
    });
});		 
/*For equal height of each lessons*/
/*
	$(document).ready(function(){
		var $tab = $( ".weektab-content");
		var length = $tab.first().find(".mainClass").length;
		var arraylength = Array.apply(null, Array(length)).map(function (_, i) {return i;});
		for(var i in arraylength){
		var height = 0;
		$(".mainClass:nth-child("+(parseInt(i)+1)+")").each(function(){
		   var h = $(this).outerHeight(true)
		   if(h > height)
			 height = h;

		});
		 
		$(".mainClass:nth-child("+(parseInt(i)+1)+")").height(height);
		 
	   }
		
	});
*/
/*Copy by check boxes*/
	$(document).ready(function(){
		var currentLocation = window.location;
		var url = new URL(currentLocation);
		var view = url.searchParams.get("view");
		var increment =0;
		$(document).on("change", ':checkbox', function(event) { 
		   if(this.checked){
			   increment++;
			   $('.btn-copy').html(increment);
			}
			else{
				increment--;
				$('.btn-copy').html(increment);
			}
			if(increment=='0'){
			$('.btn-copy').html('All');	
			}	
		});
		/*Increment and Decrement*/
		$('.incrementBtn').click(function(event) {
			var val = $(this).siblings(".copydropdown-value").val();
			if(val<=9){
				val++;
			}
			$(this).siblings(".copydropdown-value").val(val);
		});
		$('.decrementBtn').click(function(event) {
			var val = $(this).siblings(".copydropdown-value").val();
			if(val>1){
				val--;
			}
			var data = $(this).siblings(".copydropdown-value").val(val);
		});
		/*Bump Lessons*/
		$('.weekBump').on('click',function(e){
			var bump = $(this).siblings().find('.copydropdown-value').val();
			var class_ID = $(this).attr('targetID');
			var bump_date = $(this).attr('targetDate');
			var token = $(this).attr('token');
			event.preventDefault();		
			$.ajax({
				type:'POST',
				url: BASE_URL +'/teacher/dashboard/bumplessons',
				data:{
					"_token": token,
					'class_id':class_ID,
					'bump_date':bump_date,
					'bump_days':bump
					},
				beforeSend: function () {
					$(".pageLoader").show();  
				},
				complete: function () {	
				},
				success: function (response) {
					if(view =='week'){	
						$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(view == 'day'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(view == 'list'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else{
						$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}	
					
				},
				  error: function(data){
				  }
			});
		});
		/*End Bump Lessons*/
		
		/*Back Lessons*/
		$('.weekBack').on('click',function(e){
			var back = $(this).siblings().find('.copydropdown-value').val();
			var class_ID = $(this).attr('targetID');
			var back_date = $(this).attr('targetDate');
			var token = $(this).attr('token');
			var r = confirm("This will remove the lesson prior to the current lesson. Are you sure you want to bump?");
			if (r == true) {
				event.preventDefault();		
				$.ajax({
					type:'POST',
					url: BASE_URL +'/teacher/dashboard/backlessons',
					data:{
						"_token": token,
						'class_id':class_ID,
						'back_date':back_date,
						'back_days':back
						},
					beforeSend: function () {
						$(".pageLoader").show();  
					},
					complete: function () {	
					},
					success: function (response) {
						if(view =='week'){	
							$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'day'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'list'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else{
							$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}	
						
					},
					  error: function(data){
					  }
				});
			}
		});
		/*End Back Lessons*/
		
		/*Lesson Extend*/
		$('.weekExtend').on('click',function(e){
			var extendDays = $(this).siblings().find('.copydropdown-value').val();
			var class_ID = $(this).attr('targetID');
			var extend_date = $(this).attr('targetDate');
			var token = $(this).attr('token');
			event.preventDefault();		
			$.ajax({
				type:'POST',
				url: BASE_URL +'/teacher/dashboard/extendlessons',
				data:{
					"_token": token,
					'class_id':class_ID,
					'extend_date':extend_date,
					'extend_days':extendDays
					},
				beforeSend: function () {
					$(".pageLoader").show();  
				},
				complete: function () {	
				},
				success: function (response) {
					if(view =='week'){	
						$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(view == 'day'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(view == 'list'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else{
						$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}	
					
				},
				  error: function(data){
				  }
			});
		});
		/*End Lesson Extend*/
		
		/*Delete Lessons*/
		$('.deleteLessons').click(function(e){
			var class_ID = $(this).attr('targetID');
			var delete_date = $(this).attr('targetDate');
			var token = $(this).attr('token');
			$('#deletemodal').modal();
			$('.wshiftLessons').click(function(l){
				l.preventDefault();
				$.ajax({
					type:'POST',
					url: BASE_URL +'/teacher/dashboard/deletelessons',
					data:{
						"_token":token ,
						'class_id':class_ID,
						'delete_date':delete_date,
						'shift_lessons':1
						},
					beforeSend: function () {
						//$(".pageLoader").show();  
					},
					complete: function () {	
					},
					success: function (response) {
						if(view =='week'){	
							$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'day'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'list'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else{
							$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}	
						
					},
					error: function(data){
					}
				}); 
			});
			$('.wnshiftLessons').click(function(l){
				l.preventDefault();
				$.ajax({
					type:'POST',
					url: BASE_URL +'/teacher/dashboard/deletelessons',
					data:{
						"_token": token,
						'class_id':class_ID,
						'delete_date':delete_date,
						'shift_lessons':0
						},
					beforeSend: function () {
						$(".pageLoader").show();  
					},
					complete: function () {	
					},
					success: function (response) {
						if(view =='week'){	
							$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'day'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else if(view == 'list'){
							$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}
						else{
							$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
								$(".pageLoader").hide();  
							});
						}	
						
					},
					error: function(data){
					}
				}); 
			});
		});
		/*End Delete Lessons*/

		/*Remove a attachment*/
		$(document).on('click','.trash-button .fa-trash',function(){
			$(this).parents('tr').remove();
		});

		/*Show hide view details*/
		$(".viewDetails").unbind("change").bind('change',function(){
			//$('.displayItems').trigger('submit');
			var data_val 	  = $(this).attr('data-val');
			var selectedClass = $('.'+data_val);
			if($(selectedClass).hasClass('hide')){
				$(selectedClass).removeClass('hide');
			}
			else{
				$(selectedClass).addClass('hide');
			}
			
		});

		/* Edit assignment */

	  	$(".edit_assignment").click(function(){

		    var assignment_id = $(this).data("assignment-id");

		    $("#dynamicRenderDiv").show().load("/teacher/assignments/edit/"+assignment_id,function(){

		      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
		      

		    });

		 });

	  /* Save edit classs data*/

	  $("body").on('click','#save_edit_assignment_data_button',function(e){
		tinyMCE.triggerSave();  
		e.preventDefault();  
	    var assignment_id = $("#assignment_id").val();

	    var formData = $("#assignment_edit_form").serialize();

	    var obj = $(this);
	    $.ajax({
	      type:'POST',
	      url: BASE_URL +'/teacher/assignments/edit/'+assignment_id,
	      data: formData,
	      dataType: 'json',

	      beforeSend: function () {
	        $(".pageLoader").show();
	      },
	      complete: function () {
	        //obj.html('Sent <i class="fa fa-send"></i>');
	      },

	      success: function (response) {
	      	$(".pageLoader").hide();
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
			  setTimeout(function(){
	          $("#dynamicCalendarContent").fadeOut();		
				window.location.reload();
			  },3000);
	        }


	        },


	      error: function(data){
	        console.log("error");
	        console.log(data);
	      }

	    });
	      
	  }); 

	  /* Edit Unit */

  $(".edit_unit").click(function(){

    var unit_id = $(this).data("unit-id");

    $("#dynamicRenderDiv").show().load("/teacher/units/edit/"+unit_id,function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  /* Save edit classs datra*/

  $("body").on('click','#save_edit_unit_data_button',function(){

    var unit_id = $("#unit_id").val();

    var formData = $("#unit_edit_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/units/edit/'+unit_id,
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
            $('#unit_edit_form').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have updated Unit successfully !</strong>';
          html += '</div>';

          $('#unit_edit_form').before(html);
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
  	$(".edit_assessment").click(function(){

	    var assessment_id = $(this).data("assessment-id");
	    
	    $("#dynamicRenderDiv").show().load("/teacher/assessments/edit/"+assessment_id,function(){

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
  /*Close a modal box*/
  $(document).on('click','.d-popoup-close',function(){
  	$('.d-render-popoup').fadeOut();
  });

  $(document).on('click','.fa-close',function(){
  	$('.d-render-popoup').fadeOut();
  });

  /*Show over-view*/
  $(".overview-open").on('click',function(){
	    
	    $("#overviewwelcome-modal").show().load("/teacher/overview/index/",function(){

	    });

	});
  $(document).on('click','.overview-next',function(){
  	var href 		= $(this).attr('data-value');
  	var nxtclass    = $(this).attr('next-class');
  	var preclass    = $(this).attr('pre-class');
  	var showcheck   = $(this).attr('data-show'); 
  	$("#overviewwelcome-modal").show().load("/teacher/overview/overviewnext/"+href,function(){
  		$(this).removeClass(preclass).addClass(nxtclass);
  		if(showcheck=='add-menu'){
  			$('.add-menus').trigger('click');
  		}
  		if(showcheck=='goto-menu'){
  			$('.goto-menus').trigger('click');
  		}
	});
  });

  $(document).on('click','.overview-prev',function(){
  	var href 		= $(this).attr('data-value');
  	var nxtclass    = $(this).attr('next-class');
  	var preclass    = $(this).attr('pre-class');
  	var showcheck   = $(this).attr('data-show');
  	$("#overviewwelcome-modal").show().load("/teacher/overview/overviewnext/"+href,function(){
  		$(this).removeClass(nxtclass).addClass(preclass);
  		if(showcheck=='add-menu'){
  			$('.add-menus').trigger('click');
  		}
  		if(showcheck=='goto-menu'){
  			$('.goto-menus').trigger('click');
  		}
	});
  });

 /*overview close button*/
 $(document).on('click','.overview-modalcontent button.btn-default',function(){
 	$('.overview-modalcontent').hide();
 });
 $(document).on('click','.close-button',function(){
 	$('#dynamicRenderDiv').hide();
 });
 /*Today button*/
 $('.todayBtn').on('click',function(){
 	window.location.reload();
 });

 /*Show announcement popup*/
 $('.studentannouncementsmodal').on('click',function(){
 	$("#dynamicRenderDiv").show().load("/teacher/partials/announcement/",function(){
 		$(this).addClass('samoplelayout-content movemodalcontent');
	});
 })

/*Save announcement*/
 $(document).on('click','.announcement-save',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();
    var formData = $(this).closest('form').serialize();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/partials/announcement_save',
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
          html += '<strong>Student Announcement added successfully !</strong>';
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

 /*Edit Announcement*/
 $(document).on('click','.announcement-edit',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();
    var formData = $(this).closest('form').serialize();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/partials/announcement_edit',
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
          html += '<strong>Student Announcement updated!</strong>';
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

  /*Delete Function*/
  $(document).on('click','.announcement-delete',function(e){
  	var id = $(this).attr('delete_id')
    $.ajax({
      type:'GET',
      url: BASE_URL +'/teacher/partials/announcement_delete/'+id,
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
          html += '<strong>Student Announcement Deleted!</strong>';
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

  /*Show substitute popup*/
 $('.substitutenotesmodal').on('click',function(){
 	$("#dynamicRenderDiv").show().load("/teacher/partials/substitute/",function(){
 		$(this).addClass('samoplelayout-content movemodalcontent');
	});
 })

/*Save substitute*/
 $(document).on('click','.substitute-save',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();
    var formData = $(this).closest('form').serialize();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/partials/substitute_save',
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
               
          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>Substitute Notes added successfully !</strong>';
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

 /*Edit substitute*/
 $(document).on('click','.substitute-edit',function(e){
	tinyMCE.triggerSave();
	e.preventDefault();
    var formData = $(this).closest('form').serialize();
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/partials/substitute_edit',
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
               

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>Substitute Notes updated!</strong>';
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

  /*Delete substitute Function*/
  $(document).on('click','.substitute-delete',function(e){
  	var id = $(this).attr('delete_id')
    $.ajax({
      type:'GET',
      url: BASE_URL +'/teacher/partials/substitute_delete/'+id,
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
          html += '<strong>Substitute Notes Deleted!</strong>';
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

  /*function to add no school day*/
   $(".addnoschoolday").click(function(){

     	$("#dynamicRenderDiv").show().load("/teacher/events/add",function(){        
     		$('input[name="schoolday"]').prop('checked','checked');	
      	});

    });
    /*function to add or remove days*/
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
    $(document).on('click','.addDiv.fa-close',function(){
        $(this).closest(".addDays").fadeOut(300);

    }); 

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
  
  $('.hover-weekicons .downarrow-icon').on('click',function(){
  	$(this).parents('.week-tabbottom').css('position','initial');
  }) ;
  $(document).on('click',function(){
  	$('.week-tabbottom').css('position','relative');
  });
  //https://codepen.io/b0y/pen/qNazQV
//$(this).removeClass('.redBG').addClass('.black');
});
