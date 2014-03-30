			<!-- BLOG POST CONTENT -->
			
			{if empty($posts)}
				<div class="row post">
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-body text-center">
							<h3><p style="font-size:20px;"><i class="fa fa-exclamation-triangle"></i>  No posts found</p></h3>
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
										<a href="topic.html"> {foreach from=$post->categories item=category}{$category} &middot;  {/foreach} </a>
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

						<div class="card-actions card-comments">
							<a href="#"><i class="fa fa-facebook  muted pull-left pad-right8"></i></a>
							<a href="#"><i class="fa fa-twitter  muted pull-left pad-right8"></i></a>
							<a href="#"><i class="fa fa-google-plus  muted pull-left pad-right8"></i></a>
							{if $isLoggedIn == true}
							{if $post->user_upvote == 0}
							<a class="btn btn-primary pull-right button-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
							<i class="fa fa-thumbs-o-up"></i> &nbsp; PROMOTE 
							</a>
							{else}
							<a class="btn btn-primary pull-right button-undo-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
							<i class="fa fa-thumbs-up"></i>  &nbsp; PROMOTE  
							</a>
							{/if}
							{else}
							<a class="btn btn-primary pull-right button-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
							PROMOTE 
							</a>
							{/if}
							{if $post->upvote_count == 0}
							No upvotes
							{else}
							<a id="upvote_count" class="pull-right upvote-count-container">{$post->upvote_count}</a>
							{/if}
						</div>

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
{literal}
<script type="text/javascript">

$('.post-heading').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=read', 'post-book-container', ajax_values, ''); 
});

$('.post-book').on('hide.bs.modal', function (e) {
  $("#post-book-container").html('');
});

$('.button-upvote').click(function()
{
	upvotePost(this);
});



$('.button-undo-upvote').click(function()
{
	undoUpvotePost(this);
});

function upvotePost(e)
{
	var post_encrypted_id = e.id;
	var upvote_button = $(e);
	var upvote_count_div = $(e).parent().find('#upvote_count');
	var ajax_values =  'post_encrypted_id='+post_encrypted_id; 
	$.ajax({
		type : 'POST',
		url : site_root_path+'posts/?a=upvote',
		data : ajax_values,
		success: function(result){
			if(result == 0)
			{
				$.growl.warning({ message: "Please login to promote posts." });
			}
			else if(result == 1)
			{
				$.growl.warning({ message: "You have already promoted this post." });
				upvote_button.removeClass('button-upvote');
				upvote_button.addClass('button-undo-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  undoUpvotePost(this);
				});
				i = upvote_button.find('i');
				i.removeClass('fa-thumbs-o-up');
				i.addClass('fa-thumbs-up');
			}
			else
			{
				upvote_button.removeClass('button-upvote');
				upvote_button.addClass('button-undo-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  undoUpvotePost(this);
				});
				i = upvote_button.find('i');
				i.removeClass('fa-thumbs-o-up');
				i.addClass('fa-thumbs-up');
				var count = parseInt(upvote_count_div.html());
				upvote_count_div.html((count+1)); 
			}
		}
	});
}

function undoUpvotePost(e)
{
	var post_encrypted_id = e.id;
	var upvote_button = $(e);
	var upvote_count_div = $(e).parent().find('#upvote_count');
	var ajax_values =  'post_encrypted_id='+post_encrypted_id; 
	$.ajax({
		type : 'POST',
		url : site_root_path+'posts/?a=undo_upvote',
		data : ajax_values,
		success: function(result){
			if(result == 0)
			{
				$.growl.warning({ message: "Please login to promote posts." });
			}
			else if(result == 1)
			{
				$.growl.warning({ message: "You have not promoted this post." });
				i = upvote_button.find('i');
				i.removeClass('fa-thumbs-up');
				i.addClass('fa-thumbs-o-up');
				upvote_button.removeClass('button-undo-upvote');
				upvote_button.addClass('button-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  upvotePost(this);
				});
			}
			else
			{
				i = upvote_button.find('i');
				i.removeClass('fa-thumbs-up');
				i.addClass('fa-thumbs-o-up');
				upvote_button.removeClass('button-undo-upvote');
				upvote_button.addClass('button-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  upvotePost(this);
				});
				var count = parseInt(upvote_count_div.html());
				upvote_count_div.html((count-1)); 
			}
		}
	});
}

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

