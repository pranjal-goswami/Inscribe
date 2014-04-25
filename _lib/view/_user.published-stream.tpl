			<h3>Publications</h3>
	<hr />
			<!-- BLOG POST CONTENT -->
			
			{if empty($posts)}
				<div class="row post">
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-body text-center">
							<h3><p style="font-size:20px;"><i class="fa fa-file-o"></i> There are no publications</p></h3>
							<br /><Br />
						</div>
					</div>
				</div>
			</div>
			{/if}

			{foreach from=$posts item=post}
			<div class="row post">
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-heading image">
							<div class="card-heading-header">
								<a href="#"><h1 data-toggle="modal" data-target=".post-book" class="post-heading" id="{$post->content_id}">{$post->title}</h1></a>
								<h3>  
									<span> Published <i class="glyphicon glyphicon-time muted"> </i> {$post->published_on}</span>
								 	<span> 
										<i class="glyphicon glyphicon-eye-open muted"> </i> {$post->read_length} min read  
									</span>
									<span> in  
										<i class="fa fa-tags muted"> </i> 
										{foreach from=$post->categories item=category}<a href="{$site_root_path}?a=scatposts&cat={$category->id}">{$category->category_name}</a> &middot;  {/foreach} 
									</span> 
								</h3>
							</div>
						</div>
						<hr>
						<div class="card-body">
							<p>
								{$post->excerpt}
							</p>
						</div>

						{include file="_upvote-button.tpl"}

					</div>
				</div>
			</div>
			{/foreach}

			<!-- BLOG POST CONTENT ENDS -->

			<!-- POST CONTENT BOOK - MODAL -->

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
			<!-- POST CONTENT BOOK - MODAL ENDS-->

			<!-- BOTTOM TABS ENDS-->

<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/hash.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/load.flipbook.js"></script>
<script type="text/javascript" src="{$site_root_path}assets/js/upvote.button.js"></script>

{literal}
<script type="text/javascript">
</script>
{/literal}

