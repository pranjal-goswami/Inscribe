<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{if $controller_title}{$controller_title} | {/if}{$app_title}</title>
	
	<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/bootstrap/css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="{$site_root_path}plugins/bootstrap/css/bootstrap-theme.css" /> 
	<link type="text/css" rel="stylesheet" href="{$site_root_path}assets/css/style.css" /> 
	{foreach from=$header_css item=css}
	<link type="text/css" rel="stylesheet" href="{$site_root_path}{$css}" />
	{/foreach}
	
	<script type="text/javascript" src="{$site_root_path}plugins/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="{$site_root_path}assets/js/jquery-2.1.0.min.js"></script>
	{foreach from=$header_scripts item=script}
    <script type="text/javascript" src="{$site_root_path}{$script}"></script>
    {/foreach} 	
</head>
<body>
