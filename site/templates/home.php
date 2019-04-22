<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<main id="panel" class="main superwide cf" role="main">

		<?= snippet("home/actualites-principales", array('page' => $page)) ?>

		<?= snippet("home/actualites-secondaires", array('page' => $page)) ?>

		<?= snippet("home/actualites-membres", array('page' => $page)) ?>

	</main>

<?php snippet('footer') ?>
