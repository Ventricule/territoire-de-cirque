<?php

page::$methods['templates'] = function($page) {
	$blueprint = kirby()->roots->blueprints() . DS . $page->intendedTemplate() . '.yml';
	$blueprint = yaml::read($blueprint);
	$pages = isset($blueprint['pages']) ? $blueprint['pages'] : false ;
	$template = isset($pages['template']) ? $pages['template'] : false ;
	$template = is_array($template) ? implode(',',$template) : $template;
  return $template;
};