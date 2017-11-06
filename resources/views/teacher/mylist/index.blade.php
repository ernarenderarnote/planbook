@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section assessment-section">
         <div class="copy-header">My List</div>
         <div class="list-contentbutton gradebutons">
            <div class="btn-group">
               <button type="button" class="btn unitsbutton" data-toggle="modal" id="addListButton"><img src="/images/add2.png" class="event-icon">Add Item</button>
            </div>
         </div>
         <div class="lessonsearch-contenttable assessement-table">
            <table>
               <thead>
                  <tr class="tHeader">
                     <th>ID</th>
                     <th class="lesson-boxstrategies">Description</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($mylists as $mylist)
                  <tr class="edit_mylist" data-id={{$mylist->id}}>
                     <td>{{$mylist->list_id}}</td>
                     <td class="lesson-boxstrategies">{!!$mylist->description!!}</td>
                  </tr>
                  @empty
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
            <!-- Add class Popup Starts Here -->
      <div class="d-render-popoup t-data-popup modal fade editmodalcontent in" id="dynamicRenderDiv" role="dialog">
        

      </div>

      <!-- Add class popup end here ! -->
      

@endsection
  
@push('js')
  <script>
  $("#addListButton").click(function(){


    $("#dynamicRenderDiv").show().load("/teacher/mylist/add",function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  /* Add assignment data*/

  $("body").on('click','#save_mylist_data_button',function(e){
   tinyMCE.triggerSave();
   e.preventDefault();

    var formData = $("#mylist_add_form").serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/mylist/add',
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
            $('.modal-body').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have created Assignment successfully !</strong>';
          html += '</div>';

          $('.modal-body').before(html);
          $('#mylist_add_form')[0].reset();
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

  $(".edit_mylist").click(function(){

    var list_id = $(this).data("id");
    
    $("#dynamicRenderDiv").show().load("/teacher/mylist/edit/"+list_id,function(){

     
      

    });

  });

  /* Save edit classs datra*/

  $("body").on('click','#edit_mylist_data_button',function(e){
   tinyMCE.triggerSave();
   e.preventDefault();
    var mylist_id = $("#mylist_id").val();

    var formData = $(this).closest('form').serialize();
    
    var obj = $(this);
    $.ajax({
     contentType: "application/x-www-form-urlencoded; charset=UTF-8",   
      type:'POST',
      url: BASE_URL +'/teacher/mylist/edit/'+mylist_id,
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
            $('.modal-body').before(html);
            
        }

        if(response['success']){
               
          console.log(response['success']);

          html += '<div id="success-box" class="alert alert-success fade in">';
          html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
          html += '<strong>You Have updated list successfully !</strong>';
          html += '</div>';

          $('.modal-body').before(html);
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
$(document).on('click','.closebutton',function(){
    $('#dynamicRenderDiv').hide();
  });
  </script>    
  
@endpush  