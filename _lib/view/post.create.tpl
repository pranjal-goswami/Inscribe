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
	<form class="form-horizontal" role="form" action="?a=save" method="POST">
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
		<div class="form-group">
			<div class="col-md-4">
				<button type="submit" class="btn btn-success btn-block">Save</button>
			</div>
			<div class="col-md-2 col-md-offset-6">
				<button type="submit" class="btn btn-info btn-block">Publish</button>
			</div>
		</div>

		</form>
	</div>
	<br /><br /><br />


	{include file="_footer.tpl"}