<div class="events-month">
	<?php if ( (string)$event->end_date() ):
		$uDate = strtotime( (string)$event->end_date() ) ;
	else:
		$uDate = strtotime( (string)$event->start_date() ) ;
	endif; ?>
	<?php if( strftime('%Y%m', $uDate) == strftime('%Y%m') ) :
		$text = "Ce mois ci";
	elseif(strftime('%Y%m', $uDate) > strftime('%Y%m')) :
		$text = "À venir";
	else :
		$text = "Passé";
	endif;
	?>
	<div class="relative"><?= $text ?></div>
	<div class="month"><?= utf8_encode(strftime('%B', $uDate)) ?></div>
	<div class="year"><?= utf8_encode(strftime('%Y', $uDate)) ?></div>
	<div class="forme ligne"></div>
</div>