<?php $comments = new Comments($page); ?>
<?php $status = $comments->process(); ?>

<h2><?= $page->title() ?></h2> 
<span class="delete">
	<i class="fa fa-trash" aria-hidden="true"></i>
	<span>
		<a href="<?= $site->url() ?>/api/espace-membre/forum/<?= $page->uid() ?>?action=delete">Cliquez ici</a> pour supprimer cette discussion.
	</span>
</span>
<?php if (!$comments->isEmpty()): ?>
    
  <?php foreach ($comments as $comment): ?>
    <article id="comment-<?php echo $comment->id() ?>" class="comment<?php e($comment->isPreview(), ' preview"') ?>">
      <h3>
        <?php echo preg_replace("/\([^)]+\)/","", $comment->name()); // remove parenthesis  ?>
      </h3>
      
      <aside class="comment-info">
        <?php if ($comment->isPreview()): ?>
          <p>Ceci est une prévisualisation de votre message. S'il vous convient, <a href="#submit">envoyer</a> le.</p>
        <?php else: ?>
          <p>
            <?php echo $comment->date('d.m.Y H:i') ?>
            <span class="delete">
							<i class="fa fa-trash" aria-hidden="true"></i>
							<span>
								<a href="<?= $site->url() ?>/api/espace-membre/forum/<?= $page->uid() ?>/comments/comment-<?= $comment->id() ?>?action=delete">Cliquez ici</a> pour supprimmer ce message.
							</span>
						</span>
          </p>
        <?php endif ?>
      </aside>
      
      <?php echo $comment->message() ?>
      
      <div class="attachment">
      	<?php 
				if($files = $comment->website()) :
					$files = explode(',', $files);
						?>
						<ul class="cf">
							<?php foreach($files as $file): ?>
								<?php $file = page(dirname($file))->file(basename($file)); ?>
								<li class="item" data-url="<?= $file->uri() ?>">
									<a href="<?= $file->url() ?>">
										<figure class="cf">
											<?php if ($file->type() == 'image'): ?>
												<?= thumb($file, array('width' => 64, 'height' => 64, 'crop' => true)) ?> 
											<?php else: ?>
												<span class='extension'><?= strtoupper($file->extension()) ?></span>
											<?php endif ?>
											<figcaption><?= $file->filename() ?></figcaption>
										</figure>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					<?php
				endif;
				?>
      </div>
    </article>
  <?php endforeach ?>
<?php endif ?>

<?php if ($comments->userHasSubmitted()): ?>
<p class="thank-you">
	Message envoyé.<br> 
	<a href="<?= page('espace-membre/forum')->url() ?>"><i class="fa fa-hand-o-left" aria-hidden="true"></i>
 	Retour</a>
</p>
<?php else: ?>
 	<div class="comment-form cf">

		<?php if ($status->isUserError()): ?>
			<p id="comment-<?php echo $comments->nextCommentId() ?>" class="error">
				<?php echo $status->getMessage() ?>
			</p>
		<?php endif ?>
		
		<?php
		$username = $usermail = false;
		if($user = $site->user()) {
			$username = $user->firstName() . ' ' . $user->lastName() . ' (' . $user->username() .')' ;
			$usermail = $user->email();
		}
		?>
		
		<form action="#comment-<?php echo $comments->nextCommentId() ?>" method="post" accept-charset="utf-8">
			<label for="name">Name<abbr title="required">*</abbr></label>
			<input type="text" name="name" value="<?php echo $username ?: 'Anonyme' ?>" id="name" maxlength="<?php echo $comments->fieldMaxlength() ?>" required>

			<label for="email">Email Address<?php if ($comments->requiresEmailAddress()): ?><abbr title="required">*</abbr><?php endif ?></label>
			<input type="email" name="email" value="<?php echo $usermail ?>" id="email" maxlength="<?php echo $comments->fieldMaxlength() ?>" <?php e($comments->requiresEmailAddress(), 'required') ?>>

			<label for="website">Website</label>
			<input name="website" value="<?php echo $comments->value('website') ?>" id="website">

			<?php if ($comments->isUsingHoneypot()): ?>
				<div style="display: none" hidden>
					<input type="text" name="<?php echo $comments->honeypotName() ?>" value="<?php echo $comments->value($comments->honeypotName()) ?>">
				</div>
			<?php endif ?>

			<label for="message">Message<abbr title="required">*</abbr></label>
			<div class="editable"><?= $comments->value('message') ? kirbytext($comments->value('message')) : false ; ?></div>
			<textarea name="message" id="message" maxlength="<?php echo $comments->messageMaxlength() ?>" required><?php echo $comments->value('message') ?></textarea>
			

			<input type="hidden" name="<?php echo $comments->sessionIdName() ?>" value="<?php echo $comments->sessionId() ?>">

			<?= snippet('modules/documents-partages', array('comments'=>$comments)) ?>
			
		</form>
	</div>
<?php endif ?>