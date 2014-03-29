<div class="col-md-12">
<h2>Manage Posts</h2>
<hr />
{foreach from=$posts item=post}
<div class="user-post col-md-12">
	<div class="card-heading image col-md-12">	
		<div class="card-heading-header col-md-12">
			<div class="col-md-8">
			<a href="#"><h4 data-toggle="modal" data-target=".post-book" 
				class="post-heading" id="{$post->content_id}"
				style="margin-top:5px;">
				{if $post->title != ''}
				{$post->title}
				{else}
				<span class="maroon">Untitled</span>
				{/if}
			</h4></a>
			<h5>  
				{if $post->publish_flag == 1}
				{assign var="j" value=$post->publish_time|@strtotime}
				<span> Published on {"M d, Y"|@date:$j} at 
					<i class="glyphicon glyphicon-time muted"> </i>
					{"h:i A"|@date:$j}
				</span>
				<span> 
					<i class="glyphicon glyphicon-eye-open muted"> </i> {$post->read_length} min read  
				</span>
				<span> in  
					<i class="fa fa-tags muted"> </i>  
					<a href="topic.html"> {foreach from=$post->categories item=category}{$category} &middot;  {/foreach} </a>
				</span> 
				{else}
				<span>Not Published</span>
				{/if}
			</h5>
		</div>
		<div class="col-md-4">
			{if $post->publish_flag == 1}
			<div class="btn btn-warning unpublish-post" id="{$post->content_id}"> UnPublish </div>
			{else}
			<div class="btn btn-success publish-post" id="{$post->content_id}"> Publish </div>
			<div class="btn btn-info edit-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-edit muted"> </i> </div>
			<div class="btn btn-danger delete-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-trash muted"> </i> </div>
			{/if}	
		</div>


		</div>
	</div>
	<hr><hr><hr></div>
	{/foreach}
</div>

{literal}
<script type="text/javascript">

$('.delete-post').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=delete', 'render-content-container', ajax_values, null); 
});

$('.publish-post').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=publish', 'render-content-container', ajax_values, null, 'alertIncomplete'); 
});

function alertIncomplete()
{
	$.growl.error({ message: "Title, Excerpt and Content cannot be left empty before publishing an article." });
}

$('.unpublish-post').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=unpublish', 'render-content-container', ajax_values, ''); 
});

$('.edit-post').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=edit', 'render-content-container', ajax_values, ''); 
});

</script>
{/literal}