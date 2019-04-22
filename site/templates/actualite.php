<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">

		<div class="event-dates">
			<div class="start-date h2">
				<?= $page->date('%d.%m.%Y', 'start_date') ?>
				<?php if($enddate = $page->date('%d.%m.%Y', 'end_date')) echo ' — ' . $enddate ; ?>
			</div>
		</div>

		<h4 class="event-type"><?= $page->type() ?></h4>
		<h4><?= membres($page->membre()) ?></h4>
		<h2><?= $page->title() ?></h2>
		<h4><?= $page->subtitle() ?></h4>


		<div class="text-wrapper">
			<?= $page->text()->kt() ?>
		</div>

  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>
