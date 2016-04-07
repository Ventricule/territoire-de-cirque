<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/siblings') ?>
	</div>

  <main class="main wide" role="main">
			
		<?php snippet('modules/searchbar', array('query', $query)) ?>
		
		
		<?php if($header): ?>
			<div id="folder-header">
				
				<?php if ($cover = $header['cover']) : ?>
					<figure class='couverture' style='background-image:url(<?= $page->file( $cover )->resize(1000)->url() ?>)'>
				</figure>
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
		
		
		<div id="folder-content">
			<ul class="cf">

				<?php foreach( $results as $item ) :	?>

					<li data-uid='<?= $item->uid() ?>' class="<?= $item->intendedTemplate() ?>">
						<a href="<?= $item->url()?>">
							<div class="icon"><h3><?= $item->title() ?></h3></div>
						</a>
						<div class="caption">
							<?php 
							$membres = (string)$item->member() ? "— " . implode(', ', $item->member()->split()) : '';
							$infos = [ implode(', ', $item->author()->split()), $membres, $item->date('m.Y'), $item->exergue()->kt() ] ;
							foreach($infos as $info):
								echo "<div class='small'>$info</div>";
							endforeach;
							?>
						</div>
					</li>

				<?php endforeach	?>

			</ul>
		</div>

  </main>

<?php snippet('footer') ?>