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
	<form class="navbar-form navbar-left" role="search">
	  <div class="form-group">
		<input type="text" class="form-control" style="border-radius:100px;" placeholder="">
	  </div>
	</form>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <ul class="navbar-right navbar-form unstyled">
      <li>
		{if $isLoggedIn == true}
		<a class="btn btn-default"><img class="user_pic" 
			src="{$site_root_path}/data/user/avatar/{if $user->profile_pic_id == null}default_avatar.jpg{else}{$user->profile_pic_id}{/if}" />
			<span style="margin-top:2px;">
			{$user->full_name}</span></a>
		{else}
			<a href="./user/" class="btn btn-xs btn-primary navbar-login-btn">
			<i class="fa fa-sign-in"></i> &nbsp; Log in 
			</a>
		{/if}
		
		
	  </li>
    </ul>
  </div><!-- /.navbar-collapse -->
  </div><!--/ container -->
</nav>
<!-- MAIN CONTAINER -->
<div class="container" >
	<div class="row">
		<!-- LEFT FIXED SIDE BAR -->
		<div class="col-md-2">
		   <div class="sidebar-nav-fixed affix">
		   
		    <img class="sidebar-user-pic" src="{$site_root_path}/data/user/avatar/{if $user->profile_pic_id == null}default_avatar.jpg{else}{$user->profile_pic_id}{/if}" /> 
			<h2 class="siderbar-user-name">{$user->full_name}</h2>
			<ul class="sidebar-nav">
				<li class="separator"></li>
				<li><span>Published</span></li>
				<li class="separator"></li>
				<li><span>Posts</span></li>
				<li class="separator"></li>
				<li><span>Stats</span></li>
				<li class="separator"></li>
				<li><span>Settings</span></li>
				<li class="separator"></li>
				
			</ul>
			</div>
		   
		</div>
		<!-- LEFT FIXED SIDE BAR ENDS -->
		<!-- RIGHT BLOG CONTENT CONTAINER -->
		<div class="col-md-9 col-md-offset-3">
			
		{include file="post.create.tpl"}

		
		</div>
		<!-- RIGHT BLOG CONTENT CONTAINER ENDS -->
	</div>
</div>





