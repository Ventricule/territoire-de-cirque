<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/siblings') ?>
	</div>

  <main class="main wide" role="main">
		
		<div class="cover">
			<figure style="<?= (string)$page->une() ? 'background-image:url(' . $page->file($page->une())->resize(1000)->url() . ')' : '' ; ?>">
			</figure>
			<div class="file-infos">
				<p class="author"><?= $page->author() ?></p>
				<p class="member"><?= $page->member() ?></p>
				<p class="date"><?= $page->date('d.m.Y') ?></p>
			</div>
		</div>
		<div class="text-wrapper">
			<h1 class="main-title"><?= $page->title(); ?></h1>
			<div class="h3 introduction"><?= $page->introduction()->kt() ?></div>
			<?= $page->text()->kt() ?>
		</div>
  </main>

<?php snippet('footer') ?>