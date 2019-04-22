<?php snippet('header') ?>

	<div id="dots"></div>

	<div id="maintenance-img"><img src="<?= $site->url() ?>/assets/images/logo.svg"></div>

	<div id="maintenance-title"><h4>Le nouveau site sera bientôt en ligne</h4></div>

	<div id="maintenance-text"><h4><a href='http://mutualise.artishoc.com/cirque/'>Ancien site</a></h4></div>

	<div id="maintenance-login" class="login-popup">
		<?php if($error): ?>
		<div class="alert">Identifiant ou mot de passe incorrect</div>
		<?php endif ?>

		<form method="post">
			<div><p>Accès membre</p><br></div>
			<div>
				<input type="text" id="username" name="username" placeholder="Identifiant">
			</div>
			<div>
				<input type="password" id="password" name="password" placeholder="Mot de passe">
			</div>
			<div>      
				<input type="submit" name="login" value="Se connecter">
			</div>
		</form>
	</div>

<?php snippet('footer') ?>