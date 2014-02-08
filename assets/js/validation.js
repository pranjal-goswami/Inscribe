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
function showFormError(e){
	e.parent().parent().removeClass("has-success");
	e.parent().parent().addClass("has-error");
	item = e.parent().find(".form-error");
	item.animate({height:'22px'}, {duration :800 , easing : 'easeOutBack'}, function(){});
	return !1;
}

function hideFormError(e){
	e.parent().parent().removeClass("has-error");
	e.parent().parent().addClass("has-success");
	item = e.parent().find(".form-error");
	item.animate({height:'0px'}, {duration :800 , easing : 'easeOutBack'}, function(){});
	return !0;
}
function isEmpty(e){
	return e.val().length<=0 ? !0 : !1
}

/* Form Validation */
function validateSignUpForm(f){
	var ret = !0;
	f.find('input').each(function()	{
		if(!$(this).hasClass('pass')){
			var v = $(this).attr('data-validate');
			ret = ret && window[v]($(this));
		}
	});
	return ret;
}

function validateName(e){
	return isEmpty(e) ? showFormError(e) : hideFormError(e)	
}

function validateEmail(e) {
	var pattern = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	return isEmpty(e) || !pattern.test(e.val()) ? showFormError(e) : hideFormError(e);
}

function validatePwd(e){
	return e.val().length<5 ?  showFormError(e) : hideFormError(e); 	
}