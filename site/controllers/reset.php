<?php
return function ($site, $pages, $page) {
    // Honeypot trap for robots
    //if(r::is('post') and get('subject') != '') go(url('error'));
    // Process reset form
    if(r::is('post') and get('reset') !== null) {
        if (resetPassword(get('email'))) {
            $reset_message = 'Vous recevrez un e-mail contenant les instructions qui vous permettront de réinitialiser le mot se passe.';
        } else {
            $reset_message = 'Désolé, ce compte n’a pas été trouvé.';
        }
    } else {
        $reset_message = false;
    }
	// Pass variables to the template
	return [
		'reset_message' => $reset_message,
	];
};
