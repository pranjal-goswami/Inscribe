{include file="_header.tpl"}
<!-- NAVBAR-->
{include file="_navbar.tpl"}
<!-- MAIN CONTAINER -->
<div class="container" >




	<div class="row">
		<!-- LEFT FIXED SIDE BAR -->
		
		<div class="col-md-2">
		
		   <div class="sidebar-nav-fixed">
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
			{include file="post-stream.tpl"}
		</div>
		<!-- RIGHT BLOG CONTENT CONTAINER ENDS -->

	</div>
	
	
</div>
{include file="_footer.tpl"}

<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/hash.js"></script>

<!-- Search scripts -->
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="{$site_root_path}plugins/typeahead/typeahead.jquery.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/search.js"></script>

{literal}
<script type="text/javascript">

$(document).ready(function(){
	$('.create-new-post-btn').tooltip();
	if($('.sidebar-nav').height() > 550) $('.sidebar-nav').css('overflow-y','scroll');
	});

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




