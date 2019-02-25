@extends('layouts.default')

@section('content')
<!--banner content-->
<div class="site-banner">
   <div class="site-bannerlogo">
     <img src="images/footerlogo.png">
   </div>
  <div class="row">
      <div class="col-md-6 pull-right planing-header"><p class="sectionHeader">Online lesson planning and grading!</p></div>
  </div>
  <div class="banner-inner">
  <div class="container">
    
    <div class="banner-cat">
      <ul>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/schedule.png" alt="schedules"></div>
          <div class="aFeature">Create Class Schedules</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/print.png"  alt="print"></div>
          <div class="aFeature">Print or Save Lessons</div>
        </li>
        <li >
          <div class="aCircle home-schedule"><img class="aImage" src="images/templates.png"  alt="template"></div>
          <div class="aFeature">Create Class Templates</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/standards.png"  alt="standard"></div>
          <div class="aFeature">Connect to Standards</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/fileschedule.png"  alt="attach-file"></div>
          <div class="aFeature">Attach Files and Links</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/pencil.png"  alt="schedules"></div>
          <div class="aFeature">Easily Adjust Schedule</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/viewing.png"  alt="student-viewing"></div>
          <div class="aFeature">Student Viewing</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/plansschedule.png"  alt="share"></div>
          <div class="aFeature">Share Plans with Peers</div>
        </li>
        <li>
          <div class="aCircle home-schedule"><img class="aImage" src="images/yearly.png"  alt="yearly-reuse"></div>
          <div class="aFeature">Yearly Lesson Reuse</div>
        </li>
      </ul>
    </div>
  </div>
  </div>
</div>
<!--banner content End--> 
<a id="planbook"></a> 
<!--Teacher plan content-->
<div id="teacherPlan" class="teacher-plan full-section padding-tb-40">
 <div class="row teacher-header"><div class="col-md-7"><p class="sectionHeader m-0">Teacher Yellowbus</p></div></div>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
       
        <ul class="navList m-0" >
          <li>Supports weekly, two-week, A/B, and cycle schedules</li>
          <li>Plans can be viewed by day, week, month, or class</li>
          <li>Customizable lessons with up-to ten unique sections</li>
          <li>Schedule classes for full year, terms, or defined range</li>
          <li>Standards available for all 50 states, 68 national and international frameworks, 48 districts and dioceses, and growing!</li>
        </ul>
      </div>
      <div class="col-sm-6">
        <div id="watchoverview">
          <div id="overviewimage"> <img class="img-responsive" src="images/imagem 2.png" alt=""> </div>
        </div>
        <div class="text-center">
          <p class="button signup">Sign up Today!</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Teacher plan content end--> 
<a id="gradebook"></a> 
<!--Teacher gradebook content-->
<div class="teacher-gb full-section teacher-gradebook " >
    <div class="sectionHeader2 gradebook-header">Teacher Gradebook</div>
  <div class="container">

    <div class="clearfix"></div>
    <div class="teacher-gb-li">
      <ul class="p-0 text-center">
        <li>
          <div class="tgb-bg text-center">
          <img class="img-responsive" src="images/Shape 2.png" alt=""> 
            <p>Create student gradebooks by quarter, semester, or year</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg text-center">
          <img class="img-responsive" src="images/Shape 2.png" alt=""> 
            <p>Define weighted categories for assignments and assessments</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg text-center">
          <img class="img-responsive" src="images/Shape 2.png" alt=""> 
            <p>Include notes on student performance (coming soon!)</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg text-center">
          <img class="img-responsive" src="images/Shape 2.png" alt=""> 
            <p>Create standards-based performance reports</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg text-center">
          <img class="img-responsive" src="images/Shape 2.png" alt=""> 
            <p>Allow students to view performance online</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--Teacher gradebook content end--> 
