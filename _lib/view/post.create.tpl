{include file="_header.tpl"}
<!-- Markdown Editor js and css files -->
<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/markdown/css/bootstrap-markdown.min.css" /> 
<script type="text/javascript" src="{$site_root_path}plugins/markdown/js/bootstrap-markdown.js"></script>

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

<div class="post-writer col-md-8 col-md-offset-2">
	<h2>Post</h2>
	<hr />
	<form class="form-horizontal" id="post-form-save" role="form">
		<input type="hidden" name="content_id" value={$content_id} />
		<div class="form-group">
			<div class="col-md-12">
				<input type="text" class="form-control" name="title" id="title" placeholder="Title" autofocus>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<textarea class="form-control" rows="4" name="excerpt" id="excerpt" placeholder="Excerpt (Max 150 words)"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<textarea class="form-control" rows="12" data-provide="markdown" name="content" id="content"></textarea>
			</div>
		</div>
		<div class="col-md-4">
			<button type="submit" class="btn btn-success btn-block save-post-button">Save</button>
		</div>
	</form>

	<form class="form-horizontal" id="post-form-publish" role="form">
		<input type="hidden" name="content_id" value={$content_id} />
		<div class="col-md-2 col-md-offset-6">
			<button type="submit" class="btn btn-info btn-block publish-post-button disabled" disabled>Publish</button>
		</div>
	</form>
	
</div>
<br /><br /><br />


{include file="_footer.tpl"}

{literal}
<script type="text/javascript">

var f1 = $("form#post-form-save");
f1.submit(function(e)
{
	e.preventDefault();
	var values = f1.serialize(); 
	$.ajax({
		type : 'POST',
		url : './?a=save',
		data : values,
		success: function(result){
			$(".publish-post-button").removeAttr('disabled');
			$(".publish-post-button").removeClass('disabled');
		}
	});
}); 

var f2 = $("form#post-form-publish");
f2.submit(function(e)
{
	e.preventDefault();
	var values = f2.serialize(); 
	$.ajax({
		type : 'POST',
		url : './?a=publish',
		data : values,
		success: function(result){
		}
	});
}); 

</script>
{/literal}