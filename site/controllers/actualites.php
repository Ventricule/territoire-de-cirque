<?php

return function($site, $pages, $page) {

	$filteredBy = false;
	
	$events = $page->children()->visible()->sortBy('start_date');

	if (param('annee')) :
		$filter = function($child){
			return (string)$child->date('%Y', 'start_date') == param('annee');
		};
		$events = $events->filter($filter)->sortBy('start_date', 'asc');
		$direction = 'none';
		$filteredBy = 'annee';
	endif;

	if ($value = param('type')) :
		$events = $events->filterBy('type', urlDecode($value), ',') ;
		$direction = 'none';
		$filteredBy = 'type';
	endif;

	if ($value = param('spectacle')) :
		$events = $events->filterBy('spectacle', urlDecode($value), ',') ;
		$direction = 'none';
		$filteredBy = 'spectacle';
	endif;

	if ($value = param('compagnie')) :
		$events = $events->filterBy('compagnie', urlDecode($value), ',') ;
		$direction = 'none';
		$filteredBy = 'compagnie';
	endif;

	if ($value = param('membre')) :
		$events = $events->filterBy('membre', urlDecode($value), ',')->flip() ;
		$direction = 'none';
		$filteredBy = 'membre';
	endif;

	if(!$filteredBy):
		$filter = function($child){
			if((string)$child->end_date()) :
				return $child->end_date() >= date('Y-m-d');
			else :
				return $child->start_date() >= date('Y-m-d');
			endif;
		};
		$events = $events->filter($filter)->sortBy('start_date');
		$direction = 'futur';
	endif;

  return array(
    'events' => $events,
    'direction' => $direction,
		'filteredBy' => $filteredBy
  );

};
