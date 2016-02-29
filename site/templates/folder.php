<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/siblings') ?>
</div>

<main class="main wide" role="main">
	
	<div id="folder-content">
		<ul class="cf">

			<?php foreach( $page->children()->visible() as $item ) :	?>

				<li data-uid='<?= $item->uid() ?>' class="<?= $item->intendedTemplate() ?>">
					<a href="<?= $item->url()?>">
						<figure class="icon"><?= (string)$item->une() ? $item->file($item->une())->resize(300)->html(array('class'=>'tint-blue')) : '<div class="placeholder">' ?></figure>
						<h3><?= $item->title() ?></h3>
						<div class="small"><?= (string)$item->exergue() ? $item->exergue()->kt() : '' ?></div>
					</a>
				</li>

			<?php endforeach	?>

		</ul>
	</div>
</main>

<?php snippet('footer') ?>