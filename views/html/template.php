<!doctype html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<meta name="description" content="Moni personal finance manager">
	<meta name="author" content="Guillermo Aguirre de Cárcer">
	<?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type));?>
	<?php foreach ($scripts as $file) echo HTML::script($file);?>
	<script type="text/javascript">
		var base_url = "<?php echo URL::base(); ?>";
	</script>
</head>
<body>
	<div id="content">
	<?php echo $content;?>
	</div>
</body>
</html>
