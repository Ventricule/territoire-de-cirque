<?php
switch ($format):
	case 'btn':
	?>

	<div class="filters-group as-btn by-<?= $filterName ?> <?= param($filterName) ? 'selected' : '' ; ?>">
		<?php
		$tagcloud = tagcloud($page, array('field' => $filterName, 'param' => $filterName, 'sort' => 'results'));
		foreach($tagcloud as $filter) :
			?>
			<h2 class="color-<?= f::safeName($filter->name()) ?> <?= $filter->isActive() ? 'selected' : '' ; ?> <?= !$filter->isActive() && param($filterName) ? 'unselected' : '' ; ?>">
				<a href='<?= $filter->url() ?>'><?= $filter->name() ?></a>
				<span class="close"><a href='<?= $page->url() ?>'> ×</a></span>
			</h2>
		<?php endforeach ?>
	</div>

<?php
	break;
	case 'list':
					 
	if($filterName == 'start_date'):
		$tagcloud = tagcloud($page, array('field' => $filterName, 'param' => 'annee', 'sort' => 'results', 'map' => true));
	else:
		$tagcloud = tagcloud($page, array('field' => $filterName, 'param' => $filterName, 'sort' => 'results'));
	endif;
?>

	<div class="filters-group as-list by-<?= $filterName ?>">
		<?php
		foreach($tagcloud as $filter) :
			 if($filterName == 'membre') {
				 $pagemembre = page('membres/les-membres/'.$filter->name());
				 if($pagemembre) {
					 $name = $pagemembre->title();
				 } else {
					 $name = $filter->name() ;
				 }
				 
			 } else {
				 $name = $filter->name() ;
			 }
			//$name = $filterName == 'membre' ? page('membres/les-membres/'.$filter->name())->title() : $filter->name() ;
			
			?>
			<p class='infos <?= $filter->isActive() ? 'selected' : 'unselected' ?>'>
				<a href='<?= $filter->url() ?>'><?= $name ?> <?php //$filter->results(); ?></a>
			</p>
		<?php endforeach ?>
	</div>

<?php
	break;
endswitch;
						