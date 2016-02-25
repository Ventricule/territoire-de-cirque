<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <meta name="description" content="<?php echo $site->description()->html() ?>">
  <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

  <?php echo css(array(
		'https://api.tiles.mapbox.com/mapbox-gl-js/v0.14.1/mapbox-gl.css',
		'assets/css/perfect-scrollbar.css',
		'assets/css/main.css'	
	) ) ?>
  
  <?php echo js( array(
    'assets/js/jquery-1.11.3.min.js', 
    'https://api.tiles.mapbox.com/mapbox-gl-js/v0.14.1/mapbox-gl.js',
    'assets/js/perfect-scrollbar.jquery.min.js',
    'assets/js/script.js'
  ) ); ?>

</head>
<body class="page-<?= $page->uid() ?> template-<?= $page->intendedTemplate() ?> cf">
	