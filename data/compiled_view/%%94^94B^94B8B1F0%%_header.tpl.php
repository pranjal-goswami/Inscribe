<?php /* Smarty version 2.6.26, created on 2014-01-30 23:07:22
         compiled from _header.tpl */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php if ($this->_tpl_vars['controller_title']): ?><?php echo $this->_tpl_vars['controller_title']; ?>
 | <?php endif; ?><?php echo $this->_tpl_vars['app_title']; ?>
</title>
	
	<!-- le bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/bootstrap/css/bootstrap.css" />
	
	<!-- le font-awesome -->
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/font-awesome-4.0.3/css/font-awesome.min.css" />
	
	<!--  le fonts -->
	<link rel="stylesheet" type="text/css" 
			href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600" />
	<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Glegoo|Fauna+One|Bitter|Junge' rel='stylesheet' type='text/css'>
	
	<!-- le theme stylesheets -->
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/css/style.css" /> 
	
	<?php $_from = $this->_tpl_vars['header_css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css']):
?>
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo $this->_tpl_vars['css']; ?>
" />
	<?php endforeach; endif; unset($_from); ?>
	
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
assets/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
plugins/bootstrap/js/bootstrap.js"></script>
	<?php $_from = $this->_tpl_vars['header_scripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['script']):
?>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['site_root_path']; ?>
<?php echo $this->_tpl_vars['script']; ?>
"></script>
    <?php endforeach; endif; unset($_from); ?> 	
</head>
<body>