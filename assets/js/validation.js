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
 * File : assets/js/validation.js
 * Description : Validate Form fields
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Feb 05 2014 14:51:56 GMT+0530 (IST)
 */

function submitForm(submit_location, formid, target)
{
	if (!window.jQuery){
		console.log('jQuery not loaded'); 
		var jq = document.createElement('script'); jq.type = 'text/javascript';
		jq.src = 'http://code.jquery.com/jquery-latest.pack.js';
		document.getElementsByTagName('head')[0].appendChild(jq);
	}
	
	//$('#load_error').hide(800);
	//$('#loading_gif').show(1000);
	var values = $("#"+formid).serialize(); 
    
	$.ajax({
		type : 'POST',
		url : submit_location,
		data : values,
		success: function(result){
			if(target){
				$('#'+target).html(result);
			}
			console.log(submit_location+' loaded to '+target);
			//$('#loading_gif').hide(800);

		},
		statusCode:{
			404 : function(){
					console.log('Could not load file. File does not exist.');
					if(target){
						$('#'+target).html('<div class="container-fluid"><div class="row-fluid"> \
					        <h4> &nbsp; Requested page could not be loaded</h4></div></div>');
					}
					//$('#loading_gif').hide(800);
					//$('#load_error').show(800);
				}
		},
		fail: function(error){
			console.log('ajax load failed '+error);
			if(target){
				$('#'+target).html('<h4>Requested page could not be loaded</h4>');
			}
			//$('#loading_gif').hide(800);
			//$('#load_error').show(800);
		}
		});
			
}