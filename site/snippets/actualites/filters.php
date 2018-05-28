<div id="filtersbar" class="filters cf">

	<?php
	function filterBtn($select, $param, $name) {
		$class = param($param) ? 'selected' : '' ;
		if($value = param($param)) :
			$selected = $param == 'membre' ? page('membres/les-membres/'.$value)->title() : param($param) ;
			$selected = '<div class="tag">' . $selected . ' <a class="close" href="'.page()->url().'">×</a></div>' ;
		else:
			$selected = false;
		endif;
		
		return "<li data-select='by-$select' class='$class'><span>$name</span> $selected</li>";
	}
	?>
	
	<div class="filters-types-list cf">
		<!--<div class="filtre-menu infos">
			Filtres :
		</div>-->
		<div class="selector infos">
			<ul class="cf">
				<?= filterBtn('type', 'type', 'Thématique') ?>
				<?= filterBtn('membre', 'membre', 'Membre') ?>
				<?= filterBtn('compagnie', 'compagnie', 'Compagnie') ?>
				<?= filterBtn('spectacle', 'spectacle', 'Spectacle') ?>
				<?= filterBtn('start_date', 'annee', 'Année') ?>
			</ul>
		</div>
	</div>
	
	
	<?php snippet('actualites/filters-group', array('filterName' => 'type', 'format' => 'list')) ?>
	<?php snippet('actualites/filters-group', array('filterName' => 'membre', 'format' => 'list')) ?>
	<?php snippet('actualites/filters-group', array('filterName' => 'compagnie', 'format' => 'list')) ?>
	<?php snippet('actualites/filters-group', array('filterName' => 'spectacle', 'format' => 'list')) ?>
	<?php snippet('actualites/filters-group', array('filterName' => 'start_date', 'format' => 'list')) ?>
	
</div>
