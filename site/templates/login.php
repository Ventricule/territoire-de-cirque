<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">



		<h1>Se connecter</h1>


		<?php if($error): ?>
		<div class="alert">Identifiant ou mot de passe incorrect</div>
		<?php endif ?>

		<br>

		<form method="post">
			<div>
				<label for="username">Identifiant</label><br>
				<input type="text" id="username" name="username">
			</div>
			<div>
				<label for="password">Mot de passe</label><br>
				<input type="password" id="password" name="password">
			</div>

			<br>

			<div>
				<input type="submit" name="login" value="Se connecter">
			</div>

			<br>
			
			<p><a href="<?= site()->url() ?>/reset" class="small">Réinitialiser mon mot de passe</a></p>
		</form>
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>
