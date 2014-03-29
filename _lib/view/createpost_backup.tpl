<!-- Markdown Editor js and css files -->
<script type="text/javascript" src="{$site_root_path}plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/tinymce/jquery.tinymce.min.js"></script>


<script type="text/javascript" src="{$site_root_path}assets/js/validation.js"></script>


<div class="post-writer col-md-12 ">
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
				<textarea class="form-control" rows="5" name="excerpt" id="excerpt" maxlength="1200" placeholder="Excerpt (Max 200 words)"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<textarea class="form-control" name="editor" id="editor" placeholder="Content"></textarea>
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
<div class="clear"></div>


{literal}

<script type="text/javascript">

tinymce.init({
    selector: "textarea#editor",
    theme: "modern",
    width: 460,
    height: 520,
    setup: function(editor) {
        editor.on('change', function(e) {
            handleButtons();
        });
    },
    plugins: [
         "advlist autolink link image lists charmap hr pagebreak",
         "searchreplace wordcount visualblocks code visualchars fullscreen insertdatetime media nonbreaking",
         "contextmenu directionality template paste textcolor"
   ],
   content_css: "{/literal}{$site_root_path}plugins/tinymce/style.css{literal}",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 


$.growl.warning({ message: "The article can be published only after it is saved." });
$('#excerpt').hide();
</script>

<script type="text/javascript">

var f1 = $("form#post-form-save");
var f2 = $("form#post-form-publish");
var save_button = $(".save-post-button");
var publish_button = $(".publish-post-button");
var form_inputs = $('#post-form-save .form-control');
var toggle_excerpt_button = $('.toggle-excerpt-button');

f1.submit(function(e)
{
	e.preventDefault();
	var post_content = tinyMCE.activeEditor.getContent();
	var values = f1.serialize();
	values = values+'&content='+post_content;
	$.ajax({
		type : 'POST',
		url : site_root_path+'posts/?a=save',
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
	var post_content = tinyMCE.activeEditor.getContent();
	var values = f1.serialize(); 
	values = values+'&content='+post_content;
	$.ajax({
		type : 'POST',
		url : site_root_path+'posts/?a=publish',
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
	handleButtons();
	
});


function handleButtons()
{
	publish_button.attr('disabled');
	publish_button.addClass('disabled');
	save_button.removeClass('disabled');
	save_button.removeAttr('disabled');
}


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