<a id="admin"></a> 
<!--admin tools content -->
<div class="ad-tools full-section">
<div class="sectionHeader2 gradebook-header">Administrator Tools</div>
  <div class="container">
    
    <div class="clearfix"></div>
    <div class="teacher-gb-li">
      <ul class="p-0 text-center">
        <li>
          <div class="tgb-bg">
           <img class="img-responsive" src="images/Shape 3.png" alt=""> 
            <p>View teacher plans online</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
           <img class="img-responsive" src="images/Shape 3.png" alt=""> 
            <p>Provide comments and feedback to teachers</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
           <img class="img-responsive" src="images/Shape 3.png" alt=""> 
            <p>Create a shared school calendar</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
           <img class="img-responsive" src="images/Shape 3.png" alt=""> 
            <p>Review standards covered by each teacher</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
           <img class="img-responsive" src="images/Shape 3.png" alt=""> 
            <p>Add or remove teachers, reset passwords, etc.</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--admin tools content end--> 
<a id="student"></a> 
<!--student tools content -->
<div class="student-tools  full-section">
<div class="sectionHeader2 gradebook-header">Student Tools</div>

  <div class="container">
    
    <div class="clearfix"></div>
    <div class="student-tlist">
      <ul class="p-0 text-center">
        <li>
          <div class="tgb-bg">
          <img class="img-responsive" src="images/Shape 4.png" alt=""> 
            <p>View lesson plans for your teachers and classes</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
          <img class="img-responsive" src="images/Shape 4.png" alt=""> 
            <p>View grades and standard-based performance for your classes</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
          <img class="img-responsive" src="images/Shape 4.png" alt=""> 
            <p>View upcoming assignments and assessments</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
          <img class="img-responsive" src="images/Shape 4.png" alt=""> 
            <p>Access teacher provided links, videos, and files</p>
          </div>
        </li>
        <li>
          <div class="tgb-bg">
          <img class="img-responsive" src="images/Shape 4.png" alt=""> 
            <p>Communicate with your teachers</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--student tools content end--> 
<a id="reviews"></a> 
<!--teacher review content-->
<div class="teacher-review full-section">
<div class="row teacher-header"><div class="col-md-6"><p class="sectionHeader m-0 teacher-reviewheader">Teacher Reviews</p></div> 
<div class="col-md-6">
   <img class="img-responsive review-logo" src="images/logonew.png" alt="logo">
</div>

</div>
  <div class="container">
    <p class="sectionHeader"></p>
    <div class="row">
      <div class="col-sm-4">
        <div class="teacher-r  first-review">
          <p>This website is my favorite find ever on the internet! I've e-mailed my entire staff about it. Thank you for a very user friendly site that will be a huge timesaver!</p>
        </div>
        <div class="review-auth"><strong>Tammy</strong><br/>
          2nd Grade Teacher<br/>
          Washington</div>
      </div>
      <div class="col-sm-4">
        <div class="teacher-r second-review">
          <p>Thank you for creating this website, it is a truly wonderful way to plan and organize my lessons. I have used it all year and just love it!! Keep it up!</p>
        </div>
        <div class="review-auth"><strong>Michelle</strong><br/>
          6th Grade Teacher<br/>
          New York</div>
      </div>
      <div class="col-sm-4">
        <div class="teacher-r third-review">
          <p>Thank you so much for theyellowbus.com.br! I love using it. Every week when I submit my plans to my principal, I receive an email from her saying, "I love this plan format!"</p>
        </div>
        <div class="review-auth"><strong>Leslie</strong><br/>
          Language Arts Teacher<br/>
          Illinois</div>
      </div>
    </div>
    <div class="p-3 text-center"><a class="button" href="help/reviews.html" target="_blank">Sign up Today!</a></div>
  </div>
</div>
<!--teacher review content end--> 
<a id="mobile"></a> 
<!--mobile app content -->
<div class="mobile-app full-section p-5" >
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p class="sectionHeader m-0">Aceeso mobile</p>
        <div>
         <!-- <p class="avi-tag">Apps available for Android and iOS</p>-->
        </div>
        <div class="pt-3"><a href="#" target="_blank" class="button">theyellowbus.com.br: responsive site </a></div>
        <div class="pt-3"><a href="https://itunes.apple.com/us/app/theyellowbus.com.br/id671763634?mt=8" target="_blank" class="button">Get theyellowbus.com.br for iOS</a></div>
        <div class="pt-3"><a href="#" target="_blank" class="button">Get theyellowbus.com.brfor Android</a></div>
      </div>
      <div class="col-sm-6 img-box"><img  src="images/aplicativos.png" class="img-responsive" alt="">  </div>
    </div>
  </div>
