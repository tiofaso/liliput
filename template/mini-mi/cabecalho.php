<?php // config_aplicativo('php'); ?>

<html>
	<head>
		<title><?php info_loja(LOJA,'nome','');?> - <?php info_loja(LOJA,'sobre','');?></title>
		<link rel="shortcut icon" href="<?php echo TEMPLATE_PATH; ?>favicon.ico" type="image/x-icon" />
		<meta name="generator" content="Bluefish 2.0.0" />
		<meta name="author" content="faso" />
		<meta name="description" content="<?php info_loja(LOJA,'metadescription','');?>" />
		<meta name="Keywords" content="<?php info_loja(LOJA,'metakeywords','');?>"/>
		<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>style.css" type="text/css" media="screen" />
		<?php config_aplicativo('js'); ?>
		<?php config_aplicativo('css'); ?>
		<?php if(isset($_GET['pg']) && $_GET['pg'] == 'cadastrar'){ echo "<script type=\"text/javascript\" src=\"admin/js/mascaras-form.js\"></script>"; }?>
	
	
	</head>
		
		

	