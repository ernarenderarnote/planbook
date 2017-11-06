@extends('layouts.teacher')

@section('content')
  <div id="main-loader" class="pageLoader" style="display:none">
    <div class="loader-content"> <span class="loading-text">Loading</span> <img src="/images/loading.gif"> </div>
  </div>
  <div class="events-section assessment-section">
         <div class="copy-header">Instructional Strategies</div>
         <div class="list-contentbutton gradebutons">
            <div class="btn-group">
               <button type="button" class="btn unitsbutton" id="addstrategiesButton"><img src="/images/add2.png" class="event-icon">Add Item</button>
            </div>
         </div>
         <div class="lessonsearch-contenttable assessement-table">
            <table>
               <thead>
                  <tr class="tHeader">
                     <th>ID</th>
                     <th class="lesson-boxstrategies">Title</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($mystrategies as $data)
                  <tr class="edit_mystrategies" data-id="{{$data->id}}">
                     <td>{{$data->strategies_id}}</td>
                     <td class="lesson-boxstrategies">{!!$data->title!!}</td>
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
  $("#addstrategiesButton").click(function(){


    $("#dynamicRenderDiv").show().load("/teacher/mystrategies/add",function(){

      //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
      

    });

  });

  /* Add data*/

  $("body").on('click','#add_data_button',function(e){
   tinyMCE.triggerSave();
   e.preventDefault();

    var formData = $(this).closest('form').serialize();

    var obj = $(this);
    $.ajax({
      type:'POST',
      url: BASE_URL +'/teacher/mystrategies/add',
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
          html += '<strong>You Have created Strategy successfully !</strong>';
          html += '</div>';

          $('.modal-body').before(html);
          $('#add_form')[0].reset();
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

  $(".edit_mystrategies").click(function(){

    var id = $(this).data("id");
    
    $("#dynamicRenderDiv").show().load("/teacher/mystrategies/edit/"+id,function(){

     
      

    });

  });

  /* Save edit class data*/

  $("body").on('click','#post_edit_data_button',function(e){
   tinyMCE.triggerSave();
   e.preventDefault();
    var id = $("#mystratergy_id").val();

    var formData = $(this).closest('form').serialize();
    
    var obj = $(this);
    $.ajax({
     contentType: "application/x-www-form-urlencoded; charset=UTF-8",   
      type:'POST',
      url: BASE_URL +'/teacher/mystrategies/edit/'+id,
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
          html += '<strong>You Have updated strategy successfully !</strong>';
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
