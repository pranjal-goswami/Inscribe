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
		  <input type="text" class="form-control" id="" placeholder="Name" required autofocus>
		</div>
	  </div>
	 <div class="form-group">
		<div class="col-md-12">
		  <input type="text" class="form-control" id="" placeholder="Email" required>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="password" class="form-control" id="" placeholder="Password">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <div class="checkbox">
			<label>
			  <input type="checkbox"> I accept the <a href="#">Terms & conditions.</a>
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
<br /><br /><br />
<!--FOOTER-->
<div id="footer">
	<div class="container">
		<p class=" col-md-12 center-block text-center pad-top10"><a href="index.html">Home</a> | <a href="gallery.html">Photo Gallery</a> | <a href="topic.html">Topics/Categories</a> | <a href="blank.html"> Sample Page</a>.</p>
		<p class=" col-md-12 center-block text-center pad-top10">&copy; 2013-15 Inscribe.io | All Rights Reserved </p>
	</div>
</div>

{include file="_footer.tpl"}