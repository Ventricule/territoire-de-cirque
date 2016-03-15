<div id="menu-second" class="h3">
	<ul>
	<?php foreach ($site->children()->visible() as $rubrique) : 
		if ($rubrique->isOpen()):
		?>
			<?php $increment = '' ; ?>
			<?php foreach($page->parents()->flip() as $parent) : ?>
				<li class="trame50 ancestor <?= $parent->depth() + 1 == $page->depth() ? 'parent' : ''; ?> <?= $parent->depth() > 1 ? 'child' : ''; ?>" style="margin-left:<?= $parent->depth() - 1 ?>rem;margin-right:<?= $page->depth() - $parent->depth() ?>rem;">
					<a href="<?= $parent->url() ?>"><?= $parent->title() ?></a>
				</li>
			<?php $increment .= '&emsp;'; endforeach; ?>
			<?php foreach($page->siblings() as $sibling) : ?>
				<li class="<?= $sibling->isActive() ? 'active' : '' ?>" style="margin-left:<?= $sibling->depth() - 1 ?>rem; margin-right:1rem;">
					<a href="<?= $sibling->url() ?>"> <?= $sibling->title() ?></a>
				</li>
			<?php endforeach; ?>
		
		<?php
		else:
		?>
		
			<li class="trame50 ancestor" style="margin-right:<?= $page->depth()-1 ?>rem;">
				<a href="<?= $rubrique->url() ?>">
				<?= $rubrique->title() ?>
				</a>
			</li>
		
		<?php
		endif;
		?>
	<?php endforeach; ?>
	
	</ul>
	
</div>