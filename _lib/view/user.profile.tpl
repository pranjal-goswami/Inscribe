{include file="_header.tpl"}
<!-- Navbar -->
{include file="_navbar.tpl"}
<!-- MAIN CONTAINER -->
<div class="container" >
	<div class="row">
		<!-- LEFT FIXED SIDE BAR -->
		<div class="col-md-2">
		   <div class="sidebar-nav-fixed">
		   
		    <img class="sidebar-user-pic" src="{$site_root_path}/data/user/avatar/{if $user->profile_pic_id == null}default_avatar.jpg{else}{$user->profile_pic_id}{/if}" /> 
			<h2 class="sidebar-user-name">{$user->full_name}</h2>
			<ul class="profile sidebar-nav">
			<li class="separator"></li>
				<li><span><i class="fa fa-envelope"></i></span><span style="color:#4183c4"> &nbsp; {$user->email}</span></li>
				{assign var="j" value=$user->joined|@strtotime}
				<li style="padding-top:0px;"><span><i class="fa fa-clock-o"></i> &nbsp; Joined on {"M d, Y"|@date:$j}</span>
				</li>
				<br />
				<li class="separator"></li>
				<li id="show-published-stream"><span><i class="fa fa-book"></i> &nbsp; Published</span></li>
				<li class="separator"></li>
				<li id="manage-posts"><span><i class="fa fa-edit"></i> &nbsp; Posts</span></li>
				<li class="separator"></li>
				<li><span><i class="fa fa-bar-chart-o"></i> &nbsp; Stats</span></li>
				<li class="separator"></li>
				<li><span><i class="fa fa-cog"></i> &nbsp; Settings</span></li>
				<li class="separator"></li>
				<li id="create-new-post"><span><i class="fa fa-plus"></i> &nbsp; Create New</span></li>
				<li class="separator"></li>
				
			</ul>
			</div>
		   
		</div>
		<!-- LEFT FIXED SIDE BAR ENDS -->
		<!-- RIGHT BLOG CONTENT CONTAINER -->
		<div class="col-md-9 col-md-offset-3" id="render-content-container">
			{include file=$tpl}
		</div>
		<!-- RIGHT BLOG CONTENT CONTAINER ENDS -->
	</div>
</div>


<!-- Search scripts -->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="{$site_root_path}plugins/typeahead/typeahead.jquery.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/search.js"></script>

{literal}
<script type="text/javascript">

function showPublishedStream()
{
	var ajax_values =  null;
	ajaxLoad(site_root_path+'?a=ownposts', 'render-content-container', ajax_values, ''); 
}


$('#show-published-stream').click(function()
{
	showPublishedStream();
});


$('#create-new-post').click(function()
{
	var ajax_values =  null;
	ajaxLoad(site_root_path+'posts/?a=create', 'render-content-container', ajax_values, ''); 
});

$('#manage-posts').click(function()
{
	var ajax_values =  null;
	ajaxLoad(site_root_path+'posts/?a=manage', 'render-content-container', ajax_values, ''); 
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


$('input.search-bar').keypress(function(e) {
     var code = (e.keyCode ? e.keyCode : e.which);
     if (code == 13) {
		e.preventDefault();
	var query = $('input.search-bar').val(); 
	window.location = site_root_path+"?a=sp&ptitle="+query;
	}
});

</script>
{/literal}


