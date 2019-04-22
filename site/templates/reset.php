<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">

		<h1>Réinitialiser le mot de passe</h1>

    <?php if($reset_message) { ?>
      <p dir="auto" class="alert"><?= $reset_message ?></p>
    <?php } ?>

		<br>

		<form dir="auto" method="post">

			<div>
				<label for="email">E-mail</label><br>
				<input type="text" name="email">
			</div>

			<br>

			<input type="submit" name="reset" value="Réinitialiser le mot de passe">

			<br><br>

			<p class="small">Si vous ne vous souvenez pas de l'e-mail associé à votre compte <br> vous pouvez demander de l'aide à <a href="mailto:bonjour@pierretandille.fr">bonjour@pierretandille.fr</a></p>

    </form>

  </main>

<?php snippet('footer') ?>
