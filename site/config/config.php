<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your license key here');

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('languages', array(
	array(
    'code'    => 'fr',
    'name'    => 'Français',
    'locale'  => 'fr_FR',
    'url'     => '/',
		'default' => true,
  ),
  array(
    'code'    => 'en',
    'name'    => 'English',
    'locale'  => 'en_US',
    'url'     => '/en',
  )
));

c::set('language.detect', false);

c::set('markdown.extra', true);

c::set('roles', array(
  array(
    'id'      => 'admin',
    'name'    => 'Admin',
    'default' => true,
    'panel'   => true
  ),
  array(
    'id'      => 'editor',
    'name'    => 'Editor',
    'panel'   => true
  ),
  array(
    'id'      => 'membre',
    'name'    => 'Membre',
    'panel'   => true
  )
));


/*

---------------------------------------
Site functions
---------------------------------------

*/

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
			return 'Pôle nationnal';
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