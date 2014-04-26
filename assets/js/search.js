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

$(function() {

	//autocomplete
	$("input.search-bar").autocomplete({
		source: site_root_path+'search/?a=typeahead',
		minLength: 2,
        select: function( event, ui ) {
            if(ui.item.type == "user")
            {
                window.location = site_root_path+"user/?a=sprofile&uid="+ui.item.encrypted_id;
            }
            else
            {
                window.location = site_root_path+"?a=sp&ptitle="+ui.item.label;
            }
        return false;
      }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a><div class='search-result'><div class='pull-left search-result-type'><i class='glyphicon glyphicon-"+item.type_gl_icon+"'></i></div><div class='search-result-item'>"+ item.label + "<br><span class='search-result-sublabel' style='font-size:12px;'>" + item.sublabel + "</span></div></div></a>" )
        .appendTo( ul );
    };				
 
});