<?php

$kirby->set('template',     'letter',             __DIR__ . '/templates/letter.php');
$kirby->set('template',     'section-letter',     __DIR__ . '/templates/section-letter.php');
$kirby->set('snippet',      'letter-footer', __DIR__ . '/snippets/letter-footer.php');
$kirby->set('snippet',      'letter-header', __DIR__ . '/snippets/letter-header.php');
$kirby->set('blueprint',    'letter', __DIR__ . '/blueprints/letter.yml');
$kirby->set('blueprint',    'section-letter', __DIR__ . '/blueprints/section-letter.yml');

function redchimp() {
  return true;
}
