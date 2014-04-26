<div class="col-md-12">
	<h3>Manage Posts</h3>
	<hr />

	{if empty($posts)}
				<div class="row post">
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-body text-center">
							<h3><p style="font-size:20px;"><i class="fa fa-paperclip"></i> There are no created posts</p></h3>
							<br /><Br />
						</div>
					</div>
				</div>
			</div>
	{/if}

	{foreach from=$posts item=post}
	<div class="user-post col-md-12">
		<div class="card-heading-header">
			<div class="row">
				<div class="col-md-1" style="width:6%;margin-top:10px;">
					<i class="fa fa-{if $post->publish_flag == 1}check-{/if}square-o" style="color:#777; font-size:30px;"></i>
				</div>
				<div class="col-md-7">

					<a href="#">
						{if $post->title != ''}
						<h4 data-toggle="modal" data-target=".post-book" 
						class="post-heading" id="{$post->content_id}"
						style="margin-top:5px;">
						{$post->title}
						</h4>
						{else}
						<h4 data-toggle="modal" data-target=".post-book" 
						class="post-heading" id="{$post->content_id}"
						style="margin-top:5px;">
						<span class="maroon">Untitled</span>
						</h4>
						{/if}
					</a>
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
						<br /><br />
						<span>
							<i class="fa fa-tags muted"> </i>  
							{foreach from=$post->categories item=category}<a href="{$site_root_path}?a=scatposts&cat={$category->id}">{$category->category_name}</a> &middot;  {/foreach}
						</span> 
						{else}
						<span>Not Published</span>
						{/if}
					</h5>
				</div>
				<div class="col-md-4">
					{if $post->publish_flag == 1}
					<div class="manage-btn pull-right unpublish-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-cloud-download"></i>  UnPublish </div>
					{else}
					<div data-toggle="modal" data-target="#assign-categories-container" class="manage-btn pull-right assign-categories" id="{$post->content_id}"> <i class="glyphicon glyphicon-cloud-upload"></i> Publish </div>
					<div class="manage-btn pull-right edit-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-edit muted"> </i> </div>
					<div class="manage-btn pull-right delete-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-trash muted"> </i> </div>
					{/if}	
				</div>


			</div>
		</div>
		<hr style="margin-top:5px; margin-bottom:5px;" />
	</div>

	{/foreach}
</div>

<!-- MODAL FOR FLIPBOOK -->
<div class="modal fade post-book" id="post-book-container" tabindex="-1" role="dialog" aria-hidden="true">
				<div id="canvas">
					<div class="sj-book">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>

<!-- MODAL FOR CHOOSING CATEGORIES -->
<div class="modal fade" id="assign-categories-container" tabindex="-1" role="dialog" aria-hidden="true">
  
</div>
<!-- MODAL ENDS -->

<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/hash.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/load.flipbook.js"></script>

{literal}
<script type="text/javascript">

$('.delete-post').click(function()
{
	var r = confirm("Are you sure you want to delete this post?");
  	if(r==true){
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=delete', 'render-content-container', ajax_values, null); 
	}
});

$('.assign-categories').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=assign_categories', 'assign-categories-container', ajax_values, null, 'alertIncomplete'); 
});

function alertIncomplete()
{
	$('#assign-categories-container').modal('hide');
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
