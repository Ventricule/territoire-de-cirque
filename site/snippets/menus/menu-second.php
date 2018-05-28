<div id="logo-tdc" class="second">
	<a href="<?= $site->url() ?>">
		<img class="logo-anime" src="<?= $site->url() ?>/assets/images/logo-anime.gif">
	</a>
</div>

<?php if( $page->uid() != 'home' ) : ?>
<div id="menu-second" class="h3">
	<ul>
		<?php if( $page->depth() > 2) : ?>
			<li class="parent">
				<a href="<?= $page->parent()->url() ?>" class="retour"><div class="icon"></div>&lt;</a>
				<span><?= $page->parent()->title() ?></span>
			</li>
			<li class="placeholder">
				<span>&nbsp;</span>
			</li>
		<?php endif; ?>
		<?php
		if( $page->depth() > 1) :
			$list = $page->siblings();
			// Filtrer les visible, sauf certaines pages
			if( ! in_array($page->intendedTemplate(), array('discussion')) ):
				$list = $page->siblings()->visible();
			endif;
			// Ordres spécifiques
			if( in_array($page->intendedTemplate(), array('file', 'folder', 'discussion', 'action')) ):
				$list = $list->sortBy('date', 'desc');
			endif;
		else:
			$list = $page->children()->visible();
		endif;
		?>
			<?php foreach($list as $item) : ?>
				<li class="<?= $item->isActive() ? 'active' : '' ?>">
					<?php if($item->intendedTemplate() == 'folder'): ?>
						<a href="<?= $item->url() ?>"><i class="fa fa-folder-o" aria-hidden="true"></i> <?= $item->title() ?></a>
					<?php elseif($file = $item->fichier()->toString()): ?>
						<a href="<?= $item->file($file)->url() ?>"><i class="fa fa-download" aria-hidden="true"></i> <?= $item->title() ?></a>
					<?php else: ?>
						<a href="<?= $item->url() ?>"> <?= $item->title() ?></a>
					<?php endif ?>
				</li>
			<?php endforeach; ?>
	</ul>
	<div class="exergue"><?= $page->exergue()->kt() ?></div>
</div>
<?php endif ?>