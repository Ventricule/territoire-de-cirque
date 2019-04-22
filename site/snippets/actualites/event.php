<?php
$membres = membres($event->membre());
?>
<div class="event color-<?= f::safeName($event->type()) ?> cf">
	<div class="event-dates">
		<?php $startdate = $event->date('%d.%m', 'start_date'); 		$enddate = $event->date('%d.%m', 'end_date') ?>
		<div class="start-date h2"><?= $startdate ?></div>
		<?php if($enddate && $enddate != $startdate) : ?><div class="end-date h2"><span> </span><?= $enddate ?></div><?php endif ?>
	</div>
	<div class="event-content">
		<h4><?= $event->type() ?></h4>
		<h4><?= $membres ?></h4>
		<h2><?= $event->title() ?></h2>
		<h4><?= $event->subtitle() ?></h4>
		<?php if(strlen((string)$event->text())>300): ?>
			<div class="event-text"><p><?= $event->text()->excerpt(200) ?> <a href="#" class="read-more">+</a></p></div>
			<div class="event-full-text"><?= $event->text()->kt() ?> <a href="#" class="read-less">-</a></div>
		<?php else: ?>
			<div class="event-text"><?= $event->text()->kt() ?></div>
		<?php endif ?>
	</div>
	<div class="event-image">
		<?php if ( $visuel = $event->file( $event->visuel() ) ): ?>
			<?php $imagecaption = $visuel ? $visuel->caption() : false ; ?>
			<?php $caption = (string)$event->caption() ?: $imagecaption; ?>
			<figure style="background-image:url('<?= $event->file($event->visuel())->resize(400)->url() ?>')">
				<figcaption><?= $caption ?></figcaption>
			</figure>
		<?php else: ?>
			<figure class="placeholder">
			</figure>
		<?php endif ?>
	</div>
</div>
