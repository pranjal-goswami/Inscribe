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
			<div class="btn btn-success publish-post"> Publish </div>
			<div class="btn btn-info edit-post"> <i class="glyphicon glyphicon-edit muted"> </i> </div>
			<div class="btn btn-danger delete-post"> <i class="glyphicon glyphicon-trash muted"> </i> </div>
			{/if}	
		</div>


		</div>
	</div>
	<hr><hr><hr></div>
	{/foreach}
</div>

