<?php
$events = page('membres/actualites-des-membres')
					->children()
					->visible()
					->filterBy('membre', $membre, ',')
					->filter(function($child) {
						if ($end_date = (string)$child->end_date()) :
							return $end_date >= date('Y-m-d') ? true : false ;
						else :
							return (string)$child->start_date() >= date('Y-m-d') ? true : false ;
						endif;
					})
					->sortBy('start_date')
					->limit(3);
if(count($events)):
	?>
	<h2>Actualités</h2>
	<div class='events cf'>
		<?php
		foreach($events as $event) :
		?>

		<div class="event">
			<h2 class="event-date">
				<?= $event->date('%d.%m', 'start_date') ?>
				<?php if($enddate = $event->date('%d.%m', 'end_date')) echo ' > ' . $enddate ; ?>
			</h2>
			<h4 class="event-type"><?= $event->type() ?></h4>
			<h2 class="event-title"><a href="<?= $event->url() ?>"><?= $event->title() ?></a></h2>
			<h4 class="event-subtitle"><?= $event->subtitle() ?></h4>
		</div>


		<?php endforeach; ?>

	</div>

<?php endif; ?>

