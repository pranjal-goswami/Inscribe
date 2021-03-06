<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
 <div class="container">
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <span class="navbar-brand">
		<a href="{$site_root_path}"><span class="logo-text">inscribe</span></a>
	</span>
	<form class="navbar-form navbar-left" role="search">
	  <div class="form-group">
		<input type="text" class="form-control search-bar" placeholder="Search for posts, authors" onclick="this.select()">
	  </div>
	</form>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="navbar-collapse">
   <ul class="nav navbar-nav navbar-right navbar-form">
 	  <li>
	  	<a href="{$site_root_path}user/?a=create" class="btn btn-xs btn-default navbar-login-btn"
			style=" font-size:17px; margin-right:7px;">
			<i class="fa fa-pencil" style="padding:4px 0px 4px 0px; color:#777;"></i> 
			</a>
	  </li>
	  <li class="dropdown">
          {if $isLoggedIn == true}

		<div class="btn-group" style="height:37px;">
			<a class="btn btn-default btn-xs navbar-login-btn" href="{$site_root_path}user/"
				style=" padding-right:0px !important; height:37px;">
				<img class="user_pic" 
					src="{$site_root_path}/data/user/avatar/{if $user->profile_pic_id == null}default_avatar.jpg{else}{$user->profile_pic_id}{/if}" />
				<span style="margin-top:2px; color:#777; font-size:14px;">
				{$user->full_name}  &nbsp;</span>
			</a>
			<a href="#" class="btn btn-default btn-xs navbar-login-btn dropdown-toggle" data-toggle="dropdown"
				style="padding-left:4px !important; padding-right:4px !important; height:37px; border-left:none; ">
				<div style="padding-top:3px; color:#777; font-size:12px;">
					<i class="fa fa-caret-down"></i>
				</div>
			</a>
			<ul class="dropdown-menu" style="width:100%; font-family:'Open Sans', Helvetica,Arial;">
				<li><a href="{$site_root_path}user/"><i class="fa fa-user"></i> &nbsp; Profile</a></li>
				<li><a href="{$site_root_path}user/logout.php"><i class="fa fa-sign-out"></i> &nbsp; Logout</a></li>
			</ul>
		</div>
		{else}
		<a href="{$site_root_path}user/" class="btn btn-xs btn-primary navbar-login-btn" id="login-button">
			<i class="fa fa-sign-in"></i> &nbsp; Log in 
		</a>
		{/if}
          
        </li>
	</ul>
	</div>
  </div><!-- /.navbar-collapse -->
  </div><!--/ container -->
</nav>
