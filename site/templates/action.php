<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">
		
		<div class="text-wrapper">
		  <?= $page->content($site->language()->html())->exists() ? false : "<div class='warning'>Sorry, this page is not available in your language.</div>" ?>
			<h1><?= $page->title() ?></h1>
			<div class="chapo h3"><?= $page->chapo()->kt() ?></div>
			<div class="content">
				<?= $page->text()->kt() ?>
			</div>
		</div>
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>