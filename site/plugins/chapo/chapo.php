<?php

/**
 * Chapo Plugin
 *
 * @author Pierre Tandille pour TDC
 * @version 1.0.0
 */
kirbytext::$pre[] = function($kirbytext, $text) {

  $text = preg_replace_callback('!\(chapo(…|\.{3})\)(.*?)\((…|\.{3})chapo\)!is', function($matches) use($kirbytext) {
		
		$chapo = $matches[2];
		
		$field = new Field($kirbytext->field->page, null, trim($chapo));
    
		$html = kirbytext($field);
		
		return '<div class="chapo h3">' . $html . '</div>';

  }, $text);

  return $text;

};
