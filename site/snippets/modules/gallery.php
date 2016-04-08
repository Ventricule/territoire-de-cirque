<div class="gallery">
	<a href="#" class="btn-close"><img src="<?= $site->url() ?>/assets/images/close.svg" /></a>
	<?php
	// Transform the comma-separated list of filenames into a file collection
	$filenames = $page->gallery()->split(',');
	if(count($filenames) < 2) $filenames = array_pad($filenames, 2, '');
	$files = call_user_func_array(array($page->files(), 'find'), $filenames);

	// Use the file collection
	foreach($files as $file):
		$thumb = $file->resize(1000, 1000);
		?>
		<div class="slide-wrapper">
			<figure class="slide">
				<img class='gallery-img' src="<?= $thumb->url() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
			</figure>
			<div class="caption"><?= $file->caption() ?></div>
		</div>
		<?php
	endforeach;
	?>
</div>