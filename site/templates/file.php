<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/siblings') ?>
	</div>

  <main class="main wide" role="main">
		
		<figure class="cover">
			<h1><?= $page->title(); ?></h1>
			<div class="file-infos">
				<p class="author"><?= $page->author() ?></p>
				<p class="member"><?= $page->member() ?></p>
				<p class="date"><?= $page->date('d.m.Y') ?></p>
			</div>
			<?= (string)$page->une() ? $page->file($page->une())->resize(1000)->html() : '' ; ?>
		</figure>
		<div class="text-wrapper">
			<div class="h3 introduction"><?= $page->introduction()->kt() ?></div>
			<?= $page->text()->kt() ?>
		</div>
  </main>

<?php snippet('footer') ?>