<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/siblings', array('page' => $page)) ?>
</div>

<main class="main wide" role="main">
	
	
	<div id="map-membres" class="map"><nav id='filter-group' class='filter-group'></nav></div>
	
	
	<div id="liste-membres">
		<ul class="cf">

			<?php
			$markers = array(
				'type' => "FeatureCollection",
				'features' => array()
			);

			foreach( $page->children() as $membre ) :
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
					<a href="<?= $membre->url()?>" class="titraille">
						<figure><img src='<?= $logo->url() ?>' width='<?= $logo->width() ?>' height='<?= $logo->height() ?>'/></figure>
						<h2 class="membre-prenom"><?= $membre->title() ?></h2>
					</a>
						<h3 class="membre-nom"><?= $membre->complement() ?></h3>
						<h3 class="membre-activites"><?php foreach($activites as $activite)	echo " — ".id2title($activite); ?></h3>
						<h3 class="membre-ville"><?= $membre->ville()." ({$membre->departement()}) " ?></h3>
					<a href="<?= $membre->url()?>">
						<h3 class="membre-more">Voir +</h3>
					</a>
					

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