<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
		<div class="actions-header cf">
			<div class="title">
				<h2><?= $page->title() ?></h2>
			</div>
			<div class="subtitle">
				<?= $page->subtitle()->kt() ?>
			</div>
		</div>
		<div class="folder-content">
			<?php snippet( 'modules/folder-content', array('items' => $page->children()->visible()->sortBy('date', 'desc') ) ) ?>
		</div>
  </main>

<?php snippet('footer') ?>