<?php snippet('header') ?>
<?php snippet('menus/menu') ?>

	<div id="left-side">
		<?php snippet('menus/menu-second') ?>
	</div>

  <main id="panel" class="main wide cf" role="main">
  	<div id="new">
  		<form action="<?= $site->url() ?>/api/espace-membre/forum/" method="get" accept-charset="utf-8">
  			<input type="text" required name="title" value="" id="topic" placeholder="Décrivez le sujet de votre discussion en quelques mots.">
  			<input type="hidden" name="template" value="discussion">
  			<input type="hidden" name="action" value="create">
  			<input type="hidden" name="redirect" value="1">
  			<input type="submit" name="submit" value="Créer" id="submit">
  		</form>
  	</div>
		<ul class="discourses">
			<li class="discourse header">
				<div class="title">
					<span>Sujet</span>
				</div>
				<div class="users">
					<span>Participants</span>
				</div>
				<div class="reply">
					<span>Réponses</span>
				</div>
				<div class="activity">
					<span>Activité</span>
				</div>
			</li>
			<?php foreach($page->children()->sortBy('date', 'desc') as $discussion) : ?>
			
				<?php
				$users = array();
				$replies = 0;
				$activity = $discussion->date('%d.%m');
				if($comments = $discussion->find('comments')):
					if ($comments->children()->count()):
						$comments = $comments->children();
						$users = $comments->pluck('name', null, true);
						$replies = $comments->count() - 1;
						$activity = $comments->last()->date('%d.%m');
					endif;
				endif;
				?>
				<li class="discourse">
					<div class="title">
						<a href="<?= $discussion->url() ?>"><?= $discussion->title() ?></a>
					</div>
					<div class="users">
						<?php if($users): ?>
							<?php foreach($users as $user): ?>
								<?php $userletter = substr($user, 0, 1); ?>
								<div class="user infobulle" data-info="<?= strpos($user,'(') ? substr($user, 0, strpos($user,'(') ) : $user ?>"><span class='letter'><?= $userletter ?></span></div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
					<div class="reply">
						<span><?= $replies ?></span>
					</div>
					<div class="activity">
						<span><?= $activity ?></span>
					</div>
				</li>
			<?php endforeach ?>
		</ul>
  </main>

<?php snippet('footer') ?>