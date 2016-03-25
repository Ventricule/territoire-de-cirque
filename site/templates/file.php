<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/siblings') ?>
	</div>

  <main class="main wide" role="main">
		
		<div class="cover">
			<figure style="<?= (string)$page->une() ? 'background-image:url(' . $page->file($page->une())->resize(1000)->url() . ')' : '' ; ?>">
			</figure>
		</div>
		<div class="file-content">
			<h1 class="main-title"><?= $page->title(); ?></h1>
			<div class="h3 introduction"><?= $page->introduction()->kt() ?></div>
			<div class="container">
				<div class="file-infos">
					<p class="author"><?= $page->author() ?></p>
					<p class="member"><?= $page->member() ?></p>
					<p class="date"><?= $page->date('d.m.Y') ?></p>
				</div>
				<div class="text-wrapper">
					<?= $page->text()->kt() ?>
				</div>
			</div>
		</div>
  </main>

<?php snippet('footer') ?>