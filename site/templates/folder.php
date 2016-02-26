<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/siblings') ?>
</div>

<main class="main wide" role="main">
	
	<div id="folder-content">
		<ul class="cf">

			<?php
			$markers = array(
				'type' => "FeatureCollection",
				'features' => array()
			);

			foreach( $page->children() as $item ) :
				?>

				<li data-uid='<?= $item->uid() ?>' class="<?= $item->intendedTemplate() ?>">
					<a href="<?= $item->url()?>">
						<figure class="icon"></figure>
						<h3><?= $item->title() ?></h3>
						<p class="small"><?= (string)$item->description() ? '— '.$item->description() : '' ?></p>
					</a>
				</li>

				<?php
			endforeach;
			?>

		</ul>
	</div>
</main>

<?php snippet('footer') ?>