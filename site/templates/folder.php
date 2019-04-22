<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
			
		<?php snippet('modules/searchbar', array('query' => $query)) ?>
		
		
		<?php if($header): ?>
			<div id="folder-header">
				
				<?php if ($cover = $header['cover']) : ?>
					<?php if ($cover = $page->file( $cover )): ?>
						<figure class='couverture' style='background-image:url(<?= $cover->resize(1000)->url() ?>)'>
							<figcaption><?= $cover->caption() ?></figcaption>
						</figure>
					<?php endif ?>
				<?php endif ?>
				
				<?php if($titraille = $header['titraille']): ?>
					<div class="titraille">
						<?php foreach($titraille as $class => $value): ?>
							<div class="<?= $class ?>"><?= $value ?></div>
						<?php endforeach ?>
					</div>
				<?php endif; ?>
				
				<?php if ($edito = $header['edito']): ?>
					<div class="edito">
						<?= $edito ?>
					</div>
				<?php endif; ?>
				
			</div>
		<?php endif ?>
		
		
		<div id="folder-content" class="folder-content">
				<?php snippet('modules/folder-content', array('items' => $results)) ?>
		</div>

  </main>

<?php snippet('footer') ?>