<?php 

return function($site, $pages, $page) {

	$query = get('q') ?: false ; $here = get('here'); $tag = get('tag'); $author = get('author'); $member = get('member'); $year = get('year'); $header = false;
		
  if( $query ) :
		$where = $here ? $page : page('ressources');
		$collection1 = $where->search($query, 'title|author|member');
		$collection2 = $where->search($query, 'tags|introduction');
		$collection3 = $where->search($query, 'text|exergue');
		$results = $collection1->merge($collection2->merge($collection3));
	elseif( $tag || $author || $member || $year ):
		if($here) :
			$results = $page->index();
		else:
  		$results = page('ressources')->index();
		endif;
	else :
		$results = $page->children();
		if( $edito = (string)$page->text()->kt() ) :
			$titraille = array(
				'folder' 			=> '<h4>' . 'Dossier' . '</h4>',
				'title' 			=> '<h2>' . $page->title() . '</h2>',
				'description' => '<h4>' . $page->exergue() . '</h4>'
			);
		else:
			$titraille = false;
		endif;
		$header = array(
			'cover' 		=> (string)$page->cover(),
			'titraille'	=> $titraille,
			'edito'			=> $edito
		);
	endif;
	
	$results = $results->visible()->sortBy('date', 'desc');
	
	$results = $tag 		? $results->filterBy('tags', '*=', $tag) 				: $results ;
	
	$results = $author 	? $results->filterBy('author', '*=', $author) 	: $results;
	
	$results = $member	? $results->filterBy('membre', '*=', $member)		: $results;
	
	if ( $year ) :
		$results = $results->filter(function($child) use(&$year){
			return $child->date('%Y') == $year;
		});
	endif;
	
	if(!$header):
		if( $results->count() > 0) :
			$count = $results->count();
			$header = array(
				'cover' 		=> false,
				'titraille'	=> array(
					'description' => $count == 1 ? "<h4>La recherche a retourné 1 résultat</h4>" : "<h4>La recherche a retourné $count résultats</h4>",
					'close' 			=> "<img src='{$site->url()}/assets/images/plus.svg'/>"
					),
				'edito'			=> false
			);
		else:
			$header = array(
				'cover' 		=> false,
				'titraille'	=> array(
					'description' => "<h4>La recherche n'a retourné aucun résultats</h4>",
					'close' 			=> "<img src='{$site->url()}/assets/images/plus.svg'/>"
				),
				'edito'			=> false
			);
		endif;
	endif;
	
  return array(
		'count'		=> $results->count(),
    'query'   => $query,
		'header'	=> $header,
    'results' => $results, 
  );

};