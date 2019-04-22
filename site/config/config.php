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

c::set('license', 'K2-PRO-c8f460446beb3096f09cd2b8c68ac31a');

c::set('debug', true);

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('plugin.embed.video.lazyload', false);

c::set('geolocation-key', 'AIzaSyDraEiI_zrPNxq44oPwzfw3Xk0ys28LljY');

c::set('panel.widgets', array(
  'pages'    		=> true,
  'account'  		=> true,
  'site'     		=> true,
	'astuces'			=> true,
  'history'  		=> true,
	'content-viewer'			=> true,
));


// Language

c::set('date.handler', 'strftime');

c::set('language.detect', false);

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

// Files types jpg, gif, png, svg
f::$types['imageweb'] = array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'svg');

// Medium editor
c::set('field.wysiwyg.dragdrop.kirby', true);
c::set('field.wysiwyg.dragdrop.medium', true);
c::set('field.wysiwyg.buttons', array('h1','h3', 'bold', 'italic', 'anchor', 'superscript', 'quote', 'orderedlist', 'unorderedlist', 'removeFormat'));

// Typography paramètres (pour les paramètres régionaux, voir dans site/languages/ )
/*c::set('typography', false);
c::set('typography.hyphenation', false);
c::set('typography.hyphenation.titlecase', false); // Allow hyphenation of words that begin with a capital letter. Disable to avoid hyphenation of proper nouns.
c::set('typography.debug', false); */

// Comments
c::set('comments.use.email', true);
c::set('comments.email.to', array('pierretandille@gmail.com'));
c::set('comments.email.subject', 'Nouveau message sur {{ page.title }}');
c::set('comments.allowed_tags', "<p><br><a><em><i><b><strong><code><pre><blockquote>");
c::set('comments.max-field-length', 99999);

// Backend

c::set('panel.stylesheet', '/assets/css/panel.css');

c::set('markdown.extra', true);

c::set('roles', array(
  array(
    'id'      => 'admin',
    'name'    => 'Administrateur',
    'panel'   => true
  ),
  array(
    'id'      => 'membre',
    'name'    => 'Membre',
		'default' => true,
    'panel'   => true
  ),
  array(
    'id'      => 'visiteur',
    'name'    => 'Visiteur',
    'panel'   => false
  )
));

c::set('routes', array(
  array(
    // Password reset and account opt-in verification
    'pattern' => 'token/([a-f0-9]{32})',
    'action' => function($token) {
      $site = site();
      // Log out any active users
      if($u = $site->user()) $u->logout();
      // Find user by token
      if ($user = $site->users()->findBy('token',$token)) {
        // Make sure the user has a non-nobody role assigned
        // if ($user->role() == 'nobody') $user->update(['role' => 'customer']);
        // Destroy the token
        $user->update(['token' => null]);
        // Log in
        if ($user->loginPasswordless()) {
          return go('/espace-membre/mon-profil');
        } else {
          return go('/');
        }
      } else {
        return go('/');
      }
    }
  ),
  array(
		'pattern' => 'api/(:all)',
		'method' => 'GET',
		'action'  => function($page_uri) {
			header('Content-Type: application/json');

			$action = get('action');

			switch ($action) :

				case 'subpages':
					// Est ce que l'utilisateur est enregistré ?
					if( $user = site()->user() ):
						// Est ce que l'utilisateur a une page membre ?
						if($pageMembreUid = $user->pagemembre()):
							$pageMembre = page('membres/les-membres/' . $pageMembreUid)->uid();
						else:
							$pageMembre = false;
						endif;
					else :
						$pageMembre = false;
					endif;
					$response['subpages'] = subpages($page_uri, array('user' => $pageMembre));
					$response['templates'] = page($page_uri)->templates();
					$response['pageMembre'] = $pageMembre;
					return response::json($response);
					break;

				case 'create':
					$user = site()->user();
					if( (string)$user && $template = get('template') ):
						if($user->hasRole('membre')):
							$data = array('membre' => $user->pagemembre(), 'title' => get('title'));
						else:
							$data = array('title' => get('title'));
						endif;
						if(in_array($template, array('actualite'))):
							$data['start_date'] = date('Y-m-d');
						endif;
						if(in_array($template, array('discussion'))):
							$data['date'] = date('Y-m-d H:i');
						endif;
						$newpage = createPage($page_uri, $template, $data);
						if(get('redirect')):
							return go($newpage['uri']);
						else:
							return response::json($newpage);
						endif;
					endif;
					return false;
					break;

				case 'delete':
					$user = site()->user();
					if( (string)$user ):

						$page = page($page_uri);
						if (in_array($page->intendedTemplate(), array('discussion', 'comment'))):
							$page->delete(true);
						endif;
						if ($page->intendedTemplate() == 'comment'):
							return go(dirname(dirname($page_uri)));
						else:
							return go(dirname($page_uri));
						endif;

					endif;
					return false;
					break;

				default:
					return false;
					break;

			endswitch;
		}
	)
));
c::set('route',[

]);
