<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/siblings') ?>
</div>

<main class="main wide" role="main">
	
	<?php snippet('modules/searchbar') ?>
	
	<?php if ((string)$page->cover() || (string)$page->text()) : ?>
	<div id="folder-header">
		<?php if ((string)$page->cover()) : ?>
			<figure class='couverture' style='background-image:url(<?= $page->file( $page->cover() )->resize(1000)->url() ?>)'>
		</figure>
		<?php endif ?>
		<div class="titraille">
			<div class="dossier"><h4>Dossier</h4></div>
			<div class="title"><h2><?= $page->title() ?></h2></div>
			<div class="description"><h4><?= $page->exergue() ?></h4></div>
		</div>
		<?php if ( (string)$page->text() ): ?>
		<div class="edito">
			<?= $page->text()->kt() ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	
	<div id="folder-content">
		<ul class="cf">

			<?php foreach( $page->children()->visible() as $item ) :	?>

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