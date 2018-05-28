<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main cf" role="main">
		<?php if($user = $site->user()): ?>
			<div class="comments">
				<?php snippet('comments', array('page'=>$page)) ?>
			</div>
		<?php endif; ?>
  </main>

<?php snippet('footer') ?>