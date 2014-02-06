/**
 * © 2013-2015 GreekTurtle
 *
 * LICENSE:
 *
 * This file is part of Inscribe (http://inscribe.io).
 *
 * The contents of this file cannot be copied, distributed or modified without prior
 * consent from the author. 
 *
 * Project : Inscribe
 * File : assets/js/ajaxload.js
 * Description : Load Pages by AJAX
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Feb 05 2014 14:51:56 GMT+0530 (IST)
 */
function loadContents(content_location,target,e)
{
	if (!window.jQuery){
		console.log('jQuery not loaded'); 
		var jq = document.createElement('script'); jq.type = 'text/javascript';
		jq.src = 'http://code.jquery.com/jquery-latest.pack.js';
		document.getElementsByTagName('head')[0].appendChild(jq);
	}
	
	//$('#load_error').hide(800);
	//$('#loading_gif').show(1000);
    
	$.ajax({
		url : content_location,
		success: function(result){
			$('#'+target).html(result);
			console.log(content_location+' loaded to '+target);
			//$('#loading_gif').hide(800);
			if(e) postLoad(e);
		},
		statusCode:{
			404 : function(){
					console.log('Could not load file. File does not exist.');
					$('#'+target).html('<div class="container-fluid"><div class="row-fluid"> \
					        <h4> &nbsp; Requested page could not be loaded</h4></div></div>');
					//$('#loading_gif').hide(800);
					//$('#load_error').show(800);
				}
		},
		fail: function(error){
			console.log('ajax load failed '+error);
			$('#'+target).html('<h4>Requested page could not be loaded</h4>');
			//$('#loading_gif').hide(800);
			//$('#load_error').show(800);
		}
		});
			
}

	

/*Function post Load - execute functions after ajaxPageLoad */

function postLoad(e)
{
	//var post_load = e.attr('post-load').split(" ");	
}
