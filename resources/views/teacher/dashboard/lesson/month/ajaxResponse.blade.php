 <div id="main-loader" style="display:none;">
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="../../images/loading.gif"> </div>
</div>

 @forelse($myFiles as $images)
    @if(isset($attachments))
        @if(in_array($images->file_name,$attachments))
            <li class="list-group-item" targetID="{{$images->id}}" targetVal="{{ $images->file_name }}" data-checked="true" >
        	   {{ $images->file_name }}
        		<span class="download-link">
        			<i class="fa fa-download pull-right" aria-hidden="true"></i>
        		</span> 	
        	</li>
        @else 
            <li class="list-group-item" targetID="{{$images->id}}" targetVal="{{ $images->file_name }}">
               {{ $images->file_name }}
                <span class="download-link">
                    <i class="fa fa-download pull-right" aria-hidden="true"></i>
                </span>     
            </li>
        @endif 
    @else 
        <li class="list-group-item" targetID="{{$images->id}}" targetVal="{{ $images->file_name }}">
           {{ $images->file_name }}
            <span class="download-link">
                <i class="fa fa-download pull-right" aria-hidden="true"></i>
            </span>     
        </li>
    @endif          
	@empty
	<li>Nothing Found</li>
  @endforelse

	<!-- Check Boxes for Standards -->
	<script>
         $(function () {
             $('.list-group.checked-list-box .list-group-item').each(function () {
                 
                 // Settings
                 var $widget = $(this),
                     $checkbox = $('<input type="checkbox" class="hidden" />'),
                     color = ($widget.data('color') ? $widget.data('color') : "primary"),
                     style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
                     settings = {
                         on: {
                             icon: 'glyphicon glyphicon-check'
                         },
                         off: {
                             icon: 'glyphicon glyphicon-unchecked'
                         }
                     };
                     
                 $widget.css('cursor', 'pointer')
                 $widget.append($checkbox);
         
                 // Event Handlers
                 $widget.on('click', function () {
                     $checkbox.prop('checked', !$checkbox.is(':checked'));
                     $checkbox.triggerHandler('change');
                     updateDisplay();
                 });
				 var idx ;
                 $checkbox.on('change', function () {
                     updateDisplay();
                 });
                   
         
                 // Actions
                 function updateDisplay() {
                     var isChecked = $checkbox.is(':checked');
         
                     // Set the button's state
                     $widget.data('state', (isChecked) ? "on" : "off");
         
                     // Set the button's icon
                     $widget.find('.state-icon')
                         .removeClass()
                         .addClass('state-icon ' + settings[$widget.data('state')].icon);
         
                     // Update the button's color
                     if (isChecked) {
						
						
						var checkedItems = [], counter = 0;
				
						$(".file-attchedmain li.active").each(function(idx, li) {
						checkedItems[counter] = [$(li).attr('targetVal'),$(li).attr('targetid')];
							
							counter++;
							
						});
						//console.log(checkedItems[0][0]);
						var checkedAttach;
						if(checkedItems != null){
							$('.attachOrEmbedBody').html('');
							$('#attachedFiles').html('');
						}
					    for(checkedAttach in checkedItems){
							
						 $('#attachedFiles').append("<tr style='display:none'><td class='filename' id='selectedFile'><a href='#'>"+checkedItems[checkedAttach][0]+"</a></td><td><label><input type='hidden' id='check_file' name='attach[]' value="+checkedItems[checkedAttach][0]+"> <input type='checkbox'>Private</label></td><td><div class='main-buton trash-button'><i class='fa fa-trash' aria-hidden='true'></i></div></td></tr>");
						 $('.attachOrEmbedBody').append("<span>"+checkedItems[checkedAttach][0]+"<input type='hidden' value='"+checkedItems[checkedAttach][0]+"' name='embID'></span>");
							
						}
						
                         $widget.addClass(style + color + ' active');
                     } 
					 else {
						 $widget.removeClass(style + color + ' active');
						 var value = $('li').attr('targetVal');
						 var checkedItems = [], counter = 0;
						 $(".file-attchedmain li.active").each(function(idx, li) {
							checkedItems[counter] = [$(li).attr('targetVal'),$(li).attr('targetid')];
							counter++;
						});
						var checkedAttach;
						if(checkedItems != null){
							$('.attachOrEmbedBody').html('');
							$('#attachedFiles').html('');
						}
						for(checkedAttach in checkedItems){
						 $('#attachedFiles').append("<tr style=''><td class='filename' id='selectedFile'><a href='#'>"+checkedItems[checkedAttach][0]+"</a></td><td><label><input type='hidden' id='check_file' name='attach[]' value="+checkedItems[checkedAttach][1]+"> <input type='checkbox'>Private</label></td><td><div class='main-buton trash-button'><i class='fa fa-trash' aria-hidden='true'></i></div></td></tr>");
						 $('.attachOrEmbedBody').append("<span>"+checkedItems[checkedAttach][0]+"</span><input type='hidden' value='"+checkedItems[checkedAttach][1]+"' name='embID'></br>");
						
						}
                     }
                 }
         
                 // Initialization
                 function init() {
                     
                     if ($widget.data('checked') == true) {
                         $checkbox.prop('checked', !$checkbox.is(':checked'));
                     }
                     
                     updateDisplay();
         
                     // Inject the icon if applicable
                     if ($widget.find('.state-icon').length == 0) {
                         $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
                     }
                 }
                 init();
             });
         });
    </script>		