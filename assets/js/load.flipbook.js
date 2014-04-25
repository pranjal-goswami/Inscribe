$('.post-heading').click(function()
{
	var post_encrypted_id = this.id;
	var ajax_values =  'post_encrypted_id='+post_encrypted_id;
	ajaxLoad(site_root_path+'posts/?a=read', 'post-book-container', ajax_values, null); 
});

$('.post-book').on('hide.bs.modal', function (e) {
  $("#post-book-container").html('');
});

// Load turn.js

yepnope({
	test : Modernizr.csstransforms,
	yep: [site_root_path+'plugins/turnjs4/turn.min.js'],
	nope: [site_root_path+'plugins/turnjs4/turn.html4.min.js', site_root_path+'plugins/turnjs4/css/jquery.ui.html4.css', site_root_path+'plugins/turnjs4/css/steve-jobs-html4.css'],
	both: [site_root_path+'plugins/turnjs4/js/steve-jobs.js', site_root_path+'plugins/turnjs4/css/steve-jobs.css', site_root_path+'plugins/turnjs4/css/jquery.ui.css']
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
		page: 4,
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