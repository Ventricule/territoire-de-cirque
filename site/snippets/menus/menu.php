<div id="logo-tdc" class="main">
	<a href="<?= $site->url() ?>">
		<img class="logo-anime" src="<?= $site->url() ?>/assets/images/logo-anime.gif">
	</a>
</div>

<div class="toggle-button">Menu</div>

<?php
function getMenuButton($item) {
	$list = $item->children()->visible();
	$class = $item->isActive() ? ' class="Selected" ' : '' ;
	$vertical = (string)$item->depth() < 2 ?  " class='Vertical' " : "" ;
	$menu = '';
	if((string)$list->count() ):
		$menu .= "<li $class>";
		$menu .= "<a $class href='{$item->url()}'>{$item->title()}</a>";
		$menu .= "<ul>";
		foreach($list as $child) :
			$menu .= getMenuButton($child);
		endforeach;
		$menu .= '</ul>';
		$menu .= '</li>';
	else:
		$menu .= "<li $class><a href='{$item->url()}'>{$item->title()}</a></li>";
	endif;
	return $menu;
}
?>

<nav id="main-menu" role="navigation">
	<ul>
		<li><a href='<?= $site->url() ?>'>Accueil</a></li>
		<?php
		foreach($site->children()->visible() as $rubrique):
			echo getMenuButton($rubrique);
		endforeach;
		?>
	</ul>
</nav>

<nav id="main-menu-not-mobile" role="navigation">
	
	<div id="menu-wrapper">
		<ul class="menu nav-font cf">
			<?php
			foreach($site->children()->visible() as $rubrique):
				if($rubrique->uid() != 'espace-membre' || $site->user() ):
				?>
					<li class='btn-<?= $rubrique->uid() ?>'><a <?= (string)$rubrique->isOpen() ? ' class="active"' : '' ?> href="<?= $rubrique->url() ?>"><?= $rubrique->title() ?></a></li>
				<?php
				endif;
			endforeach;
			?>
			<li>
				<div class="lang-switcher">
					<?php foreach($site->languages() as $language): ?>
						<?php if ($site->language() != $language): ?>
						<a href="<?php echo $page->url($language->code()) ?>">
							<?php echo html($language->code()) ?>
						</a>
						<?php else : ?>
							<span class="active"><?php echo html($language->code()) ?></span>
						<?php endif; ?>
					<?php endforeach ?>
				</div>
			</li>
			<li><a href="#" class="btn-menu-plus"><img src="<?= $site->url() ?>/assets/images/plus.svg" alt="Suivre" title="Suivre" /></a></li>
		</ul>
		
		
		<div class="line"></div>

		<div id="menu-plus">
			<div class="columns columns-3">
				<div class="column">
					<a class="noborder" href="<?= $site->facebook() ?>"><img src="<?= $site->url() ?>/assets/images/F_icon.svg"></a>
				</div>
				<div class="column">
					<a class="noborder" href="#"><img src="<?= $site->url() ?>/assets/images/T_icon.svg"></a>
				</div>
				<div class="column">
					<a class="noborder" href="https://my.sendinblue.com/users/subscribe/js_id/2c0cg/id/1/email/"><h2 class="btn-newsletter">Newsletter</h2></a>
					<!--<form action="">
					<h2>Newsletter</h2>
					<input type="text" name="mail" placeholder="auguste@mail.com"><br>
					<input type="submit" value="Inscription">
					</form> -->
				</div>
			</div>
			<?php if ($site->user()): ?>
			<div class="btn-acces-membre">
				<a class="noborder" href="<?= page('login')->url() ?>?logout=1"><span>Dé-<br>connexion</span></a>
			</div>
			<?php else : ?>
			<div class="btn-acces-membre">
				<a class="noborder" href="<?= page('login')->url() ?>"><span>Connexion membre</span></a>
			</div>
			<?php endif ?>
		</div>
		
	</div>
	
</nav>
