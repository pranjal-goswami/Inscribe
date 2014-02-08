{include file="_header.tpl"}
<!-- Markdown Editor js and css files -->
<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/pagedown-bootstrap-master/css/jquery.pagedown-bootstrap.css"/> 
<script type="text/javascript" src="{$site_root_path}plugins/pagedown-bootstrap-master/js/jquery.pagedown-bootstrap.combined.min.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/validation.js"></script>

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
				<textarea class="form-control" rows="5" name="excerpt" id="excerpt" maxlength="200" placeholder="Excerpt (Max 200 words)"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<textarea class="form-control" rows="18" name="content" id="content" placeholder="Content"></textarea>
			</div>
		</div>
		<div class="col-md-4">
			<button type="submit" class="btn btn-success btn-block save-post-button disabled" disabled>Save</button>
		</div>
	</form>

	<div class="col-md-2 col-md-offset-4">
			<button class="btn btn-default btn-block toggle-excerpt-button">Write Excerpt</button>
	</div>

	<form class="form-horizontal" id="post-form-publish" role="form">
		<input type="hidden" name="content_id" value={$content_id} />
		<div class="col-md-2 col-md-offset-0">
			<button type="submit" class="btn btn-info btn-block publish-post-button disabled" disabled>Publish</button>
		</div>
	</form>
<br /><br /><br />
</div>
<br /><br /><br />


{include file="_footer.tpl"}

{literal}

<script type="text/javascript">

(function () {
	$("textarea#content").pagedownBootstrap();
})();
$('div.wmd-preview').hide();
$('div#wmd-button-row-0').append('<div class="btn btn-info pull-right preview-post-button"><span id="preview-post-button-text"><i class="fa fa-search-plus"></i></span> Preview</div>');
$.growl.warning({ message: "The article can be published only after it is saved." });
$('#excerpt').hide();
</script>

<script type="text/javascript">

var f1 = $("form#post-form-save");
var f2 = $("form#post-form-publish");
var save_button = $(".save-post-button");
var publish_button = $(".publish-post-button");
var preview_post_button = $(".preview-post-button");
var form_inputs = $('#post-form-save .form-control');
var toggle_excerpt_button = $('.toggle-excerpt-button');

f1.submit(function(e)
{
	e.preventDefault();
	var values = f1.serialize(); 
	$.ajax({
		type : 'POST',
		url : './?a=save',
		data : values,
		success: function(result){
			publish_button.removeAttr('disabled');
			publish_button.removeClass('disabled');
			save_button.attr('disabled');
			save_button.addClass('disabled');
			$.growl.notice({ message: "Saved successfully" });
		}
	});
}); 


f2.submit(function(e)
{
	e.preventDefault();

	if(isEmpty($('#excerpt')))
	{
		$('#excerpt').slideDown("slow");
		toggle_excerpt_button.html('Hide Excerpt');
		$.growl.warning({ message: "Please write a 50-200 word excerpt before publishing." });
	}

	else
	{

	if(validatePostForm(f1))
	{
	var values = f1.serialize(); 
	$.ajax({
		type : 'POST',
		url : './?a=publish',
		data : values,
		success: function(result){
			$('textarea.wmd-input').slideUp("slow");
			$('div.wmd-preview').show("slow");
			$('#preview-post-button-text').html('<i class="fa fa-search-minus"></i>');
			$.growl.notice({ message: "Published Successfully." });
		}
	});
	}
	else
	{
		$.growl.error({ message: "Title, Excerpt and Content cannot be left empty before publishing an article." });
	}

	}
}); 

form_inputs.keyup(function()
{
	publish_button.attr('disabled');
	publish_button.addClass('disabled');
	save_button.removeClass('disabled');
	save_button.removeAttr('disabled');
	
});

preview_post_button.click(function()
{
	if($('div.wmd-preview').is(":visible"))
	{
		$('div.wmd-preview').hide("slow");
		$('textarea.wmd-input').slideDown("slow");
		$('#preview-post-button-text').html('<i class="fa fa-search-plus"></i>');
	}
	else
	{	
		$('textarea.wmd-input').slideUp("slow");
		$('div.wmd-preview').show("slow");
		$('#preview-post-button-text').html('<i class="fa fa-search-minus"></i>');
	}
});

toggle_excerpt_button.click(function()
{
	if($('#excerpt').is(":visible"))
	{
		$('#excerpt').hide("slow");
		toggle_excerpt_button.html('Write Excerpt');
	}
	else
	{	
		$('#excerpt').slideDown("slow");
		toggle_excerpt_button.html('Hide Excerpt');
	}
});

</script>

{/literal}