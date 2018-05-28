<?php
function id2title($id) {
	$id = str_replace('activite-', '', $id); 
	switch ($id) {
		case 'diffusion':
			return 'Lieu de diffusion';
			break;
		case 'residence':
			return 'Lieu de résidence';
			break;
		case 'chapiteau':
			return 'Espace chapiteau';
			break;
		case 'polenationnal':
			return 'Pôle national';
			break;
		case 'festival':
			return 'Festival';
			break;
		case 'formation':
			return 'Formation professionnelle';
			break;
		case 'all':
			return 'Tous les membres';
			break;
		default:
			return id;
			break;
	}
	return false;
}

function subpages($uri, $options = array()) {

  // default values
  $defaults = array(
    'user'					    => false
  );

  // merge defaults and options
  $options = array_merge($defaults, $options);
	
	$folder = page($uri);
	$subpages = array();
	$subpages[] = array(
		'uid' => (string)$folder->uid(),
		'uri' => (string)$folder->uri(),
		'title' => (string)$folder->title(),
		'date' => (string)$folder->date(),
		'start_date' => (string)$folder->start_date(),
		'end_date' => (string)$folder->end_date(),
		'template' => (string)$folder->intendedTemplate(),
		'parent' => 'parent',
		'visibility' => $folder->isVisible() ? 'visible' : 'invisible'
	);
	
	// Pages à restriction d'accès
	if (in_array($folder->uid(), array('actualites-des-membres'))) {
		if ( $user = $options['user']) {
			$items = $folder->children()->filter(function($child){
				global $user;
				return in_array($user, $child->membre()->split());
			});
			$items = $folder->children()->filterBy('membre', $user);
		} else {
			$items = $folder->children();
		}
	} else {
		$items = $folder->children();
	}
	$items = $items->sortBy('start_date', 'desc');
	// Lister les sous-pages
	foreach($items as $subpage):
		$subpages[] = array(
			'uid' => (string)$subpage->uid(),
			'uri' => (string)$subpage->uri(),
			'title' => (string)$subpage->title(),
			'date' => (string)$subpage->date(),
			'start_date' => (string)$subpage->start_date(),
			'end_date' => (string)$subpage->end_date(),
			'template' => (string)$subpage->intendedTemplate(),
			'parent' => 'child',
			'visibility' => $subpage->isVisible() ? 'visible' : 'invisible'
		);
	endforeach;
	return $subpages;
}

function createPage($uri, $template, $data) {
	
	if ($uid = $data['title']):
		
		$uid = f::safeName($uid);
	
		if( page($uri.'/'.$uid) ):
			$newname = $uid;
			$counter = 2;
			while (page($uri.'/'.$newname)) {
				 $newname = $uid .'-'. $counter;
				 $counter++;
			}
			$uid = $newname;
		endif;
		
		try {

			$newPage = page($uri)->children()->create($uid, $template, $data);
			return array('uri' => $newPage->uri());

		} catch(Exception $e) {

			return array('error' => $e->getMessage());

		}
	
	endif;

}