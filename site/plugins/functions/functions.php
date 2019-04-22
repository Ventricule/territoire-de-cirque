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
		if ( $user = $options['user']) {
			$items = $folder->children()->filterBy('membre', 'in', ['', $user]);
		}
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

function membres($membres){
	$membresArray = $membres->split();
	$membres = array();
	foreach($membresArray as $membre):
		if ($pagemembre = page('membres/les-membres/'.$membre)):
			$membres[] = $pagemembre->title();
		else:
			$membres[] = $membre;
		endif;
	endforeach;
	return $membres = implode($membres, ", ");
}

function resetPassword($email,$firstTime = false) {
  // Find the user
  $user = site()->users()->findBy('email',$email);
  if (!$user) return false;
  // Generate a secure random 32-character hex token
  do {
    $bytes = openssl_random_pseudo_bytes(16, $crypto_strong);
    $token = bin2hex($bytes);
  } while(!$crypto_strong);
  // Add the token to the user's profile
  $user->update([
    'token' => $token,
  ]);
  // Set the reset link
  $resetLink = url('token/'.$token);
  // Build the email text
  if ($firstTime) {
    $subject = 'Activez votre compte';
    $body = 'Votre e-mail est enregistré sur '.str_replace('www.', '', $_SERVER['HTTP_HOST']).'. Accédez au lien ci-dessous afin d’activer votre compte \n\n'.$resetLink.'\n\n Si vous n’avez pas créé ce compte, aucune action n’est requise. Le compte restera inactivé.';
  } else {
    $subject = 'Réinitialisez votre mot de passe';
    $body = 'Quelqu’un a demandé un nouveau mot de passe pour votre compte sur '.str_replace('www.', '', $_SERVER['HTTP_HOST']).'. Accédez au lien ci-dessous afin de réinitialiser votre mot de passe. \n\n'.$resetLink.'\n\n Si vous n’avez pas effectué cette action, aucune action n’est requise.';
  }
  // Send the confirmation email
  return sendMail($subject, $body, $user->email());
}

function sendMail($subject, $body, $to) {
  // Define from email address
  $from = 'noreply@'.str_replace('www.', '', server::get('server_name'));

  // Build email
  $email = new Email([
    'subject' => $subject,
    'body'    => $body,
    'to'      => $to,
    'from'    => $from,
  ]);
  // Log email
  if (c::get('mail.log') == true) {
    $file = kirby()->roots()->index().DS.'logs'.DS.'mail.log';
    $content = "\n\n----\n\n".date('Y-m-d H:i:s')."\n\n".yaml::encode($email);
    f::write($file, $content, true);
  }
  // Vaidate and send
  if (v::email($to) and v::email($from) and $email->send()) {
    return true;
  } else {
    return false;
  }
}
