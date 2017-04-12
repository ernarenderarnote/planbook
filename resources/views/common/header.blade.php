<!-- header Start-->
<div class="header">
  <div class="container header-container">
    <div class="row">
      <div class="col-sm-4 pt-1" >
        <table>
          <tr>
            <td><img class="img-responsive" src="images/12-dollar-badge.png" alt=""></td>
            <td>
              <div class="logo-signup" style="">
                <a href="#" id="signUpButton" class="button  signup">Sign up</a><br/>
                and receive a one month<br/>
                free trial.
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="col-sm-4 text-center head-center"><img class="img-responsive" src="images/planbook.png" alt=""></div>
      <div class="col-sm-4">
        <form>
          <div class="header-form text-right">
            <p> <span class="text-bold">Login</span> <span id="viewPlans" class="form-top navButton">Student View</span> <span  id="forgotPW" class="form-top navButton">Forgot Password</span> </p>
            <p>
              <input type="text" id="loginEmail" class="hf-input"  placeholder="Email Address">
            </p>
            <p>
              <input type="password" id="loginPW" class="hf-input"  placeholder="Password">
            </p>
            <table>
              <tr>
                <td><div class="loginerr-box">
                    <p id="loginErrorMsg" class="error"></p>
                  </div></td>
                <td><div class="head-f-s">
                    <input type="submit" name="applyLogin" id="applyLogin" class="button" value="Login" >
                    <p id="loadingMsg" class="text-bold mt-1" >Loading...</p>
                  </div></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- header End-->


<!-- popup-signup-->
<div id="newUserBox" class="editBox" >
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
      <input id="newEmail" name="newEmail" type="email" placeholder="Email Address" class="popup-input mb-4" />
      <input id="newPW" name="newPW" type="password" placeholder="Password" class="popup-input mb-4" />
      <input id="confirmPW" name="confirmPW" type="password" placeholder="Confirm Password" class="popup-input mb-4" />
      <div class="mb-4">
        <input type="button" name="applyNewUser" id="applyNewUser" class="button popup-btn" value="Sign Up"  />
        <span style="display:none;" id="regNewUser" class="full-section" >Registering...</span>
        <input type="button" id="cancelNewUser" class="greybutton  popup-btn" Value="Cancel" />
      </div>
    </form>
  </div>
</div>
<!-- popup-signup-->

<!--Navigation Start-->
<nav class="navbar m-0 br-0  bg-theme ">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"> <a class=" navButton"  href="#planbook" >Planbook <span class="sr-only">(current)</span></a> </li>
        <li> <a class=" navButton" href="#gradebook">Gradebook</a> </li>
        <li> <a class=" navButton" href="#admin" >Administrators</a> </li>
        <li> <a class=" navButton" href="#student" >Students</a> </li>
        <li> <a class=" navButton" href="#reviews" >Reviews</a> </li>
        <li> <a class=" navButton" href="#mobile" >Mobile Apps</a> </li>
        <li> <a class=" navButton" href="#pricing" >Pricing</a> </li>
        <li> <a class=" navButton" href="#tutorials" >Tutorials</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!--Navigation End-->

@push('js')
<script type="text/javascript">
  // A $( document ).ready() block.
$(document).ready(function() {


  $('#signUpButton').on('click', function() {
    $('#newUserBox').show();
  });

  $('#cancelNewUser').on('click', function() {
    $('#newUserBox').hide();
  });


  $('#applyNewUser').click(function (event) {

    console.log(event.target);
    var obj = $(this);

    event.preventDefault()

    //$('#signup_loader').show();

    $.ajax({
      url: "{{ url('/signUp') }}",
      type: 'POST',
      dataType: 'json',
      data: $(this).closest('form').serialize(),
      beforeSend: function () {
        //obj.html('Saving... <i class="fa fa-floppy-o"></i>');
      },
      complete: function () {
        //  obj.html('Save <i class="fa fa-floppy-o"></i>');
      },
      success: function (response) {
        var html = '';

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
            $('#signupform').before(html);
           // $('#signup_loader').hide();
        }

        if (response['success']) {
          $('#newUserBox').hide();

          window.location.href = APP_URL + response['success_redirect_url'];
        }

      }
    });
});


   
});

</script>
@endpush