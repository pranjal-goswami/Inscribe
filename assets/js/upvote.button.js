$('.button-upvote').click(function()
{
	upvotePost(this);
});

$('.button-upvote-disabled').click(function()
{
	$.growl.warning({ message: "Please login to promote posts." });
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

	//Updating Button and Count
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

	//AJAX Request
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

	//Updating Button and Count 
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

	//AJAX Request	
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
				
			}
		}
	});
}
