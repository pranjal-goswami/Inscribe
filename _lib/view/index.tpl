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
		<a href="{$site_root_path}"><span class="logo-text">inscribe</span></a>
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
	    <a href="./user/" class="btn btn-xs btn-info navbar-login-btn">
	  	<i class="fa fa-sign-in"></i> &nbsp; Log in
		</a>
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
			<ul class="sidebar-nav">
				<li class="separator"></li>
				{foreach from=$category_list item=category}
				<li class="category_name" id="{$category->id}"><span>{$category->category_name}</span></li>
				<li class="separator"></li>
				{/foreach}
			</ul>
			</div>
		   
		</div>
		<!-- LEFT FIXED SIDE BAR ENDS -->
		<!-- RIGHT BLOG CONTENT CONTAINER -->
		<div class="col-md-9 col-md-offset-3" id="post-stream-container">
			<!-- BLOG POST CONTENT -->
		</div>
		<!-- RIGHT BLOG CONTENT CONTAINER ENDS -->

	</div>
</div>

{include file="_footer.tpl"}
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/hash.js"></script>
{literal}
<script type="text/javascript">

streamAllPosts();

function streamAllPosts()
{
	var category_id = 0;
	var ajax_values =  'category_id='+category_id;
	ajaxLoad('./?a=catposts', 'post-stream-container', ajax_values, ''); 
}


$('.category_name').click(function()
{
	var category_id = this.id;
	var ajax_values =  'category_id='+category_id;
	ajaxLoad('./?a=catposts', 'post-stream-container', ajax_values, ''); 
});

// Arrows

	$(document).keydown(function(e){

		var previous = 37, next = 39;

		switch (e.keyCode) {
			case previous:

				$('.sj-book').turn('previous');

			break;
			case next:
				
				$('.sj-book').turn('next');

			break;
		}

	});
	
</script>
{/literal}




