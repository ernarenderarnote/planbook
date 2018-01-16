<form method="post" action="" class="toDoForm">
    {{csrf_field()}}
    <div class="studentsnotes-dropdwntopbar">
        <div class="pull-left">
            <i class="fa fa-arrow-down" aria-hidden="true" id="arrow-showlist"></i>
            <span class="do-listdowntext"> To Do</span>
        </div>
        <div class="pull-right studentsnotes-dropdwnright">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            <i class="fa fa-plus toDoAppend" aria-hidden="true"></i>
        </div>
    </div>
    <div class="studentsnotes-contentmain todocontent">
        @php $i=1; @endphp
        @forelse(json_decode($todo->todo) as $do)
        <div class="studentsnotes-dropdwncontent">
            <div class="studentsnotes-dropdwncontenttopbar">
                <div class="pull-left">
                    <input type="hidden"   name="todo[{{$i}}][check]" value="N">
                    <input type="checkbox" name="todo[{{$i}}][check]" value="Y" {{ $do->check == 'Y' ? 'checked' : ''}}>
                    <input name="todo[{{$i}}][date]" class="datepicker" value="{{$do->date}}" id="demo30">
                </div>
                <div class="pull-right studentsnotes-dropdwncontentright">
                    <span class="do-calendertext" id="demo30"> None</span>
                    <a href="javascript:void(0);"> <i class="fa toDoremove fa-trash" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="studentsnotes-dropdwncontentbottom">
                <textarea name="todo[{{$i}}][description]" class="form-control" value="">{{$do->description}}</textarea>
            </div>
        </div> 
        @php $i++; @endphp
        @empty

        @endforelse
    </div>

    <div class="studentsnotes-dropdwntopbar">
        <div class="pull-left">
            <i class="fa fa-arrow-down" aria-hidden="true" id="arrow-showlist"></i>
            <span class="do-listdowntext">Notes</span>
        </div>
        <div class="pull-right studentsnotes-dropdwnright">
            <i class="fa fa-search" aria-hidden="true" id="notes-searcharrow"></i>
            <i class="fa fa-plus todonotesappend" aria-hidden="true"></i>
        </div>
    </div>
    <div class="search-formnotes">
        <div class="form-group">
            <input type="text" name="search-notes" class="form-control" placholder="search notes" value="{{$todo->search_notes}}">
        </div>
        <div class="form-group">
            <div class="notesinputdate-fields">
                <input type="text" name="datefrom" class="form-control daterange" id="demo31"  value="{{$todo->date_from}}"> </div>
            <div class="notesinputdate-text"> to </div>
            <div class="notesinputdate-fields">
                <input type="text" name="dateto" class="form-control daterange" id="demo32"  value="{{$todo->date_from}}"> </div>
        </div>
        <div class="form-group">
            <div class="notesserchselect-fields">
                <select name="search-class" class="form-control">
                    <option value="">All Classes</option>
                    @forelse($classes as $class=>$id)
                    <option value="{{$id}}" {{ $todo->class_id == $id ? 'selected' : ''}}>{{$class}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
            <div class="notesserchselect-fields">
                <select name="search-student" class="form-control studentsoptions" >
                    <option value="0">All Students</option>
                    @forelse($students as $student)
                        <option value="{{$student['id']}}" {{ $todo->student_id == $student['id'] ? 'selected' : ''}}>{{$student['last_name']}} , {{$student['name'] }}</option>
                    @empty

                    @endforelse
                </select>
            </div>
        </div>
    </div>
    <div class="todonotescontent">
        @php $i=1;@endphp
        @forelse(json_decode($todo->notes) as $notes)
        <div class="studentsnotes-dropdwncontent">      
            <div class="studentsnotes-dropdwncontenttopbar">                                                            
                <div class="pull-left">                                                              
                    <input name="notes[{{$i}}][date]" class="datepicker" value="{{$todo->date}}" id="demo30">                                                               
                </div>                                                                
                <div class="pull-right studentsnotes-dropdwncontentrightbottom">                                                             
                    <select name="notes[{{$i}}][class]">
                        <option value="0">All Classes</option>
                        @forelse($classes as $class=>$id)
                        <option value="{{$id}}"  {{ $notes->class == $id ? 'selected' : ''}}>{{$class}}</option>
                        @empty

                        @endforelse
                    </select>                                                           
                    <select name="notes[{{$i}}][student]">  
                        <option value="">All Students</option>
                        @forelse($students as $student)
                            <option value="{{$student['id']}}" {{ $notes->student == $student['id'] ? 'selected' : ''}} >{{$student['last_name']}} , {{$student['name'] }}</option>
                        @empty

                        @endforelse
                    </select>                                                             
                    <a href="javascript:void(0);"><i class="fa fa-trash todonotesremove" aria-hidden="true"></i></a>                                                            
                </div>                                                               
            </div>                                                               
            <div class="studentsnotes-dropdwncontentbottom">                                                             
                <textarea name="notes[{{$i}}][description]" class="form-control">{{$notes->description}}</textarea>                                                             
            </div>
        </div>
        @php $i++; @endphp
        @empty

        @endforelse
    </div>
    
</form>

<script>
    $(function() {
        $('.datepicker').datepicker({format: 'dd/mm',autoclose:true});
        $('.daterange').datepicker({format: 'yyyy-mm-dd',autoclose:true})
        var scntDiv = $('.studentsnotes-contentmain');
        var i = $('.studentsnotes-dropdwncontent').size() + 1;
        $(document).on('click','.toDoAppend',function() {
            var html = '';   
            html += '<div class="studentsnotes-dropdwncontent">';
            html += '<div class="studentsnotes-dropdwncontenttopbar">';
            html += '<div class="pull-left">';
            html += '<input type="hidden"   name="todo[' + i +'][check]" value="N">';
            html += '<input type="checkbox" name="todo[' + i +'][check]" value="Y">';
            html += '<input name="todo[' + i +'][date]" class="datepicker" value="9/9" id="demo30">';
            html += '</div>';
            html += '<div class="pull-right studentsnotes-dropdwncontentright">';
            html += '<span class="do-calendertext" id="demo30"> None</span>';
            html += '<a href="javascript:void(0);"> <i class="fa toDoremove fa-trash" aria-hidden="true"></i></a>';
            html += '</div>';
            html += '</div>';
            html += '<div class="studentsnotes-dropdwncontentbottom">';
            html += '<textarea name="todo[' + i +'][description]" class="form-control"></textarea>';
            html += '</div>';
            html += '</div>'; 
            $(html).appendTo(scntDiv);
            scntDiv.find('.datepicker').datepicker({format: 'dd/mm',autoclose:true});
            i++;
            return false;
        });
        
        $(document).on('click','.toDoremove',function() { 
            if( i >= 1 ) {
                $(this).parents('.studentsnotes-dropdwncontent').remove();
                i--;
            }
            return false;
        });

    });
    $(function() {
        var scntDiv = $('.todonotescontent');
        var i = $('.studentsnotes-dropdwncontent').size() + 1;
        $(document).on('click','.todonotesappend',function() {
            var classes  = '<?php echo $classes; ?>';
            var students = $('.studentsoptions').html();
            var html= '';
            html += '<div class="studentsnotes-dropdwncontent">';      
            html += '<div class="studentsnotes-dropdwncontenttopbar">';                                                              
            html += '<div class="pull-left">';                                                               
            html += '<input name="notes[' + i +'][date]" class="datepicker" value="9/9" id="demo30">';                                                               
            html += '</div>';                                                                
            html += '<div class="pull-right studentsnotes-dropdwncontentrightbottom">';                                                              
            html += '<select name="notes[' + i +'][class]">';
            html += '<option value="0">All Classes</option>';
            var data = $.parseJSON(classes);
            $.each(data, function( k, v ) {
                html += '<option value="'+v+'">'+k+'</option>';
            });                                                                                                                                                                                                                                                                           
            html += '</select>';                                                             
            html += '<select name="notes[' + i +'][student]">';                                                              
            html += students;                                                               
            html += '</select>';                                                             
            html += '<a href="javascript:void(0);"> <i class="fa fa-trash todonotesremove" aria-hidden="true"></i></a>';                                                             
            html += '</div>';                                                                
            html += '</div>';                                                                
            html += '<div class="studentsnotes-dropdwncontentbottom">';                                                              
            html += '<textarea name="notes[' + i +'][description]" class="form-control"></textarea>';                                                              
            html += '</div>'; 
            html += '</div>';
            $(html).appendTo(scntDiv);
            scntDiv.find('.datepicker').datepicker({format: 'dd/mm',autoclose:true});
            i++;
            return false;
        });
        
        $(document).on('click','.todonotesremove',function() { 
            if( i >= 1 ) {
                $(this).parents('.studentsnotes-dropdwncontent').remove();
                i--;
            }
            return false;
        });

    });

    /*submit todo list*/
    $(".toDoForm input[type='text']").focusout(function(){
        var data = $(this).closest('form').serialize();
        submitTodoform(data);
    });

    $(document).on('blur',".toDoForm textarea",function(){
        var data = $(this).closest('form').serialize();
        submitTodoform(data);
    });

    $(".toDoForm select").on('change',function(){
         var data = $(this).closest('form').serialize();
        submitTodoform(data);
    });

    /*function to submit the form data of todo form*/
    function submitTodoform(data){
        $.ajax({
            type:'POST',
            url: BASE_URL +'/teacher/dashboard/todoPost',
            data:data,
            beforeSend: function () {
            },
            complete: function () {   
            },

            success: function (response) {
            console.log(response);
            },
            error: function(data){
            }
        });
    
    }
    
</script>   
                                                               