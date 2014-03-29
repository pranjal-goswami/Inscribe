<!-- Markdown Editor js and css files -->
<script type="text/javascript" src="{$site_root_path}plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/tinymce/jquery.tinymce.min.js"></script>


<script type="text/javascript" src="{$site_root_path}assets/js/validation.js"></script>


<div class="post-writer col-md-12">
	<h2>Post</h2>
	<hr />
	<form class="form-horizontal" id="post-form-save" role="form">
		<input type="hidden" name="content_id" value={$content_id} />
		<div class="form-group col-md-12">
			<div>
				<input type="text" class="form-control" name="title" id="title" placeholder="Title" autofocus>
			</div>
		</div>
		<div class="form-group col-md-8">
			<div class=" pull-left">
				<textarea class="form-control" name="editor" id="editor" placeholder="Content"></textarea>
			</div>
		</div>
		<div class="form-group col-md-4">
			<div class="pull-left">
				<textarea class="form-control" rows="10" name="excerpt" id="excerpt" maxlength="1200" placeholder="Excerpt (Max 200 words)" 
				style="width:270px;"></textarea>
			</div>
		</div>
		<div class="form-group col-md-4">
		<div class="pull-left">
			<button type="submit" style="width:270px;" class="btn btn-success btn-block save-post-button disabled" disabled>Save</button>
		</div>
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
         "advlist autosave autolink link image lists charmap hr pagebreak",
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

</script>

<script type="text/javascript">

var f1 = $("form#post-form-save");
var save_button = $(".save-post-button");
var form_inputs = $('#post-form-save .form-control');

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
			save_button.attr('disabled');
			save_button.addClass('disabled');
			$.growl.notice({ message: "Saved successfully" });
		}
	});
}); 

form_inputs.keyup(function()
{
	handleButtons();
	
});


function handleButtons()
{
	save_button.removeClass('disabled');
	save_button.removeAttr('disabled');
}


</script>

{/literal}