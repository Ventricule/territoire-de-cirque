<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
  	<?php
		$pageUri = (string)$page->folderUri();
		$pageToShow = page($pageUri);
		$explorer = (string)$page->subpages();
		$restrictedTo = $page->restrictedTo()->split();

		if($user = $site->user()):
			if(in_array($user->role(), $restrictedTo)):

				// Est ce que l'utilisateur a une page membre ?
				$pageMembre = false;
				if($user = $site->user()):
					$pageUri = $pageUri == "user" ? "users/".$user->username() : $pageUri ;
					$pageToShow = page($pageUri);
					if($pageMembreUid = $user->pagemembre()):
						$pageMembre = page('membres/les-membres/' . $pageMembreUid);
					endif;
				endif;

				// Si oui, est-ce qu'on se trouve actuellement sur sa page associé ? Si oui, afficher sa page perso.
				if($pageMembre && $pageToShow) :
					if($pageMembre->isChildOf($pageToShow)) :
						$pageToShow = $pageMembre;
						$explorer = false;
					endif;
				endif;
				if($pageToShow):
					$pageUri = (string)$pageToShow->uri();
				endif;

				if($explorer):
				?>
					<div id="explorer">
						<div id="list-subpages" data-uri="<?= $pageUri ?>" data-folders="<?= (string)$page->subpages() ?>" data-navigate="<?= (string)$page->navigate() ?>" data-templates="<?= $pageToShow->templates() ?>">
						</div>
					</div>
				<?php endif ?>
				<?php
				$src = $pageToShow ? $site->url() . "/panel/pages/$pageUri/edit" : $site->url() . "/panel/$pageUri/edit" ;
				?>
				<div class="iframe-wrapper <?= $explorer ? '' : 'wide' ; ?>">
					<iframe src="<?= $src ?>"></iframe>
				</div>

			<?php
			else:
			?>
				<p><?= $page->message()->kt() ?></p>
			<?php
			endif;
		endif;
		?>
  </main>

<?php snippet('footer') ?>
