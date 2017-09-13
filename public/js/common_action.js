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
	});
