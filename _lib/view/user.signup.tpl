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
		  <input type="text" class="form-control" id="" placeholder="Email" autofocus>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="email" class="form-control" id="inputEmail3" placeholder="Email" autofocus>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-md-12">
		  <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
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
<br /><br /><br />
<!--FOOTER-->
<div id="footer">
	<div class="container">
		<p class=" col-md-12 center-block text-center pad-top10"><a href="index.html">Home</a> | <a href="gallery.html">Photo Gallery</a> | <a href="topic.html">Topics/Categories</a> | <a href="blank.html"> Sample Page</a>.</p>
		<p class=" col-md-12 center-block text-center pad-top10">&copy; 2013-15 Inscribe.io | All Rights Reserved </p>
	</div>
</div>
{include file="_footer.tpl"}