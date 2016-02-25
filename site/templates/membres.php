<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

<div id="left-side">
	<?php snippet('menus/siblings', array('page' => $page)) ?>
</div>

<main class="main wide" role="main">
	<div id="map-membres" class="map"><nav id='filter-group' class='filter-group'></nav></div>
	
	
	<div id="liste-membres">
		<h2>Liste</h2>
		<ul class="cf">

			<?php
			$markers = array(
				'type' => "FeatureCollection",
				'features' => array()
			);

			foreach( $page->children() as $membre ) :
				$logo = $membre->file($membre->logo())->resize(300, 300);
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

				<li data-uid='<?= $membre->uid() ?>'>
					<a href="<?= $membre->url()?>">
						<figure><img src='<?= $logo->url() ?>' width='<?= $logo->width() ?>' height='<?= $logo->height() ?>'/></figure>
						<h2><?= $membre->title() ?></h2>
						<h3><?= $membre->complement() ?></h3>
					</a>
					<p class="ville"><?= $membre->ville()." ( {$membre->departement()} ) " ?></p>

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