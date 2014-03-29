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
		<span class="logo-text">inscribe</span>
	</span>
   
  </div>


  </div><!--/ container -->
</nav>

<div class="form-signin">
	<div class="form-signin-heading">
		<img src="{$site_root_path}assets/img/logo.png" />
	</div>
	<hr />
	<div id="login_form_response"></div>
	<form class="form-horizontal" role="form" id="login_form">
	  
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required autofocus>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="password" class="form-control" id="user_pwd" name="user_pwd" placeholder="Password" required>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <button type="submit" class="btn btn-success btn-block">Sign in</button>
		</div>
	  </div>
	  
	  <p class="text-center"><small><a href=#>Forgot Password?</a> | Haven't Registered yet? <a href="../signup/">Register</a></small></p>
	</form>
</div>

{literal}
<script type="text/javascript">
var f = $("form#login_form");
var log = true;
f.submit(function(e){
	e.preventDefault();
	if(log)	console.log("Submitting Login form");

	$.ajax({
		type:"POST",
		url:'./?a=login',
		data:f.serialize(),
		dataType: "json",
		success: function(r){
			var e = $('#login_form_response');
			if(log) console.log(r);
			switch(r.status){
				case "error":
					e.removeClass();
					e.addClass('alert alert-danger');
					e.html(r.message);
					f[0].reset();
					break;
				case "success":
					e.removeClass();
					e.addClass('alert alert-success');
					e.html(r.message);
					f.hide();
					window.location = '../../';
					break;
				case "info":
					e.removeClass();
					e.addClass('alert alert-info');
					e.html(r.message);
					break;
				default:
					alert();
					
			}
		},
		fail: function(){
			alert('failed');
		}
	})
	return false;
});
</script>
{/literal}
{include file="_footer.tpl"}