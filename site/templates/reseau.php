<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/siblings') ?>
		<?php foreach($page->infos()->toStructure() as $info): ?>
			<div class="informations-secondaires">
				<div class="secondaire"><?= $info->text()->kt() ?></div>
			</div>
		<?php endforeach ?>
	</div>

  <main class="main" role="main">
					<?= $page->text()->kt() ?>
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>