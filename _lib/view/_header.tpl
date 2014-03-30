<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{if $controller_title}{$controller_title} | {/if}{$app_title}</title>
	
	<!-- le bootstrap -->
	<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/bootstrap/css/bootstrap.css" />
	
	<!-- le font-awesome -->
	<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/font-awesome-4.0.3/css/font-awesome.min.css" />
	
	<!--  le fonts -->
	<link rel="stylesheet" type="text/css" 
			href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600" />
	<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Glegoo|Fauna+One|Bitter|Junge' rel='stylesheet' type='text/css'>
	
	<!-- le theme stylesheets -->
	<link type="text/css" rel="stylesheet" href="{$site_root_path}assets/css/style.css?v=102" />
	<link type="text/css" rel="stylesheet" href="{$site_root_path}assets/css/style-responsive.css?v=102" /> 
	
	{foreach from=$header_css item=css}
	<link type="text/css" rel="stylesheet" href="{$site_root_path}{$css}" />
	{/foreach}
	
	<script type="text/javascript" src="{$site_root_path}assets/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="{$site_root_path}assets/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="{$site_root_path}assets/js/ajaxload.js"></script>
	<script type="text/javascript" src="{$site_root_path}plugins/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript"> var site_root_path = "{$site_root_path}"; </script>
	{foreach from=$header_scripts item=script}
    <script type="text/javascript" src="{$site_root_path}{$script}"></script>
    {/foreach} 	

    <!-- Growl -->
	<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/growl/css/jquery.growl.css"/> 
	<script type="text/javascript" src="{$site_root_path}plugins/growl/js/jquery.growl.js"></script>
	
</head>
<body>
