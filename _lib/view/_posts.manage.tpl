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
				<span> Published on {"M d, Y"|@date:$j}</span>
				<span> 
					<i class="glyphicon glyphicon-eye-open muted"> </i> {$post->read_length} min read  
				</span>
				<span> in  
					<i class="fa fa-tags muted"> </i>  
					<a href="topic.html"> &middot; {foreach from=$post->categories item=category}{$category} &middot;  {/foreach} </a>
				</span> 
				{else}
				<span>Not Published</span>
				{/if}
			</h5>
		</div>
		<div class="col-md-4">
			{if $post->publish_flag == 1}
			<div class="btn btn-warning unpublish-post"> UnPublish </div>
			{else}
			<div class="manage-btn pull-right publish-post"><i class="glyphicon glyphicon-send"></i> Publish </div>
			<div class="manage-btn pull-right delete-post"><i class="glyphicon glyphicon-trash"></i> </div>
			<div class="manage-btn pull-right edit-post"><i class="glyphicon glyphicon-edit"></i> </div>
			{/if}	
		</div>

		
	</div>
	</div>
	<hr style="margin-top:5px; margin-bottom:5px;" />
</div>
		
	{/foreach}
</div>

