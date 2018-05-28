<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
		<div id="actions" class="cf">
			
			<div class="action">
				<?php $item = $page->find('accompagnement') ?>
				<a href="<?= $item->url() ?>">
					<img src="<?= $site->url() ?>/assets/images/accompagnement2.png">
					<h2><?= $item->title() ?></h2>
					<div class="sous-titres">
						<?= $item->subtitle()->kt() ?>
					</div>
				</a>
			</div>
			
			<div class="action">
				<?php $item = $page->find('cooperation') ?>
				<a href="<?= $item->url() ?>">
					<img src="<?= $site->url() ?>/assets/images/coordination2.png">
					<h2><?= $item->title() ?></h2>
					<div class="sous-titres">
						<?= $item->subtitle()->kt() ?>
					</div>
				</a>
			</div>
			
		</div>
		
		<div class="modalites">
			<?php $item = $page->find('modalites-de-travail') ?>
			<a href="<?= $item->url() ?>"><h2><?= $item->title() ?></h2></a>
			<?= $item->text()->kt() ?>
		</div>
		
  </main>

<?php snippet('footer') ?>