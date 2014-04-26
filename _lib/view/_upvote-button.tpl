<div class="card-actions card-comments">
	<a href="#"><i class="fa fa-facebook  muted pull-left pad-right8"></i></a>
	<a href="#"><i class="fa fa-twitter  muted pull-left pad-right8"></i></a>
	<a href="#"><i class="fa fa-google-plus  muted pull-left pad-right8"></i></a>
	{if $isLoggedIn == true}
	{if $post->user_upvote == 0}
	<a class="btn btn-primary pull-right button-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
		<i class="fa fa-thumbs-o-up" style="width:10px; overflow:hidden;"></i> &nbsp; PROMOTE 
	</a>
	{else}
	<a class="btn btn-primary pull-right button-undo-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
		<i class="fa fa-thumbs-up" style="width:10px; overflow:hidden;"></i>  &nbsp; PROMOTE  
	</a>
	{/if}
	{else}
	<a class="btn btn-primary pull-right button-upvote-disabled btn-sm" id="{$post->content_id}" title="Upvote this article">
		<i class="fa fa-thumbs-o-up" style="width:10px; overflow:hidden;"></i> &nbsp; PROMOTE 
	</a>
	{/if}
	<a id="upvote_count" class="pull-right upvote-count-container">{$post->upvote_count}</a>
</div>