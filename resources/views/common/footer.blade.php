<!--footer content-->
<div class="footer full-section p-5">
  <div class="container">
    <div class="row" >
      <ul class="footer-img text-center p-0 full-section">
        <li><img  src="images/planbookwhite.png" alt=""></li>
        <li><a href="http://www.facebook.com/planbookcom" target="_blank" title="Follow us on Facebook"  class="ml-4"><img src="images/facebook.png"></a></li>
        <li><a href="http://www.twitter.com/planbookcom" target="_blank" title="Follow us on Twitter" class="ml-4"><img src="images/twitter.png"></a></li>
      </ul>
    </div>
  </div>
  <ul class="p-3 m-0 full-section text-center footer-supline">
    <li><a id="termLink" href="help/terms.html" target="_blank" class="navButton">Terms of Service</a></li>
    <li><a id="privacyLink" href="help/privacy.html" target="_blank" class="navButton">Privacy Policy</a></li>
    <li>support@planbook.com</li>
    <li>(888) 205-5528 </li>
  </ul>
</div>
<!--footer end--> 
<!-- popup-studentlogin-->

<!-- popup-signup-->
<div id="newUserBox" class="editBox student-loginmain" >
  <p class="popup-heading">Sign Up</p>
  <div class="editBoxRow alertContainer text-center" style="display:none;">
    <div class="alertImage"> <img src="images/icon-alert.png" /> </div>
    <div class="alertMessage" id="newUserErrorMsg"> </div>
  </div>
  <div class="pl-4 pt-4 pr-4">
    <div class="clearfix"></div>
    <div class="button-group">
      <div class="row">
        <div class="form-group col-sm-5 text-left"> <a class="btn btn-facebook button  width-auto" href="/auth/facebook" target="_self"> <span class="pr-2">Login with </span><i class="fa fa-facebook" aria-hidden="true"></i></a> </div>
        <div class="col-sm-2">
          <h4> Or </h4>
        </div>
        <div class="form-group col-sm-5 text-center"> <a class="btn btn-google button width-auto" href="/auth/google" target="_self">  <span class="pr-2">Login with </span> <i class="fa fa-google-plus" aria-hidden="true"></i></a> </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <form id="signupform" role="form" method="POST">
      {{ csrf_field() }}
      <input id="user_role" name="user_role" type="hidden" value="2" />
      <input id="email" name="email" type="email" placeholder="Email Address" class="popup-input mb-4" />
      <input id="password" name="password" type="password" placeholder="Password" class="popup-input mb-4" />
      <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" class="popup-input mb-4" />
      <div class="mb-4">
        <input type="button" name="applyNewUser" id="applyNewUser" class="button popup-btn" value="Sign Up"  />
        <span style="display:none;" id="regNewUser" class="full-section" >Registering...</span>
        <input type="button" id="cancelNewUser" class="greybutton  popup-btn" Value="Cancel" />
      </div>
    </form>
  </div>
</div>
<!-- popup-signup-->
<div id="overview" class="modalDialog" style="display:none;">
  <div> <a id="closeVideoBox" href="javascript:void(0);" title="Close" class="close">X</a>
    <video id="planbookVideo" width="699px" height="393px" controls>
      <source src="help/planbook.mp4" type="video/mp4">
      Your browser does not support the video tag. </video>
  </div>
</div>

<!-- popup-re-->
<div id="retrievePW" class="editBox">
  <p class="popup-heading">Retrieve Password</p>
  <div class="pl-4 pt-4 pr-4">
    <form>
      <input id="retrieveEmail" name="retrieveEmail" type="email" placeholder="Email Address" class="popup-input" />
      <div class="mt-4">
        <input type="submit" name="mailPW" id="mailPW" class="button" value="Retrieve Password"  />
        <span id="emailSending" class="full-section">Sending password...</span>
        <input type="button" id="cancelRetrieve" class="greybutton  popup-btn" Value="Cancel" />
        <p id="retrievePWErrorMsg" class="error mt-1">&nbsp;</p>
      </div>
    </form>
  </div>
</div>
<div id="load">
  <div class="p-3"> <span>Loading</span> <img src="images/ajax-loader.gif"> </div>
</div>

@include('common.script')

