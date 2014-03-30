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
					<div class="manage-btn pull-right unpublish-post" id="{$post->content_id}"> <i class="glyphicon glyphicon-cloud-download"></i>  UnPublish </div>
					{else}
					<div data-toggle="modal" data-target="#assign-categories-container" class="manage-btn pull-right assign-categories" id="{$post->content_id}"> <i class="glyphicon glyphicon-cloud-upload"></i> Publish </div>
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


$('.post-heading').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=read', 'post-book-container', ajax_values, null); 
});

$('.post-book').on('hide.bs.modal', function (e) {
  $("#post-book-container").html('');
})

// Load turn.js

yepnope({
	{/literal}
	test : Modernizr.csstransforms,
	yep: ['{$site_root_path}plugins/turnjs4/turn.min.js'],
	nope: ['{$site_root_path}plugins/turnjs4/turn.html4.min.js', '{$site_root_path}plugins/turnjs4/css/jquery.ui.html4.css', '{$site_root_path}plugins/turnjs4/css/steve-jobs-html4.css'],
	both: ['{$site_root_path}plugins/turnjs4/js/steve-jobs.js', '{$site_root_path}plugins/turnjs4/css/steve-jobs.css', '{$site_root_path}plugins/turnjs4/css/jquery.ui.css']
	{literal}
});

function loadApp() {
	
	var flipbook = $('.sj-book');

	// Check if the CSS was already loaded
	
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}

	// Flipbook

	flipbook.turn({
		elevation: 50,
		acceleration: !isChrome(),
		autoCenter: true,
		gradients: true,
		duration: 1000,
		page: 2,
		when: {
			turning: function(e, page, view) {
				
				var book = $(this),
					currentPage = book.turn('page'),
					pages = book.turn('pages');

				if (currentPage>3 && currentPage<pages-3) {
				
					if (page==1) {
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (page==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				} else if (page>3 && page<pages-3) {
					if (currentPage==1) {
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (currentPage==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				}

				updateDepth(book, page);
				
				if (page>=2)
					$('.sj-book .p2').addClass('fixed');
				else
					$('.sj-book .p2').removeClass('fixed');

				if (page<book.turn('pages'))
					$('.sj-book .hard-last-page').addClass('fixed');
				else
					$('.sj-book .hard-last-page').removeClass('fixed');

				Hash.go('page/'+page).update();
					
			},

			turned: function(e, page, view) {

				var book = $(this);

				if (page==2 || page==3) {
					book.turn('peel', 'br');
				}

				updateDepth(book);
				

				book.turn('center');

			}
		}
	});



	flipbook.addClass('animated');

	// Show canvas

	$('#canvas').css({visibility: ''});
}

// Hide canvas

$('#canvas').css({visibility: 'hidden'});


</script>
{/literal}
