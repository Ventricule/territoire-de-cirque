<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/menu-second', array('page' => $page)) ?>
</div>

<main id="panel" class="main wide cf" role="main">
	
	
	<div id="map-membres" class="map">
		<figure><img src="<?= $site->url() ?>/assets/images/reunion.png" width="140" height="140"></figure>
	</div>
	
	<nav id='filter-group' class='filter-group cf'></nav>
	
	
	<div id="liste-membres">
		<ul class="cf">

			<?php
			$markers = array(
				'type' => "FeatureCollection",
				'features' => array()
			);

			foreach( $page->children()->visible() as $membre ) :
				$logo = thumb( $membre->file($membre->logo()), array( 'width' => 300, 'grayscale' => false ) );
				$activites = $membre->activites()->split();
				$properties = [];
				foreach ($activites as $activite) {
					$properties['activite-' . $activite] = true;
				}
				$properties['uid'] = $membre->uid();
				$markers['features'][] = array(
					'type' => 'Feature',
					'properties' => $properties,
					'geometry' => array(
						'type' => 'Point',
						'coordinates' => array_map('floatval', array_reverse(explode(',', (string)$membre->location() )))
					)
				);
				?>

				<li data-uid='<?= $membre->uid() ?>' data-activites="<?= implode(' ', $membre->activites()->split()) ?>">
					<div class="wrapper">
						<a href="<?= $membre->url()?>" class="titraille">
							<?php if($logo->url() && $logo->name() != "index-225x225"): ?>
								<figure style="background-image:url(<?= $logo->url() ?>)"></figure>
							<?php else: ?>
								<figure class="placeholder"></figure>
							<?php endif ?>
							<h2 class="membre-prenom"><?= $membre->title() ?></h2>
						</a>
							<h3 class="membre-nom"><?= $membre->complement() ?></h3>
							<h3 class="membre-activites"><?php foreach($activites as $activite)	echo " — ".id2title($activite); ?></h3>
							<h3 class="membre-ville"><?= $membre->ville()." ({$membre->departement()}) " ?></h3>
						<a href="<?= $membre->url()?>">
							<h3 class="membre-more">Voir +</h3>
						</a>
					</div>
				</li>

				<?php
			endforeach;
			?>

		</ul>
	</div>
</main>

<script>
	var markers = <?php echo json_encode($markers) ?> ;
</script>

<?php snippet('footer') ?>