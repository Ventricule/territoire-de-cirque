<div id="menu-second" class="h3">
	<ul>
			<li class="parent">
				<?php if( $page->depth() > 2) : ?>
				<a href="<?= $page->parent()->url() ?>" class="retour"><div class="icon"></div>&lt;</a>
				<?php endif; ?>
				<span><?= $page->parent()->title() ?></span>
				<?php $first = true ?>
				<!--
				<?php foreach($page->parents()->flip() as $parent) : ?>
					<?php echo $first = $first === true ? false : ' > ' ?><a href="<?= $parent->url() ?>"><?= $parent->title() ?></a>
				<?php endforeach; ?>
				-->
			</li>
			<?php foreach($page->siblings() as $sibling) : ?>
				<li class="<?= $sibling->isActive() ? 'active' : '' ?>">
					<a href="<?= $sibling->url() ?>"> <?= $sibling->title() ?></a>
				</li>
			<?php endforeach; ?>
	</ul>
	
</div>