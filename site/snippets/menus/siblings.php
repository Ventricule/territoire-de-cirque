<div id="menu-second" class="h3">
	<ul>
	<?php if ($page->depth() > 2) : ?>
		<li class="trame50"><a href="<?= $page->parent()->url() ?>"><img src="<?= $site->url() ?>/assets/images/arrow_back.svg" width="13" height="13"> <?= $page->parent()->title() ?></a></li>
	<?php endif ?>
	<?php if ($page->depth() > 1) : foreach($page->siblings() as $sibling) : ?>
		<li class="<?= $sibling->isActive() ? 'active' : '' ?>"><a href="<?= $sibling->url() ?>"> <?= $sibling->title() ?></a></li>
	<?php endforeach ; endif; ?>
	</ul>
</div>