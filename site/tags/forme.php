<?php

kirbytext::$tags['forme'] = array(
  'html' => function($tag) {
		switch ( $forme = $tag->attr('forme') ) :
			case 'cercle':
				return '<div class="forme cercle"></div>';
				break;
			default:
				return "<div class='forme $forme'></div>";
				break;
		endswitch;
  }
);