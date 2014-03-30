			<!-- BLOG POST CONTENT -->
			{foreach from=$posts item=post}
			<div class="row post">
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-heading image">
							<a href="profile.html" > 
								<img class="pull-right pull-up10" src="assets/img/shaan.png" alt="author avatar"/>
							</a>
							<div class="card-heading-header">
								<a href="#"><h1 data-toggle="modal" data-target=".post-book" class="post-heading" id="{$post->content_id}">{$post->title}</h1></a>
								<h3>  
									<span> Published <i class="glyphicon glyphicon-time muted"> </i> {$post->published_on}</span>
								 	<span> 
										<i class="glyphicon glyphicon-eye-open muted"> </i> {$post->read_length} min read  
									</span>
									<span>  By <a href="#">{$post->author_name}</a>  in  
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
							PROMOTE 
							</a>
							{else}
							<a class="btn btn-primary pull-right button-undo-upvote btn-sm" id="{$post->content_id}" title="Upvote this article">
							DEMOTE 
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
							<div id="upvote_count" class="btn btn-default pull-right upvote-count-container">{$post->upvote_count}</div>
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

			<!-- BOTTOM TABS -->
			<div class="card"> 
				<ul class="nav nav-tabs" id="myTab">
					<li ><a href="#topics">Trending Topics</a></li>
					<li class="active"><a href="#people">Top Authors</a></li>

				</ul>

				<div class="tab-content">
					<div class="tab-pane" id="topics">

						<div class="row push border-bottom">
							<div class="col-md-6">
								<div class="media border-right" >
									<a class="pull-left" href="#">
										<i class="glyphicon glyphicon-beaker glyphicon glyphicon-4x pull-left muted "></i>
									</a>
									<div class="media-body">
										<a href="#">  <h1 class="media-heading">5 minutes with us</h1></a>


										<p>5 Posts, 32 Comments</p>

									</div>
								</div>
							</div>

							<div class="col-md-6" >
								<div class="media">
									<a class="pull-left" href="#">
										<i class="glyphicon glyphicon-quote-left glyphicon glyphicon-4x pull-left muted"></i>
									</a>
									<div class="media-body">
										<a href="#">   <h2 class="media-heading">Blog</h2></a>


										<p>22 Posts, 290 Comments </p>

									</div>
								</div>
							</div>      </div>
						<div class="row border-bottom">
							<div class="col-md-6"  >
								<div class="media border-right" >
									<a class="pull-left" href="#">
										<i class="glyphicon glyphicon-circle-blank glyphicon glyphicon-4x pull-left muted"></i>
									</a>
									<div class="media-body">
										<a href="#">     <h2 class="media-heading">Company News</h2></a>


										<p>5 Posts, 77 Comments </p>

									</div>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="media" >
									<a class="pull-left" href="#">
										<i class="glyphicon glyphicon-building glyphicon glyphicon-4x pull-left muted"></i>
									</a>
									<div class="media-body">
										<a href="#">      <h2 class="media-heading">Development</h2></a>


										<p>1 Post, 0 Comments </p>

									</div>
								</div>
							</div>
						</div>

					</div>
<br /><br />
					<div class="tab-pane active " id="people">
						<div class="row">
							<div class="col-md-4">
								<div class="card hovercard">
									<img src="assets/img/cover.png" alt="image avatar">
									<div class="avatar">
										<img src="assets/img/scarlet.jpg" alt="image avatar">
									</div>
									<div class="info">
										<div class="title">
											<a href="profile.html">Shawn Says</a>
										</div>
										<div class="desc">Passionate designer</div>
										<div class="desc">Curious developer</div>
										<div class="desc">Tech geek</div>
									</div>
									<div class="bottom">
										<a href="#" class="btn btn-block">
											<i class="glyphicon glyphicon-twitter"></i>
											Follow on Twitter
										</a>
										<a href="#" rel="publisher" class="btn btn-block">
											<i class="glyphicon glyphicon-google-plus"></i>
											Follow on Google+
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card hovercard">
									<img src="assets/img/author-cover.jpg" alt="image avatar">
									<div class="avatar">
										<img src="assets/img/shaan.png" alt="image avatar">
									</div>
									<div class="info">
										<div class="title">
											<a href="profile.html">Shawn Says</a>
										</div>
										<div class="desc">Passionate designer</div>
										<div class="desc">Curious developer</div>
										<div class="desc">Tech geek</div>
									</div>
									<div class="bottom">
										<a href="#" class="btn btn-block">
											<i class="glyphicon glyphicon-twitter"></i>
											Follow on Twitter
										</a>
										<a href="#" rel="publisher" class="btn btn-block">
											<i class="glyphicon glyphicon-google-plus"></i>
											Follow on Google+
										</a>
									</div>
								</div>  </div>
							<div class="col-md-4">
								<div class="card hovercard">
									<img src="assets/img/cover2.jpg" alt="image avatar">
									<div class="avatar">
										<img src="assets/img/naman.png" alt="image avatar">
									</div>
									<div class="info">
										<div class="title">
											<a href="profile.html">Shawn Says</a>
										</div>
										<div class="desc">Passionate designer</div>
										<div class="desc">Curious developer</div>
										<div class="desc">Tech geek</div>
									</div>
									<div class="bottom">
										<a href="#" class="btn btn-block">
											<i class="glyphicon glyphicon-twitter"></i>
											Follow on Twitter
										</a>
										<a href="#" rel="publisher" class="btn btn-block">
											<i class="glyphicon glyphicon-google-plus"></i>
											Follow on Google+
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<!-- BOTTOM TABS ENDS-->

<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="{$site_root_path}plugins/turnjs4/hash.js"></script>
{literal}
<script type="text/javascript">

$('.post-heading').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=read', 'post-book-container', ajax_values, null); 
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
				upvote_button.html('DEMOTE');
				upvote_button.removeClass('button-upvote');
				upvote_button.addClass('button-undo-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  undoUpvotePost(this);
				});
			}
			else
			{
				upvote_button.html('DEMOTE');
				upvote_button.removeClass('button-upvote');
				upvote_button.addClass('button-undo-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  undoUpvotePost(this);
				});
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
				upvote_button.html('PROMOTE');
				upvote_button.removeClass('button-undo-upvote');
				upvote_button.addClass('button-upvote');
				upvote_button.off("click");
				upvote_button.on( "click", function() {
				  upvotePost(this);
				});
			}
			else
			{
				upvote_button.html('PROMOTE');
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

