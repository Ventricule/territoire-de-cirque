<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">
		<div class="text-wrapper">
			<?= $page->text()->kt() ?>
		</div>
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>