</div>
<!--mobile app content end--> 
<a id="pricing"></a> 
<!--pricing content-->
<div class="pricing-section full-section">
<div class="sectionHeader2 gradebook-header">Pricing</div>
  <div class="container">
   
    <div class="row">
      <div class="col-sm-3">
        <div class="rcorners1">
          <div class="priceHead">Annual Subscription</div>
          <div class="price-textmain"> A one year subscription to theyellowbus.com.br is only $12, with additional discounts for multi-year purchases.<br/>
            <br/>
            We offer a no cost, no obligation, 30 day trial, so feel free to give it a try! </div>
          <div class="text-center m-0">
            <p class="button signupmain">Sign Up</p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="rcorners1">
          <div class="priceHead">Three Free Months</div>
           <div class="price-textmain"> A one year subscription to theyellowbus.com.br is only $12, with additional discounts for multi-year purchases.<br/>
            <br/>
            We offer a no cost, no obligation, 30 day trial, so feel free to give it a try! </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="rcorners1">
          <div class="priceHead">Six Free Months</div>
           <div class="price-textmain"> A one year subscription to theyellowbus.com.br is only $12, with additional discounts for multi-year purchases.<br/>
            <br/>
            We offer a no cost, no obligation, 30 day trial, so feel free to give it a try! </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="rcorners1">
          <div class="priceHead">School or District</div>
          <div class="price-textmain"> A one year subscription to theyellowbus.com.br is only $12, with additional discounts for multi-year purchases.<br>
            <br>
            We offer a no cost, no obligation, 30 day trial, so feel free to give it a try! </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
<!--pricing content--> 
<a id="tutorials"></a> 
<!--video content-->
<div class="video-section full-section pt-2 pb-5 " >
  
    <p class="sectionHeader">Tutorials</p>
    
    <!--   <div class="col-sm-4">
        <iframe width="100%" height="208" src="https://www.youtube.com/embed/yx8d5yOB2OI" allowfullscreen></iframe>
      </div>
      <div class="col-sm-4">
        <iframe width="100%" height="208" src="https://www.youtube.com/embed/Q_orzECqh_c" allowfullscreen></iframe>
      </div>
      <div class="col-sm-4">
        <iframe width="100%" height="208" src="https://www.youtube.com/embed/2vcN5g1glUE" allowfullscreen></iframe>
      </div>
    </div> -->
    <div class="p-3 text-center tutorial-links"> <a class="button signupmain" href="#" target="_blank">View all tutorials</a></div>
  

<!--video content--> 



@endsection

@push('js')
  <script>
    $(document).ready(function(){
       $('#viewPlans').on('click',function(){
        $('#studentLoginBox').modal(); 
     });
    }); 
    $("body").on('click','#applyStudent',function(e){
      var obj = $(this);

      event.preventDefault();

      //$('#login_loader').show();

      $.ajax({
          url: "{{ url('/studentlogin') }}",
          type: 'POST',
          dataType: 'json',
          data: $("#studentLogin").serialize(),
          beforeSend: function () {
              //obj.html('Saving... <i class="fa fa-floppy-o"></i>');
          },
          complete: function () {
              //  obj.html('Save <i class="fa fa-floppy-o"></i>');
          },
          success: function (response) {
              var html = '';
              console.log(response);
              $('#warning-box').remove();
              $('#success-box').remove();

              if (response['error']) {
                  html += '<div id="warning-box" class="alert alert-danger fade in">';
                  html += '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                  html += '<strong>Error!</strong>';

                  for (var i = 0; i < response['error'].length; i++) {
                      html += '<p>' + response['error'][i] + '</p>';
                  }

                  html += '</div>';
                  $('.alertContainer').before(html);
                  //$('#login_loader').hide();
              }

              if (response['success']) {


                  window.location.href = APP_URL + response['success_redirect_url'];

                  //$('#login_loader').hide();


              }
          }
      });
  });

  
 
  </script>
   
@endpush