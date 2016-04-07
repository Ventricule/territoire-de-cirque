<?php if( $page->depth() > 1) : ?>
<div id="menu-second" class="h3">
	<ul>
			<?php if( $page->depth() > 2) : ?>
				<li class="parent">
					<a href="<?= $page->parent()->url() ?>" class="retour"><div class="icon"></div>&lt;</a>
					<span><?= $page->parent()->title() ?></span>
					<?php $first = true ?>
					<!--
					<?php foreach($page->parents()->flip() as $parent) : ?>
						<?php echo $first = $first === true ? false : ' > ' ?><a href="<?= $parent->url() ?>"><?= $parent->title() ?></a>
					<?php endforeach; ?>
					-->
				</li>
			<?php endif; ?>
			<?php foreach($page->siblings() as $sibling) : ?>
				<li class="<?= $sibling->isActive() ? 'active' : '' ?>">
					<a href="<?= $sibling->url() ?>"> <?= $sibling->title() ?></a>
				</li>
			<?php endforeach; ?>
	</ul>
	<div class="exergue"><?= $page->exergue()->kt() ?></div>
</div>
<?php endif ?>