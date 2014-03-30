<div class="col-md-12">
<h2>Manage Posts</h2>
<hr />
{foreach from=$posts item=post}
<div class="user-post col-md-12">
	<div class="card-heading-header">
		<div class="row">
		<div class="col-md-1" style="width:6%;margin-top:10px;">
		<i class="fa fa-{if $post->publish_flag == 1}check-{/if}square-o" style="color:#777; font-size:30px;"></i>
		</div>
		<div class="col-md-7">
			
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
			<div class="manage-btn pull-right unpublish-post" id="{$post->content_id}"> 
				<i class="glyphicon glyphicon-cloud-download"></i> UnPublish 
			</div>
			{else}
			<div class="manage-btn pull-right publish-post" id="{$post->content_id}"> 
				<i class="glyphicon glyphicon-cloud-upload"></i> Publish 
			</div>
			<div class="manage-btn pull-right delete-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-trash muted"> </i> </div>
			<div class="manage-btn pull-right edit-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-edit muted"> </i> </div>
			{/if}	
		</div>

		
	</div>
	</div>
	<hr style="margin-top:5px; margin-bottom:5px;" />
</div>
		
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
