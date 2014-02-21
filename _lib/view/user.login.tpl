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
	<form class="form-horizontal" role="form">
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="email" class="form-control" id="inputEmail3" placeholder="Email" required autofocus>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" required>
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

{include file="_footer.tpl"}