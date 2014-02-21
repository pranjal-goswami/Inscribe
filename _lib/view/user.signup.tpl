{include file="_header.tpl"}
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
 <div class="container">
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
	 <span class="navbar-brand">
		<div class="navbar-logo"></div>
		<span class="logo-text"></span>
	</span>
   
  </div>


  </div><!--/ container -->
</nav>

<div class="form-signin">
	<div class="form-signin-heading">
		<img src="{$site_root_path}assets/img/logo.png" />
	</div>
	<hr />
	<div id="signup_form_response"></div>
	<form id="signup_form" class="form-horizontal" role="form">
	   <div class="form-group">
		<div class="col-md-12">
		  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name" autofocus data-validate="validateName">
		  <div class="form-error">* Name is required</div>
		</div>
	  </div>
	 <div class="form-group">
		<div class="col-md-12">
		  <input type="text" class="form-control" id="email" name="email" placeholder="Email" data-validate="validateEmail">
		  <div class="form-error">* Email should be like <em>myname@email.com</em></div>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" data-validate="validatePwd">
		  <div class="form-error">* Password should be atleast <strong>5</strong> characters long</div>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" class="pass"> I accept the <a href="#">Terms & conditions.</a>
			</label>
		  </div>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Sign Up</button>
		</div>
	  </div>
	  

	  <p class="text-center"><small> Have an account already? <a href="../login/">Sign In</a></small></p>

	</form>
</div>


{literal}
<script type="text/javascript">
var f = $("form#signup_form");

$("form#signup_form").find('input').focusout(function(){
	if(!$(this).hasClass('pass')){
		var v = $(this).attr('data-validate');
		window[v]($(this));
		}
});

f.submit(function(e){
	e.preventDefault();
	console.log(validateSignUpForm(f));
	if(validateSignUpForm(f))
	{
		$.ajax({
			type:"POST",
			url:'./?a=signup',
			data:f.serialize(),
			dataType: "json",
			success: function(r){
				alert(r.status);
				alert(r.message);
			},
			fail: function(){
				alert('failed');
			}
		})
		return false;
	}
});
</script>
{/literal}

{include file="_footer.tpl"}