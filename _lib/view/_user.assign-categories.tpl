<div class="modal-dialog">
    <div class="modal-content">
    	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Assign Category</h4>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" id="assign-categories-publish-form" role="form">
		<input type="hidden" name="post_encrypted_id" value="{$post_encrypted_id}" />
		<div class="row">
		{foreach from=$categories item=category}
			<div class="col-md-4">
				{if in_array($category->category_name, $post_categories)}
				<input type="checkbox" class="category" name="post_categories[]" value="{$category->id}" checked="checked">
				{else}
				<input type="checkbox" class="category" name="post_categories[]" value="{$category->id}">
				{/if}
				{$category->category_name}
				<br /><br />
			</div>
		{/foreach}
	</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary publish-post">Publish</button>
      </div>
    </div>
  </div>
 


{literal}

<script type="text/javascript">

$('.publish-post').click(function()
{
	var no_of_categories=$('#assign-categories-publish-form').find('input[name="post_categories[]"]:checked').length;
	if(no_of_categories > 3) alert('One post cannot be assigned more than 3 categories.');
	else if(no_of_categories < 1) alert('Please assign at least one category to your post.');
	else{
	var ajax_values = $('#assign-categories-publish-form').serialize();
	ajaxLoad(site_root_path+'posts/?a=publish', 'render-content-container', ajax_values, 'publishSuccess');

	} 
});

function publishSuccess()
{
	$('.modal-backdrop').hide();
	$.growl.notice({ message: "Published Successfully." });
}

</script>

{/literal}