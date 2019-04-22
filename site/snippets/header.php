<?php if ( $page->uid() != 'maintenance' && c::get('maintenance') && ! $user = $site->user() ) go('maintenance') ; ?>
<?php if ( $page->isChildOf(page('espace-membre')) && ! $user = $site->user() ) go('login') ; ?>
<?php // if ( $page->uid() == 'maintenance' && !c::get('maintenance') ) go('/') ; ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="cleartype" content="on">
	<meta name="MobileOptimized" content="320">
	<meta name="HandheldFriendly" content="True">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <meta name="description" content="<?php echo $site->description()->html() ?>">
  <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

  <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

  <script>
		var siteUrl = "<?= $site->url() ?>";
	</script>

  <script src=""></script>
<link rel="stylesheet" href="" type="text/css" media="screen" charset="utf-8">

  <?php echo css(array(
		'https://api.tiles.mapbox.com/mapbox-gl-js/v0.14.1/mapbox-gl.css',
		'assets/css/vendor/perfect-scrollbar.css',
		'assets/plugins/embed/css/embed.css',
		'assets/css/main.css',
		'https://cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css',
		'https://cdn.jsdelivr.net/medium-editor/5.20.0/css/themes/flat.min.css',
    'assets/css/vendor/jquery.mmenu.css'
	) ) ?>

	<?php

  $cssURI  = 'assets/css/templates/' . $page->template() . '.css';
  if(file_exists($cssURI)) echo css($cssURI);

  ?>

  <?php echo js( array(
    'assets/js/jquery-1.11.3.min.js',
    'https://api.tiles.mapbox.com/mapbox-gl-js/v0.14.1/mapbox-gl.js',
    'assets/js/perfect-scrollbar.jquery.min.js',
    'assets/js/jquery.mmenu.min.js',
		'assets/plugins/embed/js/embed.js',
		'https://use.fontawesome.com/4143ff1e1a.js',
		'https://cdn.jsdelivr.net/medium-editor/latest/js/medium-editor.min.js',
    'assets/js/me-markdown.standalone.min.js',
    'assets/js/script.js',
  ) ); ?>

</head>
<body class="page-<?= $page->uid() ?> template-<?= $page->intendedTemplate() ?> rubrique-<?= $page->depth() > 1 ? $page->parents()->flip()->first()->uid() : $page->uid() ; ?> cf">

<div id="page-wrapper">
