<?php

kirbytext::$tags['forme'] = array(
  'html' => function($tag) {
		switch ( $tag->attr('forme') ) :
			case 'cercle':
				return '<div class="forme cercle"></div>';
				break;
			default:
				return false;
				break;
		endswitch;
  }
);