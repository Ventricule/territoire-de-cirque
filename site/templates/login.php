<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">
		<?php if($error): ?>
		<div class="alert">Identifiant ou mot de passe incorrect</div>
		<?php endif ?>

		<form method="post">
			<div>
				<label for="username">Identifiant</label>
				<input type="text" id="username" name="username">
			</div>
			<div>
				<label for="password">Mot de passe</label>
				<input type="password" id="password" name="password">
			</div>
			<div>      
				<input type="submit" name="login" value="Se connecter">
			</div>
		</form>
  </main>

	<div id="right-side">
		<?php snippet('modules/gallery') ?>
	</div>

<?php snippet('footer') ?>